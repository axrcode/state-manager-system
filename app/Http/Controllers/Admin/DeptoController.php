<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeptoController extends Controller
{
    private $empresa;
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::first();

        //  Permisos
        $this->middleware('can:admin/departamentos')->only('index');
        $this->middleware('can:admin/departamentos/create')->only('create', 'store');
        $this->middleware('can:admin/departamentos/show')->only('show');
        $this->middleware('can:admin/departamentos/edit')->only('edit', 'update');
        $this->middleware('can:admin/departamentos/delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::all();

        return view('admin.departamentos.index', [
            'departamentos' => $departamentos,
            'empresa' => $this->empresa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string'
        ]);

        DB::beginTransaction();

        $depto = new Departamento;
        $depto->nombre = $request->nombre;
        $depto->save();

        DB::commit();

        return redirect()
        ->route('admin.departamentos.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Departamento creado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        return abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $this->validate($request, [
            'nombre' => 'required|string'
        ]);

        DB::beginTransaction();

        $departamento->nombre = $request->nombre;
        $departamento->save();

        DB::commit();

        return redirect()
        ->route('admin.departamentos.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Departamento actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $empleados_depto = Empleado::where('departamento_id', $departamento->id)->get();

        if ( sizeof($empleados_depto) > 0 ) {

            if ( $departamento->estado == 'activo' ) {
                $departamento->estado = 'inactivo';
                $msg = 'El departamento ha sido inactivado ya que tiene empleados asociados. Esto desactiva el acceso a los usuarios';
                $status = 'info';
            } else {
                $departamento->estado = 'activo';
                $msg = 'Departamento activado nuevamente';
                $status = 'success';
            }

            $departamento->save();

            return redirect()
            ->route('admin.departamentos.index')
            ->with('process_result', [
                'status' => $status,
                'content' => $msg
            ]);
        } else {

            $departamento->delete();

            return redirect()
            ->route('admin.departamentos.index')
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Departamento eliminado correctamente'
            ]);
        }
    }
}
