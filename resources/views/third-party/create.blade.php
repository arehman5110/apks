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

        input[type='checkbox']>.col-md-4 {
            display: flex;
        }
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Third Party Digging</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">index</a></li>
                        <li class="breadcrumb-item active">create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" ">

        <div class="container">

            <div class=" ">

                <div class=" card col-md-12 p-3 ">
                    <div class=" ">
                        <h3 class="text-center p-2">QR SAVR</h3>

                        <form action="{{ route('third-party-digging.store') }} " method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4"><label for="zone">Zone</label></div>
                                <div class="col-md-4">
                                    <select name="zone" id="search_zone" class="form-control">

                                        <option value="" hidden>select zone</option>
                                        <option value="W1">W1</option>
                                        <option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B4">B4</option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">ba</label></div>
                                <div class="col-md-4"><select  name="ba" id="ba"
                                        class="form-control" required onchange="getWp(this)">
                                        <option value="" hidden>select zone</option>

                                    </select></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="wp_name">Work Package Name</label></div>
                                <div class="col-md-4"><select   name="wp_name" id="wp_name"
                                        class="form-control"   >
                                        <option value="" hidden>select ba</option>

                                        @foreach ($wp as $p)
                                            <option value="">{{$p->ba}}</option>
                                        @endforeach
                                    
                                    </select></div>
                            </div>
                            

                            
                            <div class="row">
                                <div class="col-md-4"><label for="team_name">Team Name</label></div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" value="{{$team}}" disabled id=""><input type="hidden" name="team_name" id="team_name"
                                        class="form-control" required></div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="survey_date">Survey Date</label></div>
                                <div class="col-md-4"><input type="date" name="survey_date" id="survey_date"
                                        class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="patrolling_time">Patrolling Time</label></div>
                                <div class="col-md-4"><input type="date" name="patrolling_time" id="patrolling_time"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="road_id">Road Id</label></div>
                                <div class="col-md-4"><input type="text" name="road_id" id="road_id"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="project_name">Project Name</label></div>
                                <div class="col-md-4"><input type="text" name="project_name" id="project_name"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="feeder_involved">Feeder Involved</label></div>
                                <div class="col-md-4"><input type="text" name="feeder_involved" id="feeder_involved"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="km_plan">Km Plan</label></div>
                                <div class="col-md-4"><input type="text" name="km_plan" id="km_plan"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="km_actual">Km Actual</label></div>
                                <div class="col-md-4"><input type="text" name="km_actual" id="km_actual"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="digging">Digging</label></div>
                                <div class="col-md-4"><input type="text" name="digging" id="digging"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="notice">Notice</label></div>
                                <div class="col-md-4"><input type="text" name="notice" id="notice"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="supervision">Supervision</label></div>
                                <div class="col-md-4"><input type="text" name="supervision" id="supervision"
                                        class="form-control" required></div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="company_name">Company Name</label></div>
                                <div class="col-md-4"><input type="text" name="company_name" id="company_name"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="office_phone_no">Office Phone No</label></div>
                                <div class="col-md-4"><input type="text" name="office_phone_no" id="office_phone_no"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="main_contractor">Main Contractor</label></div>
                                <div class="col-md-4"><input type="text" name="main_contractor" id="main_contractor"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="developer_phone_no">Developer Phone No</label></div>
                                <div class="col-md-4"><input type="text" name="developer_phone_no"
                                        id="developer_phone_no" class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="contractor_company_name">Contractor Company Name</label>
                                </div>
                                <div class="col-md-4"><input type="text" name="contractor_company_name"
                                        id="contractor_company_name" class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="site_supervisor_name">Site Supervisor Name</label></div>
                                <div class="col-md-4"><input type="text" name="site_supervisor_name"
                                        id="site_supervisor_name" class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="site_supervisor_phone_no">Site Supervisor Phone
                                        No</label></div>
                                <div class="col-md-4"><input type="text" name="site_supervisor_phone_no"
                                        id="site_supervisor_phone_no" class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="excavator_operator_name">Excavator Operator Name</label>
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
                                <div class="col-md-4"><label for="workpackage_id">Workpackage Id</label></div>
                                <div class="col-md-4"><input type="number" name="workpackage_id" id="workpackage_id"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="department_diging">Department Diging</label></div>
                                <div class="col-md-4"><input type="text" name="department_diging"
                                        id="department_diging" class="form-control" required></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="survey_status">Survey Status</label></div>
                                <div class="col-md-4"><input type="text" name="survey_status" id="survey_status"
                                        class="form-control" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="before_image1">Before Image 1</label></div>
                                <div class="col-md-4"><input type="file" name="before_image1" id="before_image1"
                                        class="form-control"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="before_image2">Before Image 2</label></div>
                                <div class="col-md-4"><input type="file" name="before_image2" id="before_image2"
                                        class="form-control"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="before_image3">Before Image 3</label></div>
                                <div class="col-md-4"><input type="file" name="before_image3" id="before_image3"
                                        class="form-control"></div>
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


                            <div class="row">
                                <div class="col-md-4"><label for="loc">Location</label></div>

                                <div class="col-md-4"><input type="text" name="lat" id="lat" required
                                        class="form-control">
                                    <input type="text" name="log" id="log" class="form-control">
                                </div>
                                <div class="col-md-4 text-center"><button type="button" class="btn btn-sm btn-secondary"
                                        onclick="getLocation()">Get Location</button></div>

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
    <script>
        $(document).ready(function() {
            // $('form').validate();



            $('#search_zone').on('change', function() {
                const selectedValue = this.value;
                const areaSelect = $('#ba');
                var baValues = '';

                // Clear previous options
                areaSelect.empty();
                areaSelect.append(`<option value="" hidden>Select ba</option>`)

                if (selectedValue === 'W1') {
                    baValues = [ 'KUALA LUMPUR PUSAT'];

                } else if (selectedValue === 'B1') {
                    baValues = [ 'PETALING JAYA','RAWANG', 'KUALA SELANGOR' ];
                } else if (selectedValue === 'B2') {
                    baValues = ['KLANG',  'PELABUHAN KLANG'];
                  

                } else if (selectedValue === 'B4') {
                    baValues = [ 'CHERAS', 'BANTING', 'BANGI', 'PUTRAJAYA & CYBERJAYA'];
                }


                baValues.forEach((data) => {
                    areaSelect.append(`<option value="${data}">${data}</option>`);
                });
                $('#wp_name').empty();
                $('#search_wp').append(`<option value="" hidden>select wp</option>`);
                // $('#for-excel').html('')
                // $('#pw-zone').val(this.value);
            });


        });

       

function getWp(event) {
    var wp = @json($wp);
    console.log(event.value);
    const wpSelect = $('#wp_name');
    wpSelect.empty();
    wpSelect.append(`<option value="" hidden>select wp</option>`)
    wp.forEach((data) => {
        if(event.value == data.ba ){
                    wpSelect.append(`<option value="${data.package_name}">${data.package_name}</option>`);
        }
                });
 
}









        //get current location

        function getLocation() {

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {

            $('#lat').val(position.coords.latitude)
            $('#log').val(position.coords.longitude)

        }
    </script>
@endsection
