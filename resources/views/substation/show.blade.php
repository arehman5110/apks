@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/test/css/style.css') }}" /> --}}
    <style>

        input[type='checkbox'],
        input[type='radio'] {
            min-width: 16px !important;
            margin-right: 12px;
        }

        .error {
            color: red;
        }

        label {
            margin-bottom: 0px !important;
            margin-top: 1rem;
        }

        input,
        select {
            /* color: black !important; */
            margin-bottom: 0px !important;
            margin-top: 1rem;
        }

        .adjust-height {
            height: 70px;
        }
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{__('messages.substation')}}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item text-lowercase"><a href="{{route('substation.index',app()->getLocale())}}">{{__('messages.index')}}</a></li>
                        <li class="breadcrumb-item text-lowercase active">{{__('messages.show')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" ">

        <div class="container">

            <div class=" ">

                <div class=" card col-md-12 p-4 ">
                    <div class=" ">
                        <h3 class="text-center p-2"></h3>


                        <div class="row">
                            <div class="col-md-4"><label for="zone">{{__('messages.zone')}}</label></div>
                            <div class="col-md-4"><input readonly value="{{ $data->zone }}" class="form-control">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="ba">{{__('messages.ba')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->ba }}" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="team">{{__('messages.team_name')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly class="form-control" value="{{ $data->team }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="visit_date">{{__('messages.visit_date')}}</label></div>
                            <div class="col-md-4">
                                <input type="date" readonly class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="patrol_time">{{__('messages.patrol_time')}}</label></div>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control" value="{{ date('H:i:s', strtotime($data->patrol_time)) }}"
                                    required>
                            </div>
                        </div>






                        <div class="row">
                            <div class="col-md-4"><label for="area">{{__('messages.voltage')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->voltage }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="start_date">{{__('messages.name')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->name }}" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="end_date">{{__('messages.type')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->type }}" class="form-control" required>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-4"><label for="voltage">{{__('messages.coordinate')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->coordinate }}" class="form-control" required>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-4"><label for="gate">{{__('messages.gate')}}</label></div>
                            <div class="col-md-4">
                                <div class="  d-flex">
                                    <input type="checkbox" name="gate_status[locked]"  {{substaionCheckBox('locked', $data->gate_status)}} id="gate_status_locked" disabled>
                                    <label for="gate_status_locked">{{__('messages.locked')}}</label>
                                </div>
                                <div class=" d-flex">
                                    <input type="checkbox" name="gate_status[unlocked]" {{substaionCheckBox('unlocked', $data->gate_status)}} id="gate_status_unlocked" disabled>
                                    <label for="gate_status_unlocked">{{__('messages.unlocked')}}</label>
                                </div>
                                <div class=" d-flex">
                                    <input type="checkbox" name="gate_status[demaged]" {{substaionCheckBox('demaged', $data->gate_status)}} id="gate_status_demaged" disabled>
                                    <label for="gate_status_demaged">{{__('messages.demaged')}}</label>
                                </div>

                                    <div class="d-flex">
                                    <input type="checkbox" name="gate_status[other]" {{substaionCheckBox('other', $data->gate_status)}} id="gate_status_others" disabled onclick="getStatus(this)">
                                    <label for="gate_status_others">{{__('messages.others')}}</label>


                                </div>
                                <input type="text" name="gate_status[other_value]" id="gate_status_other" class="form-control  @if(substaionCheckBox('other', $data->gate_status)   !== 'checked' ) d-none @endif" value="@if (substaionCheckBox('other', $data->gate_status) == 'checked')
{{$data->gate_status->other_value}}
                                @endif"  placeholder="please enter other gate defect" disabled >

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="grass_status">{{__('messages.long_grass')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->grass_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="tree_branches_status">{{__('messages.tree_branches_in_PE')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->tree_branches_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="building_status">{{__('messages.building_defects')}}</label></div>
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <input type="checkbox" name="building_status[broken_roof]" {{substaionCheckBox('broken_roof', $data->building_status)}} disabled  id="building_status_broken_roof">
                                    <label for="building_status_broken_roof">{{__('messages.broken_roof')}}</label>
                                </div>

                                <div class="d-flex">
                                    <input type="checkbox" name="building_status[broken_gutter]" {{substaionCheckBox('broken_gutter', $data->building_status)}} disabled id="building_status_broken_gutter">
                                    <label for="building_status_broken_gutter">{{__('messages.broken_gutter')}}</label>
                                </div>

                                <div class="d-flex">
                                    <input type="checkbox" name="building_status[broken_base]" {{substaionCheckBox('broken_base', $data->building_status)}}  disabledid="building_status_broken_base">
                                    <label for="building_status_broken_base">{{__('messages.broken_base')}}</label>
                                </div>

                               <div class="d-flex">
                                    <input type="checkbox" name="building_status[other]" {{substaionCheckBox('other', $data->building_status)}} disabled id="building_status_other" onclick="bulidingStatus(this)">
                                    <label for="building_status_other">{{__('messages.others')}}</label>
                                </div>

                                <input type="text" name="building_status[other_value]" id="other_building_defects" placeholder="please enter other buliding defects"disabled class="form-control @if(substaionCheckBox('other', $data->building_status)   !== 'checked' ) d-none @endif"
                                value="@if(substaionCheckBox('other_value', $data->building_status)   == 'checked' ) {{$data->building_status->other_value}} @endif"
                                >

                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="rust_status">{{__('messages.cleaning_illegal_ads_banners')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->advertise_poster_status }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="image_pipe">{{ __('messages.substation') }} {{__('messages.images')}} </label>
                            </div>
                            <div class="col-md-8 row">


                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->substation_image_1)) && $data->substation_image_1 != '')
                                            <a href="{{ URL::asset($data->substation_image_1) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->substation_image_1) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>





                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->substation_image_2)) && $data->substation_image_2 != '')
                                            <a href="{{ URL::asset($data->substation_image_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->substation_image_2) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>


                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="image_pipe">{{__('messages.image_gate')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_gate)) && $data->image_gate != '')
                                    <a href="{{ URL::asset($data->image_gate) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_gate) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__('messages.no_image_found')}}</strong>

                                @endif
                            </div>
                                <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_gate_2)) && $data->image_gate_2 != '')
                                    <a href="{{ URL::asset($data->image_gate_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_gate_2) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>

                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_vandalism">{{__('messages.image_grass')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_grass)) && $data->image_grass != '')
                                    <a href="{{ URL::asset($data->image_grass) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_grass) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__('messages.no_image_found')}}</strong>

                                @endif
                            </div>
                                <div class="col-md-4 text-center mb-3">

                                @if (file_exists(public_path($data->image_grass_2)) && $data->image_grass_2 != '')
                                    <a href="{{ URL::asset($data->image_grass_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_grass_2) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>


                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_collapsed">{{__('messages.image_tree_branches')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_tree_branches)) && $data->image_tree_branches != '')
                                    <a href="{{ URL::asset($data->image_tree_branches) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_tree_branches) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__('messages.no_image_found')}}</strong>

                                @endif
                            </div>
                                <div class="col-md-4 text-center mb-3">

                                @if (file_exists(public_path($data->image_tree_branches_2)) && $data->image_tree_branches_2 != '')
                                <a href="{{ URL::asset($data->image_tree_branches_2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->image_tree_branches_2) }}" alt="" height="70"
                                        class="adjust-height ml-5  "></a>


                            @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="image_rust">{{__('messages.images_gate_after_lock')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_gate_after_lock)) && $data->images_gate_after_lock != '')
                                    <a href="{{ URL::asset($data->images_gate_after_lock) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_gate_after_lock) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__('messages.no_image_found')}}</strong>

                                @endif
                            </div>
                                <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_gate_after_lock_2)) && $data->images_gate_after_lock_2 != '')
                                    <a href="{{ URL::asset($data->images_gate_after_lock_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_gate_after_lock_2) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>


                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="images_bushes">{{__('messages.image_building')}}</label></div>

                            <div class="col-md-4 text-center  ">
                                @if (file_exists(public_path($data->image_building)) && $data->image_building != '')
                                    <a href="{{ URL::asset($data->image_building) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_building) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__('messages.no_image_found')}}</strong>

                                @endif
                            </div>
                                <div class="col-md-4 text-center mb-3">

                                @if (file_exists(public_path($data->image_building_2)) && $data->image_building_2 != '')
                                <a href="{{ URL::asset($data->image_building_2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->image_building_2) }}" alt="" height="70"
                                        class="adjust-height ml-5  "></a>


                            @endif
                            </div>
                        </div>

{{--
                        <div class="row">
                            <div class="col-md-4"><label for="img_advertise_poster">{{__('messages.image_advertise_poster')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->img_advertise_poster)) && $data->img_advertise_poster != '')
                                    <a href="{{ URL::asset($data->img_advertise_poster) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->img_advertise_poster) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__('messages.no_image_found')}}</strong>

                                @endif


                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-4"><label for="other_image">{{__('messages.other_image')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
                                    <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->other_image) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{__('messages.no_image_found')}}</strong>

                                @endif


                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
