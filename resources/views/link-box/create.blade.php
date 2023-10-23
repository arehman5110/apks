@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />
    @include('partials.map-css')

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
        .form-input{border: 0}
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Link Box Pelbagai Voltan</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('link-box-pelbagai-voltan.index',app()->getLocale()) }}">index</a></li>
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
                    <div class="form-input ">
                        <h3 class="text-center p-2"></h3>

                        <form action="{{ route('link-box-pelbagai-voltan.store', app()->getLocale()) }} " id="myForm" method="POST"
                            enctype="multipart/form-data" onsubmit="return submitFoam()">
                            @csrf


                            <div class="row">
                                <div class="col-md-4"><label for="zone">Zone</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control" required>

                                        @if (Auth::user()->zone == '')
                                            <option value="" hidden>select zone</option>
                                            <option value="W1">W1</option>
                                            <option value="B1">B1</option>
                                            <option value="B2">B2</option>
                                            <option value="B4">B4</option>
                                        @else
                                            <option value="{{ Auth::user()->zone }}" hidden>{{ Auth::user()->zone }}
                                            </option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="ba">BA</label></div>
                                <div class="col-md-4"><select name="ba_s" id="ba_s" class="form-control" required
                                        onchange="getWp(this)">
                                        <option value="" hidden>select zone</option>

                                    </select>
                                    <input type="hidden" name="ba" id="ba">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="visit_date">Visit Date</label></div>
                                <div class="col-md-4">
                                    <input type="date" name="visit_date" id="visit_date" class="form-control" required
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="patrol_time">Patrol Time</label></div>
                                <div class="col-md-4">
                                    <input type="time" name="patrol_time" id="patrol_time" class="form-control" required
                                        value="{{ date('H:i') }}">
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="team">Team</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="team" id="team" value="{{ $team }}"
                                        class="form-control" readonly>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="start_date">From</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="start_date" id="start_date" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="end_date">To</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="end_date" id="end_date" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="type">Type</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="type" id="type" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="cover_status">Cover is Not Closed</label></div>
                                <div class="col-md-4">
                                    <select name="cover_status" id="cover_status" class="form-control" required>
                                        <option value="" hidden>select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="vandalism_status">Vandalism </label></div>
                                <div class="col-md-4">
                                    <select name="vandalism_status" id="vandalism_status" class="form-control" required>
                                        <option value="" hidden>select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="leaning_staus">Leaning </label></div>
                                <div class="col-md-4">
                                    <select name="leaning_staus" id="leaning_staus" class="form-control" required
                                        onchange="leaningStatus(this)">
                                        <option value="" hidden>select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row  d-none" id="leaning-angle">
                                <div class="col-md-4"><label for="leaning_angle">Leaning angle</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="leaning_angle" id="leaning_angle" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="rust_status">Rusty</label></div>
                                <div class="col-md-4">
                                    <select name="rust_status" id="rust_status" class="form-control" required>
                                        <option value="" hidden>select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="advertise_poster_status">Cleaning illegal
                                        ads/banners</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="advertise_poster_status" id="advertise_poster_status"
                                        class="form-control" required>
                                        <option value="" hidden>select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="bushes_status">Bushy</label></div>
                                <div class="col-md-4">
                                    <select name="bushes_status" id="bushes_status" class="form-control" required>
                                        <option value="" hidden>select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="image_gate">Cover Image</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_cover" id="image_cover" class="form-control" accept="image/*">
                                    <input type="file" name="image_cover_2" id="image_cover_2" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="image_vandalism">Image vandalism</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_vandalism" id="image_vandalism" class="form-control" accept="image/*">
                                    <input type="file" name="image_vandalism_2" id="image_vandalism_2" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="image_leaning">Image Leaning</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_leaning" id="image_leaning" class="form-control" accept="image/*">
                                    <input type="file" name="image_leaning_2" id="image_leaning_2" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="image_rust">Image Rust</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_rust" id="image_rust" class="form-control" accept="image/*">
                                    <input type="file" name="image_rust_2" id="image_rust_2" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="images_advertise_poster">Images Advertise Poster</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="images_advertise_poster" id="images_advertise_poster" class="form-control" accept="image/*">
                                    <input type="file" name="images_advertise_poster_2" id="images_advertise_poster_2" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="images_bushes">Images Bushes</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="images_bushes" id="images_bushes" class="form-control" accept="image/*">
                                    <input type="file" name="images_bushes_2" id="images_bushes_2" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="other_image">Other Image</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="other_image" id="other_image" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="coordinate">Coordinate</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="coordinate" id="coordinate" class="form-control" readonly
                                        required>
                                </div>
                            </div>



                            <input type="hidden" name="lat" id="lat" required class="form-control">
                            <input type="hidden" name="log" id="log" class="form-control">
                            <div class="text-center">
                                <strong> <span class="text-danger map-error"></span></strong>
                            </div>
                            <div id="map">

                            </div>

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

    <script>
        const b1Options = [
            ['W1', 'KUALA LUMPUR PUSAT', 3.14925905877391, 101.754098819705],
            ['B1', 'PETALING JAYA', 3.1128074178475, 101.605270457169],
            ['B1', 'RAWANG', 3.47839445121726, 101.622905486475],
            ['B1', 'KUALA SELANGOR', 3.40703209426401, 101.317426926947],
            ['B2', 'KLANG', 3.08428642705789, 101.436185279023],
            ['B2', 'PELABUHAN KLANG', 2.98188527916042, 101.324234779569],
            ['B4', 'CHERAS', 3.14197346621987, 101.849883983416],
            ['B4', 'BANTING', 2.82111390453244, 101.505890775541],
            ['B4', 'BANGI', 2.965810949933260, 101.81881303103104],
            ['B4', 'PUTRAJAYA & CYBERJAYA', 2.92875032271019, 101.675338316575]
        ];
        const userBa = "{{ Auth::user()->ba }}";
        $(document).ready(function() {



            if (userBa !== '') {
                getBaPoints(userBa)
            }

        });


        function getBaPoints(param) {
            var baSelect = $('#ba_s')
            baSelect.empty();

            b1Options.map((data) => {
                if (data[1] == param) {
                    baSelect.append(`<option value="${data}">${data[1]}</option>`)
                }
            });
            let baVal = document.getElementById('ba_s');
            getWp(baVal)
        }

        function leaningStatus(event) {
            var val = event.value;
            if (val == 'No') {
                if (!$('#leaning-angle').hasClass('d-none')) {
                    $('#leaning-angle').addClass('d-none')
                }
            } else {
                $('#leaning-angle').removeClass('d-none')
            }
        }
    </script>
@endsection
