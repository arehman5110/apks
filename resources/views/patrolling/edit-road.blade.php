@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />

    @include('partials.map-css')
    <style>
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
                    <h3>Patrolling</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('third-party-digging.index')}}">index</a></li>
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

                        <form action="/patrolling-update" id="myForm" method="POST"
                            enctype="multipart/form-data" onsubmit="return submitFoam()">
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
                                        onchange="getWorkPackage(this)">
                                        <option value="" hidden>select zone</option>

                                    </select>
                                    <input type="hidden" name="ba" id="ba">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="search_wp">Work Package Name</label></div>
                                <div class="col-md-4">
                                    <select name="search_wp" id="search_wp" class="form-control" required>
                                        <option value="" hidden>select ba</option>

                                    </select>
                                    <input type="hidden" name="workpackage_id" id="workpackage_id" class="form-control">
                                    <input type="hidden" name="wp_name" id="wp_name" >
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="team_name">Team Name</label></div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="team_name" value="{{ $team }}"
                                        readonly id="team_name">
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="survey_date">Survey Date</label></div>
                                <div class="col-md-4"><input type="date" name="survey_date" id="survey_date"
                                        class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="patrolling_time">Patrolling Time</label></div>
                                <div class="col-md-4"><input type="time" name="patrolling_time" id="patrolling_time"
                                        class="form-control" required></div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-4"><label for="road_id">Road Id</label></div> --}}
                            <div class="col-md-4"><input type="hidden" name="road_id" id="road_id" class="form-control">
                            </div>
                            {{-- </div> --}}
                            <div class="row">
                                <div class="col-md-4"><label for="project_name">Project Name</label></div>
                                <div class="col-md-4"><input type="text" name="project_name" id="project_name"
                                        class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="km_plan">Km Plan</label></div>
                                <div class="col-md-4"><input type="number" name="km_plan" id="km_plan"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="km_actual">Km Actual</label></div>
                                <div class="col-md-4"><input type="number" name="km_actual" id="km_actual"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="digging">Digging</label></div>
                                <div class="col-md-4">

                                    <select name="digging" id="digging" class="form-control" required>
                                        <option value="" hidden>select digging</option>
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="notice">Notice</label></div>
                                <div class="col-md-4">
                                    <select name="notice" id="notice" class="form-control" required>
                                        <option value="" hidden>select notice</option>
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="supervision">Supervision</label></div>
                                <div class="col-md-4">

                                    <select name="supervision" id="supervision" class="form-control" required>
                                        <option value="" hidden>select supervision</option>
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select>

                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="company_name">Company Name</label></div>
                                <div class="col-md-4"><input type="text" name="company_name" id="company_name"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="office_phone_no">Office Phone No</label></div>
                                <div class="col-md-4"><input type="number" name="office_phone_no" id="office_phone_no"
                                        class="form-control" required minlength="9" maxlength="11"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="main_contractor">Main Contractor</label></div>
                                <div class="col-md-4"><input type="text" name="main_contractor" id="main_contractor"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="developer_phone_no">Developer Phone No</label></div>
                                <div class="col-md-4"><input type="text" name="developer_phone_no"
                                        id="developer_phone_no" class="form-control" required minlength="9"
                                        maxlength="11"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="contractor_company_name">Contractor Company
                                        Name</label>
                                </div>
                                <div class="col-md-4"><input type="text" name="contractor_company_name"
                                        id="contractor_company_name" class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="site_supervisor_name">Site Supervisor Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="site_supervisor_name" id="site_supervisor_name"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="site_supervisor_phone_no">Site Supervisor Phone
                                        No</label></div>
                                <div class="col-md-4"><input type="number" name="site_supervisor_phone_no"
                                        id="site_supervisor_phone_no" class="form-control" required minlength="9"
                                        maxlength="11">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="excavator_operator_name">Excavator Operator
                                        Name</label>
                                </div>
                                <div class="col-md-4"><input type="text" name="excavator_operator_name"
                                        id="excavator_operator_name" class="form-control" required></div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="excavator_machinery_reg_no">Excavator Machinery Reg
                                        No</label></div>
                                <div class="col-md-4"><input type="text" name="excavator_machinery_reg_no"
                                        id="excavator_machinery_reg_no" class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="department_diging">Department Diging</label></div>
                                <div class="col-md-4"><input type="text" name="department_diging"
                                        id="department_diging" class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="survey_status">Survey Status</label></div>
                                <div class="col-md-4">
                                    <select name="survey_status" id="survey_status" class="form-control" required>
                                        <option value="" hidden>select status</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Complete">Complete</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="before_image1">Before Image 1</label></div>
                                <div class="col-md-4"><input type="file" name="before_image1" id="before_image1"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="before_image2">Before Image 2</label></div>
                                <div class="col-md-4"><input type="file" name="before_image2" id="before_image2"
                                        class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="before_image3">Before Image 3</label></div>
                                <div class="col-md-4"><input type="file" name="before_image3" id="before_image3"
                                        class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="during_image1">During Image 1</label></div>
                                <div class="col-md-4"><input type="file" name="during_image1" id="during_image1"
                                        class="form-control"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="during_image1">During Image 2</label></div>
                                <div class="col-md-4"><input type="file" name="during_image2" id="during_image2"
                                        class="form-control"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="during_image1">During Image 3</label></div>
                                <div class="col-md-4"><input type="file" name="during_image3" id="during_image3"
                                        class="form-control"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="after_image1">After Image 1</label></div>
                                <div class="col-md-4"><input type="file" name="after_image1" id="after_image1"
                                        class="form-control"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="after_image2">After Image 2</label></div>
                                <div class="col-md-4"><input type="file" name="after_image2" id="after_image2"
                                        class="form-control"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="after_image3">After Image 3</label></div>
                                <div class="col-md-4"><input type="file" name="after_image3" id="after_image3"
                                        class="form-control"></div>
                            </div>

                            <div class="row   road-d">
                                <div class="col-md-4"><label for="road_name">Road Name</label></div>
                                <div class="col-md-4">
                                    <span id="road_name_check" class="text-danger"></span>
                                    <input type="text" name="road_name" id="road_name"
                                        class="form-control" required></div>
                            </div>








                            <input type="hidden" name="lat" id="lat" class="form-control">
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
        var wp = '';
        var rd = '';


        function getWorkPackage(param) {
            var splitVal = param.value.split(',');
            addRemoveBundary(splitVal[1], splitVal[2], splitVal[3])
                $('#ba').val(splitVal[1]);
            if (wp != '') {
                map.removeLayer(wp)
            }
            wp = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_workpackage',
                format: 'image/png',
                cql_filter: "ba='" + splitVal[1] + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(wp)
            wp.bringToFront()
            if (rd != '') {
                map.removeLayer(rd)
            }
            
         
            var zone = $('#search_zone').val();
            $.ajax({
                url: `/get-work-package/${splitVal[1]}/${zone}`,
                dataType: 'JSON',
                method: 'GET',
                async: false,
                success: function callback(data) {
                    console.log(data);
                    $('#search_wp').empty();
                    $('#search_wp').append(`<option value="" hidden>Select Work Package</option>`);
                    data.forEach((val) => {
                        if (val.wp_status == 'approved') {


                        $('#search_wp').append(
                            `<option value="${val.id},${val.package_name},${val.x} ,${val.y}">${val.package_name}</option>`
                        );
                    }
                    });


                }
            })

        }


        $('#search_wp').on('change', function() {
            const selectedValue = this.value;
            var spiltVal = selectedValue.split(',');

            $('#wp_name').val(spiltVal[1]);
            map.setView([parseFloat(spiltVal[3]), parseFloat(spiltVal[2])], 16)
            $('#for-excel').html(`<a class="mt-4" href="/generate-third-party-diging-excel/${spiltVal[0]}"><button class="btn-sm mt-2
                btn btn-primary">Download Qr</button></a>`)
            $('#workpackage_id').val(spiltVal[0])

            if (wp != '') {
                map.removeLayer(wp)
            }
            wp = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_workpackage',
                format: 'image/png',
                cql_filter: "package_name='" + spiltVal[1] + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(wp)
            wp.bringToFront()
            if (rd != '') {
                map.removeLayer(rd)
            }
            rd = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_roads',
                format: 'image/png',
                cql_filter: "id_workpackage='" + spiltVal[0] + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(rd)
            rd.bringToFront()

        })
    </script>
@endsection
