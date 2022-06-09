@extends('layouts.front.app')
@section('styles')
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="icon/x-icon">
@endsection
@section('name-pagine')
    Crear cuenta |
@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
<div class="row row-reset bg-blue-xisfopay">
    <div class="content-banner-create">
        <h1 class="text-banner-create">
            CREA TU <br> CUENTA EN <br> 4 SENCILLOS <br> PASOS
        </h1>
    </div>
</div>
<div class="row row-reset mt-4">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-auto text-center">
        <span class="selector-form">Escoge una</span>
        <h3 class="selector-icon">
            <i class="fas fa-angle-double-down"></i>
        </h3>
    </div>
</div>
<div id="accordion">
    <div class="card border-none">
        <div class="card-header border-none bg-card-form" id="headingOne">
            <div id="natural_button" class="row row-reset">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-card-title-align m-auto">
                    <div class="w-100">
                        <span class="title-card-form">
                            ¿Eres persona natural? <i class="fas fa-exclamation-circle"></i>
                        </span>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-card-btn-align">
                    <div class="w-100">
                        <span>
                            <button  class="btn btn-link btn-card-form" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="change_constitution('Natural', 1)">
                                Click aquí
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="row row-reset mt-4">
                <div class="col-12 col-md-12 font-collapse">
                    <h6 class="text-center title-form p-4" style="font-weight: 600;">
                        FORMULARIO DE REGISTRO PARA PERSONA NATURAL <i class="fas fa-user-shield"></i>
                    </h6>
                </div>
            </div>
            <div class="card-body mx-4">
                <form action="{{ route('contract-requests.store') }}" method="post" class="form" onsubmit="disable_button('create_button_1')">
                    @csrf
                    @include('xisfopay::front.layouts.contract-requests.contract-request-form', ['id' => '1'])
                    {{-- <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <div class="captcha">
                                <div class="g-recaptcha" data-sitekey="6Lc65tEaAAAAAGJX8z2Myq2Ga8jBjyHAmvauhLD0"
                                    data-callback="removeFakeCaptcha"></div>
                                <input type="checkbox" class="captcha-fake-field" tabindex="-1" required>
                            </div>
                        </div>
                    </div> --}}
                    <div class="container text-right">
                        <button type="submit" class="btn btn-sm rounded-pill font-bold btn-send-form" id="create_button_1">
                            <i class="fas fa-paper-plane"></i> ENVIAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card my-2 border-none">
        <div class="card-header border-none bg-card-form" id="headingTwo">
            <div id="natural_button" class="row row-reset">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-card-title-align m-auto">
                    <div class="w-100">
                        <span class="title-card-form">
                            ¿Eres persona jurídica? <i class="fas fa-exclamation-circle"></i>
                        </span>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-card-btn-align">
                    <div class="w-100">
                        <span>
                            <button class="btn btn-link collapsed btn-card-form" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" onclick="change_constitution('Jurídica', 2)">
                                Click aquí
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="row row-reset mt-4">
                <div class="col-12 col-md-12 font-collapse">
                    <h2 class="text-center title-form p-4">
                        FORMULARIO DE REGISTRO PARA PERSONA JURÍDICA <i class="fas fa-building"></i>
                    </h2>
                </div>
            </div>
            <div class="card-body mx-4">
                <form action="{{ route('contract-requests.store') }}" method="post" class="form" onsubmit="disable_button('create_button_2')">
                    @csrf
                    @include('xisfopay::front.layouts.contract-requests.contract-request-form', ['id' => '2'])
                    <div class="container text-right">
                        <button type="submit" class="btn btn-sm rounded-pill font-bold btn-send-form" id="create_button_2"><i class="fas fa-paper-plane"></i> ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function change_constitution(type, target_id) {
        document.getElementById("constitution_type_"+target_id).value = type;
        name_change(target_id);
    }

    function name_change(target_id) {
        if (document.getElementById("constitution_type_"+target_id).value == 'Natural') {
            document.getElementById("company_legal_name").value = document.getElementById("name").value + " " + document
                .getElementById("last_name").value;
            var elements = document.getElementsByClassName("in_legal_name");
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = 'none';
            }
        } else {
            document.getElementById("company_legal_name").value = '';
            var elements = document.getElementsByClassName("in_legal_name");
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = 'inline';
            }
        }
    }

</script>
<script>
    window.removeFakeCaptcha = function() {
   document.querySelector('.captcha-fake-field').remove();
}
</script>
@endsection
@section('scripts')
@include('xisfopay::front.layouts.cities-selectorJS')
@endsection
