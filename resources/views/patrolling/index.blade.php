@extends('layouts.app', ['page_title' => 'Index'])

@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>

        select.custom-select.custom-select-sm.form-control.form-control-sm {
                width: 65px !important;
                min-width: 20px !important;
            }

        .collapse {
            visibility: visible;
        }
        input {
        min-width: 16px !important;
     }


        #map {
            height: 800px;
        }

         th,
        td {
            font-size: 13px !important;
            padding: 5px !important;
        }

        th {
            font-size: 14px !important
        }
    </style>
@endsection



@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.Patrolling') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a
                                href="/{{ app()->getLocale() }}/dashboard">{{ __('messages.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.index') }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">



            @include('components.message')


            @include('components.qr-filter', ['url' => 'generate-patrolling-excel'])

            {{-- DATA TABLE --}}




            {{-- BA ZONE SEARCH FILTER --}}

                <div class="form-input card p-0 mb-3">
                    <div class="card-body row">

                        <div class="col-md-3">
                            <label for="search_zone">Zone</label>
                            <select name="search_zone" id="search_zone" class="form-control"
                                onchange="onChangeZone(this.value)">

                                @if (Auth::user()->zone == '')
                                    <option value="" hidden>select zone</option>
                                    <option value="W1">W1</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B4">B4</option>
                                @else
                                    <option value="{{ Auth::user()->zone }}" hidden>{{ Auth::user()->zone }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="search_ba">BA</label>
                            <select name="search_ba" id="search_ba" class="form-control" onchange="callLayers(this.value)">

                                <option value="{{ Auth::user()->ba }}" hidden>
                                    {{ Auth::user()->ba != '' ? Auth::user()->ba : 'Select BA' }}</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-secondary btn-sm mt-2    " type="button" onclick="removePoint()">Clear Points</button>
                        </div>


                    </div>
                </div>



            <div class="row">


            {{-- MAP --}}
            <div class="col-md-8 p-0 ">
                <div class="card p-0 m-0"
                    style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important;">
                    <div class="card-header text-center"><strong> MAP</strong></div>
                    <div class="card-body p-0">
                        <div id="map">

                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-4">
                <div class="card">

                    <div class="card-header d-flex justify-content-between ">
                        <p class="mb-0">{{ __('messages.Patrolling') }}</p>
                        <div class="d-flex ml-auto">
                            <button class="btn text-white  btn-sm mr-4" type="button" data-toggle="collapse"
                                style="background-color: #708090" data-target="#collapseQr" aria-expanded="false"
                                aria-controls="collapseQr">
                                QR Feeder Pillar
                            </button>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="text-right mb-4">

                        </div>



                        <div class="table-responsive add-substation" id="add-substation">
                            <table id="" class="table table-bordered  table-hover data-table">


                                <thead style="background-color: #E4E3E3 !important">
                                    <tr>
                                        <th class="text-center">WP NAME</th>
                                        <th class="text-center">CYCLE</th>
                                        <th class="text-center">READING START</th>
                                        <th class="text-center">READING END</th>
                                        <th class="text-center">TOATL PATROLLING (KM)</th>
                                        <th class="text-center">PATROLLING DATE</th>
                                        <th class="text-center">PATROLLING TIME</th>
                                        <th>STATUS</th>

                                        <th class="tex-center">IMAGE READING START</th>
                                        <th class="tex-center">IMAGE READING END</th>
                                        {{-- <th class="text-center">PATROLLING PATH START</th>
                                        <th class="text-center">PATROLLING PATH END</th> --}}

                                        <th class="text-center">PATROLLING PATH</th>




                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>






                    </div>
                </div>



            </div>


 </div>

        </div>
    </section>



@endsection


@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ URL::asset('map/draw/leaflet.draw.css') }}" />

    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

    <script src="{{ URL::asset('map/draw/leaflet.draw-custom.js') }}"></script>

    <script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js') }}"></script>

    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>





    <script type="text/javascript">
        var layerControl = '';
        var boundary = '';
        var zoom = 8;
        var patroling = '';


        var popup = L.popup();


        map = L.map('map').setView([2.75101756479656, 101.304931640625], 8);

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




        function addRemoveBundary(param, paramY, paramX) {

            if (boundary !== '') {
                map.removeLayer(boundary)
            }


            boundary = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:ba',
                format: 'image/png',
                cql_filter: "station ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(boundary)
            boundary.bringToFront()

            map.flyTo([parseFloat(paramY), parseFloat(paramX)], zoom, {
                duration: 1.5, // Animation duration in seconds
                easeLinearity: 0.25,
            });


            if (patroling !== '') {
                map.removeLayer(patroling)
            }


            patroling = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:patroling',
                format: 'image/png',
                cql_filter: "ba ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(patroling)
            patroling.bringToFront()


            addGroupOverLays()

        }



        function addGroupOverLays() {
            if (layerControl != '') {
                // console.log("inmsdanssdkjnasjnd");
                map.removeControl(layerControl);
            }
            // console.log("sdfsdf");
            groupedOverlays = {
                "POI": {
                    'Boundary': boundary,
                    'Patrolling': patroling,
                }
            };
            //add layer control on top right corner of map
            layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
                collapsed: true,
                position: 'topright'
                // groupCheckboxes: true
            }).addTo(map);
        }
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

        var ba = "{{ Auth::user()->ba }}";


        // on page load
        $(document).ready(function() {

            // check ba is empty or not
            if (ba == '') {
                addRemoveBundary('', 2.75101756479656, 101.304931640625)
            } else {
                callLayers(ba);
            }

        });


        // if ba is not empty
        function callLayers(param) {
            var userBa = '';
            for (const data of b1Options) {
                if (data[1] == param) {
                    userBa = data;
                    break;
                }
            }
            zoom = 11;
            addRemoveBundary(userBa[1], userBa[2], userBa[3])
        }


        function onChangeZone(param) {
            const areaSelect = $('#search_ba');

            // Clear previous options
            areaSelect.empty();
            areaSelect.append(`<option value="" hidden>Select ba</option>`)


            b1Options.map((data) => {
                if (data[0] == param) {
                    areaSelect.append(`<option value="${data[1]}">${data[1]}</option>`)
                }
            });

        }
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('patrolling-paginate', app()->getLocale()) }}",
                columns: [{
                        data: 'wp_name',
                        name: 'wp_name'
                    },
                    {
                        data: 'cycle',
                        name: 'cycle'
                    },
                    {
                        data: 'reading_start',
                        name: 'reading_start'
                    },
                    {
                        data: 'reading_end',
                        name: 'reading_end'
                    },
                    {
                        data: 'km',
                        name: 'km'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        render: function(data, type, full) {
                            if (full.image_reading_start !== '') {
                                return ` <a href="{{ URL::asset('${full.image_reading_start}') }}" data-lightbox="roadtrip">
                                    <img height="70" src="{{ URL::asset('${full.image_reading_start}') }}" ></a>`;
                            }
                            return `<td></td>`;
                        },
                        name: 'image_reading_start'
                    },
                    {
                        render: function(data, type, full) {
                            if (full.image_reading_end !== '') {
                                return ` <a href="{{ URL::asset('${full.image_reading_end}') }}" data-lightbox="roadtrip">
                                    <img height="70" src="{{ URL::asset('${full.image_reading_end}') }}" ></a>`;
                            }
                            return `<td></td>`;
                        },
                        name: 'image_reading_end'
                    },
            //         {
            //             render: function(data, type, full) {

            //                 var id = full.id;
            //                 return `<button type="button" class="btn  " onclick="showPoint(${full.start_x} , ${full.start_y})" data-toggle="dropdown" >

            //     <i class="fa fa-eye" aria-hidden="true"></i>
            // </button>

            // `;
            //             }
            //         },
            //         {
            //             render: function(data, type, full) {

            //                 var id = full.id;
            //                 return `<button type="button" class="btn  " onclick="showPoint(${full.end_x} , ${full.end_y})" data-toggle="dropdown" >

            //     <i class="fa fa-eye" aria-hidden="true"></i>
            // </button>

            // `;
            //             }
            //         },
                    {
                        render: function(data, type, full) {

                            var id = full.id;
                            return `<button type="button" class="btn  " data-toggle="dropdown">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" role="menu">


                                <button type="button" onclick="getGeoJson(${full.id})" class="dropdown-item pl-3 w-100 text-left">Full Path</button>


                                <button type="button" class="btn btn-primary dropdown-item" onclick="showPoint(${full.start_x} , ${full.start_y})"  >
                                Starting Point
                            </button>
                                <button type="button" onclick="showPoint(${full.end_x} , ${full.end_y})" class="dropdown-item pl-3 w-100 text-left">End Point</button>


                        </div>


            `;
                        }
                    }



                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(1)').addClass('text-center');
                    $(row).find('td:eq(2)').addClass('text-center');
                    $(row).find('td:eq(3)').addClass('text-center');
                    $(row).find('td:eq(4)').addClass('text-center');
                    $(row).find('td:eq(5)').addClass('text-center');
                    $(row).find('td:eq(10)').addClass('text-center');




                }
            });

            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', '/en/substation/' + id)
            });
        });

        var patrol = '';

        function getGeoJson(param) {
            $.ajax({
                url: '/{{ app()->getLocale() }}/get-patrolling-json/' + param,
                dataType: 'JSON',
                //data: data,
                method: 'GET',
                async: false,
                success: function callback(data) {
                    var data1 = JSON.parse(data[0].geojson)


                    if (patrol) {
                        map.removeLayer(patrol)
                    }

                    var geom = L.GeoJSON.coordsToLatLngs(data1.features[0].geometry.coordinates);
                    var line = L.polyline(geom);
                    map.fitBounds(line.getBounds());

                    patrol = L.geoJSON(data1.features[0].geometry);
                    map.addLayer(patrol)


                }
            })
        }

        var marker = [];
        var layer_index = 0;

        function showPoint(param_x , param_y){

            marker[layer_index] = new L.Marker([param_y, param_x]);
                    map.addLayer(marker[layer_index]);
                layer_index++;
                    map.flyTo([parseFloat(param_y), parseFloat(param_x)], 18, {
                duration: 1.5, // Animation duration in seconds
                easeLinearity: 0.25,
            });

        }

        function removePoint(){
           for(let i = 0 ; i < layer_index ; i++){
            if (marker[i] != '') {
                map.removeLayer(marker[i])
            }
           }
        }
    </script>
@endsection
