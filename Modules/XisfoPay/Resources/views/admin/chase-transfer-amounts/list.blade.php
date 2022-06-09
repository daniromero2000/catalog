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
                <div class="col-6 col-sm-6 col-md-6 col-xl-2" style="text-align: end">
                    <h3 class="mb-0">{{ $module}} </h3>
                </div>
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$chaseTransferAmounts->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($chaseTransferAmounts as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->amount }}</td>
                        <td class="text-center">$ {{ number_format($data->chaseTransfer->ChaseTransferTrm->trm, 2) }}
                            / {{ $data->chaseTransfer->ChaseTransferTrm->bank->name }}</td>
                        <td class="text-center"> {{ $data->streaming->streaming }}</td>
                        <td class="text-center"> {{ $data->chaseTransfer->id }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                        <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row row-reset w-100">
                                            <div class="col-12 text-center">
                                                <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post"  class="form">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body py-0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="amount">Monto</label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                                            </div>
                                                            <input class="form-control" type="text" id="amount" name="amount"
                                                                value="{{ $data->amount }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">COP</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                <tbody>
            </table>
        </div>
      <div class="card-footer py-2">
            {{ $chaseTransferAmounts->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif

</section>
@endsection
