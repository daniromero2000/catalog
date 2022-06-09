@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
                @include('generals::layouts.admin.module_name')
            </div>
        </div>
        @if(!$customer_companies->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @if($customer_companies)
                    @foreach($customer_companies as $data)
                    <tr>
                        <td class="text-center">
                            {{ $data->customer->name . ' ' . $data->customer->last_name }}
                        </td>
                        <td class="text-center">{{ $data->company_legal_name }}
                             / {{ $data->company_commercial_name }}
                        </td>
                        <td class="text-center">
                            {{ $data->constitution_type }}
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.status', ['status' => $data->is_active])
                            @include('generals::layouts.status', ['status' => $data->is_aprobed])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('customers::layouts.admin.customer-companies.edit_customer_company_modal')
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $customer_companies->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
@section('scripts')
@include('generals::layouts.cities-selectorJS')
@endsection
