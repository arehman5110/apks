

@extends('layouts.app')

@section('content')
<style>
    .navbar{display: none !important}
</style>
<section class="content">
    <div class="container-fluid">

@if (Session::has('failed'))
<h1>sdfjuhgsdiukfh</h1>
<div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
    {{ Session::get('failed') }}

    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif
{{-- @if (Session::has('success')) --}}
<div class="alert  alert-class   alert-success  }}" role="alert">
    Form Update Successfully
    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{-- @endif --}}
    </div></section>

@endsection