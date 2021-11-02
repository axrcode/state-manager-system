<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sa = Role::find(1);
        $pedido = Role::find(2);
        $bodega = Role::find(3);
        $produccion = Role::find(4);
        $sqa = Role::find(4);
        $entrega = Role::find(5);
        $none = Role::find(6);

        // CRUD Pedidos
        Permission::create(['name' => 'admin/proceso-pedidos'])->syncRoles([$sa, $pedido, $bodega, $produccion, $sqa, $entrega]);
        Permission::create(['name' => 'admin/proceso-pedidos/solicitado'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/proceso-pedidos/despachado'])->syncRoles([$sa, $pedido, $bodega]);
        Permission::create(['name' => 'admin/proceso-pedidos/proceso'])->syncRoles([$sa, $pedido, $produccion]);
        Permission::create(['name' => 'admin/proceso-pedidos/terminado'])->syncRoles([$sa, $sqa]);
        Permission::create(['name' => 'admin/proceso-pedidos/entregado'])->syncRoles([$sa, $entrega]);
    }
}
