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
                    <h3>Tiang</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('tiang-talian-vt-and-vr.index') }}">index</a></li>
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
                        <form id="framework-wizard-form" action="{{ route('tiang-talian-vt-and-vr.store') }}"  enctype="multipart/form-data"
                            style="display: none" method="POST"  onsubmit="return submitFoam()">
                            @csrf
                            <h3></h3>

                            {{-- START Info (1) --}}
                            <fieldset class=" form-input">
                                <h3>Info</h3>

                                <div class="row">
                                    <div class="col-md-4"><label for="ba">Ba</label></div>
                                    <div class="col-md-4"><select name="ba_s" id="ba_s" class="form-control" onchange="getWp(this)"
                                            required>

                                            <option value="" hidden>Select ba</option>
                                            <optgroup label="W1">
                                                <option value="KL PUSAT, KUALA LUMPUR PUSAT, 3.14925905877391, 101.754098819705">KL PUSAT</option>
                                            </optgroup>
                                            <optgroup label="B1">
                                                <option value="PJ, PETALING JAYA, 3.1128074178475, 101.605270457169">PETALING JAYA</option>
                                                <option value="RAWANG, RAWANG, 3.47839445121726, 101.622905486475">RAWANG</option>
                                                <option value="K.SELANGOR, KUALA SELANGOR, 3.40703209426401, 101.317426926947">KUALA SELANGOR</option>
                                            </optgroup>
                                            <optgroup label="B2">
                                                <option value="KLANG, KLANG, 3.08428642705789, 101.436185279023">KLANG</option>
                                                <option value="PORT KLANG, PELABUHAN KLANG, 2.98188527916042, 101.324234779569">PELABUHAN KLANG</option>
                                            </optgroup>
                                            <optgroup label="B4">
                                                <option value="CHERAS, CHERAS, 3.14197346621987, 101.849883983416">CHERAS</option>
                                                <option value="BANTING/SEPANG,BANTING, 2.82111390453244, 101.505890775541">BANTING</option>
                                                <option value="BANGI, BANGI">BANGI</option>
                                                <option value="PUTRAJAYA/CYBERJAYA/PUCHONG, PUTRAJAYA & CYBERJAYA, 2.92875032271019, 101.675338316575">PUTRAJAYA & CYBERJAYA</option>
                                            </optgroup>


                                        </select>
                                        <input type="hidden" name="ba" id="ba">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="name_contractor">Contractor</label></div>
                                    <div class="col-md-4"><input type="text" name="name_contractor" id="name_contractor"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_start_date">PO Start Date</label></div>
                                    <div class="col-md-4"><input type="date" name="start_date" id="po_sstart_date"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="po_end_date">PO End Date</label></div>
                                    <div class="col-md-4"><input type="date" name="end_date" id="po_end_date"
                                            class="form-control" required></div>
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
                                            class="form-control" required></div>
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
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">To</label></div>
                                    <div class="col-md-4"><input type="text" name="section_to" id="section_to"
                                            class="form-control" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="tiang_no">Tiang No</label></div>
                                    <div class="col-md-4"><input type="text" name="tiang_no" id="tiang_no"
                                            class="form-control" required></div>
                                </div>

                                <input type="hidden" name="lat" id="lat" required class="form-control">
                                <input type="hidden" name="log" id="log" class="form-control">

                                <div class="text-center">
                                    <strong>  <span class="text-danger map-error"  ></span></strong>
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
                                    <div class="col-md-4"><label for="st7">
                                            Pole Size Bill 7.5</label></div>
                                    <div class="col-md-4"><input type="number" name="size_tiang[st7]" id="st7"
                                            class="form-control" min="0"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="st9">Pole Size Bill 9</label></div>
                                    <div class="col-md-4"><input type="number" name="size_tiang[st9]" id="st9"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="st10">Pole Size Bill 10</label></div>
                                    <div class="col-md-4"><input type="number" name="size_tiang[st10]" id="st10"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="spun">Pole Type No Spun</label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[spun]" id="spun"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="concrete">Pole Type No Concrete </label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[concrete]"
                                            id="concrete" class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="iron">Pole Type No Iron</label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[iron]" id="iron"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="wood">Pole Type No Wood</label></div>
                                    <div class="col-md-4"><input type="number" name="jenis_tiang[wood]" id="wood"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">ABC (Span) 3 X 185</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s3_185]" id="section_to"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_95">ABC (Span) 3 X 95</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s3_95]" id="s3_95"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_16">ABC (Span) 3 X 16</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s3_16]" id="s3_16"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s1_16">ABC (Span) 1 X 16</label></div>
                                    <div class="col-md-4"><input type="number" name="abc_span[s1_16]" id="s1_16"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s19_064">PVC (Span) 19/064</label></div>
                                    <div class="col-md-4"><input type="number" name="pvc_span[s19_064]" id="s19_064"
                                            class="form-control"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="s7_083">PVC (Span) 7/083</label></div>
                                    <div class="col-md-4"><input type="number" name="pvc_span[s7_083]" id="s7_083"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_044">PVC (Span) 7/044</label></div>
                                    <div class="col-md-4"><input type="number" name="pvc_span[s7_044]" id="s7_044"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_173">BARE (Span) 7/173</label></div>
                                    <div class="col-md-4"><input type="number" name="bare_span[s7_173]" id="s7_173"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="s7_122">BARE (Span) 7/122</label></div>
                                    <div class="col-md-4"><input type="number" name="bare_span[s7_122]" id="s7_122"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><label for="s3_132">BARE (Span) 3/132</label></div>
                                    <div class="col-md-4"><input type="number" name="bare_span[s3_132]" id="s3_132"
                                            class="form-control"></div>
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
                                                    class="form-check"><label for="cracked"> Cracked</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tiang_defect[leaning]" id="leaning"
                                                    class="form-check"><label for="leaning"> Leaning</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tiang_defect[dim]" id="dim"
                                                    class="form-check"><label for="dim"> No. Dim Post / None
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tiang_defect[creepers]" id="creepers"
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
                                                    class="form-check"><label for="joint"> Joint</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_defect[need_rentis]" id="need_rentis"
                                                    class="form-check"><label for="need_rentis">
                                                    Need Rentis</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="talian_defect[ground]" id="ground"
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
                                                    id="umbang-breaking" class="form-check"><label for="umbang-breaking">
                                                    Sagging/Breaking</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect[creepers]"
                                                    id="umbang-creepers" class="form-check"><label for="umbang-creepers">
                                                    Creepers</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect[]" id="umbang_cracked"
                                                    class="form-check"><label for="umbang_cracked"> No Stay
                                                    Insulator/Damaged
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="umbang_defect[stay_palte]" id="stay_palte"
                                                    class="form-check"><label for="stay_palte"> Stay Plate / Base Stay
                                                    Blocked
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">IPC</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="ipc_defect[burn]" id="ipc-burn"
                                                    class="form-check"><label for="ipc-burn"> Burn Effect</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="section_to">Black Box</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="blackbox_defect[cracked]"
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
                                                    class="form-check"><label for="jumper-sleeve"> No UV Sleeve</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[burn]" id="jumper-burn"
                                                    class="form-check"><label for="jumper-burn">
                                                    Burn Effect</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[damage]" id="jumper-damage"
                                                    class="form-check"><label for="jumper-damage"> No Stay
                                                    Insulator/Damaged
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="jumper[blocked]" id="jumper-blocked"
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
                                                    class="form-check"><label for="service-roof">
                                                    The service line is on the roof</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="servis_defect[won-piece]"
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
                                                <input type="checkbox" name="Pembumian_defect[netural]"
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
                                                    id="street-date-wire" class="form-check"><label
                                                    for="street-date-wire">Date Wire</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kaki_lima_defect[burn]" id="street-burn"
                                                    class="form-check"><label for="street-burn">
                                                    Junction Box Date / Burn Effect</label>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="total_defects">Total Defects</label></div>
                                    <div class="col-md-4"><input type="number" name="total_defects" id="total_defects"
                                            class="form-control"></div>
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
                                    <div class="col-md-4"><input type="text" name="remarks" id="remarks"
                                            class="form-control"></div>
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
                                                    class="form-check"><label for="site-road">
                                                    Crossing the Road</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tapak_condition[side_walk]" id="side_walk"
                                                    class="form-check"><label for="side_walk">
                                                    Sidewalk</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="tapak_condition[vehicle_entry]"
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
                                                    class="form-check"><label for="area-bend">
                                                    Bend</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[raod]" id="area-raod"
                                                    class="form-check"><label for="area-raod">
                                                    Road</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[forest]" id="area-forest"
                                                    class="form-check"><label for="area-forest">Forest
                                                </label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="checkbox" name="kawasan[other]" id="area-other"
                                                    class="form-check"><label for="area-other">others (please state)
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="jarak_kelegaan">Clearance Distance</label></div>
                                    <div class="col-md-4"><input type="text" name="jarak_kelegaan"
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
                            {{-- START Kejanggalan Images --}}
                            <fieldset class="form-input">
                                <h3>Kejanggalan Images</h3>



                                <div class="row">
                                    <div class="col-md-4"><label for="tapak_road_img">Crossing the Road Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="tapak_road_img" id="tapak_road_img"
                                            class="form-control">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="tapak_sidewalk_img">Sidewalk Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="tapak_sidewalk_img" id="tapak_sidewalk_img"
                                            class="form-control">
                                    </div>
                                </div>






                                <div class="row">
                                    <div class="col-md-4"><label
                                            for="tapak_no_vehicle_entry_img">No Vehicle Entry Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="tapak_no_vehicle_entry_img"
                                            id="tapak_no_vehicle_entry_img" class="form-control">
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_bend_img">Bend Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_bend_img" id="kawasan_bend_img"
                                            class="form-control">
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_road_img">Road Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_road_img" id="kawasan_road_img"
                                            class="form-control">
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_forest_img">Forest Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_forest_img" id="kawasan_forest_img"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4"><label for="kawasan_other_img">Other Area Image</label></div>
                                    <div class="col-md-4">
                                        <input type="file" name="kawasan_other_img" id="kawasan_other_img"
                                            class="form-control">
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

                                                    No</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_yes"
                                                    class="form-check" value="yes"><label for="arus_pada_tiang_yes">
                                                    Yes</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_amp"
                                                    value="amp" class="form-check"><label for="arus_pada_tiang_amp">
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
    function submitFoam(){
            if ($('#lat').val() == '' || $('#log').val() == '') {
                $('.map-error').html('Please select location')
                return false;
            }else{
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

            map.removeLayer(boundary3) // Remove on page load boundary

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
        }

        map.on('click', onMapClick);
    </script>


@endsection
