@extends('layouts.app')
@section('css')

<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    h3{
        font-weight: 600
    }

</style>
@endsection

@section('content')


<div class=" p-5">
    <div class="row ">
        <div class="col-md-4">
            <a href="{{route('third-party-digging.index')}}">
            <div class="card p-3 bg-light"> <h3 ><i class="fas fa-tools"></i>  3rd Party Digging</h3></div></a>
        </div>
        <div class="col-md-4">
            <a href="{{route('substation.index')}}">
            <div class="card p-3 bg-light"><h3><i class="fas fa-building"></i>  Substation</h3></div></a>
        </div>
        <div class="col-md-4">
            <a href="{{route('feeder-pillar.index')}}">
            <div class="card p-3 bg-light"><h3><i class="fas fa-cube"></i> Feeder Pillar</h3></div></a>
        </div>
        <div class="col-md-4">
            <a href="{{route('tiang-talian-vt-and-vr.index')}}">
            <div class="card p-3 bg-light"><h3>  <i class="fas fa-bolt"></i> Tiang + Talian VT & VR</h3></div></a>
        </div>
        <div class="col-md-4">
            <a href="{{route('link-box-pelbagai-voltan.index')}}">
            <div class="card p-3 bg-light"><h3><i class="fas fa-link"></i> Link Box Pelbagai Voltan</h3></div></a>
        </div>
        <div class="col-md-4">
            <a href="{{route('cable-bridge.create')}}">
            <div class="card p-3 bg-light"><h3><i class="fas fa-road"></i> Cable Bridge</h3> </div></a>
        </div>
    </div>
</div>
@endsection
