@extends('generals::layouts.admin.app')

@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/jscolor.min.js') }}" type="text/javascript"></script>
@endsection