@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-0">Cuentas Bancarias Clientes</h3>
                </div>
            </div>
        </div>
        @if(!$customerBankAccounts->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
              @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @if($customerBankAccounts)
                    @foreach($customerBankAccounts as $data)
                    <tr>
                        <td class="text-center">
                            {{ $data->customer->name . ' ' . $data->customer->last_name }}
                        </td>
                        <td class="text-center">
                            {{ $data->bankNames->name }}
                        </td>
                        <td class="text-center">{{ $data->account_number }}</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_aprobed])
                        </td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <!-- Modal -->
                    @include('customers::layouts.admin.customer-bank-accounts.edit_customer_bank_account_modal')
                    {{-- @include('companies::layouts.edit_employee') --}}
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="card-footer py-2">
            {{ $customerBankAccounts->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
    @endif
</section>
@endsection
