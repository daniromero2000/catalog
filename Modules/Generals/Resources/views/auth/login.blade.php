@extends('layouts.front.app')

@section('content')
<section class="container content content-empty">
    <div class="row my-5 mx-0 justify-content-center">
        @include('generals::auth.layouts.login')
    </div>

</section>

@endsection