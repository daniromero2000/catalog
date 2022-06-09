@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if(!$interviews->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
               @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @if($interviews)
                    @foreach($interviews as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->name }} {{ $data->last_name }}</td>
                        <td class="text-center">{{ $data->email }}</td>
                        <td class="text-center">{{ $data->employeePosition->position }}</td>
                        <td class="text-center">
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $data->interviewStatus->color }}">
                                {{ $data->interviewStatus->name }}
                            </span>
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <!-- Modal -->
                    {{-- @include('companies::layouts.edit_employee') --}}
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
    @endif
</section>
@endsection
