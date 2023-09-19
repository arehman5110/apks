@extends('layouts.app', ['page_title' => 'Index'])

@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script>
        var $jq = $.noConflict(true);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="{{ URL::asset('assets/lib/images_slider/css-view/lightbox.css') }}">
    <script src="{{ URL::asset('assets/lib/images_slider/js-view/lightbox-2.6.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/lib/window-engine.css') }}" />
    <script src="{{ URL::asset('assets/lib/window-engine.js') }}"></script>


    <style>
        .sidebar-mini.sidebar-collapse .content-wrapper,
        .sidebar-mini.sidebar-collapse .main-footer,
        .sidebar-mini.sidebar-collapse .main-header {
            margin-left: 0rem !important;
        }

        .sidebar-mini.sidebar-collapse .main-sidebar,
        .sidebar-mini.sidebar-collapse .main-sidebar::before {
            margin-left: 0;
            width: 0rem !important;
        }

        .card-header {
            font-weight: 700;
        }

        #map {
            height: 600px;
            z-index: 1;
        }

        li {
            list-style-type: none;
            margin-bottom: 0.5rem;

        }

        ul {
            padding-left: 0.5rem;
        }

        .side-bar::-webkit-scrollbar,
        .lb-outerContainer {
            display: none;
        }

        #panorama {
            width: 400px;
            height: 400px;
        }

        input {
            min-width: 16px !important;
        }

        div#lightbox {
            display: none;
        }

        .side-bar>.table td {
            padding: 0.5rem !important
        }
    </style>
@endsection
@section('content')
    @if (Session::has('failed'))
        <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
            {{ Session::get('failed') }}

            <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
    <h5 class="m-1">PEMERIKSAAN KEJANGGALAN PEPASANGAN TNB &
        SENGGARAAN BUKAN ELEKTRIK TALIAN ATAS DI SELANGOR UNTUK DISTRIBUTION NETWORK
        DIVISION, TNB</h5>



    <!--  START TOP TABS -->

    {{-- <div class="row text-center m-2">

        <!--  START TAB W1 -->

        <div class="col-md-4 p-1">

            <div class="card p-0 mb-3" style="height: 90%;">
                <div class="card-header ">W1</div>
                <div class="card-body row">
                    <div class="col-md-12 "
                        onclick="addRemoveBundary('KUALA LUMPUR PUSAT' , 3.14925905877391 , 101.754098819705)"
                        style="cursor: pointer;">

                        <div class="  p-1" style="background-color:  skyblue !important;color:white">
                            <p style="font-weight: 600;">KL PUSAT</p>

                        </div>

                    </div>
                </div>
            </div>

        </div> <!--  END TAB w1 -->


        <!--  START TAB B1 -->

        <div class="col-md-4 p-1">
            <div class="card p-0 mb-3 ">
                <div class="card-header ">B1</div>
                <div class="card-body row">



                    <div class="col-md-4 " onclick="addRemoveBundary('PETALING JAYA', 3.1128074178475 , 101.605270457169)"
                        style="cursor: pointer;">

                        <div class="  p-1" style="background-color:  purple !important;color:white">
                            <p style="font-weight: 600;">PJ</p>

                        </div>

                    </div>

                    <div class="col-md-4 " onclick="addRemoveBundary('RAWANG' , 3.47839445121726, 101.622905486475)"
                        style="cursor: pointer;">

                        <div class=" mx-1   p-1" style="background-color:  purple !important;color:white">
                            <p style="font-weight: 600;">RAWANG</p>

                        </div>

                    </div>
                    <div class="col-md-4 " onclick="addRemoveBundary('KUALA SELANGOR' , 3.40703209426401, 101.317426926947)"
                        style="cursor: pointer;">

                        <div class="ml-0  p-1" style="background-color:  purple !important; color:white;">
                            <p style="font-weight: 600;">K.SELANGOR </p>

                        </div>

                    </div>
                </div>
            </div>

        </div> <!--  END TAB B1 -->


        <!--  START TAB B2 -->
        <div class="col-md-4 p-1">
            <div class="card p-0 mb-3 ">
                <div class="card-header ">B2</div>
                <div class="card-body row">



                    <div class="col-md-6 " onclick="addRemoveBundary('KLANG' , 3.08428642705789, 101.436185279023)"
                        style="cursor: pointer;color:white">

                        <div class=" p-1" style="background-color:  red !important;">
                            <p style="font-weight: 600;">KLANG</p>

                        </div>

                    </div>

                    <div class="col-md-6 "
                        onclick="addRemoveBundary('PELABUHAN KLANG' , 2.98188527916042, 101.324234779569)"
                        style="cursor: pointer;color:white">

                        <div class=" mx-1   p-1" style="background-color:  red !important;">
                            <p style="font-weight: 600;">PORT KLANG</p>

                        </div>

                    </div>

                </div>
            </div>

        </div> <!--  END TAB B2 -->


        <!-- START TAB B4 -->
        <div class=" p-1 col-12">
            <div class="card p-0 mb-3">
                <div class="card-header ">B4</div>
                <div class="card-body row">



                    <div class="col-md-3 " onclick="addRemoveBundary('CHERAS' , 3.14197346621987, 101.849883983416)"
                        style="cursor: pointer;color:white">

                        <div class=" p-1" style="background-color:  green !important; height: 100%;">
                            <p style="font-weight: 600;">CHERAS</p>

                        </div>

                    </div>

                    <div class="col-md-3 " onclick="addRemoveBundary('BANTING' , 2.82111390453244 , 101.505890775541)"
                        style="cursor: pointer;">

                        <div class=" mx-1   p-1 text-capitalize"
                            style="background-color:  green !important;color:white ; height: 100%;">
                            <p style="font-weight: 600;">BANTING/SEPANG</p>

                        </div>

                    </div>

                    <div class="col-md-3 " onclick="bangi()" style="cursor: pointer;">

                        <div class=" mx-1  p-1 text-capitalize"
                            style="background-color:  green !important;color:white;  height: 100%;">
                            <p style="font-weight: 600;">BANGI</p>

                        </div>

                    </div>

                    <div class="col-md-3 "
                        onclick="addRemoveBundary('PUTRAJAYA & CYBERJAYA' , 2.92875032271019 , 101.675338316575)"
                        style="cursor: pointer;">

                        <div class=" mx-1   p-1 t" style="background-color:  green !important;color:white">
                            <p style="font-weight: 600;">PUTRAJAYA/CYBERJAYA/PUCHONG</p>

                        </div>

                    </div>

                </div>
            </div>
        </div> <!--  END TAB B4 -->

    </div> <!--  END TOP TABS  --> --}}

    <div class=" p-1 col-12 m-2">
        <div class="card p-0 mb-3">
            <div class="card-body row">

                <div class="col-md-3">
                    <label for="search_zone">Zone</label>
                    <select name="search_zone" id="search_zone" class="form-control">

                        <option value="" hidden>select zone</option>
                        <option value="W1">W1</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B4">B4</option>

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="search_ba">Ba</label>
                    <select name="search_ba" id="search_ba" class="form-control" onchange="getWorkPackage(this)">
                        <option value="">Select zone</option>
                    </select>
                </div>



                <div class="col-md-3">
                    <label for="search_wp">Work Package</label>
                    <select name="search_wp" id="search_wp" class="form-control"></select>
                </div>
                <div class="col-md-2 p-2 text-center pt-4" id="for-excel">
                </div>



            </div>
        </div>
    </div>


    <!-- MAP DASHBOARD -->


    <div class=" p-1 col-12 m-2">
        <div class="card p-0 mb-3">
            <div class="card-body row">

                <div class="col-md-4 text-center" style="cursor: pointer;">

                    <div class=" mx-1   p-1 t" style="background-color:  #92C400 !important;color:white">
                        <p style="font-weight: 600;">Total Km</p>
                        <span id="total"></span>

                    </div>

                </div>

                <div class="col-md-4 text-center" style="cursor: pointer;">

                    <div class=" mx-1   p-1 t" style="background-color:  #92C400 !important;color:white">
                        <p style="font-weight: 600;">Total Notice</p>

                    </div>

                </div>
                <div class="col-md-4 text-center" style="cursor: pointer;">

                    <div class=" mx-1   p-1 t" style="background-color:  #92C400 !important;color:white">
                        <p style="font-weight: 600;">Total Supervision</p>

                    </div>

                </div>

            </div>
        </div>


    </div>
    <!-- END MAP DASHBOARD -->



    <!--  START MAP CARD DIV -->
    <div class="row m-2">

        <!-- START MAP SIDEBAR DIV -->
        <div class="col-2 p-0">
            <div class="card p-0 m-0"
                style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important">
                <div class="card-header"><strong> NAVIGATION</strong></div>
                <div class="card-body">
                    <!-- MAP SIDEBAR LAYERS SELECTOR -->
                    <div class="side-bar" style="height: 569px !important; overflow-y: scroll;">
                        <div class="col-md-12 mb-2" class="form-group">
                            <label>Select Info Layer :</label>
                            <select class="form-select" id="tableLayer" onchange="activeSelectedLayerOther(this.value)">
                                <option value="" hidden>Select Layer</option>
                                <option value="lv_fuse">lv_fuse</option>
                                <option value="lv_ug_conductor">lv_ug_conductor</option>
                                <option value="lvdb_fp">lvdb_fp</option>
                                <option value="street_light">street_light</option>
                                <option value="pole">pole</option>
                                <option value="wp">wp</option>
                                <option value="notice">notice</option>
                                <option value="supervise">supervise</option>

                            </select>
                        </div>

                        <!-- START MAP SIDEBAR DETAILS -->
                        <details class="mb-3">
                            <summary><strong>Patrolling 3rd Party Digging Activities</strong> </summary>
                            <table class="table table-bordered" style="cursor: pointer">
                                <tr>
                                    <td onclick="addNotice(this)">Mengeluarkan notis</td>
                                </tr>
                                <tr>
                                    <td onclick="addSupervise(this)">Menyelia kerja-kerja korekan</td>
                                </tr>
                            </table>
                            {{-- <ul>
                               <li> <input type="checkbox" name="" id="petroling_a" onclick="addpanolayer()">
                                    <label for="petroling_a">Pemeriksaan di Jalan</label>
                                </li> 
                                <li><input type="checkbox" name="" id="petroling_b"> <label
                                        for="petroling_b" onclick="addNotice()">Mengeluarkan notis</label> </li>
                                <li><input type="checkbox" name="" id="petroling_c"> <label
                                        for="petroling_c" onclick="addSupervise()">Menyelia kerja-kerja korekan</label> </li>
                                <li><input type="checkbox" name="" id="petroling_d"> <label
                                        for="petroling_d">Report</label> </li>
                            </ul> --}}
                        </details>

                        <details class="mb-3">
                            <summary><strong>Pencawang</strong> </summary>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Pemeriksaan visual dan pelaporan</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan iklan haram/banner </td>
                                </tr>
                                <tr>
                                    <td>Report</td>
                                </tr>
                            </table>

                        </details>


                        <details class="mb-3">
                            <summary><strong>Feeder Pillar</strong> </summary>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Pemeriksaan visual</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan iklan haram/banner</td>
                                </tr>
                                <tr>
                                    <td>Report</td>
                                </tr>
                            </table>

                        </details>

                        <details class="mb-3">
                            <summary><strong> Tiang + Talian VT & VR</strong> </summary>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Pendaftaran aset, pemeriksaan visual</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan iklan haram/banner</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan creepers</td>
                                </tr>
                                <tr>
                                    <td>Pemeriksaan kebocoran arus pada tiang</td>
                                </tr>
                                <tr>
                                    <td>Report</td>
                                </tr>
                            </table>

                        </details>


                        <details class="mb-3">
                            <summary><strong> Link Box Pelbagai Voltan</strong> </summary>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Pemeriksaan visual</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan iklan haram/banner</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan semak samun / creepers/sampah/ rumput</td>
                                </tr>
                                <table>
                                    <td>Report</td>
                                </table>
                            </table>

                        </details>


                        <details class="mb-3">
                            <summary><strong> Cable bridge</strong> </summary>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Pemeriksaan visual</td>
                                </tr>
                                <tr>
                                    <td>Pembersihan semak samun / creepers/sampah/ rumput</td>
                                </tr>
                                <tr>
                                    <td>Report</td>
                                </tr>
                            </table>

                        </details>
                        <!-- END MAP SIDEBAR DETAILS -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAP SIDEBAR DIV -->

        <!-- START MAP  DIV -->
        <div class="col-10 p-0 ">
            <div class="card p-0 m-0"
                style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important;">
                <div class="card-header text-center"><strong> MAP</strong></div>
                <div class="card-body p-0">
                    <div id="map">

                    </div>
                </div>
            </div>

        </div>
        <!-- END MAP  DIV -->
        <div id="wg" class="windowGroup">

        </div>

        <div id="wg1" class="windowGroup">

        </div>

    </div><!--  END MAP CARD DIV -->


    <div class="modal fade" id="geomModal" tabindex="-1" aria-labelledby="geomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new W.P</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/save-work-package" method="post" id="save_wp" onsubmit="return submitFoam()">
                    @csrf
                    <div class="modal-body ">


                        <label for="">Work Package Name</label>
                        <span class="text-danger" id="er-pw-name"></span> <br>
                        <input type="text" name="name" id="pw-name" class="form-control">
                        <label for="zone">Zone</label>

                        <input type="text" name="zone" id="pw-zone" class="form-control">
                        {{-- <select name="zone" id="pw-zone" class="form-control">
                        <option value="" hidden>select zone</option>
                        <option value="W1">W1</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B4">B4</option>
                    </select> --}}

                        <label for="ba">Select ba</label>
                        <input type="text" name="ba" id="pw-ba" class="form-control">
                        {{-- <select name="ba" id="pw-ba" class="form-control">
                        <option value="" hidden>Select zone</option>
                    </select> --}}

                        <input type="hidden" name="geom" id="geom">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Site Data Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <table class="table table-bordered">
                        <tbody id="my_data"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="polyLineModal" tabindex="-1" aria-labelledby="polyLineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Identify Roads</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/save-road" method="post" id="road-form" onsubmit="return submitFoam2()">
                    @csrf
                    <div class="modal-body ">
                        <label for="ba">Road Name</label>
                        <span class="text-center" id="er_raod_name"></span>
                        <input name="road_name" id="road_name" class="form-control">
                        <label for="">Work Package Name</label>
                        <input type="text" name="" id="raod-d-wp-id" class="form-control disabled">
                        <input type="hidden" name="id_wp" id="raod-wp-id">
                        {{-- <select name="id_wp" id="raod-wp-id" class="form-control" onchange="getWorkPackage(this)">
                        <option value="">select wp</option>
                        @foreach ($wps as $wp)
                            <option value="{{$wp->id}}">{{$wp->package_name}}</option>
                        @endforeach
                    </select> --}}
                        <label for="polyline-zone">Zone</label>
                        <input id="polyline-zone" name="zone" class="form-control">
                        <label for="polyline-ba">BA</label>
                        <input id="polyline-ba" name="ba" class="form-control">




                        <input type="hidden" name="geom" id="road-geom">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ URL::asset('map/draw/leaflet.draw.css') }}" />

    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

    <script src="{{ URL::asset('map/draw/leaflet.draw-custom.js') }}"></script>

    <script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js') }}"></script>

    <script type="text/javascript">
        var baseLayers
        var identifyme = '';
        map = L.map('map').setView([3.016603, 101.858382], 5);

        var st1 = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);
        var street = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

        // ADD MAPS
        baseLayers = {
            "Satellite": st1,
            "Street": street
        };


        // ADD DRAW TOOLS

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        var drawControl = new L.Control.Draw({
            draw: {
                circle: false,
                marker: true,
                polygon: true,
                polyline: {
                    shapeOptions: {
                        color: '#f357a1',
                        weight: 10
                    }
                },
                rectangle: true
            },
            edit: {
                featureGroup: drawnItems
            }
        });

        map.addControl(drawControl);

        // END DRAW TOOLS


        // DRAW TOOL ON CREATED EVENT
        map.on('draw:created', function(e) {
            var type = e.layerType;
            layer = e.layer;
            drawnItems.addLayer(layer);
            var data = layer.toGeoJSON();

            if (e.layerType == 'polyline') {
                var coords = layer.getLatLngs();
                var length = 0;
                for (var i = 0; i < coords.length - 1; i++) {
                    length += coords[i].distanceTo(coords[i + 1]);
                }
                mapLenght = parseInt(length)

                $('#polyLineModal').modal('show');
                $('#road-geom').val(JSON.stringify(data.geometry));
                getRoadInfo(JSON.stringify(data.geometry));

            } else {

                getBaInfo(JSON.stringify(data.geometry));


                $('#geomModal').modal('show');
                $('#geom').val(JSON.stringify(data.geometry));
            }

        })
        // END DRAW TOOL ON CREATED EVENT


        // DRAW TOOL ON EDIT EVENT
        map.on('draw:edited', function(e) {
            var layers = e.layers;
            layers.eachLayer(function(data) {
                let layer_d = data.toGeoJSON();
                let layer = JSON.stringify(layer_d.geometry);
                // console.log(layer);

                $('#geomID').val(layer);

            });
        });
        // END DRAW TOOL ON EDIT EVENT

        map.on('draw:deleted', function(e) {
            var layers = e.layers;
            layers.eachLayer(function(layer) {
                $('#geomID').val('');
            });
            for (let index = 0; index < 11; index++) {
                if (index <= 9) {
                    $(`#0${index}_check`).prop('checked', false);
                } else {
                    $(`#${index}_check`).prop('checked', false);
                }

            }
        });


        // ADD LAYERS
        customer = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:pano_layer',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });


        boundary = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:boundary_bangi_east',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });

        ugc = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:lv_ug_conductor',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });


        lvdb = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:lvdb_fp',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });


        manhole = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:manhole',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });
        manhole;

        street_light = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:street_light',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });

        pole = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:pole',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });


        lf = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:lv_fuse',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        });

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
                "boundary_bangi_east": boundary,
                "lv fuse": lf,
                "lvdb_fp": lvdb,
                "lv_ug_conductor": ugc,
                "street_light": street_light,
                "pole": pole
                //  "workpackage":wp

            }
        };

        var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: true,
            position: 'topright'
            // groupCheckboxes: true
        }).addTo(map);


        var bangi_status = false;
        var addTOmap = false;
        var boundary2 = '';
        var wp = '';
        var rd = '';


        map.addLayer(boundary3)
        map.setView([2.59340882301331, 101.07054901123], 8);




        function addpanolayer() {
            var checkbox = document.getElementById("petroling_a");

            if (checkbox.checked == false) {
                map.off('click');
                map.removeLayer(customer)
                map.removeLayer(identifyme)
            } else {
                map.addLayer(customer)
                map.on('click', function(e) {
                    //map.off('click');
                    $("#wg").html('');
                    // Build the URL for a GetFeatureInfo
                    var url = getFeatureInfoUrl(
                        map,
                        customer,
                        e.latlng, {
                            'info_format': 'application/json',
                            'propertyName': 'NAME,AREA_CODE,DESCRIPTIO'
                        }
                    );
                    $.ajax({
                        url: '/proxy/' + encodeURIComponent(url),
                        dataType: 'JSON',
                        //data: data,
                        method: 'GET',
                        async: false,
                        success: function callback(data) {
                            console.log(data);
                            //  alert(data
                            var str = '<div id="window1" class="window">' +
                                '<div class="green">' +
                                '<p class="windowTitle">Pano Images</p>' +
                                '</div>' +
                                '<div class="mainWindow">' +
                                // '<canvas id="canvas" width="400" height="480">' +
                                // '</canvas>' +
                                '<div id="panorama" width="400px" height="480px"></div>' +
                                // '<div class="row"><button style="margin-left: 30%;" onclick=preNext("pre") class="btn btn-success">Previous</button><button  onclick=preNext("next")  style="float: right;margin-right: 35%;" class="btn btn-success">Next</button></div>'

                                '</div>' +
                                '</div>'

                            $("#wg").html(str);


                            console.log(data)
                            if (data.features.length != 0) {
                                createWindow(1);
                                selectedId = data.features[0].id.split('.')[1];
                                // var canvas = document.getElementById('canvas');
                                // var context = canvas.getContext('2d');
                                // context.clearRect(0,0 ,canvas.width,canvas.height)
                                //     img.src = data.features[0].properties.image_path;
                                //     init_pano('canvas')
                                // setTimeout(function () {
                                //     init_pano('canvas')
                                // },1000)
                                pannellum.viewer('panorama', {
                                    "type": "equirectangular",
                                    "panorama": "http://121.121.232.54:88/" + data.features[0]
                                        .properties.photo,
                                    "compass": true,
                                    "autoLoad": true
                                });

                                if (identifyme != '') {
                                    map.removeLayer(identifyme)
                                }
                                identifyme = L.geoJSON(data.features[0].geometry).addTo(map);

                            }

                        }
                    });




                });
            }
        }


        function bangi() {
            map.removeLayer(boundary3)
            if (boundary2 !== '') {
                map.removeLayer(boundary2)
            }
            if (bangi_status == false) {

                map.addLayer(boundary);
                map.addLayer(lf);
                map.addLayer(lvdb);
                map.addLayer(ugc);
                map.addLayer(street_light);
                map.addLayer(pole);



                map.setView([3.016603, 101.858382], 11);
                bangi_status = true
                //  lc[0].style.display = 'block';

            } else {
                map.removeLayer(boundary);
                map.removeLayer(lf);
                map.removeLayer(lvdb);
                map.removeLayer(ugc);
                map.removeLayer(street_light);
                map.removeLayer(pole);

                map.setView([3.016603, 101.858382], 5);
                bangi_status = false
                //   lc[0].style.display = 'none';
            }
        }

        function activeSelectedLayerOther(val) {


            var sel_lyr = ''

            if (val == 'lv_fuse') {
                sel_lyr = lf;
            }
            if (val == 'lv_ug_conductor') {
                sel_lyr = ugc;
            }
            if (val == 'lvdb_fp') {
                sel_lyr = lvdb;
            }
            if (val == 'pole') {
                sel_lyr = pole;
            }
            if (val == 'manhole') {
                sel_lyr = manhole;
            }
            if (val == 'street_light') {
                sel_lyr = street_light;
            }
            if (val == 'wp') {
                sel_lyr = wp;
            }
            if (val == 'rd') {
                sel_lyr = rd;
            }
            if (val == 'notice') {
                sel_lyr = notice;
            }

            if (val == 'supervise') {
                sel_lyr = supervise;
            }


            map.off('click');
            map.on('click', function(e) {
                var url = getFeatureInfoUrl(
                    map,
                    sel_lyr,
                    e.latlng, {
                        'info_format': 'application/json',
                        'propertyName': 'NAME,AREA_CODE,DESCRIPTIO'
                    }
                );
                var secondUrl = encodeURIComponent(url)
                $.ajax({
                    url: '/proxy/' + encodeURIComponent(secondUrl),
                    dataType: 'JSON',
                    //data: data,
                    method: 'GET',
                    async: false,
                    success: function callback(data1) {
                        console.log(data1)
                        data = JSON.parse(data1)
                        if (data.features.length != 0) {
                            var str = '';
                            for (key in data.features[0].properties) {
                                //console.log(key);
                                //console.log(data.features[0].properties[key]);
                                if (key == 'image_1' || key == 'image_2' || key == 'image_3' || key ==
                                    'image_4' || key == 'image_5' || key == 'image_6' || key ==
                                    'image_7' || key == 'image_8' || key == 'image_9' || key ==
                                    'image_10') {
                                    // str = str + '<tr><td>' + key + '</td><td><a href="' + data.features[
                                    //         0].properties[key] +
                                    //     '" class=\'example-image-link\' data-lightbox=\'example-set\' title=\'&lt;button class=&quot;primary &quot; onclick= rotate_img(&quot;pic1&quot)  &gt;Rotate image&lt;/button&gt;\'><img src="' +
                                    //     data.features[0].properties[key] +
                                    //     '" width="20px" height="20px"></a></td></tr>'

                                } else {
                                    str = str + '<tr><td>' + key + '</td><td>' + data.features[0]
                                        .properties[key] + '</td></tr>'
                                }


                            }
                            if ($('#tableLayer').val() == 'supervise' || $('#tableLayer').val() == 'notice') {
                                str = str + `<tr><td> Report</td><td> <a href="/generate-third-party-pdf/${data.features[0].properties.id}" target="_blank"><button class="btn btn-sm btn-success">Download</button></a></td></tr>`

                            }

                            $("#my_data").html(str);
                            $('#myModal').modal('show');
                            if (identifyme != '') {
                                map.removeLayer(identifyme)
                            }
                            var myStyle = {
                                "fillColor": "#ff7800"
                            };
                            identifyme = L.geoJSON(data.features[0].geometry, {
                                style: myStyle
                            }).addTo(map);

                        }

                    }
                });


            });
        }



        function getFeatureInfoUrl(map, layer, latlng, params) {

            var point = map.latLngToContainerPoint(latlng, map.getZoom()),
                size = map.getSize(),

                params = {
                    request: 'GetFeatureInfo',
                    service: 'WMS',
                    srs: 'EPSG:4326',
                    styles: layer.wmsParams.styles,
                    transparent: layer.wmsParams.transparent,
                    version: layer._wmsVersion,
                    format: layer.wmsParams.format,
                    bbox: map.getBounds().toBBoxString(),
                    height: size.y,
                    width: size.x,
                    layers: layer.wmsParams.layers,
                    query_layers: layer.wmsParams.layers,
                    info_format: 'application/json'
                };

            params[params.version === '1.3.0' ? 'i' : 'x'] = parseInt(point.x);
            params[params.version === '1.3.0' ? 'j' : 'y'] = parseInt(point.y);

            // return this._url + L.Util.getParamString(params, this._url, true);

            var url = layer._url + L.Util.getParamString(params, layer._url, true);
            if (typeof layer.wmsParams.proxy !== "undefined") {


                // check if proxyParamName is defined (instead, use default value)
                if (typeof layer.wmsParams.proxyParamName !== "undefined")
                    layer.wmsParams.proxyParamName = 'url';

                // build proxy (es: "proxy.php?url=" )
                _proxy = layer.wmsParams.proxy + '?' + layer.wmsParams.proxyParamName + '=';

                url = _proxy + encodeURIComponent(url);

            }

            return url.toString();

        }



        function addRemoveBundary(param, paramY, paramX) {
            map.removeLayer(boundary3)

            if (bangi_status == true) {
                bangi();
            }

            if (boundary2 !== '') {
                map.removeLayer(boundary2)
            }
            boundary2 = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:ba',
                format: 'image/png',
                cql_filter: "station='" + param + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(boundary2)
            boundary2.bringToFront()

            map.setView([parseFloat(paramY), parseFloat(paramX)], 11);

            wp = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_workpackage',
                format: 'image/png',
                cql_filter: "ba='" + param + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(wp)
            wp.bringToFront()

            rd = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_roads',
                format: 'image/png',
                cql_filter: "ba='" + param + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(rd)
            rd.bringToFront()




        }

        var notice = '';
        var supervise = '';

        function addNotice(event) {
            if (notice == '') {
                notice = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                    layers: 'cite:diging_notice',
                    format: 'image/png',
                    // cql_filter: "ba='" + param + "'",
                    maxZoom: 21,
                    transparent: true
                }, {
                    buffer: 10
                })
                map.addLayer(notice)
                notice.bringToFront()
                $(event).css('background', '#c9def2');
            } else {
                map.removeLayer(notice);
                notice = '';
                $(event).css('background', 'white');
            }

        }


        function addSupervise(event) {
            if (supervise == '') {
                supervise = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                    layers: 'cite:diging_supervise',
                    format: 'image/png',
                    // cql_filter: "ba='" + param + "'",
                    maxZoom: 21,
                    transparent: true
                }, {
                    buffer: 10
                })
                map.addLayer(supervise)
                supervise.bringToFront()
                $(event).css('background', '#c9def2');
            } else {
                map.removeLayer(supervise);
                supervise = '';
                $(event).css('background', 'white');
            }

        }


        function zoomToxy(x, y) {
            map.setView([y, x], 16)
        }
    </script>


    <script>
        const baJson = [
            // ['PUTRAJAYA & CYBERJAYA', 2.92875032271019, 101.675338316575],
            // ['BANTING', 2.82111390453244, 101.505890775541],
            // ['CHERAS', 3.14197346621987, 101.849883983416],
            // ['PELABUHAN KLANG', 2.98188527916042, 101.324234779569],
            // ['KLANG', 3.08428642705789, 101.436185279023],
            // ['KUALA SELANGOR', 3.40703209426401, 101.317426926947],
            // ['RAWANG', 3.47839445121726, 101.622905486475],
            // ['PETALING JAYA', 3.1128074178475, 101.605270457169],
            // ['KUALA LUMPUR PUSAT', 3.14925905877391, 101.754098819705]
        ]
        $(document).ready(function() {


            $jq('#save_wp').ajaxForm(function() {
                alert("Thank you for your comment!");
                $('#geomModal').modal('hide');
                map.removeLayer(drawnItems);
            });

            $jq('#road-form').ajaxForm(function() {
                alert("Thank you for your comment!");
                $('#polyLineModal').modal('hide');
                map.removeLayer(drawnItems);
            });


            $('body').addClass('sidebar-collapse');

            $('#search_zone').on('change', function() {
                const selectedValue = this.value;
                const areaSelect = $('#search_ba');

                // Clear previous options
                areaSelect.empty();
                areaSelect.append(`<option value="" hidden>Select ba</option>`)

                if (selectedValue === 'W1') {
                    const w1Options = [
                        ['KL PUSAT', 'KUALA LUMPUR PUSAT', 3.14925905877391, 101.754098819705]
                    ];

                    w1Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data[0]}</option>`);
                    });
                } else if (selectedValue === 'B1') {
                    const b1Options = [
                        ['PJ', 'PETALING JAYA', 3.1128074178475, 101.605270457169],
                        ['RWANG', 'RAWANG', 3.47839445121726, 101.622905486475],
                        ['K.SELANGOR', 'KUALA SELANGOR', 3.40703209426401, 101.317426926947]
                    ];

                    b1Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data[0]}</option>`);
                    });
                } else if (selectedValue === 'B2') {
                    const b2Options = [
                        ['KLANG', 'KLANG', 3.08428642705789, 101.436185279023],
                        ['PORT KLANG', 'PELABUHAN KLANG', 2.98188527916042, 101.324234779569]
                    ];

                    b2Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data[0]}</option>`);
                    });
                } else if (selectedValue === 'B4') {
                    const b4Options = [
                        ['CHERAS', 'CHERAS', 3.14197346621987, 101.849883983416],
                        ['BANTING/SEPANG', 'BANTING', 2.82111390453244, 101.505890775541],
                        ['BANGI', 'BANGI'],
                        ['PUTRAJAYA/CYBERJAYA/PUCHONG', 'PUTRAJAYA & CYBERJAYA', 2.92875032271019,
                            101.675338316575
                        ]
                    ];

                    b4Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data[0]}</option>`);
                    });
                }
                $('#search_wp').empty();
                $('#search_wp').append(`<option value="" hidden>Select Work Package</option>`);
                $('#for-excel').html('')
                // $('#pw-zone').val(this.value);
            });

            $('#ba').on('change', function() {
                $('#pw-ba').val(this.value)
            })


        })



        function getWorkPackage(param) {
            var splitVal = param.value.split(',');
            addRemoveBundary(splitVal[1], splitVal[2], splitVal[3])
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

                        $('#search_wp').append(
                            `<option value="${val.id} ,${val.x} ,${val.y}">${val.package_name}</option>`
                        );
                    });
                    $('#for-excel').html('')

                }
            })

        }


        $('#search_wp').on('change', function() {
            const selectedValue = this.value;
            var spiltVal = selectedValue.split(',');
            zoomToxy(parseFloat(spiltVal[1]), parseFloat(spiltVal[2]))

            $('#for-excel').html(`<a class="mt-4" href="/generate-third-party-diging-excel/${spiltVal[0]}"><button class="btn-sm mt-2
                btn btn-primary">Download Qr</button></a>`)

            $.ajax({
                url: `/getStats/${spiltVal[0]}`,
                dataType: 'JSON',
                method: 'GET',
                async: false,
                success: function callback(data) {
                    console.log(data);
                    $("#total").html(Number((data[0].distance)).toFixed(1))


                }
            })


        })





        function getBaInfo(param) {
            // console.log(param);
            $.ajax({
                url: `/get-ba-info`,
                dataType: 'JSON',
                method: 'POST',
                async: false,
                data: {
                    'geom': param
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function callback(data) {

                    $('#pw-zone').val(data[0].ppb_zone)
                    $('#pw-ba').val(data[0].station)

                },

                error: function errorCallback(xhr, status, error) {
                    console.log(error);
                },
            })
        }



        function getRoadInfo(param) {
            console.log(param);
            $.ajax({
                url: `/get-raod-info`,
                dataType: 'JSON',
                method: 'POST',
                async: false,
                data: {
                    'geom': param
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function callback(data) {
                    console.log(data);
                    $('#polyline-zone').val(data.data[0].zone)
                    $('#polyline-ba').val(data.data[0].ba)
                    $('#raod-wp-id').val(data.data[0].id)
                    $('#raod-d-wp-id').val(data.data[0].package_name)

                },

                error: function errorCallback(xhr, status, error) {
                    console.log(error);
                },
            })
        }


        function submitFoam() {
            if ($('#pw-name').val() == '') {
                $('#er-pw-name').html("This feild is required");
                return false;
            }
            $('#er-pw-name').html("");
        }

        function submitFoam2() {
            if ($('#road_name').val() == '') {
                $('#er_raod_name').html("This feild is required");
                return false;
            }
            $('#er_raod_name').html("");
        }
    </script>
@endsection
