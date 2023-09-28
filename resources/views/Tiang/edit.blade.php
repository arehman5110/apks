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
                    <li class="breadcrumb-item"><a href="{{route('tiang-talian-vt-and-vr.index')}}">index</a></li>
                    <li class="breadcrumb-item active">edit</li>
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
                        <form id="framework-wizard-form" action="{{ route('tiang-talian-vt-and-vr.update',$data->id) }}" enctype="multipart/form-data"
                            style="display: none" method="POST">
                            @method('PATCH')
                            @csrf
                            <h3></h3>

                            {{-- START Info (1) --}}
                            <fieldset class=" form-input">
                                <h3>Info </h3>

                                <div class="row">
                                    <div class="col-md-4"><label for="ba">Ba</label></div>
                                    <div class="col-md-4"><select name="ba" id="ba" class="form-control"
                                            required>

                                            <option value="{{ $data->ba }}" hidden>{{ $data->ba }}</option>
                                            <optgroup label="W1">
                                                <option value="KUALA LUMPUR PUSAT">KL PUSAT</option>
                                            </optgroup>
                                            <optgroup label="B1">
                                                <option value="PETALING JAYA">PETALING JAYA</option>
                                                <option value="RAWANG">RAWANG</option>
                                                <option value="KUALA SELANGOR">KUALA SELANGOR</option>
                                            </optgroup>
                                            <optgroup label="B2">
                                                <option value="KLANG">KLANG</option>
                                                <option value="PELABUHAN KLANG">PELABUHAN KLANG</option>
                                            </optgroup>
                                            <optgroup label="B4">
                                                <option value="CHERAS">CHERAS</option>
                                                <option value="BANTING">BANTING</option>
                                                <option value="BANGI">BANGI</option>
                                                <option value="PUTRAJAYA & CYBERJAYA">PUTRAJAYA & CYBERJAYA</option>
                                            </optgroup>


                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="name_contractor">Contractor</label></div>
                                    <div class="col-md-4"><input type="text" name="name_contractor"
                                            value="{{ $data->name_contractor }}" id="name_contractor" class="form-control"
                                            required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_start_date">PO Start Date</label></div>
                                    <div class="col-md-4"><input type="date" name="start_date"
                                            value="{{ date('Y-m-d', strtotime($data->start_date)) }}" id="po_sstart_date"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_end_date">PO End Date</label></div>
                                    <div class="col-md-4"><input type="date" name="end_date"
                                            value="{{ date('Y-m-d', strtotime($data->end_date)) }}" id="po_end_date"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="fp_name">Name of Substation / Name of Feeder
                                            Pillar</label></div>
                                    <div class="col-md-4"><input type="text" name="fp_name" value="{{ $data->fp_name }}"
                                            id="fp_name" class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="review_date">Review Date </label></div>
                                    <div class="col-md-4"><input type="date" name="review_date"
                                            value="{{ date('Y-m-d', strtotime($data->review_date)) }}" id="review_date"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="fp_road">Feeder Name / Street Name</label></div>
                                    <div class="col-md-4"><input type="text" name="fp_road" value="{{ $data->fp_road }}"
                                            id="fp_road" class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="">Section </label></div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_from">From </label></div>
                                    <div class="col-md-4"><input type="text" name="section_from"
                                            value="{{ $data->section_from }}" id="section_from" class="form-control"
                                            required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">To</label></div>
                                    <div class="col-md-4"><input type="text" name="section_to"
                                            value="{{ $data->section_to }}" id="section_to" class="form-control"
                                            required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="tiang_no">Tiang No</label></div>
                                    <div class="col-md-4"><input type="text" name="tiang_no"
                                            value="{{ $data->tiang_no }}" id="tiang_no" class="form-control" required>
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
                                    <div class="col-md-4"><input type="number" name="size_tiang[st7]"
                                            value="{{ $data->size_tiang->st7 }}" id="st7" class="form-control"
                                            min="0"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="st9">Pole Size Bill 9</label></div>
                                    <div class="col-md-4"><input type="number" name="size_tiang[st9]"
                                            value="{{ $data->size_tiang->st9 }}" id="st9" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="st10">Pole Size Bill 10</label></div>
                                    <div class="col-md-4"><input type="number" name="size_tiang[st10]"
                                            value="{{ $data->size_tiang->st10 }}" id="st10" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="spun">Pole Type No Spun</label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[spun]"
                                            value="{{ $data->jenis_tiang->spun }}" id="spun" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="concrete">Pole Type No Concrete </label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[concrete]"
                                            value="{{ $data->jenis_tiang->concrete }}" id="concrete"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="iron">Pole Type No Iron</label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[iron]" id="iron"
                                            value="{{ $data->jenis_tiang->iron }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="wood">Pole Type No Wood</label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[wood]" id="wood"
                                            value="{{ $data->jenis_tiang->wood }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">ABC (Span) 3 X 185</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s3_185]" id="section_to"
                                            value="{{ $data->abc_span->s3_185 }}" class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_95">ABC (Span) 3 X 95</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s3_95]" id="s3_95"
                                            value="{{ $data->abc_span->s3_95 }}" class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_16">ABC (Span) 3 X 16</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s3_16]" id="s3_16"
                                            value="{{ $data->abc_span->s3_16 }}" class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s1_16">ABC (Span) 1 X 16</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s1_16]" id="s1_16"
                                            value="{{ $data->abc_span->s1_16 }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s19_064">PVC (Span) 19/064</label></div>
                                    <div class="col-md-4"><input type="number" name="pvc_span[s19_064]" id="s19_064"
                                            value="{{ $data->pvc_span->s19_064 }}" class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="s7_083">PVC (Span) 7/083</label></div>
                                    <div class="col-md-4"><input type="number" name="pvc_span[s7_083]" id="s7_083"
                                            value="{{ $data->pvc_span->s7_083 }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_044">PVC (Span) 7/044</label></div>
                                    <div class="col-md-4"><input type="number" name="pvc_span[s7_044]" id="s7_044"
                                            value="{{ $data->pvc_span->s7_044 }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_173">BARE (Span) 7/173</label></div>
                                    <div class="col-md-4"><input type="number" name="bare_span[s7_173]" id="s7_173"
                                            value="{{ $data->bare_span->s7_173 }}" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_122">BARE (Span) 7/122</label></div>
                                    <div class="col-md-4"><input type="number" name="bare_span[s7_122]" id="s7_122"
                                            value="{{ $data->bare_span->s7_122 }}" class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_132">BARE (Span) 3/132</label></div>
                                    <div class="col-md-4"><input type="number" name="bare_span[s3_132]" id="s3_132"
                                            value="{{ $data->bare_span->s3_132 }}" class="form-control"></div>
                                </div>

                            </fieldset>

                            {{-- END Asset Register (2) --}}

                            {{-- START Kejanggalan (3) --}}
                            <h3></h3>
                            <fieldset class="form-input">

                                <h3>Kejanggalan</h3>
                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">Pole</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">

                                                <input type="checkbox" name="tiang_defect[cracked]" id="cracked"
                                                    {{ checkCheckBox('cracked', $data->tiang_defect) }}
                                                    class="form-check">
                                                <label for="cracked"> Cracked</label>
                                            </div>


                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tiang_defect[leaning]" id="leaning"
                                                    {{ checkCheckBox('leaning', $data->tiang_defect) }}
                                                    class="form-check"><label for="leaning"> Leaning</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tiang_defect[dim]" id="dim"
                                                    {{ checkCheckBox('dim', $data->tiang_defect) }}
                                                    class="form-check"><label for="dim"> No. Dim Post / None
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tiang_defect[creepers]" id="creepers"
                                                    {{ checkCheckBox('creepers', $data->tiang_defect) }}
                                                    class="form-check"><label for="creepers"> Creepers
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="">Line (Main / Service)</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_defect[joint]" id="joint"
                                                    {{ checkCheckBox('joint', $data->talian_defect) }}
                                                    class="form-check"><label for="joint"> Joint</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_defect[need_rentis]" id="need_rentis"
                                                    {{ checkCheckBox('need_rentis', $data->talian_defect) }}
                                                    class="form-check"><label for="need_rentis">
                                                    Need Rentis</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_defect[ground]" id="ground"
                                                    {{ checkCheckBox('ground', $data->talian_defect) }}
                                                    class="form-check"><label for="ground"> Does Not Comply With Ground
                                                    Clearance
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="">Umbang</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect[breaking]"
                                                    {{ checkCheckBox('breaking', $data->umbang_defect) }}
                                                    id="umbang-breaking" class="form-check"><label for="umbang-breaking">
                                                    Sagging/Breaking</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect[creepers]"
                                                    {{ checkCheckBox('creepers', $data->umbang_defect) }}
                                                    id="umbang-creepers" class="form-check"><label for="umbang-creepers">
                                                    Creepers</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect['cracked']"
                                                    id="umbang_cracked"
                                                    {{ checkCheckBox('cracked', $data->umbang_defect) }}
                                                    class="form-check"><label for="umbang_cracked"> No Stay
                                                    Insulator/Damaged
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect[stay_palte]" id="stay_palte"
                                                    {{ checkCheckBox('stay_palte', $data->umbang_defect) }}
                                                    class="form-check"><label for="stay_palte"> Stay Plate / Base Stay
                                                    Blocked
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="">IPC</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="ipc_defect[burn]" id="ipc-burn"
                                                    {{ checkCheckBox('burn', $data->ipc_defect) }}
                                                    class="form-check"><label for="ipc-burn"> Burn Effect</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="">Black Box</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="blackbox_defect[cracked]"
                                                    {{ checkCheckBox('cracked', $data->ipc_defect) }}
                                                    id="black-box-cracked" class="form-check"><label
                                                    for="black-box-cracked"> Kesan Bakar</label>
                                            </div>



                                        </div>
                                    </div>
                                </div>






                                <div class="row">
                                    <div class="col-md-4"><label for="">Jumper</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[sleeve]" id="jumper-sleeve"
                                                    {{ checkCheckBox('sleeve', $data->jumper) }}
                                                    class="form-check"><label for="jumper-sleeve"> No UV Sleeve</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[burn]" id="jumper-burn"
                                                    {{ checkCheckBox('burn', $data->jumper) }} class="form-check"><label
                                                    for="jumper-burn">
                                                    Burn Effect</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[damage]" id="jumper-damage"
                                                    {{ checkCheckBox('damage', $data->jumper) }}
                                                    class="form-check"><label for="jumper-damage"> No Stay
                                                    Insulator/Damaged
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[blocked]" id="jumper-blocked"
                                                    {{ checkCheckBox('damage', $data->jumper) }}
                                                    class="form-check"><label for="jumper-blocked"> Stay Plate / Base Stay
                                                    Blocked
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>






                                <div class="row">
                                    <div class="col-md-4"><label for="">Lightning catcher</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kilat_defect[broken]" id="lightning-broken"
                                                    {{ checkCheckBox('broken', $data->kilat_defect) }}
                                                    class="form-check"><label for="lightning-broken"> Broken</label>
                                            </div>



                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="">Service</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="servis_defect[roof]" id="service-roof"
                                                    {{ checkCheckBox('roof', $data->servis_defect) }}
                                                    class="form-check"><label for="service-roof">
                                                    The service line is on the roof</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="servis_defect[won_piece]"
                                                    {{ checkCheckBox('won_piece', $data->servis_defect) }}
                                                    id="service-won-piece" class="form-check"><label
                                                    for="service-won-piece">
                                                    Won piece Date</label>
                                            </div>



                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="">Grounding</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="pembumian_defect[netural]"
                                                    {{ checkCheckBox('netural', $data->pembumian_defect) }}
                                                    id="grounding-netural" class="form-check"><label
                                                    for="grounding-netural"> No Connection to Neutral</label>
                                            </div>



                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="">
                                            Signage - OFF Point / Two Way Supply</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="bekalan_dua_defect[damage]"
                                                    {{ checkCheckBox('damage', $data->bekalan_dua_defect) }}
                                                    id="signage-damage" class="form-check"><label for="signage-damage">
                                                    Faded / Damaged / Missing Signage</label>
                                            </div>


                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="">Main Street</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[date_wire]"
                                                    {{ checkCheckBox('date_wire', $data->kaki_lima_defect) }}
                                                    id="street-date-wire" class="form-check"><label
                                                    for="street-date-wire">Date Wire</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[burn]" id="street-burn"
                                                    {{ checkCheckBox('burn', $data->kaki_lima_defect) }}
                                                    class="form-check"><label for="street-burn">
                                                    Junction Box Date / Burn Effect</label>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="total_defects">Total Defects</label></div>
                                    <div class="col-md-4"><input type="number" name="total_defects" id="total_defects"
                                            value="{{ $data->total_defects }}" class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="planed_date">Planned Repair Date</label></div>
                                    <div class="col-md-4"><input type="date" name="planed_date" id="planed_date"
                                            value="{{ date('Y-m-d', strtotime($data->planed_date)) }}"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="actual_date">Date of Repair Performed</label></div>
                                    <div class="col-md-4"><input type="date" name="actual_date" id="actual_date"
                                            value="{{ date('Y-m-d', strtotime($data->actual_date)) }}"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="remarks">Remarks</label></div>
                                    <div class="col-md-4"><input type="text" name="remarks" id="remarks"
                                            value="{{ $data->remarks }}" class="form-control"></div>
                                </div>






                            </fieldset>

                            {{-- END Kejanggalan (3) --}}


                            <h3></h3>
                            {{-- START Heigh Clearance (4) --}}

                            <fieldset class="form-input">
                                <h3>Heigh Clearance</h3>
                                <div class="row">
                                    <div class="col-md-4"><label for="">Site Conditions</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tapak_condition[road]" id="site-road"
                                                    {{ checkCheckBox('road', $data->tapak_condition) }}
                                                    class="form-check"><label for="site-road">
                                                    Crossing the Road</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tapak_condition[side_walk]" id="side_walk"
                                                    {{ checkCheckBox('side_walk', $data->tapak_condition) }}
                                                    class="form-check"><label for="side_walk">
                                                    Sidewalk</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tapak_condition[vehicle_entry]"
                                                    {{ checkCheckBox('vehicle_entry', $data->tapak_condition) }}
                                                    id="vehicle_entry" class="form-check"><label for="vehicle_entry">No
                                                    vehicle entry area
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for=""> Area</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[bend]" id="area-bend"
                                                    {{ checkCheckBox('bend', $data->kawasan) }} class="form-check"><label
                                                    for="area-bend">
                                                    Bend</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[raod]" id="area-raod"
                                                    {{ checkCheckBox('raod', $data->kawasan) }} class="form-check"><label
                                                    for="area-raod">
                                                    Road</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[forest]" id="area-forest"
                                                    {{ checkCheckBox('forest', $data->kawasan) }}
                                                    class="form-check"><label for="area-forest">Forest
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[other]" id="area-other"
                                                    {{ checkCheckBox('other', $data->kawasan) }}
                                                    class="form-check"><label for="area-other">others (please state)
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="jarak_kelegaan">Clearance Distance</label></div>
                                    <div class="col-md-4"><input type="text" name="jarak_kelegaan"
                                            value="{{ $data->jarak_kelegaan }}" id="jarak_kelegaan"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for=""> Line clearance specifications</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_spec[comply]" id="line-comply"
                                                    {{ checkCheckBox('comply', $data->talian_spec) }}
                                                    class="form-check"><label for="line-comply">
                                                    Comply</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_spec[disobedient]"
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
                            {{-- START Kejanggalan Images --}}
                            <fieldset class="form-input">
                                <h3>Kejanggalan Images</h3>



                                <div class="row">
                                    <div class="col-md-4"><label for="tapak_road_img">Crossing the Road Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="tapak_road_img" id="tapak_road_img"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->tapak_road_img)) && $data->tapak_road_img != '')
                                            <a href="{{ URL::asset($data->tapak_road_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->tapak_road_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="tapak_sidewalk_img">Sidewalk Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="tapak_sidewalk_img" id="tapak_sidewalk_img"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->tapak_sidewalk_img)) && $data->tapak_sidewalk_img != '')
                                            <a href="{{ URL::asset($data->tapak_sidewalk_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->tapak_sidewalk_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>






                                <div class="row">
                                    <div class="col-md-4"><label
                                            for="tapak_no_vehicle_entry_img">No Vehicle Entry Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="tapak_no_vehicle_entry_img"
                                            id="tapak_no_vehicle_entry_img" class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->tapak_no_vehicle_entry_img)) && $data->tapak_no_vehicle_entry_img != '')
                                            <a href="{{ URL::asset($data->tapak_no_vehicle_entry_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->tapak_no_vehicle_entry_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_bend_img">Bend Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_bend_img" id="kawasan_bend_img"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->kawasan_bend_img)) && $data->kawasan_bend_img != '')
                                            <a href="{{ URL::asset($data->kawasan_bend_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->kawasan_bend_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_road_img">Road Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_road_img" id="kawasan_road_img"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->kawasan_road_img)) && $data->kawasan_road_img != '')
                                            <a href="{{ URL::asset($data->kawasan_road_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->kawasan_road_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_forest_img">Forest Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_forest_img" id="kawasan_forest_img"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->kawasan_forest_img)) && $data->kawasan_forest_img != '')
                                            <a href="{{ URL::asset($data->kawasan_forest_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->kawasan_forest_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_other_img">Other Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_other_img" id="kawasan_other_img"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 text-center mb-3">
                                        @if (file_exists(public_path($data->kawasan_other_img)) && $data->kawasan_other_img != '')
                                            <a href="{{ URL::asset($data->kawasan_other_img) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->kawasan_other_img) }}" alt=""
                                                    height="70" class="adjust-height ml-5  "></a>
                                        @else
                                            <strong>No image found</strong>
                                        @endif
                                    </div>
                                </div>

                            </fieldset>
                            {{-- END Kejanggalan Images --}}


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
                                                    {{ $data->arus_pada_tiang == 'no' ? 'checked' : '' }}
                                                    No</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_yes"
                                                    {{ $data->arus_pada_tiang == 'yes' ? 'checked' : '' }}
                                                    class="form-check" value="yes"><label for="arus_pada_tiang_yes">
                                                    Yes</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_amp"
                                                    {{ $data->arus_pada_tiang == 'amp' ? 'checked' : '' }} value="amp"
                                                    class="form-check"><label for="arus_pada_tiang_amp">
                                                    (Amp)</label>
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
                    form.submit();
                },
                // autoHeight: true,
            })

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
