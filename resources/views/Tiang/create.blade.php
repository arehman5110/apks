@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />


    <link rel="stylesheet" href="{{ URL::asset('assets/test/css/style.css') }}" />
    @include('partials.map-css')
    <style>
        input[type='checkbox'],
        input[type='radio'] {
            min-width: 16px !important;
            margin-right: 12px;
        }

        input[type='file'],
        table input {
            margin: 0px !important;
        }

        table label {
            font-size: 14px !important;
            font-weight: 400 !important;
            margin-left: 10px !important;
            margin-bottom: 0px !important
        }

        th {
            font-size: 14px !important;
        }

        th,
        td {
            padding: 6px 16px !important
        }

        table,
        input[type='file'] {
            width: 90% !important;
        }

        #map {
            margin: 30px;
            height: 400px;
            padding: 20px;
        }

        table input[type="file"] {
            font-size: 11px !important;
            height: 33px !important;
        }

        td.d-flex {
            border-bottom: 0px !important;
            border-left: 0px !important;
            border-right: 0px !important;
        }

        .defects input[type="file"] {
            margin-bottom: 5px !important;
        }

        textarea {
            border: 1px solid #999999 !important;
        }

        .form-input .card {
            border: 1px solid black !important;
            border-radius: 0px !important
        }
    </style>
@endsection


@section('content')
    <section class="content-header ">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{__('messages.tiang')}}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('tiang-talian-vt-and-vr.index', app()->getLocale()) }}">{{__('messages.index')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.create')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class=" ">

        <div class="container- m-2">

            <div class=" ">

                <div class=" card col-md-12 p-3 ">
                    <div class=" ">
                        <h3 class="text-center p-2">{{__()}}</h3>
                        <form id="framework-wizard-form"
                            action="{{ route('tiang-talian-vt-and-vr.store', app()->getLocale()) }}"
                            enctype="multipart/form-data" style="display: none" method="POST"
                            onsubmit="return submitFoam()">
                            @csrf
                            <h3></h3>

                            {{-- START Info (1) --}}
                            <fieldset class=" form-input">
                                <h3>Info</h3>

                                <div class="row">
                                    <div class="col-md-4"><label for="ba">BA</label></div>
                                    <div class="col-md-4"><select name="ba_s" id="ba_s" class="form-control"
                                            onchange="getWp(this)" required>
                                            @if (Auth::user()->ba == '')
                                                <option value="" hidden>Select ba</option>
                                                <optgroup label="W1">
                                                    <option
                                                        value="KL PUSAT,KUALA LUMPUR PUSAT, 3.14925905877391, 101.754098819705">
                                                        KL PUSAT</option>
                                                </optgroup>
                                                <optgroup label="B1">
                                                    <option value="PJ,PETALING JAYA, 3.1128074178475, 101.605270457169">
                                                        PETALING JAYA</option>
                                                    <option value="RAWANG,RAWANG, 3.47839445121726, 101.622905486475">RAWANG
                                                    </option>
                                                    <option
                                                        value="K.SELANGOR,KUALA SELANGOR, 3.40703209426401, 101.317426926947">
                                                        KUALA SELANGOR</option>
                                                </optgroup>
                                                <optgroup label="B2">
                                                    <option value="KLANG,KLANG, 3.08428642705789, 101.436185279023">KLANG
                                                    </option>
                                                    <option
                                                        value="PORT KLANG,PELABUHAN KLANG, 2.98188527916042, 101.324234779569">
                                                        PELABUHAN KLANG</option>
                                                </optgroup>
                                                <optgroup label="B4">
                                                    <option value="CHERAS,CHERAS, 3.14197346621987, 101.849883983416">CHERAS
                                                    </option>
                                                    <option
                                                        value="BANTING/SEPANG,BANTING, 2.82111390453244, 101.505890775541">
                                                        BANTING</option>
                                                    <option value="BANGI,BANGI,2.965810949933260,101.81881303103104">BANGI
                                                    </option>
                                                    <option
                                                        value="PUTRAJAYA/CYBERJAYA/PUCHONG,PUTRAJAYA & CYBERJAYA, 2.92875032271019, 101.675338316575">
                                                        PUTRAJAYA & CYBERJAYA</option>
                                                </optgroup>
                                            @else
                                            @endif

                                        </select>
                                        <input type="hidden" name="ba" id="ba">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="name_contractor">Contractor</label></div>
                                    <div class="col-md-4"><input type="text" name="name_contractor" id="name_contractor"
                                            readonly value="Arosynergy" class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_start_date">PO Start Date</label></div>
                                    <div class="col-md-4"><input type="date" name="start_date" id="po_start_date"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_end_date">PO End Date</label></div>
                                    <div class="col-md-4"><input type="date" name="end_date" id="po_end_date"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="fp_name">Name of Substation / Name of Feeder
                                            Pillar</label></div>
                                    <div class="col-md-4"><input type="text" name="fp_name" id="fp_name"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="review_date">Review Date </label></div>
                                    <div class="col-md-4"><input type="date" name="review_date" id="review_date"
                                            value="{{ date('Y-m-d') }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="fp_road">Feeder Name / Street Name</label></div>
                                    <div class="col-md-4"><input type="text" name="fp_road" id="fp_road"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="">Section </label></div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_from">From </label></div>
                                    <div class="col-md-4"><input type="text" name="section_from" id="section_from"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">To</label></div>
                                    <div class="col-md-4"><input type="text" name="section_to" id="section_to"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="tiang_no">Tiang No</label></div>
                                    <div class="col-md-4"><input type="text" name="tiang_no" id="tiang_no"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="cordinates">Cordinates</label></div>
                                    <div class="col-md-4"><input type="text" name="cordinates" id="cordinates"
                                            class="form-control" required readonly></div>
                                </div>

                                <input type="hidden" name="lat" id="lat" required class="form-control">
                                <input type="hidden" name="log" id="log" class="form-control">

                                <div class="text-center">
                                    <strong> <span class="text-danger map-error"></span></strong>
                                </div>

                                <div id="map">

                                </div>


                            </fieldset>
                            {{-- END Info (1) --}}
                            <h3></h3>

                            {{-- START Asset Register (2) --}}
                            <fieldset class="form-input">
                                <h3>Asset Register</h3>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="card p-4 ">
                                            <div class="row">
                                                <div class="col-md-6"><label for="st7">
                                                        Pole Size Bill 7.5</label></div>
                                                <div class="col-md-6"><input type="number" name="size_tiang[st7]"
                                                        id="st7" class="form-control" min="0"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="st9">Pole Size Bill 9</label></div>
                                                <div class="col-md-6"><input type="number" name="size_tiang[st9]"
                                                        id="st9" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="st10">Pole Size Bill 10</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" name="size_tiang[st10]" id="st10"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="card p-4">

                                            <div class="row">
                                                <div class="col-md-6"><label for="s19_064">PVC (Span) 19/064</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="pvc_span[s19_064]"
                                                        id="s19_064" class="form-control"></div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6"><label for="s7_083">PVC (Span) 7/083</label></div>
                                                <div class="col-md-6"><input type="number" name="pvc_span[s7_083]"
                                                        id="s7_083" class="form-control"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6"><label for="s7_044">PVC (Span) 7/044</label></div>
                                                <div class="col-md-6"><input type="number" name="pvc_span[s7_044]"
                                                        id="s7_044" class="form-control"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card p-4">
                                            <div class="row">
                                                <div class="col-md-6"><label for="spun">Pole Type No Spun</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" name="jenis_tiang[spun]" id="spun"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="concrete">Pole Type No Concrete </label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="jenis_tiang[concrete]"
                                                        id="concrete" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6"><label for="iron">Pole Type No Iron</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="jenis_tiang[iron]"
                                                        id="iron" class="form-control"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6"><label for="wood">Pole Type No Wood</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="jenis_tiang[wood]"
                                                        id="wood" class="form-control"></div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="card p-4">
                                            <div class="row">
                                                <div class="col-md-6"><label for="section_to">ABC (Span) 3 X 185</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="abc_span[s3_185]"
                                                        id="section_to" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="s3_95">ABC (Span) 3 X 95</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="abc_span[s3_95]"
                                                        id="s3_95" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="s3_16">ABC (Span) 3 X 16</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="abc_span[s3_16]"
                                                        id="s3_16" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="s1_16">ABC (Span) 1 X 16</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="abc_span[s1_16]"
                                                        id="s1_16" class="form-control"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="card p-4">

                                            <div class="row">
                                                <div class="col-md-6"><label for="s7_173">BARE (Span) 7/173</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="bare_span[s7_173]"
                                                        id="s7_173" class="form-control"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6"><label for="s7_122">BARE (Span) 7/122</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="bare_span[s7_122]"
                                                        id="s7_122" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><label for="s3_132">BARE (Span) 3/132</label>
                                                </div>
                                                <div class="col-md-6"><input type="number" name="bare_span[s3_132]"
                                                        id="s3_132" class="form-control"></div>
                                            </div>
                                        </div>
                                    </div>



                                </div>






                            </fieldset>

                            {{-- END Asset Register (2) --}}

                            {{-- START Kejanggalan (3) --}}
                            <h3></h3>
                            <fieldset class="form-input defects">

                                <h3>Kejanggalan</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <thead style="background-color: #E4E3E3 !important">
                                            <th class="col-4">Title</th>
                                            <th class="col-4">Defects</th>
                                            <th class="col-4">Images</th>
                                        </thead>
                                        {{-- POLE --}}
                                        <tr>
                                            <th rowspan="5">Pole</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[cracked]" id="cracked"
                                                    class="form-check">
                                                <label for="cracked"> Cracked</label>

                                            </td>
                                            <td>
                                                <input type="file" name="tiang_defect_image[cracked]"
                                                    id="cracked-image" accept="image/*" class="d-none form-control"
                                                    required>
                                                <input type="file" name="tiang_defect_image[cracked_2]"
                                                    id="cracked-image-2" accept="image/*" class="d-none form-control"
                                                    required>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[leaning]" id="leaning"
                                                    class="form-check">
                                                <label for="leaning"> Leaning</label>
                                            </td>
                                            <td>
                                                <input type="file" name="tiang_defect_image[leaning]"
                                                    id="leaning-image" accept="image/*" class="d-none form-control"
                                                    required>
                                                <input type="file" name="tiang_defect_image[leaning_2]"
                                                    id="leaning-image-2" accept="image/*" class="d-none form-control"
                                                    required>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[dim]" id="dim"
                                                    class="form-check">
                                                <label for="dim"> No. Dim Post / None </label>

                                            </td>
                                            <td>
                                                <input type="file" name="tiang_defect_image[dim]" id="dim-image"
                                                    accept="image/*" class="d-none form-control" required>
                                                <input type="file" name="tiang_defect_image[dim_2]" id="dim-image-2"
                                                    accept="image/*" class="d-none form-control" required>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[creepers]" id="creepers"
                                                    class="form-check">
                                                <label for="creepers"> Creepers </label>

                                            </td>
                                            <td>
                                                <input type="file" name="tiang_defect_image[creepers]"
                                                    id="creepers-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="tiang_defect_image[creepers_2]"
                                                    id="creepers-image-2" class="d-none form-control" accept="image/*"
                                                    required>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="tiang_defect[other]" id="other_tiang_defect"
                                                    class="form-check">
                                                <label for="other_tiang_defect"> Others </label>
                                                <input type="text" name="tiang_defect[other_input]"
                                                    id="other_tiang_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="tiang_defect_image[other]"
                                                    id="other_tiang_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="tiang_defect_image[other_2]"
                                                    id="other_tiang_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Line (Main / Service) --}}

                                        <tr>
                                            <th rowspan="4">Line (Main / Service)</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="talian_defect[joint]" id="joint"
                                                    class="form-check">
                                                <label for="joint"> Joint</label>
                                            </td>
                                            <td>
                                                <input type="file" name="talian_defect_image[joint]" id="joint-image"
                                                    class="d-none  form-control" accept="image/*" required>
                                                <input type="file" name="talian_defect_image[joint_2]"
                                                    id="joint-image-2" class="d-none  form-control" accept="image/*"
                                                    required>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="talian_defect[need_rentis]" id="need_rentis"
                                                    class="form-check">
                                                <label for="need_rentis"> Need Rentis</label>
                                            </td>
                                            <td>
                                                <input type="file" name="talian_defect_image[need_rentis]"
                                                    id="need_rentis-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="talian_defect_image[need_rentis_2]"
                                                    id="need_rentis-image-2" class="d-none form-control" accept="image/*"
                                                    required>


                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="talian_defect[ground]" id="ground"
                                                    class="form-check">
                                                <label for="ground"> Does Not Comply With Ground Clearance</label>
                                            </td>
                                            <td>
                                                <input type="file" name="talian_defect_image[ground]"
                                                    id="ground-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="talian_defect_image[ground_2]"
                                                    id="ground-image-2" class="d-none form-control" accept="image/*"
                                                    required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="talian_defect[other]"
                                                    id="other_talian_defect" class="form-check">
                                                <label for="other_talian_defect"> Others </label>
                                                <input type="text" name="talian_defect[other_input]"
                                                    id="other_talian_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="talian_defect_image[other]"
                                                    id="other_talian_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="talian_defect_image[other_2]"
                                                    id="other_talian_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>


                                        {{-- Umbang --}}

                                        <tr>
                                            <th rowspan="5">Umbang</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[breaking]"
                                                    id="umbang_breaking" class="form-check ">
                                                <label for="umbang_breaking"> Sagging/Breaking</label>
                                            </td>
                                            <td>
                                                <input type="file" name="umbang_defect_image[breaking]"
                                                    id="umbang_breaking-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="umbang_defect_image[breaking_2]"
                                                    id="umbang_breaking-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[creepers]"
                                                    id="umbang_creepers" class="form-check ">
                                                <label for="umbang_creepers"> Creepers</label>
                                            </td>
                                            <td>
                                                <input type="file" name="umbang_defect_image[creepers]"
                                                    id="umbang_creepers-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="umbang_defect_image[creepers_2]"
                                                    id="umbang_creepers-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[cracked]" id="umbang_cracked"
                                                    class="form-check ">
                                                <label for="umbang_cracked"> No Stay Insulator/Damaged </label>
                                            </td>
                                            <td>
                                                <input type="file" name="umbang_defect_image[cracked]"
                                                    id="umbang_cracked-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="umbang_defect_image[cracked_2]"
                                                    id="umbang_cracked-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[stay_palte]" id="stay_palte"
                                                    class="form-check">
                                                <label for="stay_palte"> Stay Plate / Base Stay Blocked</label>
                                            </td>
                                            <td>
                                                <input type="file" name="umbang_defect_image[stay_palte]"
                                                    id="stay_palte-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="umbang_defect_image[stay_palte_2]"
                                                    id="stay_palte-image-2" class="d-none form-control" accept="image/*"
                                                    required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="umbang_defect[other]"
                                                    id="other_umbang_defect" class="form-check">
                                                <label for="other_umbang_defect"> Others </label>
                                                <input type="text" name="umbang_defect[other_input]"
                                                    id="other_umbang_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="umbang_defect_image[other]"
                                                    id="other_umbang_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="umbang_defect_image[other_2]"
                                                    id="other_umbang_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>


                                        {{-- IPC --}}
                                        <tr>
                                            <th rowspan="2">IPC</th>
                                            <td>
                                                <input type="checkbox" name="ipc_defect[burn]"
                                                    id="ipc_burn"class="form-check">
                                                <label for="ipc_burn"> Burn Effect</label>
                                            </td>
                                            <td>
                                                <input type="file" name="ipc_defect_image[burn]" id="ipc_burn-image"
                                                    class="d-none form-control" accept="image/*" required>
                                                <input type="file" name="ipc_defect_image[burn_2]"
                                                    id="ipc_burn-image-2" class="d-none form-control" accept="image/*"
                                                    required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="ipc_defect[other]" id="other_ipc_defect"
                                                    class="form-check">
                                                <label for="other_ipc_defect"> Others </label>
                                                <input type="text" name="ipc_defect[other_input]"
                                                    id="other_ipc_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="ipc_defect_image[other]"
                                                    id="other_ipc_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="ipc_defect_image[other_2]"
                                                    id="other_ipc_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Black Box --}}

                                        <tr>
                                            <th rowspan="2">Black Box</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="blackbox_defect[cracked]"
                                                    id="black_box_cracked" class="form-check">
                                                <label for="black_box_cracked"> Kesan Bakar</label>
                                            </td>
                                            <td>
                                                <input type="file" name="blackbox_defect_image[cracked]"
                                                    id="black_box_cracked-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="blackbox_defect_image[cracked_2]"
                                                    id="black_box_cracked-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="blackbox_defect[other]"
                                                    id="other_blackbox_defect" class="form-check">
                                                <label for="other_blackbox_defect"> Others </label>
                                                <input type="text" name="blackbox_defect[other_input]"
                                                    id="other_blackbox_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="blackbox_defect_image[other]"
                                                    id="other_blackbox_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="blackbox_defect_image[other_2]"
                                                    id="other_blackbox_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Jumper --}}

                                        <tr>
                                            <th rowspan="3">Jumper</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="jumper[sleeve]" id="jumper_sleeve"
                                                    class="form-check">
                                                <label for="jumper_sleeve"> No UV Sleeve</label>
                                            </td>
                                            <td>
                                                <input type="file" name="jumper_image[sleeve]"
                                                    id="jumper_sleeve-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="jumper_image[sleeve_2]"
                                                    id="jumper_sleeve-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="jumper[burn]" id="jumper_burn"
                                                    class="form-check">
                                                <label for="jumper_burn"> Burn Effect</label>
                                            </td>
                                            <td>
                                                <input type="file" name="jumper_image[burn]" id="jumper_burn-image"
                                                    class="d-none form-control" accept="image/*" required>
                                                <input type="file" name="jumper_image[burn_2]"
                                                    id="jumper_burn-image-2" class="d-none form-control" accept="image/*"
                                                    required>

                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <input type="checkbox" name="jumper[other]" id="other_jumper"
                                                    class="form-check">
                                                <label for="other_jumper"> Others </label>
                                                <input type="text" name="jumper[other_input]" id="other_jumper-input"
                                                    placeholder="mention other defect" required
                                                    class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="jumper_image[other]" id="other_jumper-image"
                                                    class="d-none form-control" accept="image/*" required>
                                                <input type="file" name="jumper_image[other_2]"
                                                    id="other_jumper-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Lightning catcher --}}

                                        <tr>
                                            <th rowspan="2">Lightning catcher</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="kilat_defect[broken]" id="lightning_broken"
                                                    class="form-check">
                                                <label for="lightning_broken"> Broken</label>
                                            </td>
                                            <td>
                                                <input type="file" name="kilat_defect_image[broken]"
                                                    id="lightning_broken-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="kilat_defect_image[broken_2]"
                                                    id="lightning_broken-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="kilat_defect[other]" id="other_kilat_defect"
                                                    class="form-check">
                                                <label for="other_kilat_defect"> Others </label>
                                                <input type="text" name="kilat_defect[other_input]"
                                                    id="other_kilat_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="kilat_defect_image[other]"
                                                    id="other_kilat_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="kilat_defect_image[other_2]"
                                                    id="other_kilat_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Service --}}

                                        <tr>
                                            <th rowspan="3">Service</th>
                                            <td class="d-felx">
                                                <input type="checkbox" name="servis_defect[roof]" id="service_roof"
                                                    class="form-check">
                                                <label for="service_roof"> The service line is on the roof</label>

                                            </td>
                                            <td>
                                                <input type="file" name="servis_defect_image[roof]"
                                                    id="service_roof-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="servis_defect_image[roof_2]"
                                                    id="service_roof-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-felx">
                                                <input type="checkbox" name="servis_defect[won_piece]"
                                                    id="service_won_piece" class="form-check">
                                                <label for="service_won_piece"> Won piece Date</label>
                                            </td>
                                            <td>
                                                <input type="file" name="servis_defect_image[won_piece]"
                                                    id="service_won_piece-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="servis_defect_image[won_piece_2]"
                                                    id="service_won_piece-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="servis_defect[other]"
                                                    id="other_servis_defect" class="form-check">
                                                <label for="other_servis_defect"> Others </label>
                                                <input type="text" name="servis_defect[other_input]"
                                                    id="other_servis_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="servis_defect_image[other]"
                                                    id="other_servis_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="servis_defect_image[other_2]"
                                                    id="other_servis_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>


                                        {{-- Grounding --}}

                                        <tr>
                                            <th rowspan="2">Grounding</th>
                                            <td>
                                                <input type="checkbox" name="pembumian_defect[netural]"
                                                    id="grounding_netural" class="form-check">
                                                <label for="grounding_netural"> No Connection to Neutral</label>
                                            </td>
                                            <td>
                                                <input type="file" name="pembumian_defect_image[netural]"
                                                    id="grounding_netural-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="pembumian_defect_image[netural_2]"
                                                    id="grounding_netural-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="pembumian_defect[other]"
                                                    id="other_pembumian_defect" class="form-check">
                                                <label for="other_pembumian_defect"> Others </label>
                                                <input type="text" name="pembumian_defect[other_input]"
                                                    id="other_pembumian_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="pembumian_defect_image[other]"
                                                    id="other_pembumian_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="pembumian_defect_image[other_2]"
                                                    id="other_pembumian_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Signage - OFF Point / Two Way Supply --}}
                                        <tr>
                                            <th rowspan="2">Signage - OFF Point / Two Way Supply</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="bekalan_dua_defect[damage]"
                                                    id="signage_damage" class="form-check">
                                                <label for="signage_damage"> Faded / Damaged / Missing Signage</label>
                                            </td>
                                            <td>
                                                <input type="file" name="bekalan_dua_defect_image[damage]"
                                                    id="signage_damage-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="bekalan_dua_defect_image[damage_2]"
                                                    id="signage_damage-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="bekalan_dua_defect[other]"
                                                    id="other_bekalan_dua_defect" class="form-check">
                                                <label for="other_bekalan_dua_defect"> Others </label>
                                                <input type="text" name="bekalan_dua_defect[other_input]"
                                                    id="other_bekalan_dua_defect-input" placeholder="mention other defect"
                                                    required class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="bekalan_dua_defect_image[other]"
                                                    id="other_bekalan_dua_defect-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="bekalan_dua_defect_image[other_2]"
                                                    id="other_bekalan_dua_defect-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>

                                        {{-- Main Street --}}

                                        <tr>
                                            <th rowspan="3">Main Street</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[date_wire]"
                                                    id="street_date_wire" class="form-check">
                                                <label for="street_date_wire">Date Wire</label>
                                            </td>
                                            <td>
                                                <input type="file" name="kaki_lima_defect_image[date_wire]"
                                                    id="street_date_wire-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="kaki_lima_defect_image[date_wire_2]"
                                                    id="street_date_wire-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[burn]" id="street_burn"
                                                    class="form-check">
                                                <label for="street_burn"> Junction Box Date / Burn Effect</label>
                                            </td>
                                            <td>
                                                <input type="file" name="kaki_lima_defect_image[burn]"
                                                    id="street_burn-image" class="d-none form-control" accept="image/*"
                                                    required>
                                                <input type="file" name="kaki_lima_defect_image[burn_2]"
                                                    id="street_burn-image-2" class="d-none form-control" accept="image/*"
                                                    required>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="kaki_lima_defect[other]"
                                                    id="other_kaki_lima_defect_image" class="form-check">
                                                <label for="other_kaki_lima_defect_image"> Others </label>
                                                <input type="text" name="kaki_lima_defect[other_input]"
                                                    id="other_kaki_lima_defect_image-input"
                                                    placeholder="mention other defect" required
                                                    class="form-control d-none">
                                            </td>
                                            <td>
                                                <input type="file" name="kaki_lima_defect_image[other]"
                                                    id="other_kaki_lima_defect_image-image" class="d-none form-control"
                                                    accept="image/*" required>
                                                <input type="file" name="kaki_lima_defect_image[other_2]"
                                                    id="other_kaki_lima_defect_image-image-2" class="d-none form-control"
                                                    accept="image/*" required>

                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </fieldset>

                            <h3></h3>
                            {{-- START TOTAL DEFECTS (4) --}}

                            <fieldset class="form-input">
                                <div class="row">
                                    <div class="col-md-4"><label for="total_defects">Total Defects</label></div>
                                    <div class="col-md-4"><input type="number" name="total_defects" id="total_defects"
                                            class="form-control" readonly></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="planed_date">Planned Repair Date</label></div>
                                    <div class="col-md-4"><input type="date" name="planed_date" id="planed_date"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="actual_date">Date of Repair Performed</label></div>
                                    <div class="col-md-4"><input type="date" name="actual_date" id="actual_date"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="remarks">Remarks</label></div>
                                    <div class="col-md-4">
                                        <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control"></textarea>

                                    </div>


                            </fieldset>



                            </fieldset>

                            {{-- END Kejanggalan (3) --}}


                            <h3></h3>
                            {{-- START Heigh Clearance (4) --}}

                            <fieldset class="form-input high-clearance">
                                <h3>Heigh Clearance</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <thead style="background-color: #E4E3E3 !important">
                                            <th class="col-4">Title</th>
                                            <th class="col-4">Defects</th>
                                            <th class="col-4">Images</th>
                                        </thead>

                                        <tbody>

                                            {{-- Site Conditions --}}

                                            <tr>
                                                <th rowspan="3">Site Conditions</th>
                                                <td class="d-flex">
                                                    <input type="checkbox" name="tapak_condition[road]" id="site_road"
                                                        class="form-check">
                                                    <label for="site_road">Crossing the Road</label>
                                                </td>
                                                <td>
                                                    <input type="file" name="tapak_road_img" id="site_road-img"
                                                        class="form-control d-none" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="tapak_condition[side_walk]"
                                                        id="side_walk" class="form-check">
                                                    <label for="side_walk">Sidewalk</label>
                                                </td>
                                                <td>
                                                    <input type="file" name="tapak_sidewalk_img" id="side_walk-img"
                                                        class="form-control d-none" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="tapak_condition[vehicle_entry]"
                                                        id="vehicle_entry" class="form-check">
                                                    <label for="vehicle_entry">No vehicle entry area </label>
                                                </td>
                                                <td>
                                                    <input type="file" name="tapak_no_vehicle_entry_img"
                                                        id="vehicle_entry-img" class="form-control d-none" required>
                                                </td>
                                            </tr>

                                            {{-- Area --}}
                                            <tr>
                                                <th rowspan="4">Area</th>
                                                <td class="d-flex">
                                                    <input type="checkbox" name="kawasan[bend]" id="area_bend"
                                                        class="form-check">
                                                    <label for="area_bend">Bend</label>
                                                </td>
                                                <td>
                                                    <input type="file" name="kawasan_bend_img" id="area_bend-img"
                                                        class="form-control d-none" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="kawasan[raod]" id="area_raod"
                                                        class="form-check">
                                                    <label for="area_raod"> Road</label>
                                                </td>
                                                <td>
                                                    <input type="file" name="kawasan_road_img" id="area_raod-img"
                                                        class="form-control d-none" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="kawasan[forest]" id="area_forest"
                                                        class="form-check">
                                                    <label for="area_forest">Forest </label>
                                                </td>
                                                <td>
                                                    <input type="file" name="kawasan_forest_img" id="area_forest-img"
                                                        class="form-control d-none" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="kawasan[other]" id="area_other"
                                                        class="form-check">
                                                    <label for="area_other">others {{-- (please state) --}} </label>
                                                    <input type="text" name="kawasan[other_input]"
                                                        id="area_other-input" class="form-control d-none" required
                                                        placeholder="(please state)">
                                                </td>
                                                <td>
                                                    <input type="file" name="kawasan_other_img" id="area_other-img"
                                                        class="form-control d-none" required>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="jarak_kelegaan">Clearance Distance</label></div>
                                    <div class="col-md-4"><input type="number" name="jarak_kelegaan"
                                            id="jarak_kelegaan" class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for=""> Line clearance specifications</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_spec[comply]" id="line-comply"
                                                    class="form-check"><label for="line-comply">
                                                    Comply</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_spec[disobedient]"
                                                    id="line-disobedient" class="form-check"><label
                                                    for="line-disobedient">
                                                    Disobedient</label>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            {{-- END Heigh Clearance (4) --}}


                            <h3></h3>

                            {{-- START Kebocoran Arus (5) --}}

                            <fieldset class="form-input">
                                <h3>Kebocoran Arus</h3>

                                <div class="row">
                                    <div class="col-md-4"><label for="">Inspection of current leakage on the
                                            pole</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_no"
                                                    class="form-check" value="no"><label for="arus_pada_tiang_no">

                                                    No</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_yes"
                                                    class="form-check" value="yes"><label
                                                    for="arus_pada_tiang_yes">
                                                    Yes</label>
                                            </div>

                                            <div class="col-md-4 d-none  " id="arus_pada_tiang_amp_div">
                                                <label for="arus_pada_tiang_amp">
                                                    (Amp)</label>
                                                <input type="text" name="arus_pada_tiang_amp"
                                                    id="arus_pada_tiang_amp" class="form-control" required>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            {{-- END Kebocoran Arus (5) --}}


                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="{{ URL::asset('assets/test/js/jquery.steps.js') }}"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js') }}"></script>

    <script>
        var form = $("#framework-wizard-form").show();
        form
            .steps({
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",

                onStepChanging: function(event, currentIndex, newIndex) {
                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        form.find(".body:eq(" + newIndex + ") label.error").remove();
                        form
                            .find(".body:eq(" + newIndex + ") .error")
                            .removeClass("error");
                    }
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },

                onStepChanged: function(event, currentIndex, priorIndex) {
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                        form.steps("next");
                    }
                    // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3) {
                        form.steps("previous");
                    }

                },



                onFinished: function(event, currentIndex) {
                    form.submit();
                },
                // autoHeight: true,
            })

        function getWp(param) {
            var splitVal = param.value.split(',');
            addRemoveBundary(splitVal[1], splitVal[2], splitVal[3])

            $('#ba').val(splitVal[1])


        }

        function submitFoam() {
            if ($('#lat').val() == '' || $('#log').val() == '') {
                $('.map-error').html('Please select location')
                return false;
            } else {
                $('.map-error').html(' ')
            }
        }
    </script>
    <script type="text/javascript">
        var baseLayers
        var identifyme = '';
        var boundary3 = '';
        var marker = '';
        var boundary2 = '';
        map = L.map('map').setView([3.016603, 101.858382], 5);



        var st1 = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map); // satlite map

        var street = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'); // street map

        // ADD MAPS
        baseLayers = {
            "Satellite": st1,
            "Street": street
        };


        boundary3 = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:aero_apks',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        })



        // ADD LAYERS GROUPED OVER LAYS
        groupedOverlays = {
            "POI": {
                'BA': boundary3,
            }
        };

        var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: true,
            position: 'topright'
            // groupCheckboxes: true
        }).addTo(map);



        // add boundary layer on page load
        map.addLayer(boundary3)
        map.setView([2.59340882301331, 101.07054901123], 8);


        // change layer and view when ba change
        function addRemoveBundary(param, paramY, paramX) {

            if (boundary3 != '') {
                map.removeLayer(boundary3) // Remove on page load boundary
            }


            if (boundary2 !== '') { // boundary if eesixts then first reomve from map
                map.removeLayer(boundary2)
            }

            boundary2 = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:ba',
                format: 'image/png',
                cql_filter: "station='" + param + "'", // add ba name for filter boundary
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(boundary2) // add filtered boundary
            boundary2.bringToFront()

            map.setView([parseFloat(paramY), parseFloat(paramX)], 10); // set view






        }

        // on click map add marker and bind popup
        function onMapClick(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng);
            map.addLayer(marker);
            marker.bindPopup("<b>You clicked the map at " + e.latlng.toString()).openPopup();

            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            $('#lat').val(lat);
            $('#log').val(lng);
            $('#cordinates').val(e.latlng);
        }

        map.on('click', onMapClick);
    </script>

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

            $('.defects input[type="checkbox"]').on('click', function() {
                addReomveImageField(this)

            })
            $('.high-clearance input[type="checkbox"]').on('click', function() {
                addReomveImageHighClearanceField(this)

            })
            $('input[name="arus_pada_tiang"]').on('change', function() {
                if (this.value == 'yes') {
                    if ($('#arus_pada_tiang_amp_div').hasClass('d-none')) {
                        $('#arus_pada_tiang_amp_div').removeClass('d-none');
                    }
                } else {
                    if (!$('#arus_pada_tiang_amp_div').hasClass('d-none')) {
                        $('#arus_pada_tiang_amp_div').addClass('d-none');
                    }
                }
            })

        });

        var total_defects = 0;

        function addReomveImageField(checkbox) {
            var element = $(checkbox);
            var id = element.attr('id');
            var input = $(`#${id}-image`)
            var input_2 = $(`#${id}-image-2`)
            var input_val = $(`#${id}-input`)

            if (checkbox.checked) {
                if (input.hasClass('d-none')) {
                    input.removeClass('d-none');
                    input_2.removeClass('d-none');
                    input_val.removeClass('d-none');
                    total_defects += 1;
                }
            } else {

                if (!input.hasClass('d-none')) {
                    input.addClass('d-none');
                    input_2.addClass('d-none');
                    input_val.addClass('d-none');
                    input_val.val('');
                    total_defects -= 1;
                    if (input.hasClass('error')) {
                        input.removeClass('error')
                        input_2.removeClass('error')
                    }
                    var span = input.parent().find('label');
                    if (span.length > 0) {
                        span.html('')
                    }
                    var span_val = $(`#${id}-input-error`);
                    if (span_val.length > 0) {
                        span_val.html('')
                    }
                }
                console.log('unchecked');
            }

            $('#total_defects').val(total_defects)

        }


        function addReomveImageHighClearanceField(checkbox) {
            var element = $(checkbox);
            var id = element.attr('id');
            var input = $(`#${id}-img`)
            var input_val = $(`#${id}-input`)

            if (checkbox.checked) {
                if (input.hasClass('d-none')) {
                    input.removeClass('d-none');

                    input_val.removeClass('d-none');

                }
            } else {

                if (!input.hasClass('d-none')) {
                    input.addClass('d-none');


                    input_val.addClass('d-none');
                    input_val.val('');

                    if (input.hasClass('error')) {
                        input.removeClass('error')

                    }
                    var span = input.parent().find('label');
                    if (span.length > 0) {
                        span.html('')
                    }

                    var span_val = $(`#${id}-input-error`);
                    if (span_val.length > 0) {
                        span_val.html('')
                    }
                }

            }
        }


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
    </script>
@endsection
