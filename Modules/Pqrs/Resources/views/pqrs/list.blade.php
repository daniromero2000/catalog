@extends('generals::layouts.admin.app')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.pqrs.index') }}">Pqrs</a><span class="divider"></span>
            </ol>
        </div>
    </div>
    @if(!is_null($pqrs))
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h1>PQRS</h1>
            <div class="row">
                @include('generals::layouts.search', ['route' => route('admin.pqrs.index')])
                <div class="col-md-5 float-right">
                    @include('layouts.admin.trashed-list', ['route' => route('admin.pqrs.index')])
                </div>
            </div>
            @if($pqrs)
            @include('layouts.admin.tables.tables_status', [$headers, 'datas' => $pqrs ])
            @include('generals::layouts.admin.pagination.pagination', [$skip])
            @else
            @include('generals::layouts.admin.pagination.pagination_null', [$skip])
            @endif
        </div>
    </div>
    @endif
</section>
@endsection
