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
                    <h3>Third Party Digging</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">index</a></li>
                        <li class="breadcrumb-item active">show</li>
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
                                <div class="col-md-4"><input readonly  value="{{$data->zone}}" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="ba">Ba</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{$data->ba}}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="wp_name">Work Package Name</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{$data->wp_name}}" class="form-control">


                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="team_name">Team Name</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{$data->team_name}}" class="form-control">
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="survey_date">Survey Date</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{$data->survey_date}}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="patrolling_time">Patrolling Time</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ date('H:i:s', strtotime($data->patrolling_time)) }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="road_id">Road Id</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->road_id }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="project_name">Project Name</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->project_name }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="km_plan">Km Plan</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->km_plan }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="km_actual">Km Actual</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->km_actual }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="digging">Digging</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->digging }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="notice">Notice</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->notice }}" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="supervision">Supervision</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->supervision }}" class="form-control">
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-4"><label for="company_name">Company Name</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->company_name }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="office_phone_no">Office Phone No</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->office_phone_no }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="main_contractor">Main Contractor</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->main_contractor }}" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="developer_phone_no">Developer Phone No</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->developer_phone_no }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="contractor_company_name">Contractor Company Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->contractor_company_name }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="site_supervisor_name">Site Supervisor Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->site_supervisor_name }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="site_supervisor_phone_no">Site Supervisor Phone No</label>
                                </div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->site_supervisor_phone_no }}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="excavator_operator_name">Excavator Operator Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->excavator_operator_name }}" class="form-control">
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4"><label for="excavator_machinery_reg_no">Excavator Machinery Reg
                                        No</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->excavator_machinery_reg_no }}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="workpackage_id">Workpackage Id</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->workpackage_id }}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="department_diging">Department Diging</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->department_diging }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="survey_status">Survey Status</label></div>
                                <div class="col-md-4">
                                    <input readonly  value="{{ $data->survey_status }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="before_image1">Before Image 1</label></div>

                                <div class="col-md-4 text-center mb-3">
                                    @if (file_exists(public_path($data->before_image1)) && $data->before_image1 != '')
                                        <a href="{{ URL::asset($data->before_image1) }}" data-lightbox="roadtrip">
                                            <img src="{{ URL::asset($data->before_image1) }}" alt=""
                                                height="70" class="adjust-height ml-5  "></a>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="before_image2">Before Image 2</label></div>


                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->before_image2)) && $data->before_image2 != '')
                                                <a href="{{ URL::asset($data->before_image2) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->before_image2) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="before_image3">Before Image 3</label></div>

                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->before_image3)) && $data->before_image3 != '')
                                                <a href="{{ URL::asset($data->before_image3) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->before_image3) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="during_image1">During Image 1</label></div>


                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->during_image1)) && $data->during_image1 != '')
                                                <a href="{{ URL::asset($data->during_image1) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->during_image1) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="during_image1">During Image 2</label></div>


                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->during_image2)) && $data->during_image2 != '')
                                                <a href="{{ URL::asset($data->during_image2) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->during_image2) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="during_image1">During Image 3</label></div>


                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->during_image3)) && $data->during_image3 != '')
                                                <a href="{{ URL::asset($data->during_image3) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->during_image3) }}" alt=""
                                                        height="70" class="adjust-heigh ml-5  "></a>
                                            @endif
                                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="after_image1">After Image 1</label></div>


                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->after_image1)) && $data->after_image1 != '')
                                                <a href="{{ URL::asset($data->after_image1) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->after_image1) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="after_image2">After Image 2</label></div>

                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->after_image2)) && $data->after_image2 != '')
                                                <a href="{{ URL::asset($data->after_image2) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->after_image2) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label for="after_image3">After Image 3</label></div>



                                        <div class="col-md-4 text-center mb-3">
                                            @if (file_exists(public_path($data->after_image3)) && $data->after_image3 != '')
                                                <a href="{{ URL::asset($data->after_image3) }}" data-lightbox="roadtrip">
                                                    <img src="{{ URL::asset($data->after_image3) }}" alt=""
                                                        height="70" class="adjust-height ml-5  "></a>
                                            @endif
                                        </div>
                            </div>







                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

