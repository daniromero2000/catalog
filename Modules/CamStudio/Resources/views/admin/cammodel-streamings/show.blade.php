@extends('generals::layouts.admin.app')
@section('styles')
{{-- <link rel="stylesheet" href="{{asset('modules/generals/argonTemplate/resources/quill/dist/quill.core.css')}}"
type="text/css">--}}
{{-- <script src="{{asset('modules/generals/argonTemplate/resources/dropzone/dist/min/dropzone.min.js')}}"></script>
--}}
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
        width: 180px;
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

    #reset {
        padding-right: 10px !important;
        padding-left: 10px !important;
    }
</style>
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/admin/carousel.js')}}"></script>
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.cammodels.index') }}">Modelos</a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">{{$employee->name}}
                            {{$employee->last_name}}</li> --}}
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
    <div class="header pb-6 d-flex align-items-center"
        style="min-height: 500px; background-image: url({{asset('modules/generals/argonTemplate/img/theme/profile-cover.jpg')}}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row w-100">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hola {{$cammodel->nickname}}</h1>
                    <p class="text-white mt-0 mb-5">Esta es tu página de perfil de modelo. aqui puedes editar todos tus
                        datos como modelo.</p>
                    <a href="{{ route('front.model.slug', ['slug' => $cammodel->slug]) }}"
                        class="btn btn-danger remove-img btn-sm" target="_blank"> Ver perfil publicado</a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <div class="row">
                        <div class="px-2 col-md-12 col-xl-12">
                            @include('camstudio::admin.layouts.generals')
                        </div>
                        <div class="px-2 col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-body ">
                                    <h5 class="card-title">Imagen de agradecimiento</h5>
                                    <div class="d-flex mx-auto " style=" max-width: 300px; position: relative;">
                                        <a class="bg-primary text-white" data-toggle="modal" data-target="#modal-tkn"
                                            style="width: 35px;height: 35px;border-radius: 25px;position: absolute;top: 2px;right: 4px;display: flex;">
                                            <i class="fas fa-pen m-auto"></i>
                                        </a>
                                        <img src="{{ asset("storage/$cammodel->image_tks") }}"
                                            class="img-fluid mx-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-md-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Imagenes <a class="bg-primary text-white" data-toggle="modal"
                                            data-target="#modal-img"
                                            style="width: 35px;height: 35px;border-radius: 25px;position: absolute;top: 10px;right: 10px;display: flex;">
                                            <i class="fas fa-pen m-auto"></i>
                                        </a></h5>
                                    <div class="px-3">
                                        <div class="glider-contain">
                                            <div class="glider3">
                                                @foreach($images as $image)
                                                <div class="card-body">
                                                    <div style=" position: relative; ">
                                                        <img src="{{ asset("storage/$image->src") }}"
                                                            alt="{{ $image->src }}"
                                                            style="border-radius: 15px;max-height: 220px;">
                                                        <a onclick="return confirm('¿Estás Seguro?')"
                                                            href="{{ route('admin.cammodels.remove.thumb', ['src' => $image->src]) }}"
                                                            class="btn btn-danger remove-img btn-sm btn-block">X</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="glider-prev"><i
                                                    class="fas fa-angle-left"></i></button>
                                            <button type="button" class="glider-next"><i
                                                    class="fas fa-angle-right"></i></button>
                                            <div id="dots"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-md-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Banned Countries <a class="bg-primary text-white"
                                            data-toggle="modal" data-target="#modal-countries"
                                            style="width: 35px;height: 35px;border-radius: 25px;position: absolute;top: 10px;right: 10px;display: flex;">
                                            <i class="fas fa-pen m-auto"></i>
                                        </a></h5>
                                    <div class="px-3">
                                        <div class="card-body">
                                            <div style=" position: relative; ">
                                                <table class="table-striped table align-items-center table-flush table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center">Country</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        @if($bannedCountries)
                                                        @foreach($bannedCountries as $bannedCountry)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $bannedCountry->country->name }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Editar Perfil <strong>{{$cammodel->slug}}</strong></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <h6 class="heading-small text-muted mb-4">Informacion</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="nickname">Nombre</label>
                                                <input required type="text" id="nickname" name="nickname"
                                                    class="form-control" placeholder="Nombre"
                                                    value="{{$cammodel->nickname}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="height">Estatura</label>
                                                <input type="text" id="height" value="{{$cammodel->height}}"
                                                    name="height" class="form-control" placeholder="1.50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="weight">Peso / Kg</label>
                                                <input required type="text" id="weight" name="weight"
                                                    value="{{$cammodel->weight}}" class="form-control" placeholder="50">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="breast_cup_size">Tamaño de
                                                    senos</label>
                                                <input type="text" id="breast_cup_size" name="breast_cup_size"
                                                    class="form-control" placeholder="38B"
                                                    value="{{$cammodel->breast_cup_size}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="fake_age">Edad</label>
                                                <input required type="text" id="fake_age"
                                                    value="{{$cammodel->fake_age}}" class="form-control"
                                                    placeholder="50">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Categorías</label>
                                                @include('ecommerce::admin.shared.categories', ['categories' =>
                                                $categories,
                                                'ids' => $cammodel])
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Tienes tatuajes o piercings?</label>
                                                <div class="row px-4">
                                                    <div class="col-md-1">
                                                        <div class="custom-control custom-radio mb-3 mr-2">
                                                            <input type="radio" id="afirmative" value="1"
                                                                name="tattoos_piercings" class="custom-control-input"
                                                                @if( $cammodel->tattoos_piercings ==
                                                            '1')checked="checked"
                                                            @endif>
                                                            <label class="custom-control-label"
                                                                for="afirmative">SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="not" value="0"
                                                                name="tattoos_piercings" class="custom-control-input"
                                                                @if( $cammodel->tattoos_piercings ==
                                                            '0')checked="checked"
                                                            @endif>
                                                            <label class="custom-control-label" for="not">NO</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Restricciones</h6>

                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Mis reglas</label>
                                                <textarea required name="my_rules" rows="4" id="editor"
                                                    placeholder="Mis reglas son...">
                                                    {{$cammodel->my_rules}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">Sobre mi</h6>

                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Gustos y disgustos</label>
                                        <textarea required name="likes_dislikes" rows="4" id="likes_dislikes"
                                            placeholder="Mis Gustos son...">
                                            {{$cammodel->likes_dislikes}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Sobre mi</label>
                                        <textarea required name="about_me" rows="4" id="about_me"
                                            placeholder="Unas palabras sobre ti...">
                                            {{$cammodel->about_me}}
                                        </textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2 text-right">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </div>

    </form>
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Cambiar foto de portada</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="w-100">
                            <img src="{{ asset("storage/$cammodel->cover_page") }}" alt="Image placeholder"
                                class="img-fluid lazy">
                        </div>
                        <div class="form-group mt-3">
                            <input type="file" name="cover_page" id="cover_page" value="{{$cammodel->cover_page}}"
                                class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-cover" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Cambiar foto de perfil</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="w-100">
                            <img src="{{ asset("storage/$cammodel->cover") }}" alt="Image placeholder"
                                class="img-fluid lazy">
                        </div>
                        <div class="form-group mt-3">
                            <input type="file" name="cover" id="cover" value="{{$cammodel->cover}}" class="form-control"
                                accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-tkn" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Foto de agradecimiento</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="w-100">
                            <img src="{{ asset("storage/$cammodel->image_tks") }}" alt="Image placeholder"
                                class="img-fluid lazy">
                        </div>
                        <div class="form-group mt-3">
                            <input type="file" name="image_tks" id="image_tks" value="{{$cammodel->image_tks}}"
                                class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-img" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Tus imagenes</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="px-3">
                            <div class="glider-contain">
                                <div class="glider4">
                                    @foreach($images as $image)
                                    <div class="card-body">
                                        <div style=" position: relative; ">
                                            <img src="{{ asset("storage/$image->src") }}" alt="{{ $image->src }}"
                                                style="border-radius: 15px;max-height: 220px;">
                                            <a onclick="return confirm('¿Estás Seguro?')"
                                                href="{{ route('admin.cammodels.remove.thumb', ['src' => $image->src]) }}"
                                                class="btn btn-danger remove-img btn-sm btn-block">X</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class=" glider-prev-2 glider-prev "><i
                                        class="fas fa-angle-left"></i></button>
                                <button type="button" class=" glider-next-2 glider-next"><i
                                        class="fas fa-angle-right"></i></button>
                                <div id="dots"></div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="file" name="image[]" id="image" class="form-control" multiple
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-countries" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Elige País a Bloquear</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.banned-countries.store') }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="px-3">
                            <div class="col-sm-6">
                                <input type="hidden" name="cammodel_id" value="{{$cammodel->id}}">
                                <div id="countries" class="form-group mt-3">
                                    <label class="form-control-label" for="country_id">País</label>
                                    <div class="input-group">
                                        <select name="country_id" id="country_id" class="form-control" enabled>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ban</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        removePlugins: [ 'Heading', 'Link' ],
        toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
    } )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#likes_dislikes' ),{
        removePlugins: [ 'Heading', 'Link' ],
        toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
    } )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#about_me' ),{
        removePlugins: [ 'Heading', 'Link' ],
        toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
    } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
