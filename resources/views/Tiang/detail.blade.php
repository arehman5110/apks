@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('assets/test/css/style.css') }}" />
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
            font-size : 14px !important;
            font-weight: 400 !important;
            margin-left: 10px !important;
            margin-bottom: 0px !important
        }
        th{font-size: 14px !important;}
        th,td{padding: 6px 16px !important}
        table  , input[type='file']{width: 90% !important;}

        table input[type="file"]{
            font-size: 11px !important;
            height: 33px !important;
        }
        td.d-flex{
            border-bottom:0px !important;
            border-left:0px !important;
            border-right:0px !important;
        }
        textarea{border: 1px solid #999999 !important;}
        .form-input .card{border:1px solid black !important;
        border-radius: 0px !important}
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Tiang</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('tiang-talian-vt-and-vr.index',app()->getLocale()) }}">index</a></li>
                        <li class="breadcrumb-item active">detail</li>
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
                        <form id="framework-wizard-form" action="#" style="display: none">

                            <h3></h3>

                            {{-- START Info (1) --}}
                            <fieldset class=" form-input">
                                <h3>Info </h3>

                                <div class="row">
                                    <div class="col-md-4"><label for="ba">BA</label></div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="{{ $data->ba }}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="name_contractor">Contractor</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->name_contractor }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_start_date">PO Start Date</label></div>
                                    <div class="col-md-4"><input type="date"
                                            value="{{ date('Y-m-d', strtotime($data->start_date)) }}" disabled
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_end_date">PO End Date</label></div>
                                    <div class="col-md-4"><input type="date"
                                            value="{{ date('Y-m-d', strtotime($data->end_date)) }}" disabled
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="fp_name">Name of Substation / Name of Feeder
                                            Pillar</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->fp_name }}" id="fp_name"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="review_date">Review Date </label></div>
                                    <div class="col-md-4"><input type="date" disabled
                                            value="{{ date('Y-m-d', strtotime($data->review_date)) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="fp_road">Feeder Name / Street Name</label></div>
                                    <div class="col-md-4"><input value="{{ $data->fp_road }}" disabled class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="">Section </label></div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_from">From </label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->section_from }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">To</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->section_to }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="tiang_no">Tiang No</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->tiang_no }}"
                                            class="form-control">
                                    </div>
                                </div>



                            </fieldset>
                            {{-- END Info (1) --}}
                            <h3></h3>

                            {{-- START Asset Register (2) --}}


                            <fieldset class="form-input">
                                <h3>Asset Register</h3>
                                <div class="row">
                                    <div class="col-md-4"><label for="st7">
                                            Pole Size Bill 7.5</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->size_tiang->st7 }}"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="st9">Pole Size Bill 9</label></div>
                                    <div class="col-md-4"><input value="{{ $data->size_tiang->st9 }}" disabled
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="st10">Pole Size Bill 10</label></div>
                                    <div class="col-md-4"><input value="{{ $data->size_tiang->st10 }}" disabled
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="spun">Pole Type No Spun</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->jenis_tiang->spun }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="concrete">Pole Type No Concrete </label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->jenis_tiang->concrete }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="iron">Pole Type No Iron</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->jenis_tiang->iron }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="wood">Pole Type No Wood</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->jenis_tiang->wood }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">ABC (Span) 3 X 185</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->abc_span->s3_185 }}"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_95">ABC (Span) 3 X 95</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->abc_span->s3_95 }}"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_16">ABC (Span) 3 X 16</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->abc_span->s3_16 }}"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s1_16">ABC (Span) 1 X 16</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->abc_span->s1_16 }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s19_064">PVC (Span) 19/064</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->pvc_span->s19_064 }}"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="s7_083">PVC (Span) 7/083</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->pvc_span->s7_083 }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_044">PVC (Span) 7/044</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->pvc_span->s7_044 }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_173">BARE (Span) 7/173</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->bare_span->s7_173 }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_122">BARE (Span) 7/122</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->bare_span->s7_122 }}"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_132">BARE (Span) 3/132</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->bare_span->s3_132 }}"
                                            class="form-control"></div>
                                </div>

                            </fieldset>

                            {{-- END Asset Register (2) --}}

                            <h3></h3>
                            <fieldset class="form-input">

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
                                                    {{ checkCheckBox('cracked', $data->tiang_defect) }}
                                                    class="form-check" disabled>
                                                <label for="cracked"> Cracked</label>

                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('cracked', $data->tiang_defect), $data->tiang_defect_image, 'cracked') !!}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[leaning]" id="leaning"
                                                    {{ checkCheckBox('leaning', $data->tiang_defect) }} disabled
                                                    class="form-check">
                                                <label for="leaning"> Leaning</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('leaning', $data->tiang_defect), $data->tiang_defect_image, 'leaning') !!}
                                            </td>

                                        </tr>

                                        @php($checkbox_dim = checkCheckBox('dim', $data->tiang_defect))

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[dim]" id="dim" disabled
                                                    {{ $checkbox_dim }} class="form-check">
                                                <label for="dim"> No. Dim Post / None </label>

                                            </td>

                                            <td>
                                                {!! getImage($checkbox_dim, $data->tiang_defect_image, 'dim') !!}
                                            </td>

                                        </tr>

                                        @php($checkbox_creepers = checkCheckBox('creepers', $data->tiang_defect))

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="tiang_defect[creepers]" id="creepers" disabled
                                                  {{checkCheckBox('creepers', $data->tiang_defect)}} class="form-check">
                                                <label for="creepers"> Creepers </label>

                                            </td>

                                            <td>
                                                {!! getImage($checkbox_creepers, $data->tiang_defect_image, 'creepers') !!}
                                            </td>

                                        </tr>

                                        @php($checkbox = checkCheckBox('other', $data->tiang_defect))

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="tiang_defect[other]" id="other_tiang_defect" disabled
                                                    {{ $checkbox }} class="form-check">
                                                <label for="other_tiang_defect"> Others </label>
                                            </td>

                                            <td>

                                                {!! getImage(checkCheckBox('other', $data->tiang_defect), $data->tiang_defect_image, 'other') !!}


                                            </td>
                                        </tr>

                                        {{-- Line (Main / Service) --}}

                                        <tr>
                                            <th rowspan="4">Line (Main / Service)</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="talian_defect[joint]" id="joint" disabled
                                                    class="form-check" {{ checkCheckBox('joint', $data->talian_defect) }}>
                                                <label for="joint"> Joint</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('joint', $data->talian_defect), $data->talian_defect_image, 'joint') !!}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="talian_defect[need_rentis]" id="need_rentis" disabled
                                                    class="form-check"
                                                    {{ checkCheckBox('need_rentis', $data->talian_defect) }}>
                                                <label for="need_rentis"> Need Rentis</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('need_rentis', $data->talian_defect), $data->talian_defect_image, 'need_rentis') !!}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="talian_defect[ground]" id="ground"
                                                    class="form-check" disabled
                                                    {{ checkCheckBox('ground', $data->talian_defect) }}>
                                                <label for="ground"> Does Not Comply With Ground Clearance</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('ground', $data->talian_defect), $data->talian_defect_image, 'ground') !!}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="talian_defect[other]"
                                                    id="other_talian_defect" disabled
                                                    {{ checkCheckBox('other', $data->talian_defect) }} class="form-check">
                                                <label for="other_talian_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->talian_defect), $data->talian_defect_image, 'other') !!}

                                            </td>
                                        </tr>


                                        {{-- Umbang --}}

                                        <tr>
                                            <th rowspan="5">Umbang</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[breaking]" disabled
                                                    id="umbang_breaking" class="form-check "
                                                    {{ checkCheckBox('breaking', $data->umbang_defect) }}>
                                                <label for="umbang_breaking"> Sagging/Breaking</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('breaking', $data->umbang_defect), $data->umbang_defect_image, 'breaking') !!}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[creepers]" disabled
                                                    id="umbang_creepers" class="form-check "
                                                    {{ checkCheckBox('creepers', $data->umbang_defect) }}>
                                                <label for="umbang_creepers"> Creepers</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('creepers', $data->umbang_defect), $data->umbang_defect_image, 'creepers') !!}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[cracked]" id="umbang_cracked" disabled
                                                    class="form-check "
                                                    {{ checkCheckBox('cracked', $data->umbang_defect) }}>
                                                <label for="umbang_cracked"> No Stay Insulator/Damaged </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('cracked', $data->umbang_defect), $data->umbang_defect_image, 'cracked') !!}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="umbang_defect[stay_palte]" id="stay_palte" disabled
                                                    class="form-check"
                                                    {{ checkCheckBox('stay_palte', $data->umbang_defect) }}>
                                                <label for="stay_palte"> Stay Plate / Base Stay Blocked</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('stay_palte', $data->umbang_defect), $data->umbang_defect_image, 'stay_palte') !!}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="umbang_defect[other]" disabled
                                                    id="other_umbang_defect"
                                                    {{ checkCheckBox('other', $data->umbang_defect) }} class="form-check">
                                                <label for="other_umbang_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->umbang_defect), $data->umbang_defect_image, 'other') !!}
                                            </td>
                                        </tr>


                                        {{-- IPC --}}
                                        <tr>
                                            <th rowspan="2">IPC</th>
                                            <td>
                                                <input type="checkbox" name="ipc_defect[burn]" disabled
                                                    id="ipc_burn"class="form-check"
                                                    {{ checkCheckBox('burn', $data->ipc_defect) }}>
                                                <label for="ipc_burn"> Burn Effect</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('burn', $data->ipc_defect), $data->ipc_defect_image, 'burn') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="ipc_defect[other]" id="other_ipc_defect" disabled
                                                    {{ checkCheckBox('other', $data->ipc_defect) }} class="form-check">
                                                <label for="other_ipc_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->ipc_defect), $data->ipc_defect_image, 'other') !!}
                                            </td>
                                        </tr>

                                        {{-- Black Box --}}

                                        <tr>
                                            <th rowspan="2">Black Box</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="blackbox_defect[cracked]" disabled
                                                    id="black_box_cracked" class="form-check"
                                                    {{ checkCheckBox('cracked', $data->blackbox_defect) }}>
                                                <label for="black_box_cracked"> Kesan Bakar</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('cracked', $data->blackbox_defect), $data->blackbox_defect_image, 'cracked') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="blackbox_defect[other]" disabled
                                                    id="other_blackbox_defect"
                                                    {{ checkCheckBox('other', $data->blackbox_defect) }}
                                                    class="form-check">
                                                <label for="other_blackbox_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->blackbox_defect), $data->blackbox_defect_image, 'other') !!}
                                            </td>
                                        </tr>

                                        {{-- Jumper --}}

                                        <tr>
                                            <th rowspan="3">Jumper</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="jumper[sleeve]" id="jumper_sleeve" disabled
                                                    class="form-check" {{ checkCheckBox('sleeve', $data->jumper) }}>
                                                <label for="jumper_sleeve"> No UV Sleeve</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('sleeve', $data->jumper), $data->jumper_image, 'sleeve') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="jumper[burn]" id="jumper_burn" disabled
                                                    class="form-check" {{ checkCheckBox('burn', $data->jumper) }}>
                                                <label for="jumper_burn"> Burn Effect</label>
                                            </td>
                                            <td>
                                                {!! getImage(checkCheckBox('burn', $data->jumper), $data->jumper_image, 'burn') !!}
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <input type="checkbox" name="jumper[other]" id="other_jumper" disabled
                                                    {{ checkCheckBox('other', $data->jumper) }} class="form-check">
                                                <label for="other_jumper"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->jumper), $data->jumper_image, 'other') !!}
                                            </td>
                                        </tr>

                                        {{-- Lightning catcher --}}

                                        <tr>
                                            <th rowspan="2">Lightning catcher</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="kilat_defect[broken]" id="lightning_broken" disabled
                                                    class="form-check" {{ checkCheckBox('broken', $data->kilat_defect) }}>
                                                <label for="lightning_broken"> Broken</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('broken', $data->kilat_defect), $data->kilat_defect_image, 'broken') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="kilat_defect[other]" id="other_kilat_defect" disabled
                                                    {{ checkCheckBox('other', $data->kilat_defect) }} class="form-check">
                                                <label for="other_kilat_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->kilat_defect), $data->kilat_defect_image, 'other') !!}
                                            </td>
                                        </tr>

                                        {{-- Service --}}

                                        <tr>
                                            <th rowspan="3">Service</th>
                                            <td class="d-felx">
                                                <input type="checkbox" name="servis_defect[roof]" id="service_roof" disabled
                                                    class="form-check" {{ checkCheckBox('roof', $data->servis_defect) }}>
                                                <label for="service_roof"> The service line is on the roof</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('roof', $data->servis_defect), $data->servis_defect_image, 'othroofer') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="d-felx">
                                                <input type="checkbox" name="servis_defect[won_piece]" disabled
                                                    id="service_won_piece" class="form-check"
                                                    {{ checkCheckBox('won_piece', $data->servis_defect) }}>
                                                <label for="service_won_piece"> Won piece Date</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('won_piece', $data->servis_defect), $data->servis_defect_image, 'won_piece') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="servis_defect[other]" disabled
                                                    id="other_servis_defect"
                                                    {{ checkCheckBox('other', $data->servis_defect) }} class="form-check">
                                                <label for="other_servis_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->servis_defect), $data->servis_defect_image, 'other') !!}
                                            </td>
                                        </tr>


                                        {{-- Grounding --}}

                                        <tr>
                                            <th rowspan="2">Grounding</th>
                                            <td>
                                                <input type="checkbox" name="pembumian_defect[netural]" disabled
                                                    id="grounding_netural" class="form-check"
                                                    {{ checkCheckBox('netural', $data->pembumian_defect) }}>
                                                <label for="grounding_netural"> No Connection to Neutral</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('netural', $data->pembumian_defect), $data->pembumian_defect_image, 'netural') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="pembumian_defect[other]" disabled
                                                    id="other_pembumian_defect"
                                                    {{ checkCheckBox('other', $data->pembumian_defect) }}
                                                    class="form-check">
                                                <label for="other_pembumian_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->pembumian_defect), $data->pembumian_defect_image, 'other') !!}
                                            </td>
                                        </tr>

                                        {{-- Signage - OFF Point / Two Way Supply --}}
                                        <tr>
                                            <th rowspan="2">Signage - OFF Point / Two Way Supply</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="bekalan_dua_defect[damage]" disabled
                                                    id="signage_damage" class="form-check"
                                                    {{ checkCheckBox('damage', $data->bekalan_dua_defect) }}>
                                                <label for="signage_damage"> Faded / Damaged / Missing Signage</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('damage', $data->bekalan_dua_defect), $data->bekalan_dua_defect_image, 'damage') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="bekalan_dua_defect[other]" disabled
                                                    id="other_bekalan_dua_defect"
                                                    {{ checkCheckBox('other', $data->bekalan_dua_defect) }}
                                                    class="form-check">
                                                <label for="other_bekalan_dua_defect"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->bekalan_dua_defect), $data->bekalan_dua_defect_image, 'other') !!}
                                            </td>
                                        </tr>

                                        {{-- Main Street --}}

                                        <tr>
                                            <th rowspan="3">Main Street</th>
                                            <td class="d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[date_wire]" disabled
                                                    id="street_date_wire" class="form-check"
                                                    {{ checkCheckBox('date_wire', $data->kaki_lima_defect) }}>
                                                <label for="street_date_wire">Date Wire</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('date_wire', $data->kaki_lima_defect), $data->kaki_lima_defect_image, 'date_wire') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[burn]" id="street_burn" disabled
                                                    class="form-check"
                                                    {{ checkCheckBox('burn', $data->kaki_lima_defect) }}>
                                                <label for="street_burn"> Junction Box Date / Burn Effect</label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('burn', $data->kaki_lima_defect), $data->kaki_lima_defect_image, 'burn') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="kaki_lima_defect[other]" disabled
                                                    id="other_kaki_lima_defect_image"
                                                    {{ checkCheckBox('other', $data->kaki_lima_defect) }}
                                                    class="form-check">
                                                <label for="other_kaki_lima_defect_image"> Others </label>
                                            </td>

                                            <td>
                                                {!! getImage(checkCheckBox('other', $data->kaki_lima_defect), $data->kaki_lima_defect_image, 'other') !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </fieldset>

                            {{-- START Kejanggalan (3) --}}
                            <h3></h3>
                            <fieldset class="form-input">

                                <h3>Kejanggalan</h3>








                                <div class="row">
                                    <div class="col-md-4"><label for="total_defects">Total Defects</label></div>
                                    <div class="col-md-4"><input type="number"disabled
                                            value="{{ $data->total_defects }}" class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="planed_date">Planned Repair Date</label></div>
                                    <div class="col-md-4"><input type="date" disabled
                                            value="{{ date('Y-m-d', strtotime($data->planed_date)) }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="actual_date">Date of Repair Performed</label></div>
                                    <div class="col-md-4"><input type="date" disabled
                                            value="{{ date('Y-m-d', strtotime($data->actual_date)) }}"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="remarks">Remarks</label></div>
                                    <div class="col-md-4">
                                        <textarea name="" id="" cols="30" rows="10" disabled class="form-control">{{ $data->remarks }}</textarea>
                                        </div>
                                </div>






                            </fieldset>

                            {{-- END Kejanggalan (3) --}}


                            <h3></h3>
                            {{-- START Heigh Clearance (4) --}}

                            <fieldset class="form-input">
                                <h3>Heigh Clearance</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <thead style="background-color: #E4E3E3 !important">
                                            <th class="col-4">Title</th>
                                            <th class="col-4">Defects</th>
                                            <th class="col-3">Upload Images</th>

                                        </thead>

                                        <tbody>

                                            {{-- Site Conditions --}}

                                            <tr>
                                                <th rowspan="3">Site Conditions</th>
                                                <td class="d-flex">
                                                    <input type="checkbox" name="tapak_condition[road]" id="site_road" disabled
                                                        class="form-check"
                                                        {{ checkCheckBox('road', $data->tapak_condition) }}>
                                                    <label for="site_road">Crossing the Road</label>
                                                </td>

                                                <td>
                                                    @if ($data->tapak_road_img != '' && file_exists(public_path($data->tapak_road_img)) )
                                                    <a href="{{ URL::asset($data->tapak_road_img)}}" data-lightbox="roadtrip">
                                                       <img src="{{ URL::asset($data->tapak_road_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                   </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="tapak_condition[side_walk]"disabled
                                                        id="side_walk" class="form-check"
                                                        {{ checkCheckBox('side_walk', $data->tapak_condition) }}>
                                                    <label for="side_walk">Sidewalk</label>
                                                </td>

                                                <td>
                                                     @if ($data->tapak_sidewalk_img != '' && file_exists(public_path($data->tapak_sidewalk_img)) )
                                                     <a href="{{ URL::asset($data->tapak_sidewalk_img)}}" data-lightbox="roadtrip">
                                                        <img src="{{ URL::asset($data->tapak_sidewalk_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                    </a>
                                                     @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="tapak_condition[vehicle_entry]" disabled
                                                        id="vehicle_entry" class="form-check"
                                                        {{ checkCheckBox('vehicle_entry', $data->tapak_condition) }}>
                                                    <label for="vehicle_entry">No vehicle entry area </label>
                                                </td>

                                                <td>
                                                    @if ($data->tapak_no_vehicle_entry_img != '' && file_exists(public_path($data->tapak_no_vehicle_entry_img)) )
                                                    <a href="{{ URL::asset($data->tapak_no_vehicle_entry_img)}}" data-lightbox="roadtrip">
                                                       <img src="{{ URL::asset($data->tapak_no_vehicle_entry_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                   </a>
                                                    @endif
                                                </td>
                                            </tr>

                                            {{-- Area --}}
                                            <tr>
                                                <th rowspan="4">Area</th>
                                                <td class="d-flex">
                                                    <input type="checkbox" name="kawasan[bend]" id="area_bend" disabled
                                                        class="form-check" {{ checkCheckBox('bend', $data->kawasan) }}>
                                                    <label for="area_bend">Bend</label>
                                                </td>

                                                <td>
                                                    @if ($data->kawasan_bend_img != '' && file_exists(public_path($data->kawasan_bend_img)) )
                                                    <a href="{{ URL::asset($data->kawasan_bend_img)}}" data-lightbox="roadtrip">
                                                       <img src="{{ URL::asset($data->kawasan_bend_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                   </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="kawasan[raod]" id="area_raod" disabled
                                                        class="form-check" {{ checkCheckBox('raod', $data->kawasan) }}>
                                                    <label for="area_raod"> Road</label>
                                                </td>

                                                <td>
                                                    @if ($data->kawasan_road_img != '' && file_exists(public_path($data->kawasan_road_img)) )
                                                    <a href="{{ URL::asset($data->kawasan_road_img)}}" data-lightbox="roadtrip">
                                                       <img src="{{ URL::asset($data->kawasan_road_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                   </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="kawasan[forest]" id="area_forest" disabled
                                                        class="form-check" {{ checkCheckBox('forest', $data->kawasan) }}>
                                                    <label for="area_forest">Forest </label>
                                                </td>

                                                <td>
                                                    @if ($data->kawasan_forest_img != '' && file_exists(public_path($data->kawasan_forest_img)) )
                                                    <a href="{{ URL::asset($data->kawasan_forest_img)}}" data-lightbox="roadtrip">
                                                       <img src="{{ URL::asset($data->kawasan_forest_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                   </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="kawasan[other]" id="area_other" disabled
                                                        class="form-check" {{ checkCheckBox('other', $data->kawasan) }}>
                                                    <label for="area_other">others (please state)</label>
                                                </td>

                                                <td>
                                                    @if ($data->kawasan_other_img != '' && file_exists(public_path($data->kawasan_other_img)) )
                                                    <a href="{{ URL::asset($data->kawasan_other_img)}}" data-lightbox="roadtrip">
                                                       <img src="{{ URL::asset($data->kawasan_other_img)}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                                   </a>

                                                    @endif
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>






                                <div class="row">
                                    <div class="col-md-4"><label for="jarak_kelegaan">Clearance Distance</label></div>
                                    <div class="col-md-4"><input type="number" name="jarak_kelegaan" disabled
                                            value="{{ $data->jarak_kelegaan }}" id="jarak_kelegaan"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for=""> Line clearance specifications</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_spec[comply]" id="line-comply" disabled
                                                    {{ checkCheckBox('comply', $data->talian_spec) }}
                                                    class="form-check"><label for="line-comply">
                                                    Comply</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_spec[disobedient]" disabled
                                                    {{ checkCheckBox('disobedient', $data->talian_spec) }}
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
                                                    class="form-check" value="no"
                                                    {{ $data->arus_pada_tiang === 'no' ? 'checked' : '' }}>
                                                <label for="arus_pada_tiang_no">No</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_yes"
                                                    class="form-check" value="yes"
                                                    {{ $data->arus_pada_tiang === 'yes' ? 'checked' : '' }}>
                                                <label for="arus_pada_tiang_yes">Yes</label>
                                            </div>

                                            <div class="col-md-4 @if($data->arus_pada_tiang == 'no' || $data->arus_pada_tiang == '') d-none @endif">
                                                <input type="text" name="arus_pada_tiang_amp" id="arus_pada_tiang_amp" disabled
                                                    class="form-control" value="{{ $data->arus_pada_tiang_amp}}">
                                                <label for="arus_pada_tiang_amp">(Amp)</label>
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

                },

            })
    </script>
@endsection
