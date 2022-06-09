<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $ecommerce =  PermissionGroup::factory()->create([
            'name'        => 'Ecommerce',
            'group_order' => 2,
            'status'      => 1
        ]);

        $products =    Permission::factory()->create([
            //id = 11
            'name'                => 'products',
            'display_name'        => 'Productos',
            'icon'                => 'ni ni-shop',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo Productos
        Action::factory()->create([
            //id = 43
            'permission_id' => $products->id,
            'name'          => 'Ver Productos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.products.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 44
            'permission_id' => $products->id,
            'name'      => 'Crear Producto',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.products.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 45
            'permission_id' => $products->id,
            'name'          => 'Editar Producto',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.products.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 46
            'permission_id' => $products->id,
            'name'          => 'Borrar Producto',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.product.destroy',
            'principal'     => 0
        ]);

        $product_categories =   Permission::factory()->create([
            //id = 12
            'name'                => 'product_categories',
            'display_name'        => 'Categorías productos',
            'icon'                => 'ni ni-books',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo Categorías
        Action::factory()->create([
            //id = 47
            'permission_id' => $product_categories->id,
            'name'          => 'Ver Categorías',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.categories.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 48
            'permission_id' => $product_categories->id,
            'name'      => 'Crear Categoría',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.categories.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 49
            'permission_id' => $product_categories->id,
            'name'          => 'Editar Categoría',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.categories.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 50
            'permission_id' => $product_categories->id,
            'name'          => 'Ver Categoría',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.categories.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 51
            'permission_id' => $product_categories->id,
            'name'          => 'Borrar Categoría',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.categories.destroy',
            'principal'     => 0
        ]);

        $attributes = Permission::factory()->create([
            //id = 13
            'name'                => 'attributes',
            'display_name'        => 'Atributos',
            'icon'                => 'fas fa-award',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo Atributos
        Action::factory()->create([
            //id = 52
            'permission_id' => $attributes->id,
            'name'          => 'Ver Atributos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.attributes.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 53
            'permission_id' => $attributes->id,
            'name'      => 'Crear Atributo',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.attributes.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 54
            'permission_id' => $attributes->id,
            'name'          => 'Editar Atributo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.attributes.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 55
            'permission_id' => $attributes->id,
            'name'          => 'Ver Atributo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.attributes.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 56
            'permission_id' => $attributes->id,
            'name'          => 'Borrar Atributo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.attributes.destroy',
            'principal'     => 0
        ]);

        $brands =  Permission::factory()->create([
            //id = 14
            'name'                => 'brands',
            'display_name'        => 'Marcas',
            'icon'                => 'fas fa-tags',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo Marcas
        Action::factory()->create([
            //id = 57
            'permission_id' => $brands->id,
            'name'          => 'Ver Marcas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.brands.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 58
            'permission_id' => $brands->id,
            'name'      => 'Crear Marca',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.brands.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 59
            'permission_id' => $brands->id,
            'name'          => 'Editar Marca',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.brands.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 60
            'permission_id' => $brands->id,
            'name'          => 'Borrar Marca',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.brands.destroy',
            'principal'     => 0
        ]);

        $orders =    Permission::factory()->create([
            //id = 15
            'name'                => 'orders',
            'display_name'        => 'Ordenes',
            'icon'                => 'fas fa-user',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo Ordenes
        Action::factory()->create([
            //id = 61
            'permission_id' => $orders->id,
            'name'          => 'Ver Ordenes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.orders.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 62
            'permission_id' => $orders->id,
            'name'          => 'Editar Orden',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.orders.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 63
            'permission_id' => $orders->id,
            'name'          => 'Ver Orden',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.orders.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 64
            'permission_id' => $orders->id,
            'name'          => 'Borrar Orden',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.orders.destroy',
            'principal'     => 0
        ]);

        $wishlist =    Permission::factory()->create([
            //id = 16
            'name'                => 'wishlist',
            'display_name'        => 'Wishlists',
            'icon'                => 'fas fa-heart',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo wishlists
        Action::factory()->create([
            //id = 65
            'permission_id' => $wishlist->id,
            'name'          => 'Ver Wishlists',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.wishlists.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 66
            'permission_id' => $wishlist->id,
            'name'          => 'Borrar Wishlist',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.wishlists.destroy',
            'principal'     => 0
        ]);

        $checkouts = Permission::factory()->create([
            //id = 17
            'name'                => 'checkouts',
            'display_name'        => 'Checkouts',
            'icon'                => 'fas fa-shopping-bag',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo Checkouts
        Action::factory()->create([
            //id = 67
            'permission_id' => $checkouts->id,
            'name'          => 'Ver Checkouts',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.checkouts.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 68
            'permission_id' => $checkouts->id,
            'name'          => 'Borrar Checkout',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.checkouts.destroy',
            'principal'     => 0
        ]);

        $order_shipments =   Permission::factory()->create([
            //id = 18
            'name'                => 'order_shipments',
            'display_name'        => 'Despachos',
            'icon'                => 'fas fa-share-square',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo despacho de ordenes
        Action::factory()->create([
            //id = 69
            'permission_id' => $order_shipments->id,
            'name'          => 'Ver Despachos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.order-shipments.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 70
            'permission_id' => $order_shipments->id,
            'name'          => 'Editar Despacho',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.order-shipments.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 71
            'permission_id' => $order_shipments->id,
            'name'          => 'Ver Despacho',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.order-shipments.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 72
            'permission_id' => $order_shipments->id,
            'name'          => 'Borrar Despacho',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.order-shipments.destroy',
            'principal'     => 0
        ]);

        $product_reviews =  Permission::factory()->create([
            //id = 19
            'name'                => 'product_reviews',
            'display_name'        => 'Calificación productos',
            'icon'                => 'fas fa-star',
            'permission_group_id' =>  $ecommerce->id
        ]);

        // Acciones Módulo calificacion de producto
        Action::factory()->create([
            //id = 73
            'permission_id' => $product_reviews->id,
            'name'          => 'Ver Calificaciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.product-reviews.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 74
            'permission_id' => $product_reviews->id,
            'name'          => 'Borrar Calificacion',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.product-reviews.destroy',
            'principal'     => 0
        ]);
    }
}
