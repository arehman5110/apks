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
            /* color: black !important; */
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
                    <h3>{{__('messages.substation')}}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item text-lowercase"><a href="{{route('substation.index', app()->getLocale())}}">{{__('messages.index')}}</a></li>
                        <li class="breadcrumb-item text-lowercase active">{{__('messages.create')}}</li>
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

                        <form action="{{ route('substation.store', app()->getLocale()) }} " id="myForm" method="POST"
                            enctype="multipart/form-data"  onsubmit="return submitFoam()">
                            @csrf


                            <div class="row">
                                <div class="col-md-4"><label for="zone">{{__('messages.zone')}}</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control" required>
                                    @if (Auth::user()->zone == '')
                                        <option value="" hidden>select zone</option>
                                        <option value="W1">W1</option>
                                        <option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B4">B4</option>
                                    @else
                                        <option value="{{ Auth::user()->zone }}" hidden>{{ Auth::user()->zone }}</option>
                                    @endif

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">{{__('messages.ba')}}</label></div>
                                <div class="col-md-4"><select name="ba_s" id="ba_s" class="form-control" required
                                        onchange="getWp(this)">
                                        <option value="" hidden>select zone</option>

                                    </select>
                                    <input type="hidden" name="ba" id="ba">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="team">{{__('messages.team_name')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="team" id="team" value="{{$team}}"
                                        class="form-control"  readonly>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="visit_date">{{__('messages.visit_date')}}</label></div>
                                <div class="col-md-4">
                                    <input type="date" name="visit_date" id="visit_date" value="{{date('Y-m-d')}}"
                                        class="form-control" required>
                                    </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="patrol_time">{{__('messages.patrol_time')}}</label></div>
                                <div class="col-md-4">
                                    <input type="time" name="patrol_time" id="patrol_time" value="{{date('H:i')}}"
                                        class="form-control" required>
                                    </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="voltage">{{__('messages.voltage')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="voltage" id="voltage"
                                        class="form-control" >
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="name">{{__('messages.name')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="name" id="name"
                                        class="form-control" required>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="type">{{__('messages.type')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="type" id="type"
                                        class="form-control" required>
                                    </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="gate_status">{{__('messages.gate')}} </label></div>
                                <div class="col-md-4">
                                    <div class="  d-flex">
                                        <input type="checkbox" name="gate_status[locked]" id="gate_status_locked">
                                        <label for="gate_status_locked">{{__('messages.locked')}}</label>
                                    </div>
                                    <div class=" d-flex">
                                        <input type="checkbox" name="gate_status[unlocked]" id="gate_status_unlocked">
                                        <label for="gate_status_unlocked">{{__('messages.unlocked')}}</label>
                                    </div>
                                    <div class=" d-flex">
                                        <input type="checkbox" name="gate_status[demaged]" id="gate_status_demaged">
                                        <label for="gate_status_demaged">{{__('messages.demaged')}}</label>
                                    </div>

                                        <div class="d-flex">
                                        <input type="checkbox" name="gate_status[other]" id="gate_status_others" onclick="getStatus(this)">
                                        <label for="gate_status_others">{{__('messages.others')}}</label>


                                    </div>
                                    <input type="text" name="gate_status[other_value]" id="gate_status_other" class="form-control d-none" placeholder="please enter other gate defect" >

                                </div>
                            </div>

                              <div class="row">
                                <div class="col-md-4"><label for="grass_status">{{__('messages.long_grass')}} </label></div>
                                <div class="col-md-4">
                                    <select  name="grass_status" id="grass_status"
                                        class="form-control" required>
                                        <option value="" hidden >select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                            </div>
                              <div class="row">
                                <div class="col-md-4"><label for="tree_branches_status">{{__('messages.tree_branches_in_PE')}} </label></div>
                                <div class="col-md-4">

                                        <select  name="tree_branches_status" id="tree_branches_status"
                                        class="form-control" required>
                                        <option value="" hidden >select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="building_status">{{__('messages.building_defects')}}</label></div>
                                <div class="col-md-4">
                                    <div class="d-flex">
                                        <input type="checkbox" name="building_status[broken_roof]" id="building_status_broken_roof">
                                        <label for="building_status_broken_roof">{{__('messages.broken_roof')}}</label>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" name="building_status[broken_gutter]" id="building_status_broken_gutter">
                                        <label for="building_status_broken_gutter">{{__('messages.broken_gutter')}}</label>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" name="building_status[broken_base]" id="building_status_broken_base">
                                        <label for="building_status_broken_base">{{__('messages.broken_base')}}</label>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" name="building_status[other]" id="building_status_other" onclick="bulidingStatus(this)">
                                        <label for="building_status_other">{{__('messages.others')}}</label>
                                    </div>

                                    <input type="text" name="building_status[other_value]" id="other_building_defects" placeholder="please enter other buliding defects" class="form-control d-none" >

                                    </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4"><label for="advertise_poster_status">{{__('messages.cleaning_illegal_ads_banners')}}</label></div>
                                <div class="col-md-4">
                                    <select name="advertise_poster_status" id="advertise_poster_status" class="form-control" required>
                                        <option value="" hidden >select status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                       </select>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="image_gate">{{__('messages.image_gate')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_gate" id="image_gate"
                                        class="form-control" >
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="image_grass">{{__('messages.image_grass')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_grass" id="image_grass"
                                        class="form-control" >
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="image_tree_branches">{{__('messages.image_tree_branches')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_tree_branches" id="image_tree_branches" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="images_gate_after_lock">{{__('messages.images_gate_after_lock')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="images_gate_after_lock" id="images_gate_after_lock"
                                        class="form-control" >
                                    </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="image_building">{{__('messages.image_building')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="image_building" id="image_building"
                                        class="form-control" >
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="img_advertise_poster">{{__('messages.image_advertise_poster')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="img_advertise_poster" id="img_advertise_poster"
                                        class="form-control" >
                                    </div>
                            </div>

                             <div class="row">
                                <div class="col-md-4"><label for="other_image">{{__('messages.other_image')}}</label></div>
                                <div class="col-md-4">
                                    <input type="file" name="other_image" id="other_image"
                                        class="form-control" >
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="coordinate">{{__('messages.coordinate')}}</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="coordinate" id="coordinate" readonly
                                        class="form-control" required>
                                    </div>
                            </div>

                            <input type="hidden" name="lat" id="lat" required class="form-control">
                            <input type="hidden" name="log" id="log" class="form-control">
                            <div class="text-center">
                                <strong>  <span class="text-danger map-error"  ></span></strong>
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
                    ['B4', 'BANGI',2.965810949933260,101.81881303103104 ],
                    ['B4', 'PUTRAJAYA & CYBERJAYA', 2.92875032271019,101.675338316575]
                ];
                const userBa = "{{Auth::user()->ba}}";
                $(document).ready(function() {



       if (userBa !== '') {
           getBaPoints(userBa)
       }

    });


       function getBaPoints(param){
           var baSelect = $('#ba_s')
               baSelect.empty();

               b1Options.map((data)=>{
                   if (data[1] == param) {
                       baSelect.append(`<option value="${data}">${data[1]}</option>`)
                   }
               });
               let baVal = document.getElementById('ba_s');
               getWp(baVal)
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
