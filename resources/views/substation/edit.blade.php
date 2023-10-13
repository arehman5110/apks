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
                    <h3>Substatoin</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('substation.index',app()->getLocale()) }}">index</a></li>
                        <li class="breadcrumb-item active">create</li>
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

                        <form action="{{ route('substation.update', [app()->getLocale(),$data->id]) }} " id="myForm" method="POST"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf


                            <div class="row">
                                <div class="col-md-4"><label for="zone">Zone</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control" required>

                                        <option value="{{ $data->zone }}" hidden>{{ $data->zone }}</option>
                                        @if ( Auth::user()->ba == '' )
                                        <option value="W1">W1</option>
                                        <option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B4">B4</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">BA</label></div>
                                <div class="col-md-4"><select name="ba" id="ba" class="form-control" required
                                        onchange="getWp(this)">
                                        <option value="{{$data->ba}}" hidden>{{$data->ba}}</option>


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
                                <div class="col-md-4"><label for="area">voltage</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="voltage" id="voltage" value="{{ $data->voltage }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="name">Name</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="name" id="name" value="{{ $data->name }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="type">End Date</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="type" id="type" value="{{ $data->type }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="voltage">Voltage</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="voltage" id="voltage" value="{{ $data->voltage }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="coordinate">Coordinate</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="coordinate" id="coordinate"
                                        value="{{ $data->coordinate }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="pipe_staus">Gate</label></div>
                                <div class="col-md-4">
                                    <div class="  d-flex">
                                        <input type="checkbox" name="gate_status[locked]"  {{substaionCheckBox('locked', $data->gate_status)}} id="gate_status_locked">
                                        <label for="gate_status_locked">Locked</label>
                                    </div>
                                    <div class=" d-flex">
                                        <input type="checkbox" name="gate_status[unlocked]" {{substaionCheckBox('unlocked', $data->gate_status)}} id="gate_status_unlocked">
                                        <label for="gate_status_unlocked">Unlocked</label>
                                    </div>
                                    <div class=" d-flex">
                                        <input type="checkbox" name="gate_status[demaged]" {{substaionCheckBox('demaged', $data->gate_status)}} id="gate_status_demaged">
                                        <label for="gate_status_demaged">Demaged</label>
                                    </div>

                                        <div class="d-flex">
                                        <input type="checkbox" name="gate_status[other]" {{substaionCheckBox('other', $data->gate_status)}} id="gate_status_others" onclick="getStatus(this)">
                                        <label for="gate_status_others">Others</label>


                                    </div>
                                    <input type="text" name="gate_status[other_value]" id="gate_status_other" class="form-control  @if(substaionCheckBox('other', $data->gate_status)   !== 'checked' ) d-none @endif" value="@if (substaionCheckBox('other', $data->gate_status) == 'checked')
{{$data->gate_status->other_value}}
                                    @endif"  placeholder="please enter other gate defect" >

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="vandalism_status">Long Grass</label></div>
                                <div class="col-md-4">
                                    <select name="grass_status" id="grass_status" class="form-control" required>
                                        <option value="{{ $data->grass_status }}" hidden>{{ $data->grass_status }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="tree_branches_status">Tree Branches in PE </label></div>
                                <div class="col-md-4">

                                        <select  name="tree_branches_status" id="tree_branches_status"
                                        class="form-control" required>
                                        <option value="{{$data->tree_branches_status}}" hidden >{{$data->tree_branches_status}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="building_status">Building Defects</label></div>

                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <input type="checkbox" name="building_status[broken_roof]" {{substaionCheckBox('broken_roof', $data->building_status)}}  id="building_status_broken_roof">
                                            <label for="building_status_broken_roof">Broken Roof</label>
                                        </div>

                                        <div class="d-flex">
                                            <input type="checkbox" name="building_status[broken_gutter]" {{substaionCheckBox('broken_gutter', $data->building_status)}}  id="building_status_broken_gutter">
                                            <label for="building_status_broken_gutter">Broken Gutter</label>
                                        </div>

                                        <div class="d-flex">
                                            <input type="checkbox" name="building_status[broken_base]" {{substaionCheckBox('broken_base', $data->building_status)}}  id="building_status_broken_base">
                                            <label for="building_status_broken_base">Broken Base</label>
                                        </div>

                                        <div class="d-flex">
                                            <input type="checkbox" name="building_status[other]" {{substaionCheckBox('other', $data->building_status)}}  id="building_status_other" onclick="bulidingStatus(this)">
                                            <label for="building_status_other">Other</label>
                                        </div>

                                        <input type="text" name="building_status[other_value]" id="other_building_defects" placeholder="please enter other buliding defects" class="form-control @if(substaionCheckBox('other', $data->building_status)   !== 'checked' ) d-none @endif"
                                        value="@if(substaionCheckBox('other', $data->building_status)   !== 'checked' ) {{$data->building_status->other_value}} @endif"
                                        >

                                        </div>

                            </div>

                            <div class="row  d-none" id="other-building-defects">
                                <div class="col-md-4"><label for="other_building_defects">Other building Defects</label></div>
                                <div class="col-md-4">
                                  <input type="text" name="other_building_defects" id="other_building_defects" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="collapsed_status">Cleaning illegal ads/banners</label></div>
                                <div class="col-md-4">
                                    <select name="advertise_poster_status" id="advertise_poster_status" class="form-control" required>
                                        <option value="{{ $data->advertise_poster_status }}" hidden >{{ $data->advertise_poster_status }}</option>
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
                                <div class="col-md-4"><label for="image_grass">Image Grass</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_grass" id="image_grass" class="form-control">
                                </div>
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
                                <div class="col-md-4"><label for="image_tree_branches">Image Tree Branches</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_tree_branches" id="image_tree_branches"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->image_tree_branches)) && $data->image_tree_branches != '')
                                        <a href="{{ URL::asset($data->image_tree_branches) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->image_tree_branches) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                        <strong>No image found</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="images_gate_after_lock">Images Gate After Lock</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="images_gate_after_lock" id="images_gate_after_lock"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->images_gate_after_lock)) && $data->images_gate_after_lock != '')
                                        <a href="{{ URL::asset($data->images_gate_after_lock) }}"
                                            data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->images_gate_after_lock) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                        <strong>No image found</strong>
                                    @endif
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="image_building">Image Building</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_building" id="image_building"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->image_building)) && $data->image_building != '')
                                        <a href="{{ URL::asset($data->image_building) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->image_building) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @else
                                        <strong>No image found</strong>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="img_advertise_poster">Image Advertise Poster</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="img_advertise_poster" id="img_advertise_poster"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->img_advertise_poster)) && $data->img_advertise_poster != '')
                                        <a href="{{ URL::asset($data->img_advertise_poster) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->img_advertise_poster) }}" alt=""
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
        const userBa = "{{Auth::user()->ba}}";
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

        function getStatus(event){
        var val = event.value;

            if (!$('#gate_status_other').hasClass('d-none')) {
                $('#gate_status_other').addClass('d-none')
            }else{
                $('#gate_status_other').removeClass('d-none')
            }



    }

    function bulidingStatus(event){
        var val = event.value;

            if (!$('#other_building_defects').hasClass('d-none')) {
                $('#other_building_defects').addClass('d-none')

        }else{
            $('#other_building_defects').removeClass('d-none')
        }
    }
    </script>
@endsection
