@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />
    @include('partials.map-css')
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
        #map {
            margin: 30px;
            height: 400px;
            padding: 20px;
        }
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Feedar Piller</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('substation.index')}}">index</a></li>
                        <li class="breadcrumb-item active">edit</li>
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

                        <form action="{{ route('feeder-pillar.store') }} " id="myForm" method="POST"
                            enctype="multipart/form-data"  onsubmit="return submitFoam()">
                            @csrf


                            <div class="row">
                                <div class="col-md-4"><label for="zone">Zone</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control" required>

                                        <option value="" hidden>select zone</option>
                                        <option value="W1">W1</option>
                                        <option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B4">B4</option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">Ba</label></div>
                                <div class="col-md-4"><select name="ba_s" id="ba_s" class="form-control" required
                                        onchange="getWp(this)">
                                        <option value="" hidden>select zone</option>

                                    </select>
                                    <input type="hidden" name="ba" id="ba">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="team">Team</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="team" id="team" value="{{$team}}"
                                        class="form-control"  readonly>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="visit_date">Visit Date</label></div>
                                <div class="col-md-4">
                                    <input type="date" name="visit_date" id="visit_date"
                                        class="form-control" required>
                                    </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="patrol_time">Patrol Time</label></div>
                                <div class="col-md-4">
                                    <input type="time" name="patrol_time" id="patrol_time"
                                        class="form-control" required>
                                    </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="fl">feeder_involved</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="feeder_involved" id="feeder_involved"
                                        class="form-control" required>
                                    </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="voltage">Area</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="area" id="area"
                                        class="form-control" required >
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="name">Size</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="size" id="size"
                                        class="form-control" required>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="coordinate">Coordinate</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="coordinate" id="coordinate"
                                        class="form-control" required>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="gate_status">Gate Status</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="gate_status" id="gate_status"
                                    class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="vandalism_status">Vandalism Status</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="vandalism_status" id="vandalism_status"
                                        class="form-control" required>
                                    </div>
                            </div>





                              <div class="row">
                                <div class="col-md-4"><label for="leaning_staus">Leaning Staus</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="leaning_staus" id="leaning_staus"
                                        class="form-control" required>
                                    </div>
                            </div>
                              <div class="row">
                                <div class="col-md-4"><label for="rust_status">Rust Status</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="rust_status" id="rust_status"
                                        class="form-control" required>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="advertise_poster_status">Advertise Poster Status</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="advertise_poster_status" id="advertise_poster_status"
                                        class="form-control" required>
                                    </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="image_gate">Image Gate</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_gate" id="image_gate"
                                        class="form-control" >
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="image_grass">Image Vandalism</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_vandalism" id="image_vandalism"
                                        class="form-control" >
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="images_gate_after_lock">Image Leaning</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_leaning" id="image_leaning"
                                        class="form-control" >
                                    </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="image_rust">Image Rust</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_rust" id="image_rust"
                                        class="form-control" >
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="images_advertise_poster">Images Advertise Poster</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="images_advertise_poster" id="images_advertise_poster"
                                        class="form-control" >
                                    </div>
                            </div>

                             <div class="row">
                                <div class="col-md-4"><label for="other_image">Other Image</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="other_image" id="other_image"
                                        class="form-control" >
                                    </div>
                            </div>

                            <input type="hidden" name="lat" id="lat" required class="form-control">
                            <input type="hidden" name="log" id="log" class="form-control">
                            <div class="text-center">
                                <strong>  <span class="text-danger map-error"  ></span></strong>
                              </div>
                              <div id="map"></div>

                            <div class="text-center p-4"><button class="btn btn-sm btn-success">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js') }}"></script>

   @include('partials.form-map-js')
@endsection
