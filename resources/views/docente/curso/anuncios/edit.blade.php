@extends('layouts.app')

@section('head')

    <title>Editar Anuncio - {{ $curso->nombre }} - {{ $curso->grado->nombre }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="wrapper">

    <!--    Navbar    -->
    @include('layouts.navbar')

    <!--    Main Sidebar Container    -->
    @include('layouts.drawer')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper text-sm">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 mb-2">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-book mr-1"></i>
                            {{ $curso->nombre }}
                        </h1>
                    </div>
                    <div class="col-12 mb-2">
                        <h4 class="text-dark m-0">
                            <a  href=""
                                class="text-dark">
                                {{ $curso->grado->nombre }} {{ $curso->grado->seccion }}
                            </a>
                        </h4>
                    </div>
                    <div class="col-12">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item">
                                <a href="{{ route('docente.curso.index') }}">
                                    {{ __('Courses')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">
                                    {{ $curso->grado->nombre }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $curso->nombre }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a  href="{{ route('docente.curso.anuncios.index', [$curso->id]) }}"
                                                class="nav-link active">
                                                Anuncios
                                            </a>
                                            <a  href="{{ route('docente.curso.actividades.index', [$curso->id]) }}"
                                                class="nav-link">
                                                Actividades
                                            </a>
                                            <a  href=""
                                                class="nav-link">
                                                Material de Aprendizaje
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-9">

                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <form action="{{ route('docente.curso.anuncios.update', [$curso->id, $anuncio->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-12">
                                                    <h3 class="font-weight-bold mb-4">
                                                        <i class="fas fa-bullhorn mr-2"></i>
                                                        Editar anuncio
                                                    </h3>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="titulo"
                                                            class="mb-1 text-muted">
                                                            Titulo (obligatorio)
                                                        </label>
                                                        <input
                                                            type="text"
                                                            name="titulo"
                                                            id="titulo"
                                                            class="form-control rounded-0"
                                                            placeholder="Ingresar título"
                                                            value="{{ $anuncio->titulo }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="titulo"
                                                            class="mb-1 text-muted">
                                                            Descripción
                                                        </label>
                                                        <textarea
                                                            id="descripcion"
                                                            name="descripcion"
                                                            class="form-control rounded-0"
                                                            rows="5"
                                                            placeholder="Especificar instrucciones"
                                                        >{{ $anuncio->descripcion }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-check">
                                                        <input
                                                            type="checkbox"
                                                            id="destacado"
                                                            name="destacado"
                                                            class="form-check-input"
                                                            {{ $anuncio->destacado == true ? 'checked' : '' }}>
                                                        <label class="form-check-label">
                                                            Marcar anuncio como <b>Destacado</b>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-4 offset-md-2">
                                                    <button class="btn btn-success btn-block btn-flat btn-sm"
                                                        type="submit">
                                                        <i class="fas fa-save mr-2"></i>
                                                        Actualizar Anuncio
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

    <script src="{{ asset('scripts/tertiary-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection