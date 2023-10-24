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
                    <h3>{{__('messages.link_box_pelbagai_voltan')}}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">{{__('messages.index')}}</a></li>
                        <li class="breadcrumb-item active">{{__("messages.show")}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" ">

        <div class="container">

            <div class=" ">

                <div class=" card col-md-12 p-4 ">
                    <div class="form-input ">
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
                            <div class="col-md-4"><label for="visit_date">{{__('messages.visit_date')}}</label></div>
                            <div class="col-md-4">
                                <input type="date" readonly class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="patrol_time">{{__('messages.patrol_time')}}</label></div>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control"
                                    value="{{ date('H:i:s', strtotime($data->patrol_time)) }}" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="team">{{__('messages.team_name')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly class="form-control" value="{{ $data->team }}" readonly>
                            </div>
                        </div>

 
                        <div class="row">
                            <div class="col-md-4"><label for="start_date">{{__('messages.from')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->start_date }}" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="end_date">{{__('messages.to')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->end_date }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="type">{{__('messages.type')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->type }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="coordinate">{{__("messages.coordinate")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->coordinate }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="gate_status">{{__("messages.cover_is_not_closed")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->cover_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="vandalism_status">{{__("messages.vandalism")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->vandalism_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="leaning_staus">{{__("messages.leaning")}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->leaning_staus }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row @if ($data->leaning_staus == 'No') d-none @endif " id="leaning-angle">
                            <div class="col-md-4"><label for="leaning_angle">{{__('messages.leaning_angle')}}</label></div>
                            <div class="col-md-4">
                                <input type="text" name="leaning_angle" id="leaning_angle" value="{{ $data->leaning_angle }}" class="form-control" readonly>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="rust_status">{{__('messages.rusty')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->rust_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="advertise_poster_status">{{__("messages.cleaning_illegal_ads_banners")}}</label>
                            </div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->advertise_poster_status }}" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="bushes_status">{{__('messages.rusty')}}</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->bushes_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_gate">{{__('messages.cover_image')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_cover)) && $data->image_cover != '')
                                    <a href="{{ URL::asset($data->image_cover) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_cover) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__("messaages.no_image_found")}}</strong>

                                @endif

                            </div>

                            <div class="col-md-4 text-center  ">
                                @if (file_exists(public_path($data->image_cover_2)) && $data->image_cover_2 != '')
                                    <a href="{{ URL::asset($data->image_cover_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_cover_2) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                              
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_vandalism">{{__('messages.image_vandalism')}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_vandalism)) && $data->image_vandalism != '')
                                    <a href="{{ URL::asset($data->image_vandalism) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_vandalism) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__("messaages.no_image_found")}}</strong>

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
                            <div class="col-md-4"><label for="image_leaning">{{__("messages.image_leaning")}}</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_leaning)) && $data->image_leaning != '')
                                    <a href="{{ URL::asset($data->image_leaning) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_leaning) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__("messaages.no_image_found")}}</strong>

                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_leaning_2)) && $data->image_leaning_2 != '')
                                    <a href="{{ URL::asset($data->image_leaning_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_leaning_2) }}" alt="" height="70"
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
                                <strong>{{__("messaages.no_image_found")}}</strong>

                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_rust)) && $data->image_rust != '')
                                    <a href="{{ URL::asset($data->image_rust) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_rust) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                              
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="images_advertise_poster">{{__('messages.image_advertise_poster')}}</label>
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_advertise_poster)) && $data->images_advertise_poster != '')
                                    <a href="{{ URL::asset($data->images_advertise_poster) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_advertise_poster) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                <strong>{{__("messaages.no_image_found")}}</strong>

                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_advertise_poster_2)) && $data->images_advertise_poster_2 != '')
                                    <a href="{{ URL::asset($data->images_advertise_poster_2) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_advertise_poster_2) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                
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
                                <strong>{{__("messaages.no_image_found")}}</strong>

                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
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
                                    <strong>{{__("messaages.no_image_found")}}</strong>
                                @endif
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
