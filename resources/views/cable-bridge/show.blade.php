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
            color: black !important;
            margin-bottom: 0px !important;
            margin-top: 1rem;
        }

        .adjust-height {
            height: 70px;
        }
        .form-input{border: 0}

    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{__('messages.cable_bridge')}}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('cable-bridge.index',app()->getLocale())}}">{{__("messages.index")}}</a></li>
                        <li class="breadcrumb-item active">{{__("messages.show")}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" ">

        <div class="container">


                <div class=" card col-md-12 p-4 ">
                    <div class=" form-input">
                        <h3 class="text-center p-2"></h3>


                        <div class="row">
                            <div class="col-md-4"><label for="zone">{{__("messages.zone")}}</label></div>
                            <div class="col-md-4"><input readonly value="{{ $data->zone }}" class="form-control">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="ba">{{__("messages.ba")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->ba }}" class="form-control">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="visit_date">{{__("messages.visit_date")}}</label></div>
                            <div class="col-md-4">
                                <input type="date" readonly class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="patrol_time">{{__("messages.patrol_time")}}</label></div>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control" value="{{ date('H:i:s', strtotime($data->patrol_time)) }}"
                                    required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="team">{{__("messages.team_name")}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly class="form-control" value="{{ $data->team }}" readonly>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4"><label for="start_date">{{__("messages.from")}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->start_date }}" class="form-control"
                                    >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="end_date">{{__("messages.to")}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->end_date }}" class="form-control" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="voltage">{{__("messages.voltage")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->voltage }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="coordinate">{{__("messages.coordinate")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->coordinate }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="pipe_staus">{{__("messages.pipe")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->pipe_staus }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="collapsed_status">{{__("messages.collapsed")}} </label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->collapsed_status }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="rust_status">{{__("messages.rusty")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->rust_status }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="bushes_status">{{__("messages.bushy")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->bushes_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_pipe">{{__("messages.image_pipe")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_pipe)) && $data->image_pipe != '')
                                    <a href="{{ URL::asset($data->image_pipe) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_pipe) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{__("messages.no_image_found")}}</strong>
                                @endif

                                </div><div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_pipe_2)) && $data->image_pipe_2 != '')
                                <a href="{{ URL::asset($data->image_pipe_2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->image_pipe_2) }}" alt="" height="70"
                                        class="adjust-height ml-5  "></a>

                            @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_vandalism">{{__("messages.image_vandalism")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_vandalism)) && $data->image_vandalism != '')
                                    <a href="{{ URL::asset($data->image_vandalism) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_vandalism) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{__("messages.no_image_found")}}</strong>
                                @endif
                            </div><div class="col-md-4 text-center mb-3">


                                @if (file_exists(public_path($data->image_vandalism_2)) && $data->image_vandalism_2 != '')
                                <a href="{{ URL::asset($data->image_vandalism_2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->image_vandalism_2) }}" alt=""
                                        height="70" class="adjust-height ml-5  "></a>

                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_collapsed">{{__("messages.image_collapsed")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_collapsed)) && $data->image_collapsed != '')
                                    <a href="{{ URL::asset($data->image_collapsed) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_collapsed) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{__("messages.no_image_found")}}</strong>
                                @endif
                            </div><div class="col-md-4 text-center mb-3">


                                @if (file_exists(public_path($data->image_collapsed)) && $data->image_collapsed != '')
                                    <a href="{{ URL::asset($data->image_collapsed) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_collapsed) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>

                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="image_rust">{{__("messages.image_rust")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_rust)) && $data->image_rust != '')
                                    <a href="{{ URL::asset($data->image_rust) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_rust) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{__("messages.no_image_found")}}</strong>
                                @endif
                            </div><div class="col-md-4 text-center mb-3">


                                @if (file_exists(public_path($data->image_rust_2)) && $data->image_rust_2 != '')
                                    <a href="{{ URL::asset($data->image_rust_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_rust_2) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>

                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="images_bushes">{{__("messages.image_bushes")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_bushes)) && $data->images_bushes != '')
                                    <a href="{{ URL::asset($data->images_bushes) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_bushes) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>{{__("messages.no_image_found")}}</strong>
                                @endif
                            </div><div class="col-md-4 text-center mb-3">

                                @if (file_exists(public_path($data->images_bushes_2)) && $data->images_bushes_2 != '')
                                <a href="{{ URL::asset($data->images_bushes_2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->images_bushes_2) }}" alt="" height="70"
                                        class="adjust-height ml-5  "></a>

                            @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="other_image">{{__("messages.other_image")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
                                    <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->other_image) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__("messages.no_image_found")}}</strong>

                                @endif
                                <div class="col-md-4 text-center mb-3"></div>


                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
