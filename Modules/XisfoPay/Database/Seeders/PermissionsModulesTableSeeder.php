<?php

namespace Modules\XisfoPay\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $xisfopay =   PermissionGroup::factory()->create([
            'name'        => 'XisfoPay',
            'group_order' => 5,
            'status'      => 1
        ]);

        $contract_statuses =   Permission::factory()->create([
            //id = 30
            'name'                => 'contract_statuses',
            'display_name'        => 'Estados de Contrato',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Estados de Contrato
        Action::factory()->create([
            //id = 118
            'permission_id' => $contract_statuses->id,
            'name'          => 'Ver Estados Contrato',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contract-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 119
            'permission_id' => $contract_statuses->id,
            'name'      => 'Crear Estado Contrato',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.contract-statuses.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 120
            'permission_id' => $contract_statuses->id,
            'name'          => 'Editar Estado Contrato',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contract-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 121
            'permission_id' => $contract_statuses->id,
            'name'          => 'Borrar Estado Contrato',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contract-statuses.destroy',
            'principal'     => 0
        ]);

        $contract_request_statuses =  Permission::factory()->create([
            //id = 31
            'name'                => 'contract_request_statuses',
            'display_name'        => 'Estados de Solicitud de Contrato',
            'icon'                => 'fas fa-arrow-alt-circle-right',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Estados de solicitudes de Contrato
        Action::factory()->create([
            //id = 122
            'permission_id' => $contract_request_statuses->id,
            'name'          => 'Ver Estados de Solicitud Contrato',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contract-request-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 123
            'permission_id' => $contract_request_statuses->id,
            'name'      => 'Crear Estado de Solicitud Contrato',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.contract-request-statuses.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 124
            'permission_id' => $contract_request_statuses->id,
            'name'          => 'Editar Estado de Solicitud Contrato',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contract-request-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 125
            'permission_id' => $contract_request_statuses->id,
            'name'          => 'Borrar Estado de Solicitud Contrato',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contract-request-statuses.destroy',
            'principal'     => 0
        ]);

        $contract_rates =  Permission::factory()->create([
            //id = 32
            'name'                => 'contract_rates',
            'display_name'        => 'Tarifas de Contrato',
            'icon'                => 'fas fa-percent',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo tarifas de Contrato
        Action::factory()->create([
            //id = 126
            'permission_id' => $contract_rates->id,
            'name'          => 'Ver Tarifas de Contrato',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contract-rates.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 127
            'permission_id' => $contract_rates->id,
            'name'      => 'Crear Tarifa de Contrato',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.contract-rates.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 128
            'permission_id' => $contract_rates->id,
            'name'          => 'Editar Tarifa de Contrato',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contract-rates.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 129
            'permission_id' => $contract_rates->id,
            'name'          => 'Borrar Tarifa de Contrato',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contract-rates.destroy',
            'principal'     => 0
        ]);

        $contracts =   Permission::factory()->create([
            //id = 33
            'name'                => 'contracts',
            'display_name'        => 'Contratos',
            'icon'                => 'fas fa-file-signature',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Contratos
        Action::factory()->create([
            //id = 130
            'permission_id' => $contracts->id,
            'name'          => 'Ver Contratos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contracts.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 131
            'permission_id' => $contracts->id,
            'name'      => 'Crear Contrato',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.contracts.create',
            'principal' => 0
        ]);

        Action::factory()->create([
            //id = 132
            'permission_id' => $contracts->id,
            'name'          => 'Editar Contrato',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contracts.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 133
            'permission_id' => $contracts->id,
            'name'          => 'Ver Contrato',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.contracts.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 134
            'permission_id' => $contracts->id,
            'name'          => 'Borrar Contrato',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contracts.destroy',
            'principal'     => 0
        ]);

        $contract_requests =  Permission::factory()->create([
            //id = 34
            'name'                => 'contract_requests',
            'display_name'        => 'Solicitudes de Contrato',
            'icon'                => 'fas fa-reply-all',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo solicitudes de Contratos
        Action::factory()->create([
            //id = 135
            'permission_id' => $contract_requests->id,
            'name'          => 'Ver Solicitudes de Contrato',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contract-requests.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 136
            'permission_id' => $contract_requests->id,
            'name'      => 'Crear Solicitud de Contrato',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.contract-requests.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 137
            'permission_id' => $contract_requests->id,
            'name'          => 'Editar Solicitud de Contrato',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contract-requests.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 138
            'permission_id' => $contract_requests->id,
            'name'          => 'Ver Solicitud de Contrato',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.contract-requests.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 139
            'permission_id' => $contract_requests->id,
            'name'          => 'Borrar Solicitud de Contrato',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contract-requests.destroy',
            'principal'     => 0
        ]);

        $contract_renewals =  Permission::factory()->create([
            //id = 35
            'name'                => 'contract_renewals',
            'display_name'        => 'Renovaciones de Contrato',
            'icon'                => 'fas fa-file-signature',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Renovaciones de Contratos
        Action::factory()->create([
            'permission_id' => $contract_renewals->id,
            'name'          => 'Ver Renovaciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contract-renewals.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $contract_renewals->id,
            'name'          => 'Editar Renovación',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contract-renewals.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 143
            'permission_id' => $contract_renewals->id,
            'name'          => 'Borrar Renovación',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contract-renewals.destroy',
            'principal'     => 0
        ]);


        $payment_request_statuses =  Permission::factory()->create([
            //id = 36
            'name'                => 'payment_request_statuses',
            'display_name'        => 'Estados de Solicitud de Pago',
            'icon'                => 'fas fa-toggle-on',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Estados de solicitudes de pagos
        Action::factory()->create([
            //id = 144
            'permission_id' => $payment_request_statuses->id,
            'name'          => 'Ver Estados Pago',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.payment-request-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 145
            'permission_id' => $payment_request_statuses->id,
            'name'      => 'Crear Estado Pago',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.payment-request-statuses.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 146
            'permission_id' => $payment_request_statuses->id,
            'name'          => 'Editar Estado Pago',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.payment-request-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 147
            'permission_id' => $payment_request_statuses->id,
            'name'          => 'Borrar Estado Pago',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.payment-request-statuses.destroy',
            'principal'     => 0
        ]);

        $payment_requests = Permission::factory()->create([
            //id = 37
            'name'                => 'payment_requests',
            'display_name'        => 'Solicitud de Pago',
            'icon'                => 'fas fa-file-invoice-dollar',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo  solicitudes de pagos
        Action::factory()->create([
            //id = 148
            'permission_id' => $payment_requests->id,
            'name'          => 'Ver Solicitudes Pago',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.payment-requests.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 149
            'permission_id' => $payment_requests->id,
            'name'      => 'Crear Solicitud Pago',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.payment-requests.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 150
            'permission_id' => $payment_requests->id,
            'name'          => 'Editar Solicitud Pago',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.payment-requests.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 151
            'permission_id' => $payment_requests->id,
            'name'          => 'Ver Solicitud Pago',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.payment-requests.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 152
            'permission_id' => $payment_requests->id,
            'name'          => 'Borrar Solicitud Pago',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.payment-requests.destroy',
            'principal'     => 0
        ]);

        $contract_request_stream_accounts =  Permission::factory()->create([
            //id = 39
            'name'                => 'contract_request_stream_accounts',
            'display_name'        => 'Cuentas Streaming Clientes',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Cuentas Stermiang Clientes
        Action::factory()->create([
            //id = 157
            'permission_id' => $contract_request_stream_accounts->id,
            'name'          => 'Ver Cuentas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.contract-request-stream-accounts.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 158
            'permission_id' => $contract_request_stream_accounts->id,
            'name'      => 'Crear Cuenta',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.contract-request-stream-accounts.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 159
            'permission_id' => $contract_request_stream_accounts->id,
            'name'          => 'Editar Cuenta',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.contract-request-stream-accounts.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 160
            'permission_id' => $contract_request_stream_accounts->id,
            'name'          => 'Borrar Cuenta',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.contract-request-stream-accounts.destroy',
            'principal'     => 0
        ]);

        $payment_cuts =  Permission::factory()->create([
            //id = 40
            'name'                => 'payment_cuts',
            'display_name'        => 'Cortes de Pagos',
            'icon'                => 'fas fa-cut',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Cortes de pago
        Action::factory()->create([
            //id = 161
            'permission_id' => $payment_cuts->id,
            'name'          => 'Ver Cortes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.payment-cuts.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 162
            'permission_id' => $payment_cuts->id,
            'name'      => 'Crear Corte',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.payment-cuts.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 163
            'permission_id' => $payment_cuts->id,
            'name'          => 'Editar Corte',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.payment-cuts.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 164
            'permission_id' => $payment_cuts->id,
            'name'          => 'Ver Corte',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.payment-cuts.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 165
            'permission_id' => $payment_cuts->id,
            'name'          => 'Borrar Corte',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.payment-cuts.destroy',
            'principal'     => 0
        ]);

        $payment_bank_transfers = Permission::factory()->create([
            //id = 42
            'name'                => 'payment_bank_transfers',
            'display_name'        => 'Transferencias Bancarias',
            'icon'                => 'fas fa-cut',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Payment Bank Transfers
        Action::factory()->create([
            //id = 170
            'permission_id' => $payment_bank_transfers->id,
            'name'          => 'Ver Transferencias',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.payment-bank-transfers.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 171
            'permission_id' => $payment_bank_transfers->id,
            'name'          => 'Editar Transferencia',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.payment-bank-transfers.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 172
            'permission_id' => $payment_bank_transfers->id,
            'name'          => 'Borrar Transferencia',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.payment-bank-transfers.destroy',
            'principal'     => 0
        ]);

        $payment_advance_requests =   Permission::factory()->create([
            //id = 43
            'name'                => 'payment_advance_requests',
            'display_name'        => 'Avances Solicitud de Pago',
            'icon'                => 'fas fa-file-invoice-dollar',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo avances solicutd de pago
        Action::factory()->create([
            //id = 173
            'permission_id' => $payment_advance_requests->id,
            'name'          => 'Ver Avances',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.payment-request-advances.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 174
            'permission_id' => $payment_advance_requests->id,
            'name'          => 'Editar Avance',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.payment-request-advances.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 175
            'permission_id' => $payment_advance_requests->id,
            'name'          => 'Ver Avance',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.payment-request-advances.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 176
            'permission_id' => $payment_advance_requests->id,
            'name'          => 'Borrar Avance',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.payment-request-advances.destroy',
            'principal'     => 0
        ]);


        $xisfo_services =  Permission::factory()->create([
            //id = 45
            'name'                => 'xisfo_services',
            'display_name'        => 'Servicios Xisfo',
            'icon'                => 'fas fa-file-invoice-dollar',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Servicios Xisfo
        Action::factory()->create([
            //id = 181
            'permission_id' => $xisfo_services->id,
            'name'          => 'Ver Servicios',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.xisfo-services.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 182
            'permission_id' => $xisfo_services->id,
            'name'      => 'Crear Servicio',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.xisfo-services.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 183
            'permission_id' => $xisfo_services->id,
            'name'          => 'Editar Servicio',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.xisfo-services.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 184
            'permission_id' => $xisfo_services->id,
            'name'          => 'Borrar Servicio',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.xisfo-services.destroy',
            'principal'     => 0
        ]);

        $chase_transfer_trms = Permission::factory()->create([
            //id = 47
            'name'                => 'chase_transfer_trms',
            'display_name'        => 'TRM Cortes de pago',
            'icon'                => 'fas fa-funnel-dollar',
            'permission_group_id' =>  $xisfopay->id
        ]);

        // Acciones Módulo Xisfo TRM Cortes
        Action::factory()->create([
            //id = 189
            'permission_id' => $chase_transfer_trms->id,
            'name'          => 'Ver TRM',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.chase-transfer-trms.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 190
            'permission_id' => $chase_transfer_trms->id,
            'name'      => 'Crear TRM',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.chase-transfer-trms.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 191
            'permission_id' => $chase_transfer_trms->id,
            'name'          => 'Editar TRM',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.chase-transfer-trms.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 192
            'permission_id' => $chase_transfer_trms->id,
            'name'          => 'Borrar TRM',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.chase-transfer-trms.destroy',
            'principal'     => 0
        ]);

        $chase_transfers = Permission::factory()->create([
            //id = 56
            'name'                => 'chase_transfers',
            'display_name'        => 'Giro',
            'icon'                => 'fas fa-funnel-dollar',
            'permission_group_id' =>  $xisfopay->id
        ]);

        //Acciones Módulo Giros
        Action::factory()->create([
            //id = 234
            'permission_id' => $chase_transfers->id,
            'name'          => 'Ver Giros',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.chase-transfers.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 235
            'permission_id' => $chase_transfers->id,
            'name'          => 'Crear Giro',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.chase-transfers.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 236
            'permission_id' => $chase_transfers->id,
            'name'          => 'Editar Giro',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.chase-transfers.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 237
            'permission_id' => $chase_transfers->id,
            'name'          => 'Ver Giro',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.chase-transfers.show',
            'principal'     => 0
        ]);

        $chase_transfer_amounts = Permission::factory()->create([
            //id = 56
            'name'                => 'chase_transfer_amounts',
            'display_name'        => 'Montos Giros',
            'icon'                => 'fas fa-hand-holding-usd',
            'permission_group_id' =>  $xisfopay->id
        ]);

        //Acciones Módulo Montos Giro
        Action::factory()->create([
            //id = 234
            'permission_id' => $chase_transfer_amounts->id,
            'name'          => 'Ver Montos Giros',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.chase-transfer-amounts.index',
            'principal'     => 1
        ]);

        $stream_account_commissions = Permission::factory()->create([
            //id = 56
            'name'                => 'stream_account_commissions',
            'display_name'        => 'Comisiones Plataformas Clientes',
            'icon'                => 'fas fa-money-bill-wave',
            'permission_group_id' =>  $xisfopay->id
        ]);

        //Acciones Módulo Comisiones Plataforma Cliente
        Action::factory()->create([
            //id = 234
            'permission_id' => $stream_account_commissions->id,
            'name'          => 'Ver Comisiones Plataformas Clientes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.stream-account-commissions.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 235
            'permission_id' => $stream_account_commissions->id,
            'name'          => 'Crear Comision Plataforma Cliente',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.stream-account-commissions.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 236
            'permission_id' => $stream_account_commissions->id,
            'name'          => 'Editar Comision Plataforma Cliente',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.stream-account-commissions.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 237
            'permission_id' => $stream_account_commissions->id,
            'name'          => 'Ver Comision Plataforma Cliente',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.stream-account-commissions.show',
            'principal'     => 0
        ]);
    }
}
