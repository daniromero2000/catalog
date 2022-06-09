<?php

namespace Modules\Customers\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $customer = PermissionGroup::factory()->create([
            'name'        => 'Clientes',
            'group_order' => 1,
            'status'      => 1
        ]);

        $customers = Permission::factory()->create([
            //id = 8
            'name'                => 'customers',
            'display_name'        => 'Clientes',
            'icon'                => 'ni ni-headphones',
            'permission_group_id' =>  $customer->id
        ]);

        // Acciones Módulo Clientes
        Action::factory()->create([
            //id = 30
            'permission_id' => $customers->id,
            'name'          => 'Ver Clientes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customers.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 31
            'permission_id' => $customers->id,
            'name'          => 'Crear Cliente',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.customers.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 32
            'permission_id' => $customers->id,
            'name'          => 'Editar Cliente',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.customers.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 1
            'permission_id' => $customers->id,
            'name'          => 'Ver Cliente',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customers.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 34
            'permission_id' => $customers->id,
            'name'          => 'Borrar Cliente',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.customers.destroy',
            'principal'     => 0
        ]);


        $customer_statuses =  Permission::factory()->create([
            //id = 9
            'name'                => 'customer_statuses',
            'display_name'        => 'Estados clientes',
            'icon'                => 'ni ni-favourite-28',
            'permission_group_id' =>  $customer->id
        ]);

        Action::factory()->create([
            //id = 35
            'permission_id' => $customer_statuses->id,
            'name'          => 'Ver Estados Cliente',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customer-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 36
            'permission_id' => $customer_statuses->id,
            'name'          => 'Crear Estado Ciente',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.customer-statuses.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 37
            'permission_id' => $customer_statuses->id,
            'name'          => 'Editar Estado Cliente',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.customer-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 38
            'permission_id' => $customer_statuses->id,
            'name'          => 'Borrar Estado Cliente',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.customer-statuses.destroy',
            'principal'     => 0
        ]);

        $newsletter_subscriptions =    Permission::factory()->create([
            //id = 22
            'name'                => 'newsletter_subscriptions',
            'display_name'        => 'Subscripciones',
            'icon'                => 'ni ni-single-02',
            'permission_group_id' =>  $customer->id
        ]);

        // Acciones Módulo Newsletters Subscriptions
        Action::factory()->create([
            //id = 86
            'permission_id' => $newsletter_subscriptions->id,
            'name'          => 'Ver Subscripciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.newsletter-subscription.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 87
            'permission_id' => $newsletter_subscriptions->id,
            'name'          => 'Borrar Subscripción',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.newsletter-subscription.destroy',
            'principal'     => 0
        ]);

        $leads =   Permission::factory()->create([
            //id = 27
            'name'                => 'leads',
            'display_name'        => 'Leads',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' =>  $customer->id
        ]);


        // Acciones Módulo Leads
        Action::factory()->create([
            //id = 105
            'permission_id' => $leads->id,
            'name'          => 'Ver Leads',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.leads.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 106
            'permission_id' => $leads->id,
            'name'      => 'Crear Lead',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.leads.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 107
            'permission_id' => $leads->id,
            'name'          => 'Editar Lead',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.leads.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 108
            'permission_id' => $leads->id,
            'name'          => 'Ver Lead',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.leads.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 109
            'permission_id' => $leads->id,
            'name'          => 'Borrar Lead',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.leads.destroy',
            'principal'     => 0
        ]);

        $lead_statuses =     Permission::factory()->create([
            //id = 28
            'name'                => 'lead_statuses',
            'display_name'        => 'Estados Leads',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' =>  $customer->id
        ]);

        // Acciones Módulo Estados Leads
        Action::factory()->create([
            //id = 110
            'permission_id' => $lead_statuses->id,
            'name'          => 'Ver Estados Leads',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.lead-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 111
            'permission_id' => $lead_statuses->id,
            'name'      => 'Crear Estado Lead',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.lead-statuses.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 112
            'permission_id' => $lead_statuses->id,
            'name'          => 'Editar Estado Lead',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.lead-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 113
            'permission_id' => $lead_statuses->id,
            'name'          => 'Borrar Estado Lead',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.lead-statuses.destroy',
            'principal'     => 0
        ]);

        $customer_bank_accounts =    Permission::factory()->create([
            //id = 44
            'name'                => 'customer_bank_accounts',
            'display_name'        => 'Cuentas Bancos Clientes',
            'icon'                => 'fas fa-file-invoice-dollar',
            'permission_group_id' =>  $customer->id
        ]);

        // Acciones Módulo cuentas bancos clientes
        Action::factory()->create([
            //id = 178
            'permission_id' => $customer_bank_accounts->id,
            'name'          => 'Ver Cuentas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customer-bank-accounts.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 177
            'permission_id' => $customer_bank_accounts->id,
            'name'      => 'Crear Cuenta',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.customer-bank-accounts.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 179
            'permission_id' => $customer_bank_accounts->id,
            'name'          => 'Editar Cuenta',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.customer-bank-accounts.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 180
            'permission_id' => $customer_bank_accounts->id,
            'name'          => 'Borrar Cuenta',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.customer-bank-accounts.destroy',
            'principal'     => 0
        ]);

        $customer_companies =   Permission::factory()->create([
            //id = 46
            'name'                => 'customer_companies',
            'display_name'        => 'Empresas Clientes',
            'icon'                => 'fas fa-file-invoice-dollar',
            'permission_group_id' =>  $customer->id
        ]);

        // Acciones Módulo Empresas Clientes
        Action::factory()->create([
            //id = 185
            'permission_id' => $customer_companies->id,
            'name'          => 'Ver Empresas Clientes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customer-companies.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 186
            'permission_id' => $customer_companies->id,
            'name'      => 'Crear Empresa Cliente',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.customer-companies.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 187
            'permission_id' => $customer_companies->id,
            'name'          => 'Editar Empresa Cliente',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.customer-companies.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 188
            'permission_id' => $customer_companies->id,
            'name'          => 'Borrar Empresa Cliente',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.customer-companies.destroy',
            'principal'     => 0
        ]);
    }
}
