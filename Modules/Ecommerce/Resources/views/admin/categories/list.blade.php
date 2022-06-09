@extends('generals::layouts.admin.app')
@section('styles')
<script src="{{ asset('js/ecommerce.js') }}" defer></script>
@endsection
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content" id="app">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @if($categories)
            @include('generals::layouts.search', ['route' => route('admin.permissions.index')])
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-0">Categorías</h3>
                </div>
            </div>
        </div>
        <sort-category :data="{{$categories}}"></sort-category>
    </div>
    @endif
</section>
@endsection
