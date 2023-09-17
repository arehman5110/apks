@extends('layouts.app', ['page_title' => 'Index'])

@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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
    {{-- <link href="{{ asset('assets/libs/ladda/ladda.min.css') }}" rel="stylesheet" type="text/css" /> --}}

    <style>
        .content-wrapper,
        .main-header {
            margin-left: 0px !important
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
    </style>
@endsection
@section('content')
    <h5 class="m-1">PEMERIKSAAN KEJANGGALAN PEPASANGAN TNB &
        SENGGARAAN BUKAN ELEKTRIK TALIAN ATAS DI SELANGOR UNTUK DISTRIBUTION NETWORK
        DIVISION, TNB</h5>

    <div class="row text-center m-2">

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

        </div>
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

        </div>
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

        </div>
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
        </div>



    </div>



    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Site Data Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <table class="table table-bordered">
                        <tbody id="my_data"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-2 p-0">
            <div class="card p-0 m-0"
                style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important">
                <div class="card-header"><strong> NAVIGATION</strong></div>
                <div class="card-body">
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

                            </select>
                        </div>
                        <details class="mb-3">
                            <summary><strong>Patrolling 3rd Party Digging Activities</strong> </summary>
                            <ul>
                                <li> <input type="checkbox" name="" id="petroling_a" onclick="addpanolayer()">
                                    <label for="petroling_a">Pemeriksaan di Jalan</label>
                                </li>
                                <li><input type="checkbox" name="" id="petroling_b"> <label
                                        for="petroling_b">Mengeluarkan notis</label> </li>
                                <li><input type="checkbox" name="" id="petroling_c"> <label
                                        for="petroling_c">Menyelia kerja-kerja korekan</label> </li>
                                <li><input type="checkbox" name="" id="petroling_d"> <label
                                        for="petroling_d">Report</label> </li>
                            </ul>
                        </details>

                        <details class="mb-3">
                            <summary><strong>Pencawang</strong> </summary>
                            <ul>
                                <li> <input type="checkbox" name="" id="pencawang_a"> <label
                                        for="pencawang_a">Pemeriksaan visual dan pelaporan </label> </li>
                                <li><input type="checkbox" name="" id="pencawang_b"> <label
                                        for="pencawang_b">Pembersihan iklan haram/banner </label> </li>

                                <li><input type="checkbox" name="" id="pencawang_c"> <label
                                        for="pencawang_c">Report</label> </li>
                            </ul>
                        </details>


                        <details class="mb-3">
                            <summary><strong>Feeder Pillar</strong> </summary>
                            <ul>
                                <li> <input type="checkbox" name="" id="feeder_a"> <label
                                        for="feeder_a">Pemeriksaan visual</label> </li>
                                <li><input type="checkbox" name="" id="feeder_b"> <label
                                        for="feeder_b">Pembersihan iklan haram/banner</label> </li>

                                <li><input type="checkbox" name="" id="feeder_c"> <label
                                        for="feeder_c">Report</label> </li>
                            </ul>
                        </details>

                        <details class="mb-3">
                            <summary><strong> Tiang + Talian VT & VR</strong> </summary>
                            <ul>
                                <li> <input type="checkbox" name="" id="tiang_a"> <label
                                        for="tiang_a">Pendaftaran aset, pemeriksaan visual </label> </li>
                                <li><input type="checkbox" name="" id="tiang_b"> <label
                                        for="tiang_b">Pembersihan iklan haram/banner</label> </li>
                                <li><input type="checkbox" name="" id="tiang_c"> <label
                                        for="tiang_c">Pembersihan creepers</label> </li>
                                <li><input type="checkbox" name="" id="tiang_d"> <label
                                        for="tiang_d">Pemeriksaan kebocoran arus pada tiang</label></li>
                                <li><input type="checkbox" name="" id="tiang_e"> <label
                                        for="tiang_e">Report</label> </li>
                            </ul>
                        </details>


                        <details class="mb-3">
                            <summary><strong> Link Box Pelbagai Voltan</strong> </summary>
                            <ul>
                                <li> <input type="checkbox" name="" id="tiang_a"> <label for="tiang_a">
                                        Pemeriksaan visual</label> </li>
                                <li><input type="checkbox" name="" id="tiang_b"> <label for="tiang_b">
                                        Pembersihan iklan haram/banner</label> </li>
                                <li><input type="checkbox" name="" id="tiang_c"> <label
                                        for="tiang_c">Pembersihan semak samun / creepers/sampah/ rumput</label> </li>
                                <li><input type="checkbox" name="" id="tiang_d"> <label
                                        for="tiang_d">Report</label> </li>
                            </ul>
                        </details>


                        <details class="mb-3">
                            <summary><strong> Cable bridge</strong> </summary>
                            <ul>
                                <li> <input type="checkbox" name="" id="cable_a"> <label for="cable_a">
                                        Pemeriksaan visual</label> </li>
                                <li><input type="checkbox" name="" id="cable_b"> <label for="cable_b">
                                        Pembersihan semak samun / creepers/sampah/ rumput</label> </li>
                                <li><input type="checkbox" name="" id="cable_c"> <label
                                        for="cable_c">Report</label> </li>
                            </ul>
                        </details>
                        <input type="text" name="" id="cabel_length">


                        <!-- <div id="my_data"></div> -->
                    </div>
                </div>
            </div>
        </div>
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
        <div id="wg" class="windowGroup">

        </div>

        <div id="wg1" class="windowGroup">

        </div>
    </div>


    <div class="modal fade" id="geomModal" tabindex="-1" aria-labelledby="geomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new W.P</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/save-work-package" method="post">
                    @csrf
                <div class="modal-body ">
                   

                    <label for="">P.W</label>
                    <input type="text" name="name" id="pw-name" class="form-control">
                    <label for="zone">Zone</label>
                    <select name="zone" id="zone" class="form-control">
                        <option value="" hidden>select zone</option>
                        <option value="W1">W1</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B4">B4</option>
                    </select>
       
                    <label for="ba">Select ba</label>
                    <select name="ba" id="ba" class="form-control">
                        <option value="" hidden>Select zone</option>
                    </select>

                    <input type="hidden" name="geom" id="geom">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="polyLineModal" tabindex="-1" aria-labelledby="polyLineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Identify Roads</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/save-road" method="post">
                    @csrf
                <div class="modal-body ">
                    <label for="">Select P.W</label>
                    <select name="id_wp" id="raod-wp-id" class="form-control">
                        <option value="">select wp</option>
                        @foreach ($wps as $wp)
                            <option value="{{$wp->id}}">{{$wp->package_name}}</option>
                        @endforeach
                    </select>
                    <label for="polyline-zone">Zone</label>
                    <input disabled  id="polyline-zone" class="form-control">
                    <label for="polyline-ba">BA</label>
                    <input disabled id="polyline-ba" class="form-control">
                 
                    <label for="ba">Road name</label>
                    <input name="road_name" id="road_name" class="form-control">
                      

                    <input type="hidden" name="geom" id="road-geom">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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

        baseLayers = {
            "Satellite": st1,
            "Street": street
        };

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

        map.on('draw:created', function(e) {
            var type = e.layerType;
            layer = e.layer;
            drawnItems.addLayer(layer);
            // console.log(type);
            var data = layer.toGeoJSON();
            //  console.log(JSON.stringify(data.geometry));


            if (e.layerType == 'polyline') {
                var coords = layer.getLatLngs();
                var length = 0;
                for (var i = 0; i < coords.length - 1; i++) {
                    length += coords[i].distanceTo(coords[i + 1]);
                }
                mapLenght = parseInt(length)
                $("#cabel_length").val(mapLenght)
                $('#polyLineModal').modal('show');
                $('#road-geom').val(JSON.stringify(data.geometry));
                
            } else {

             
                $('#geomModal').modal('show');
                $('#geom').val(JSON.stringify(data.geometry));
            }

            console.log(JSON.stringify(data.geometry))

        })


        map.on('draw:edited', function(e) {
            var layers = e.layers;
            layers.eachLayer(function(data) {
                let layer_d = data.toGeoJSON();
                let layer = JSON.stringify(layer_d.geometry);
                // console.log(layer);

                $('#geomID').val(layer);

            });
        });


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


        groupedOverlays = {
            "POI": {
                "boundary_bangi_east": boundary,
                "lv fuse": lf,
                "lvdb_fp": lvdb,
                "lv_ug_conductor": ugc,
                "street_light": street_light,
                "pole": pole

            }
        };

        var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: true,
            position: 'topright'
            // groupCheckboxes: true
        }).addTo(map);
        //  var lc = document.getElementsByClassName('leaflet-control-layers')
        //  lc[0].style.display = "none";


        var bangi_status = false;
        var addTOmap = false;
        var boundary2 = '';

        boundary3 = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:aero_apks',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        })
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
                        url: 'services/proxy.php?url=' + encodeURIComponent(url),
                        dataType: 'JSON',
                        //data: data,
                        method: 'GET',
                        async: false,
                        success: function callback(data) {

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
                $.ajax({
                    url: 'services/proxy.php?url=' + encodeURIComponent(url),
                    dataType: 'JSON',
                    //data: data,
                    method: 'GET',
                    async: false,
                    success: function callback(data) {
                        console.log(data)
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
                layers: 'cite:aero_apks',
                format: 'image/png',
                cql_filter: "station='" + param + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(boundary2)

            map.setView([parseFloat(paramY), parseFloat(paramX)], 11);





        }
    </script>


    <script>
        $(document).ready(function() {
            $('#zone').on('change', function() {
                const selectedValue = this.value;
                const areaSelect = $('#ba');

                // Clear previous options
                areaSelect.empty();
                areaSelect.append(`<option value="" hidden>Select ba</option>`)

                if (selectedValue === 'W1') {
                    const w1Options = ['KL PUSAT'];

                    w1Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data}</option>`);
                    });
                } else if (selectedValue === 'B1') {
                    const b1Options = ['PJ', 'RWANG', 'K.SELANGOR'];

                    b1Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data}</option>`);
                    });
                } else if (selectedValue === 'B2') {
                    const b2Options = ['KLANG', 'PORT KLANG'];

                    b2Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data}</option>`);
                    });
                } else if (selectedValue === 'B4') {
                    const b4Options = ['CHERAS', 'BANTING/SEPANG', 'BANGI', 'PUTRAJAYA/CYBERJAYA/PUCHONG'];

                    b4Options.forEach((data) => {
                        areaSelect.append(`<option value="${data}">${data}</option>`);
                    });
                }
            });

        })
    </script>
@endsection
