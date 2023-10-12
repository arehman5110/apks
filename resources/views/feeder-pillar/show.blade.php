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
                    <h3>Feeder Pillar</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('feeder-pillar.index')}}">index</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                            <div class="col-md-4"><label for="zone">Zone</label></div>
                            <div class="col-md-4"><input readonly value="{{ $data->zone }}" class="form-control">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="ba">BA</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->ba }}" class="form-control">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="visit_date">Visit Date</label></div>
                            <div class="col-md-4">
                                <input type="date" readonly class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-4"><label for="patrol_time">Patrol Time</label></div>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control" value="{{ date('H:i:s', strtotime($data->patrol_time)) }}"
                                    required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4"><label for="team">Team</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly class="form-control" value="{{ $data->team }}" readonly>
                            </div>
                        </div>


                        {{-- <div class="row">
                            <div class="col-md-4"><label for="area">Area</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->area }}" class="form-control">
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-4"><label for="start_date">size</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->size }}" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="voltage">coordinate</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->coordinate }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="end_date">Gate Status</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->gate_status }}" class="form-control" required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="coordinate">Vandalism </label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->vandalism_status }}" class="form-control" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4"><label for="leaning_staus">Leaning </label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->leaning_staus }}" class="form-control" required>


                            </div>
                        </div>

                        <div class="row @if ($data->leaning_staus == 'No') d-none @endif " id="leaning-angle">
                            <div class="col-md-4"><label for="leaning_angle">Leaning angle</label></div>
                            <div class="col-md-4">
                                <input type="text" name="leaning_angle" id="leaning_angle" value="{{ $data->leaning_angle }}" class="form-control" readonly>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="pipe_staus">Rusty</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->rust_status }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="advertise_poster_status">
                                Cleaning illegal ads/banners</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->advertise_poster_status }}" class="form-control" required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="image_pipe">Image Gate</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_gate)) && $data->image_gate != '')
                                    <a href="{{ URL::asset($data->image_gate) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_gate) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_vandalism">Image Vandalism</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_vandalism)) && $data->image_vandalism != '')
                                    <a href="{{ URL::asset($data->image_vandalism) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_vandalism) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_collapsed">Image Leaning</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_leaning)) && $data->image_leaning != '')
                                    <a href="{{ URL::asset($data->image_leaning) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_leaning) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="image_rust">Image Rust</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_rust)) && $data->image_rust != '')
                                    <a href="{{ URL::asset($data->image_rust) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_rust) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="images_advertise_poster">Images Advertise Poster</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_advertise_poster)) && $data->images_advertise_poster != '')
                                    <a href="{{ URL::asset($data->images_advertise_poster) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_advertise_poster) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="other_image">Other Image</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
                                    <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->other_image) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
