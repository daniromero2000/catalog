@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="col pl-0 mb-3 text-center">
                <h2>Importar {{$module}} </h2>
            </div>
            <p class="text-center">
                Ingresa a<br>
                <small> <a
                        href="https://guiadevalores.fasecolda.com/ConsultaExplorador/Default.aspx?url=C:\inetpub\wwwroot\Fasecolda\ConsultaExplorador\Guias\GuiaValores_NuevoFormato"
                        target="_blank">Guía de {{$module}}</a></small>
                <br>Cargar la fecha actual y descarga el archivo <strong>.csv</strong> necesario.
            </p>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route($optionsRoutes .'.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        Buscar el archivo de {{$module}} : <input type="file" name="file" required class="form-control"
                            accept=".csv">
                        <button type="submit" class="btn btn-primary">Cargar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
