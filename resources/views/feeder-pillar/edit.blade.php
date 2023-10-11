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
                    <h3>Feeder Pillar</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('feeder-pillar.index') }}">index</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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

                        <form action="{{ route('feeder-pillar.update', $data->id) }} " id="myForm" method="POST"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf


                            <div class="row">
                                <div class="col-md-4"><label for="zone">Zone</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control" required>

                                        <option value="{{ $data->zone }}" hidden>{{ $data->zone }}</option>
                                        <option value="W1">W1</option>
                                        <option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B4">B4</option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">Ba</label></div>
                                <div class="col-md-4"><select name="ba" id="ba" class="form-control" required
                                        onchange="getWp(this)">
                                        <option value="" hidden>select zone</option>

                                    </select></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="visit_date">Visit Date</label></div>
                                <div class="col-md-4">
                                    <input type="date" name="visit_date" id="visit_date" class="form-control"
                                        value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="patrol_time">Patrol Time</label></div>
                                <div class="col-md-4">
                                    <input type="time" name="patrol_time" id="patrol_time" class="form-control"
                                        value="{{ date('H:i:s', strtotime($data->patrol_time)) }}" required>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="team">Team</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="team" id="team" class="form-control"
                                        value="{{ $data->team }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="coordinate">Coordinate</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="coordinate" id="coordinate" value="{{ $data->coordinate }}"
                                        class="form-control" required readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="area">Size</label></div>
                                <div class="col-md-4">

                                    <select name="size" id="size" class="form-control" required>
                                        <option value="{{ $data->size }}" hidden>{{ $data->size }}</option>
                                        <option value="400">400</option>
                                        <option value="800">800</option>
                                        <option value="1600">1600</option>
                                    </select>

                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="name">Gate Status</label></div>
                                <div class="col-md-4">
                                    <select name="gate_status" id="gate_status" required class="form-control"
                                        onchange="getStatus(this)">
                                        <option value="{{ $data->gate_status }}" hidden>{{ $data->gate_status }}</option>
                                        <option value="Locked">Locked</option>
                                        <option value="Unlocked">Unlocked</option>
                                        <option value="Others">Others</option>
                                    </select>


                                </div>
                            </div>

                            <div class="row  d-none" id="other-gate-status">
                                <div class="col-md-4"><label for="other_gate_status">Other Gate Status</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="other_gate_status" id="other_gate_status"
                                        class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="type">Vandalism </label></div>
                                <div class="col-md-4">
                                    <select name="vandalism_status" id="vandalism_status" class="form-control" required>
                                        <option value="{{ $data->vandalism_status }}" hidden>
                                            {{ $data->vandalism_status }}</option>
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
                                        <option value="{{ $data->leaning_staus }}" hidden>{{ $data->leaning_staus }}
                                        </option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row @if ($data->leaning_staus == 'No') d-none @endif " id="leaning-angle">
                                <div class="col-md-4"><label for="leaning_angle">Leaning angle</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="leaning_angle" id="leaning_angle" value="{{ $data->leaning_angle }}" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="voltage">Rust Status</label></div>
                                <div class="col-md-4">

                                    <select name="rust_status" id="rust_status" class="form-control" required>
                                        <option value="{{ $data->rust_status }}" hidden>{{ $data->rust_status }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="advertise_poster_status">
                                    Cleaning illegal ads/banners</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="advertise_poster_status" id="advertise_poster_status"
                                        class="form-control" required>
                                        <option value="{{ $data->advertise_poster_status }}" hidden>
                                            {{ $data->advertise_poster_status }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="image_pipe">Image Gate</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_gate" id="image_gate" class="form-control">
                                </div>
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
                                <div class="col-md-4">
                                    <input type="file" name="image_vandalism" id="image_vandalism"
                                        class="form-control">
                                </div>
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
                                <div class="col-md-4"><label for="image_leaning">Image Leaning</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_leaning" id="image_leaning" class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->image_leaning)) && $data->image_leaning != '')
                                        <a href="{{ URL::asset($data->image_leaning) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->image_leaning) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                        <strong>No image found</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="image_rust">Images Rust</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_rust" id="image_rust" class="form-control">
                                </div>
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
                                <div class="col-md-4"><label for="images_advertise_poster">Images Advertise Poster</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="images_advertise_poster" id="images_advertise_poster"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->images_advertise_poster)) && $data->images_advertise_poster != '')
                                        <a href="{{ URL::asset($data->images_advertise_poster) }}"
                                            data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->images_advertise_poster) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                        <strong>No image found</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="other_image">Other Image</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="other_image" id="other_image" class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
                                        <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->other_image) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                        <strong>No image found</strong>
                                    @endif
                                </div>
                            </div>


                            <div class="text-center p-4"><button class="btn btn-sm btn-success">Update</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {


            $("#myForm").validate();


            getBa();
        });

        function getBa() {
            const selectedValue = $('#search_zone').val()
            const zone = "{{ $data->zone }}";
            const areaSelect = $('#ba');
            var baValues = '';
            const ba = "{{ $data->ba }}";
            // Clear previous options
            areaSelect.empty();
            if (selectedValue === zone) {
                areaSelect.append(`<option value="${ba}" hidden>${ba}</option>`)
            } else {
                areaSelect.append(`<option value="" hidden>select ba</option>`)

            }


            if (selectedValue === 'W1') {
                baValues = ['KUALA LUMPUR PUSAT'];

            } else if (selectedValue === 'B1') {
                baValues = ['PETALING JAYA', 'RAWANG', 'KUALA SELANGOR'];
            } else if (selectedValue === 'B2') {
                baValues = ['KLANG', 'PELABUHAN KLANG'];


            } else if (selectedValue === 'B4') {
                baValues = ['CHERAS', 'BANTING', 'BANGI', 'PUTRAJAYA & CYBERJAYA'];
            }


            baValues.forEach((data) => {
                areaSelect.append(`<option value="${data}">${data}</option>`);
            });

        }


        function getStatus(event) {
            var val = event.value;
            if (val !== 'Others') {
                if (!$('#other-gate-status').hasClass('d-none')) {
                    $('#other-gate-status').addClass('d-none')
                }
            } else {
                $('#other-gate-status').removeClass('d-none')
            }
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
