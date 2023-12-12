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

        .form-input {
            border: 0
        }
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.feedar_piller') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item text-lowercase"><a
                                href="{{ route('feeder-pillar.index', app()->getLocale()) }}">{{ __('messages.index') }}</a>
                        </li>
                        <li class="breadcrumb-item text-lowercase active">{{ __('messages.show') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" ">

        <div class="container">

            <div class="">

                <div class=" card col-md-12 p-4 ">
                    <div class=" form-input ">
                        <h3 class="text-center p-2"></h3>


                        <div class="row">
                            <div class="col-md-4"><label for="zone">{{ __('messages.zone') }}</label></div>
                            <div class="col-md-4"><input readonly value="{{ $data->zone }}" class="form-control">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="ba">{{ __('messages.ba') }}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->ba }}" class="form-control">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="voltage">{{ __('messages.coordinate') }}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->coordinate }}" class="form-control" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4"><label for="visit_date">{{ __('messages.visit_date') }}</label></div>
                            <div class="col-md-4">
                                <input type="date" readonly class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="patrol_time">{{ __('messages.patrol_time') }}</label></div>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control"
                                    value="{{ date('H:i:s', strtotime($data->patrol_time)) }}" required>
                            </div>
                        </div>




                        {{-- <div class="row">
                            <div class="col-md-4"><label for="area">Area</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->area }}" class="form-control">
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-4"><label for="start_date">{{ __('messages.size') }}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->size }}" class="form-control" required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="end_date">{{ __('messages.gate') }}</label></div>
                            <div class="col-md-4">
                               
                                <div class=" d-flex">
                                    <input type="checkbox" name="gate_status[unlocked]"
                                        {{ substaionCheckBox('unlocked', $data->gate_status) }} id="gate_status_unlocked"
                                        disabled>
                                    <label for="gate_status_unlocked">{{ __('messages.unlocked') }}</label>
                                </div>
                                <div class=" d-flex">
                                    <input type="checkbox" name="gate_status[demaged]"
                                        {{ substaionCheckBox('demaged', $data->gate_status) }} id="gate_status_demaged"
                                        disabled>
                                    <label for="gate_status_demaged">{{ __('messages.demaged') }}</label>
                                </div>

                                <div class="d-flex">
                                    <input type="checkbox" name="gate_status[other]"
                                        {{ substaionCheckBox('other', $data->gate_status) }} id="gate_status_others"
                                        disabled onclick="getStatus(this)">
                                    <label for="gate_status_others">{{ __('messages.others') }}</label>


                                </div>
                                <input type="text" name="gate_status[other_value]" id="gate_status_other"
                                    class="form-control  @if (substaionCheckBox('other', $data->gate_status) !== 'checked') d-none @endif"
                                    value="@if (substaionCheckBox('other', $data->gate_status) == 'checked') {{ $data->gate_status->other_value }} @endif"
                                    placeholder="please enter other gate defect" disabled>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="coordinate">{{ __('messages.vandalism') }} </label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->vandalism_status }}" class="form-control" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4"><label for="leaning_staus">{{ __('messages.leaning') }} </label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->leaning_staus }}" class="form-control" required>


                            </div>
                        </div>

                        <div class="row @if ($data->leaning_staus == 'No') d-none @endif " id="leaning-angle">
                            <div class="col-md-4"><label for="leaning_angle">{{ __('messages.leaning_angle') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="leaning_angle" id="leaning_angle"
                                    value="{{ $data->leaning_angle }}" class="form-control" readonly>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="pipe_staus">{{ __('messages.rusty') }}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->rust_status }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label
                                    for="advertise_poster_status">{{ __('messages.cleaning_illegal_ads_banners') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->advertise_poster_status }}" class="form-control"
                                    required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <label for="feeder_pillar_image">{{__('messages.feedar_piller')}} {{__("messages.images")}} </label>
                            </div>



                                <div class="col-md-4 text-center  ">
                                    @if (file_exists(public_path($data->feeder_pillar_image_1)) && $data->feeder_pillar_image_1 != '')
                                        <a href="{{ URL::asset($data->feeder_pillar_image_1) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->feeder_pillar_image_1) }}" alt="" height="70" class="adjust-height ml-5 ">
                                        </a>
                                    @else
                                        <strong>{{ __('messages.no_image_found') }}</strong>
                                    @endif
                                </div>



                                <div class="col-md-4 text-center  ">
                                    @if (file_exists(public_path($data->feeder_pillar_image_2)) && $data->feeder_pillar_image_2 != '')
                                        <a href="{{ URL::asset($data->feeder_pillar_image_2) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->feeder_pillar_image_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                        </a>

                                    @endif
                                </div>


                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="image_pipe">{{ __('messages.image_gate') }}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_gate)) && $data->image_gate != '')
                                    <a href="{{ URL::asset($data->image_gate) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_gate) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
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
                            <div class="col-md-4"><label
                                    for="image_vandalism">{{ __('messages.image_vandalism') }}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_vandalism)) && $data->image_vandalism != '')
                                    <a href="{{ URL::asset($data->image_vandalism) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_vandalism) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">

                                @if (file_exists(public_path($data->image_vandalism_2)) && $data->image_vandalism_2 != '')
                                    <a href="{{ URL::asset($data->image_vandalism_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_vandalism_2) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_collapsed">{{ __('messages.image_leaning') }}</label>
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_leaning)) && $data->image_leaning != '')
                                    <a href="{{ URL::asset($data->image_leaning) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_leaning) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_leaning_2)) && $data->image_leaning_2 != '')
                                    <a href="{{ URL::asset($data->image_leaning_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_leaning_2) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="image_rust">{{ __('messages.image_rust') }}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_rust)) && $data->image_rust != '')
                                    <a href="{{ URL::asset($data->image_rust) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_rust) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">

                                @if (file_exists(public_path($data->image_rust_2)) && $data->image_rust_2 != '')
                                    <a href="{{ URL::asset($data->image_rust_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_rust_2) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label
                                    for="images_advertise_poster">{{ __('messages.image_advertise_poster') }}</label>
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_advertise_poster)) && $data->images_advertise_poster != '')
                                    <a href="{{ URL::asset($data->images_advertise_poster) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_advertise_poster) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_advertise_poster_2)) && $data->images_advertise_poster_2 != '')
                                    <a href="{{ URL::asset($data->images_advertise_poster_2) }}"
                                        data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_advertise_poster_2) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="other_image">{{ __('messages.other_image') }}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
                                    <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->other_image) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
                                @endif
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
