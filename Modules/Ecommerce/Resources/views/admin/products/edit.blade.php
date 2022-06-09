@extends('generals::layouts.admin.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/admin/carousel.js')}}"></script>
<style type="text/css">
    label.checkbox-inline {
        padding: 10px 5px;
        display: block;
        margin-bottom: 5px;
    }

    label.checkbox-inline>input[type="checkbox"] {
        margin-left: 10px;
    }

    ul.attribute-lists>li {
        margin-bottom: 10px;
    }

    .center {
        left: 50%;
        transform: translateX(0) !important;
    }

    .info-tooltip {
        position: absolute;
        top: 3px;
        right: 18px;
        border-radius: 20px;
        background: #5e72e4;
        width: 18px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        color: white !important;
    }

    .relative {
        position: relative;
    }

    .remove-img {
        position: absolute;
        top: 5px;
        width: 29px;
        right: 5px;
    }

    @media (max-width: 700px) {
        .remove-img {
            width: 0px;
            padding-right: 12px;
            right: 0px;
            font-size: 8px;
        }
    }

</style>
<link rel="stylesheet" type="text/css" href="{{asset('css/slider/side-slider.css')}}">
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class=" col-12">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/products">Productos</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">{{ ucfirst($product->name) }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')

    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if(!request()->has('combination')) active @endif" id="info-tab"
                    data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">
                    <i class="ni ni-cloud-upload-96 mr-2"></i>Información
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="combinations-tab" data-toggle="tab" href="#combinations"
                    role="tab" aria-controls="combinations" aria-selected="false">
                    <i class="ni ni-bell-55 mr-2"></i>Combinaciones
                </a>
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="col pl-0 mb-3">
                <h2>{{ ucfirst($product->name) }}</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('ecommerce::layouts.products.info-tab')
                    @include('ecommerce::layouts.products.combination-tab')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
@section('scripts')
<script type="text/javascript">
    function backToInfoTab() {
        $('#tablist > li:first-child').addClass('active');
        $('#tablist > li:last-child').removeClass('active');

        $('#tabcontent > div:first-child').addClass('active');
        $('#tabcontent > div:last-child').removeClass('active');
    }
    $(document).ready(function () {
        const checkbox = $('input.attribute');
        $(checkbox).on('change', function () {
            const attributeId = $(this).val();
            if ($(this).is(':checked')) {
                $('#attributeValue' + attributeId).attr('disabled', false);
            } else {
                $('#attributeValue' + attributeId).attr('disabled', true);
            }
            const count = checkbox.filter(':checked').length;
            if (count > 0) {
                $('#productAttributeQuantity').attr('disabled', false);
                $('#productAttributePrice').attr('disabled', false);
                $('#salePrice').attr('disabled', false);
                $('#default').attr('disabled', false);
                $('#createCombinationBtn').attr('disabled', false);
                $('#combination').attr('disabled', false);
            } else {
                $('#productAttributeQuantity').attr('disabled', true);
                $('#productAttributePrice').attr('disabled', true);
                $('#salePrice').attr('disabled', true);
                $('#default').attr('disabled', true);
                $('#createCombinationBtn').attr('disabled', true);
                $('#combination').attr('disabled', true);
            }
        });
    });

    function inputActive(id) {
        $('#pAattributeValue' + id).attr('disabled', false);
    }

</script>
<script type="text/javascript" src="{{asset('js/slider/side-slider.js')}}"></script>
@endsection
