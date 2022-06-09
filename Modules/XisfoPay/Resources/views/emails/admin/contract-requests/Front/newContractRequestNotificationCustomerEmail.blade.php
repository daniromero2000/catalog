@extends('xisfopay::emails.admin.layouts.app-mail')
@section('styles-mail')
    <style>
        .btn-reset-mail{
            padding: 5px 10px; background-color: #154293; 
            border-radius: 20px; 
            text-decoration: none; 
            color:aqua white !important;
        }
    </style>
@endsection
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span class="text-cordial">¡Cordial saludo!</span>
        <br>
        <span class="description-mail">Te informamos que tu cuenta ha sido creada satisfactoriamente.</span>
    </div>
</div>
<br>
@endsection
@section('content')
<p>Realiza la asignación de tu contraseña en el siguiente enlace: 
    <br>
    <a class="btn-reset-mail text-white" href="{{$link}}">Restablecer contraseña</a> 
</p>
@endsection
