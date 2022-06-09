@extends('generals::layouts.admin.app')
@section('header')
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @include('xisfopay::layouts.contracts.edit_contract')
    @include('xisfopay::layouts.contracts.add_comment_modal')
</section>
@endsection
