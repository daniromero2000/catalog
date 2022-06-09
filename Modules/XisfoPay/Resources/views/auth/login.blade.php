@extends('layouts.front.app')

@section('content')
@include('generals::layouts.errors-and-messages')
<section class="container content content-empty">
    <div class="row my-5 mx-0 justify-content-center">
        @include('xisfopay::auth.layouts.login')
    </div>

</section>

@endsection