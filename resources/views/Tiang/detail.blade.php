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

        span.number{display: none}
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

                            <h3>{{__("messages.info")}} </h3>

                            {{-- START Info (1) --}}
                            <fieldset class=" form-input">


                                <div class="row">
                                    <div class="col-md-4"><label for="ba">BA</label></div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="{{ $data->ba }}" disabled>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4"><label for="fp_name">Name of Substation / Name of Feeder
                                            Pillar</label></div>
                                    <div class="col-md-4"><input disabled value="{{ $data->fp_name }}" id="fp_name"
                                            class="form-control"></div>
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

                                <div class="row">
                                    <div class="col-md-4"><label for="pole_image-1">{{ __('messages.pole') }} Image 1
                                        </label>
                                    </div>


                                    <div class="col-md-4 p-2">
                                        @if ($data->pole_image_1 != '' && file_exists(public_path($data->pole_image_1)))
                                            <a href="{{ URL::asset($data->pole_image_1) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->pole_image_1) }}" alt=""
                                                    class="adjust-height " style="height:30px; width:30px !important">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }} </strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><label for="pole_image-2">{{ __('messages.pole') }} Image
                                            2</label>
                                    </div>

                                    <div class="col-md-4 p-2">
                                        @if ($data->pole_image_2 != '' && file_exists(public_path($data->pole_image_2)))
                                            <a href="{{ URL::asset($data->pole_image_2) }}" data-lightbox="roadtrip">
                                                <img src="{{ URL::asset($data->pole_image_2) }}" alt=""
                                                    class="adjust-height " style="height:30px; width:30px !important">
                                            </a>
                                        @else
                                            <strong>{{ __('messages.no_image_found') }} </strong>
                                        @endif
                                    </div>
                                </div>




                            </fieldset>
                            {{-- END Info (1) --}}
                            <h3>{{__("messages.Asset_Register")}} </h3>

                            {{-- START Asset Register (2) --}}


                            <fieldset class="form-input">

                                <div class="row">
                                <div class="col-md-6">
                                    <div class="card p-4">
                                        <div class="row">
                                            <div class="col-md-8"><label for="st7">
                                                    {{ __('messages.Pole_Size_Bill') }}  </label>

                                                    <div class="d-flex">
                                                        <input type="radio" name="size_tiang"
                                                        value="st7" id="st7" {{$data->size_tiang == 'st7' ? 'checked' : ''}} disabled
                                                        class="  "  >
                                                        <label for="st7"> 7.5</label>

                                                    </div>

                                                    <div class="d-flex">
                                                        <input type="radio" name="size_tiang"
                                                        value="st9" id="st9" {{$data->size_tiang == 'st9' ? 'checked' : ''}} disabled
                                                        class=" ">
                                                        <label for="st9"> 9</label>

                                                    </div>

                                                    <div class="d-flex">
                                                        <input type="radio" name="size_tiang"
                                                        value="st10" id="st10" {{$data->size_tiang == 'st10' ? 'checked' : ''}} disabled
                                                        class=" ">
                                                        <label for="st10"> 10</label>


                                                    </div></div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card p-4">


                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="">{{ __('messages.Pole_type_No') }} </label>

                                                <div class="d-flex">

                                                    <input type="radio" name="jenis_tiang" value="spun" id="spun" class=" "  {{$data->jenis_tiang == 'spun' ? 'checked' : ''}} disabled>
                                                    <label for="spun">{{ __('messages.Spun') }}</label>

                                                </div>

                                                <div class="d-flex">

                                                    <input type="radio" name="jenis_tiang" value="concrete" id="concrete" class=" " {{$data->jenis_tiang == 'concrete' ? 'checked' : ''}} disabled>
                                                    <label for="concrete">{{ __('messages.Concrete') }}</label>

                                                </div>


                                                <div class="d-flex">

                                                    <input type="radio" name="jenis_tiang" value="iron" id="iron" class=" " {{$data->jenis_tiang == 'iron' ? 'checked' : ''}} disabled>
                                                    <label for="iron">{{ __('messages.Pole_type_No') }}</label>

                                                </div>

                                                <div class="d-flex">

                                                    <input type="radio" name="jenis_tiang" value="wood" id="wood" class=" " {{$data->jenis_tiang == 'wood' ? 'checked' : ''}} disabled>
                                                    <label for="wood">{{ __('messages.Wood') }}</label>

                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                </div>




                            <div class="col-md-6">
                                <div class="card p-4">
                                    <div class="row">
                                        <div class="col-md-6"><label for="s19_064">{{__("messages.PVC_Span")}} 19/064</label></div>
                                        <div class="col-md-6"><input type="number" name="pvc_span[s19_064]" disabled
                                                id="s19_064" value="{{ $data->pvc_span->s19_064 }}"
                                                class="form-control"></div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6"><label for="s7_083">{{__("messages.PVC_Span")}} 7/083</label></div>
                                        <div class="col-md-6"><input type="number" name="pvc_span[s7_083]" disabled
                                                id="s7_083" value="{{ $data->pvc_span->s7_083 }}"
                                                class="form-control"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6"><label for="s7_044">{{__("messages.PVC_Span")}} 7/044</label></div>
                                        <div class="col-md-6"><input type="number" name="pvc_span[s7_044]" disabled
                                                id="s7_044" value="{{ $data->pvc_span->s7_044 }}"
                                                class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-4">
                                    <div class="row">
                                        <div class="col-md-6"><label for="s7_173">{{__('messages.BARE_Span')}} 7/173</label></div>
                                        <div class="col-md-6"><input type="number" name="bare_span[s7_173]" disabled
                                                id="s7_173" value="{{ $data->bare_span->s7_173 }}"
                                                class="form-control"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6"><label for="s7_122">{{__('messages.BARE_Span')}} 7/122</label></div>
                                        <div class="col-md-6"><input type="number" name="bare_span[s7_122]" disabled
                                                id="s7_122" value="{{ $data->bare_span->s7_122 }}"
                                                class="form-control"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><label for="s3_132">{{__('messages.BARE_Span')}} 3/132</label></div>
                                        <div class="col-md-6"><input type="number" name="bare_span[s3_132]" disabled
                                                id="s3_132" value="{{ $data->bare_span->s3_132 }}"
                                                class="form-control"></div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="card p-4">

                                    <div class="row">
                                        <div class="col-md-6"><label for="section_to">{{__('messages.ABC_Span')}} 3 X 185</label></div>
                                        <div class="col-md-6"><input type="number" name="abc_span[s3_185]" disabled
                                                id="section_to" value="{{ $data->abc_span->s3_185 }}"
                                                class="form-control"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><label for="s3_95">{{__('messages.ABC_Span')}} 3 X 95</label></div>
                                        <div class="col-md-6"><input type="number" name="abc_span[s3_95]" disabled
                                                id="s3_95" value="{{ $data->abc_span->s3_95 }}"
                                                class="form-control"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><label for="s3_16">{{__('messages.ABC_Span')}} 3 X 16</label></div>
                                        <div class="col-md-6"><input type="number" name="abc_span[s3_16]" disabled
                                                id="s3_16" value="{{ $data->abc_span->s3_16 }}"
                                                class="form-control"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><label for="s1_16">{{__('messages.ABC_Span')}} 1 X 16</label></div>
                                        <div class="col-md-6"><input type="number" name="abc_span[s1_16]"
                                                id="s1_16" value="{{ $data->abc_span->s1_16 }}" disabled
                                                class="form-control"></div>
                                    </div>


                                </div>
                            </div>
                        </div>

                            </fieldset>

                            {{-- END Asset Register (2) --}}

                            <h3>{{__("messages.kejanggalan")}} </h3>
                            <fieldset class="form-input">


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
                                            {!! getImageShow('cracked', $data->tiang_defect , 'tiang_defect' , $data->tiang_defect_image , 'Cracked') !!}

                                        </tr>
                                        <tr>
                                            {!! getImageShow('leaning', $data->tiang_defect , 'tiang_defect' , $data->tiang_defect_image , 'Leaning') !!}


                                        </tr>


                                        <tr>
                                            {!! getImageShow('dim', $data->tiang_defect , 'tiang_defect' , $data->tiang_defect_image , 'Dim') !!}

                                        </tr>


                                        <tr>
                                            {!! getImageShow('creepers', $data->tiang_defect , 'tiang_defect' , $data->tiang_defect_image , 'Creepers') !!}

                                        </tr>


                                        <tr>
                                            {!! getImageShow('other', $data->tiang_defect , 'tiang_defect' , $data->tiang_defect_image , 'Other') !!}

                                        </tr>

                                        {{-- Line (Main / Service) --}}

                                        <tr>
                                            <th rowspan="4">Line (Main / Service)</th>
                                            {!! getImageShow('joint', $data->talian_defect , 'talian_defect' , $data->talian_defect_image , 'Joint') !!}

                                        </tr>
                                        <tr>
                                            {!! getImageShow('need_rentis', $data->talian_defect , 'talian_defect' , $data->talian_defect_image ,'Need Rentis') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('ground', $data->talian_defect , 'talian_defect' , $data->talian_defect_image ,'Does Not Comply With Ground Clearance') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->talian_defect , 'talian_defect' , $data->talian_defect_image ,'Others') !!}

                                        </tr>


                                        {{-- Umbang --}}

                                        <tr>
                                            <th rowspan="5">Umbang</th>
                                            {!! getImageShow('breaking', $data->umbang_defect , 'umbang_defect' , $data->umbang_defect_image ,'Sagging/Breaking') !!}

                                        </tr>
                                        <tr>
                                            {!! getImageShow('creepers', $data->umbang_defect , 'umbang_defect' , $data->umbang_defect_image ,'Creepers') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('cracked', $data->umbang_defect , 'umbang_defect' , $data->umbang_defect_image ,'No Stay Insulator/Damaged') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('stay_palte', $data->umbang_defect , 'umbang_defect' , $data->umbang_defect_image ,'Stay Plate / Base Stay Blocked') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->umbang_defect , 'umbang_defect' , $data->umbang_defect_image ,'Others') !!}

                                        </tr>


                                        {{-- IPC --}}
                                        <tr>
                                            <th rowspan="2">IPC</th>
                                            {!! getImageShow('burn', $data->ipc_defect , 'ipc_defect' , $data->ipc_defect_image ,'Burn Effect') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->ipc_defect , 'ipc_defect' , $data->ipc_defect_image ,'Others') !!}

                                        </tr>

                                        {{-- Black Box --}}

                                        <tr>
                                            <th rowspan="2">Black Box</th>
                                            {!! getImageShow('cracked', $data->blackbox_defect , 'blackbox_defect' , $data->blackbox_defect_image ,'Kesan Bakar') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->blackbox_defect , 'blackbox_defect' , $data->blackbox_defect_image ,'Others') !!}

                                        </tr>

                                        {{-- Jumper --}}

                                        <tr>
                                            <th rowspan="3">Jumper</th>
                                            {!! getImageShow('sleeve', $data->jumper , 'jumper' , $data->jumper_image ,'No UV Sleeve') !!}

                                        </tr>
                                        <tr>
                                            {!! getImageShow('burn', $data->jumper , 'jumper' , $data->jumper_image ,'Burn Effect') !!}

                                        </tr>


                                        <tr>
                                            {!! getImageShow('other', $data->jumper , 'jumper' , $data->jumper_image ,'Others') !!}

                                        </tr>

                                        {{-- Lightning catcher --}}

                                        <tr>
                                            <th rowspan="2">Lightning catcher</th>
                                            {!! getImageShow('broken', $data->kilat_defect , 'kilat_defect' , $data->kilat_defect_image ,'Broken') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->kilat_defect , 'kilat_defect' , $data->kilat_defect_image ,'Others') !!}

                                        </tr>

                                        {{-- Service --}}

                                        <tr>
                                            <th rowspan="3">Service</th>
                                            {!! getImageShow('roof', $data->servis_defect , 'servis_defect' , $data->servis_defect_image ,'The service line is on the roof') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('won_piece', $data->servis_defect , 'servis_defect' , $data->servis_defect_image ,'Won piece Dat') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->servis_defect , 'servis_defect' , $data->servis_defect_image ,'Others') !!}

                                        </tr>


                                        {{-- Grounding --}}

                                        <tr>
                                            <th rowspan="2">Grounding</th>
                                            {!! getImageShow('netural', $data->pembumian_defect , 'pembumian_defect' , $data->pembumian_defect_image ,'No Connection to Neutral') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->pembumian_defect , 'pembumian_defect' , $data->pembumian_defect_image ,'Others') !!}

                                        </tr>

                                        {{-- Signage - OFF Point / Two Way Supply --}}
                                        <tr>
                                            <th rowspan="2">Signage - OFF Point / Two Way Supply</th>
                                            {!! getImageShow('damage', $data->bekalan_dua_defect , 'bekalan_dua_defect' , $data->bekalan_dua_defect_image ,'Faded / Damaged / Missing Signage') !!}

                                        </tr>

                                        <tr>
                                            {!! getImageShow('other', $data->bekalan_dua_defect , 'bekalan_dua_defect' , $data->bekalan_dua_defect_image ,'Others') !!}

                                        </tr>

                                        {{-- Main Street --}}

                                        <tr>
                                            <th rowspan="3">Main Street</th>
                                            {!! getImageShow('date_wire', $data->kaki_lima_defect , 'kaki_lima_defect' , $data->kaki_lima_defect_image ,'Date Wire') !!}

                                        </tr>
                                        <tr>
                                            {!! getImageShow('burn', $data->kaki_lima_defect , 'kaki_lima_defect' , $data->kaki_lima_defect_image ,'Junction Box Date / Burn Effect') !!}

                                        </tr>
                                        <tr>
                                            {!! getImageShow('other', $data->kaki_lima_defect , 'kaki_lima_defect' , $data->kaki_lima_defect_image ,'Others') !!}

                                        </tr>
                                    </table>
                                </div>

                            </fieldset>




                            <h3>{{__("messages.Heigh_Clearance")}} </h3>
                            {{-- START Heigh Clearance (4) --}}

                            <fieldset class="form-input">
                                <h3>Heigh Clearance</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <thead style="background-color: #E4E3E3 !important">
                                            <th class="col-4">Title</th>
                                            <th class="col-4">Defects</th>
                                            <th class="col-3">Images</th>

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
                                                <input type="radio" name="talian_spec" id="line-comply"
                                                    {{   $data->talian_spec == "comply" ? "checked" : "" }} value="comply" disabled
                                                    class="form-check"><label for="line-comply">
                                                    {{ __('messages.Comply') }}</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="talian_spec"
                                                {{   $data->talian_spec == "uncomply" ? "checked" : "" }} value="uncomply" disabled
                                                    id="line-disobedient" class="form-check">
                                                <label for="line-disobedient"> Uncomply </label>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            {{-- END Heigh Clearance (4) --}}



                            <h3>{{__("messages.Kebocoran_Arus")}} </h3>



                            {{-- START Kebocoran Arus (5) --}}

                            <fieldset class="form-input">

                                <div class="row">
                                    <div class="col-md-4"><label for="">Inspection of current leakage on the
                                            pole</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_no"
                                                    class="form-check" value="no" disabled
                                                    {{ $data->arus_pada_tiang === 'no' ? 'checked' : '' }}>
                                                <label for="arus_pada_tiang_no">No</label>
                                            </div>

                                            <div class="col-md-4 d-flex">
                                                <input type="radio" name="arus_pada_tiang" id="arus_pada_tiang_yes"
                                                    class="form-check" value="yes" disabled
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
