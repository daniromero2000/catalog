<?php

namespace Modules\PawnShop\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $pawnshop =  PermissionGroup::factory()->create([
            'name'        => 'Compraventa',
            'group_order' => 8,
            'status'      => 1
        ]);

        $pawn_items =   Permission::factory()->create([
            'name'                => 'pawn_items',
            'display_name'        => 'Artículos Compraventa',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $pawnshop->id
        ]);

        //Acciones Módulo Artículos Compraventa
        Action::factory()->create([
            'permission_id' => $pawn_items->id,
            'name'          => 'Ver Artículos Compraventa',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pawn-items.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_items->id,
            'name'          => 'Crear Artículos Compraventa',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pawn-items.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_items->id,
            'name'          => 'Editar Artículos Compraventa',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pawn-items.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_items->id,
            'name'          => 'Artículos Compraventa',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.pawn-items.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_items->id,
            'name'          => 'Borrar Artículos Compraventa',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.pawn-items.destroy',
            'principal'     => 0
        ]);

        $fasecolda_price_rates =  Permission::factory()->create([
            'name'                => 'fasecolda_price_rates',
            'display_name'        => 'Porcentaje Fasecolda',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $pawnshop->id
        ]);

        //Acciones Módulo Porcentajes Fasecolda
        Action::factory()->create([
            'permission_id' => $fasecolda_price_rates->id,
            'name'          => 'Ver Porcentaje Fasecolda',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.fasecolda-price-rates.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $fasecolda_price_rates->id,
            'name'          => 'Crear Porcentaje Fasecolda',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.fasecolda-price-rates.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $fasecolda_price_rates->id,
            'name'          => 'Editar Porcentaje Fasecolda',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.fasecolda-price-rates.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $fasecolda_price_rates->id,
            'name'          => 'Borrar Porcentaje Fasecolda',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.fasecolda-price-rates.destroy',
            'principal'     => 0
        ]);

        //Acciones Módulo Calidad Joyeria
        $jewelry_qualities =  Permission::factory()->create([
            'name'                => 'jewelry_qualities',
            'display_name'        => 'Calidad Joyeria',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $pawnshop->id
        ]);


        Action::factory()->create([
            'permission_id' => $jewelry_qualities->id,
            'name'          => 'Ver Calidades de Joyería',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.jewelry-qualities.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $jewelry_qualities->id,
            'name'          => 'Crear Calidad de Joyería',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.jewelry-qualities.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $jewelry_qualities->id,
            'name'          => 'Editar Calidad de Joyería',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.jewelry-qualities.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $jewelry_qualities->id,
            'name'          => 'Borrar Calidad de Joyería',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.jewelry-qualities.destroy',
            'principal'     => 0
        ]);

        //Acciones Módulo Categorías Artículos Compraventa
        $pawn_item_categories =  Permission::factory()->create([
            'name'                => 'pawn_item_categories',
            'display_name'        => 'Categorías Artículos Compraventa',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $pawnshop->id
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_categories->id,
            'name'          => 'Ver Categorías Artículos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pawn-item-categories.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_categories->id,
            'name'          => 'Crear Categoría Artículos',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pawn-item-categories.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_categories->id,
            'name'          => 'Editar Categoría Artículos',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pawn-item-categories.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_categories->id,
            'name'          => 'Ver Categoría Artículos',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.pawn-item-categories.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_categories->id,
            'name'          => 'Borrar Categoría Artículos',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.pawn-item-categories.destroy',
            'principal'     => 0
        ]);

        //Acciones Módulo Categorías Artículos Compraventa
        $pawn_item_statuses =  Permission::factory()->create([
            'name'                => 'pawn_item_statuses',
            'display_name'        => 'Estados Articulos',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $pawnshop->id
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_statuses->id,
            'name'          => 'Ver Estados Articulos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pawn-item-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_statuses->id,
            'name'          => 'Crear Estado Articulos',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pawn-item-statuses.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_statuses->id,
            'name'          => 'Editar Estado Articulos',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pawn-item-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_item_statuses->id,
            'name'          => 'Borrar Estado Articulos',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.pawn-item-statuses.destroy',
            'principal'     => 0
        ]);

        //Acciones Módulo autoevaluador
        $pawn_shop_self_assessor =  Permission::factory()->create([
            'name'                => 'pawn_shop_self_assessor',
            'display_name'        => 'Auto-Evaluador',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $pawnshop->id
        ]);

        Action::factory()->create([
            'permission_id' => $pawn_shop_self_assessor->id,
            'name'          => 'Auto-Evaluar',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pawn-shop-self-assessor.index',
            'principal'     => 1
        ]);
    }
}
