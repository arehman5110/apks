@extends('layouts.app')
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        h3 {
            font-weight: 600
        }

        .collapse .card-body {
            padding: 0px !important
        }

        h3 {
            color: #7379AE;
            font-size: 20px !important;
        }

        .accordion .card {
            background: #d1cfcf14;
        }

        .dashboard-counts h3 {
            font-size: 1rem !important
        }

        .dashboard-counts p {
            font-weight: 600;
            color: slategrey;
        }
    </style>
@endsection

@section('content')
    <div class=" p-4 ">

        <div class="row dashboard-counts">
            {{-- <div class="col-md-2">
        <div class="card p-3">

                <h3 class="text-center">   3rd Party Digging </h3>
                <p class="text-center mb-0 pb-0"><span>0</span></p>

          </div>
    </div> --}}

            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">{{__("messages.patroling")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_patrollig_done")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0 KM</span></p>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_notice_generated")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_supervision")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header text-white">{{__("messages.substation")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_substation_visited")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_substation_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">{{__("messages.feeder_pillar")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_feeder_pillar_visited")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_feeder_pillar_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">{{__("messages.total_feeder_pillar_visited")}}</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_tiang_visited")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_tiang_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">{{__("messages.link_box")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_link_box_visited")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_link_box_defects")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header"> {{__("messages.cable_bridge")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_cable_bridge_visited")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_cable_bridge_defects")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>0</span></p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="accordion row" id="accordionExample">

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header  p-2" id="thirdPartyDigingHeading">
                        <h2 class="mb-0">
                            <button class="btn   btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#thirdPartyDiging" aria-expanded="true" aria-controls="collapseOne">
                                <h3> <i class="fas fa-tools"></i>{{__("messages.3rd_party_digging")}}</h3>
                            </button>
                        </h2>
                    </div>

                    <div id="thirdPartyDiging" class="collapse  " aria-labelledby="thirdPartyDigingHeading"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a class=" dropdown-item"
                                        href="{{ route('third-party-digging.create', app()->getLocale()) }}">{{__("messages.create")}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('third-party-digging.index', app()->getLocale()) }}">{{__("messages.index")}}</a>
                                </li>

                                <li>
                                    <a href="/create-patrolling" class="dropdown-item">{{__("messages.patrolling")}}</a>
                                </li>
                                <li>
                                    <a href="/map-1" class="dropdown-item">{{__("messages.map")}}</a>
                                </li>

                                <li>
                                    <a href="/get-all-work-packages" class="dropdown-item">{{__("messages.sbum_approval_and_detail")}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header  p-2" id="substationHeading">
                        <h2 class="mb-0">
                            <button class="btn   btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#substation" aria-expanded="true" aria-controls="collapseOne">
                                <h3><i class="fas fa-building"></i> {{__("messages.substation")}}</h3>
                            </button>
                        </h2>
                    </div>

                    <div id="substation" class="collapse  " aria-labelledby="substationHeading"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a class=" dropdown-item"
                                        href="{{ route('substation.create', app()->getLocale()) }}">{{__("messages.create")}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('substation.index', app()->getLocale()) }}">{{__("messages.index")}}</a>
                                </li>
                                <li>
                                    <a href="/substation-map" class="dropdown-item">{{__("messages.map")}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header  p-2" id="feederPillarHeading">
                        <h2 class="mb-0">
                            <button class="btn   btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#feederPillar" aria-expanded="false" aria-controls="collapseOne">
                                <h3><i class="fas fa-cube"></i> {{__("messages.feeder_pillar")}}</h3>
                            </button>
                        </h2>
                    </div>

                    <div id="feederPillar" class="collapse  " aria-labelledby="feederPillarHeading"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a class=" dropdown-item"
                                        href="{{ route('feeder-pillar.create', app()->getLocale()) }}">{{__("messages.create")}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('feeder-pillar.index', app()->getLocale()) }}">{{__("messages.index")}}</a>
                                </li>
                                <li>
                                    <a href="/feeder-pillar-map" class="dropdown-item">{{__("messages.map")}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header p-2" id="tiangHeading">
                        <h2 class="mb-0">
                            <button class="btn   btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#tiang" aria-expanded="false" aria-controls="collapseOne">
                                <h3> <i class="fas fa-bolt"></i> {{__("messages.tiang_talian_vt_&_vr")}}</h3>
                            </button>
                        </h2>
                    </div>

                    <div id="tiang" class="collapse  " aria-labelledby="tiangHeading"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a class=" dropdown-item"
                                        href="{{ route('tiang-talian-vt-and-vr.create', app()->getLocale()) }}">{{__("messages.create")}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('tiang-talian-vt-and-vr.index', app()->getLocale()) }}">{{__("messages.index")}}</a>
                                </li>
                                <li>
                                    <a href="/tiang-talian-vt-and-vr-map" class="dropdown-item">{{__("messages.map")}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header  p-2" id="linkBoxHeading">
                        <h2 class="mb-0">
                            <button class="btn   btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#linkBox" aria-expanded="false" aria-controls="collapseOne">
                                <h3><i class="fas fa-link"></i>{{__('messages.link_box_pelbagai_voltan')}}</h3>
                            </button>
                        </h2>
                    </div>

                    <div id="linkBox" class="collapse  " aria-labelledby="linkBoxHeading"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a class=" dropdown-item"
                                        href="{{ route('link-box-pelbagai-voltan.create', app()->getLocale()) }}">{{__('messages.create')}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('link-box-pelbagai-voltan.index', app()->getLocale()) }}">{{__('messages.index')}}</a>
                                </li>
                                <li>
                                    <a href="/link-box-pelbagai-voltan-map" class="dropdown-item">{{__('messages.map')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header  p-2" id="cableBridgeHeading">
                        <h2 class="mb-0">
                            <button class="btn   btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#cableBridge" aria-expanded="false" aria-controls="collapseOne">
                                <h3><i class="fas fa-road"></i> {{__('messages.cable_bridge')}}</h3>
                            </button>
                        </h2>
                    </div>

                    <div id="cableBridge" class="collapse  " aria-labelledby="cableBridgeHeading"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a class=" dropdown-item"
                                        href="{{ route('cable-bridge.create', app()->getLocale()) }}">{{__('messages.create')}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('cable-bridge.index', app()->getLocale()) }}">{{__('messages.index')}}</a>
                                </li>
                                <li>
                                    <a href="/cable-bridge-map" class="dropdown-item">{{__('messages.map')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="row ">
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
    </div> --}}
    </div>
@endsection
