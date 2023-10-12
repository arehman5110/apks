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
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Substation</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('substation.index')}}">index</a></li>
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
                            <div class="col-md-4"><label for="ba">Ba</label></div>
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


                        <div class="row">
                            <div class="col-md-4"><label for="area">voltage</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->voltage }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="start_date">name</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->name }}" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="end_date">type</label></div>
                            <div class="col-md-4">
                                <input type="text" readonly value="{{ $data->type }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="voltage">coordinate</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->coordinate }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="coordinate">Gate</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->gate_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="pipe_staus">Long Grass</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->grass_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="collapsed_status">Tree Branches in PE</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->tree_branches_status }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="building_status">Building Defects</label></div>
                            <div class="col-md-4">
                                <input readonly value="{{ $data->building_status }}" class="form-control" required>

        
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="rust_status">Cleaning illegal ads/banners</label></div>
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
                            <div class="col-md-4"><label for="image_vandalism">Image Grass</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_grass)) && $data->image_grass != '')
                                    <a href="{{ URL::asset($data->image_grass) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_grass) }}" alt=""
                                            height="70" class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="image_collapsed">Image Tree Branches</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_tree_branches)) && $data->image_tree_branches != '')
                                    <a href="{{ URL::asset($data->image_tree_branches) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_tree_branches) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="image_rust">Images Gate After Lock</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->images_gate_after_lock)) && $data->images_gate_after_lock != '')
                                    <a href="{{ URL::asset($data->images_gate_after_lock) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->images_gate_after_lock) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="images_bushes">Image Building</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->image_building)) && $data->image_building != '')
                                    <a href="{{ URL::asset($data->image_building) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->image_building) }}" alt="" height="70"
                                            class="adjust-height ml-5  "></a>
                                @else
                                    <strong>No image found</strong>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4"><label for="img_advertise_poster">Image Advertise Poster</label></div>

                            <div class="col-md-4 text-center mb-3">
                                @if (file_exists(public_path($data->img_advertise_poster)) && $data->img_advertise_poster != '')
                                    <a href="{{ URL::asset($data->img_advertise_poster) }}" data-lightbox="roadtrip">
                                        <img src="{{ URL::asset($data->img_advertise_poster) }}" alt="" height="70"
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
