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

        .navbar {
            display: none !important
        }
    </style>
@endsection


@section('content')


    <div class=" ">

        <div class="container-">

            <div class=" ">

                <div class=" card col-md-12 p-4 ">
                    <div class="form-input ">
                        <h3 class="text-center p-2">Link Box</h3>

                        <form action="{{ route('update-link-box-map-edit',[app()->getLocale(),$data->id]) }} " id="myForm"
                            method="POST" enctype="multipart/form-data">
                            
                            @csrf


                            <div class="row">
                                <div class="col-md-4"><label for="zone">{{__('messages.zone')}}</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control" required>

                                        <option value="{{ $data->zone }}" hidden>{{ $data->zone }}</option>
                                        @if (Auth::user()->ba == '')
                                            <option value="W1">W1</option>
                                            <option value="B1">B1</option>
                                            <option value="B2">B2</option>
                                            <option value="B4">B4</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">{{__('messages.ba')}}</label></div>
                                <div class="col-md-4">
                                    <select name="ba" id="ba" class="form-control" required
                                        onchange="getWp(this)">
                                        <option value="{{ $data->ba }}" hidden>{{ $data->ba }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="visit_date">{{__('messages.visit_date')}}</label></div>
                                <div class="col-md-4">
                                    <input type="date" name="visit_date" id="visit_date" class="form-control"
                                        value="{{ date('Y-m-d', strtotime($data->visit_date)) }}" required>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="patrol_time">{{__('messages.patrol_time')}}</label></div>
                                <div class="col-md-4">
                                    <input type="time" name="patrol_time" id="patrol_time" class="form-control"
                                        value="{{ date('H:i:s', strtotime($data->patrol_time)) }}" required>
                                </div>
                            </div>







                            <div class="row">
                                <div class="col-md-4"><label for="start_date">{{__('messages.from')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="start_date" id="start_date" value="{{ $data->start_date }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="end_date">{{__('messages.to')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="end_date" id="end_date" value="{{ $data->end_date }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="type">{{__('messages.type')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="type" id="type" value="{{ $data->type }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="coordinate">{{__("messages.coordinate")}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="coordinate" id="coordinate"
                                        value="{{ $data->coordinate }}" class="form-control" required readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="cover_status">{{__("messages.cover_is_not_closed")}}</label></div>
                                <div class="col-md-4">
                                    <select name="cover_status" id="cover_status" class="form-control" required>
                                        <option value="{{ $data->cover_status }}" hidden>{{ $data->cover_status }}
                                        </option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="vandalism_status">{{__("messages.vandalism")}}</label></div>
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
                                <div class="col-md-4"><label for="leaning_staus">{{__("messages.leaning")}}</label></div>
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
                                <div class="col-md-4"><label for="leaning_angle">{{__('messages.leaning_angle')}}</label></div>
                                <div class="col-md-4">

                                    <input type="text" name="leaning_angle" id="leaning_angle"
                                        value="{{ $data->leaning_angle }}" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="rust_status">{{__('messages.rusty')}}</label></div>
                                <div class="col-md-4">
                                    <select name="rust_status" id="rust_status" class="form-control" required>
                                        <option value="{{ $data->rust_status }}" hidden>{{ $data->rust_status }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="advertise_poster_status">{{__("messages.cleaning_illegal_ads_banners")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="advertise_poster_status" id="advertise_poster_status"
                                    class="form-control" required>
                                    <option value="{{ $data->advertise_poster_status }}" hidden>{{ $data->advertise_poster_status }}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="bushes_status">{{__("messages.bushy")}}</label></div>
                                <div class="col-md-4">
                                    <select name="bushes_status" id="bushes_status" class="form-control" required>
                                        <option value="{{ $data->bushes_status }}" hidden>{{ $data->bushes_status }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="link_box_image">{{__("messages.link_box")}} {{__("messages.images")}} </label></div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="link_box_image_1" id="link_box_image_1" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->link_box_image_1)) && $data->link_box_image_1 != '')
                                            <a href="{{ URL::asset($data->link_box_image_1) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->link_box_image_1) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="link_box_image_2" id="link_box_image_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->link_box_image_2)) && $data->link_box_image_2 != '')
                                            <a href="{{ URL::asset($data->link_box_image_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->link_box_image_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="image_gate">{{__('messages.cover_image')}}</label></div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_cover" id="image_cover" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_cover)) && $data->image_cover != '')
                                            <a href="{{ URL::asset($data->image_cover) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_cover) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_cover_2" id="image_cover_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_cover_2)) && $data->image_cover_2 != '')
                                            <a href="{{ URL::asset($data->image_cover_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_cover_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="image_vandalism">{{__('messages.image_vandalism')}}</label></div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_vandalism" id="image_vandalism" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_vandalism)) && $data->image_vandalism != '')
                                            <a href="{{ URL::asset($data->image_vandalism) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_vandalism) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_vandalism_2" id="image_vandalism_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_vandalism_2)) && $data->image_vandalism_2 != '')
                                            <a href="{{ URL::asset($data->image_vandalism_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_vandalism_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="image_leaning">{{__("messages.image_leaning")}}</label></div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_leaning" id="image_leaning" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_leaning)) && $data->image_leaning != '')
                                            <a href="{{ URL::asset($data->image_leaning) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_leaning) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_leaning_2" id="image_leaning_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_leaning_2)) && $data->image_leaning_2 != '')
                                            <a href="{{ URL::asset($data->image_leaning_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_leaning_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="image_rust">{{__("messages.image_rust")}}</label></div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_rust" id="image_rust" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_rust)) && $data->image_rust != '')
                                            <a href="{{ URL::asset($data->image_rust) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_rust) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_rust_2" id="image_rust_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->image_rust_2)) && $data->image_rust_2 != '')
                                            <a href="{{ URL::asset($data->image_rust_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->image_rust_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="images_advertise_poster">{{__('messages.image_advertise_poster')}}</label></div>
                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="images_advertise_poster" id="images_advertise_poster" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->images_advertise_poster)) && $data->images_advertise_poster != '')
                                            <a href="{{ URL::asset($data->images_advertise_poster) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->images_advertise_poster) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="image_gate_2" id="image_gate_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->images_advertise_poster_2)) && $data->images_advertise_poster_2 != '')
                                            <a href="{{ URL::asset($data->images_advertise_poster_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->images_advertise_poster_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="images_bushes">{{__("messages.image_bushes")}}</label></div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="images_bushes" id="images_bushes" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->images_bushes)) && $data->images_bushes != '')
                                            <a href="{{ URL::asset($data->images_bushes) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->images_bushes) }}" alt="" height="70" class="adjust-height ml-5 ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" name="images_bushes_2" id="images_bushes_2" class="form-control">
                                    </div>

                                    <div class="col-md-6 text-center  ">
                                        @if (file_exists(public_path($data->images_bushes_2)) && $data->images_bushes_2 != '')
                                            <a href="{{ URL::asset($data->images_bushes_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->images_bushes_2) }}" alt="" height="70" class="adjust-height ml-5  ">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="other_image">{{__("messages.other_image")}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" accept="image/*" name="other_image" id="other_image" class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
                                        <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->other_image) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                    <strong>{{ __('messages.no_image_found') }}</strong>
                                    @endif
                                </div>
                            </div>


                            <div class="text-center p-4"><button class="btn btn-sm btn-success"> <strong>{{ __('messages.update') }}</strong></button></div>
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
        const userBa = "{{ Auth::user()->ba }}";
        $(document).ready(function() {


            $("#myForm").validate();
            if (userBa == '') {
                getBa();
            }
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