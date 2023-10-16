@extends('layouts.app', ['page_title' => 'Index'])

@section('css')
    @include('partials.map-css')
    <style>
        #map {
            height: 600px;
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

    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Tiang + Talian VT & VR</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid bg-white pt-2">


        <div class=" p-1 col-12 m-2">
            <div class="card p-0 mb-3">
                <div class="card-body row">

                    <div class="col-md-3">
                        <label for="search_zone">Zone</label>
                        <select name="search_zone" id="search_zone" class="form-control">

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
                        <label for="search_ba">Ba</label>
                        <select name="search_ba" id="search_ba" class="form-control" onchange="getWorkPackage(this)">
                            <option value="">Select zone</option>
                        </select>
                    </div>





                </div>
            </div>
        </div>




        <!--  START MAP CARD DIV -->
        <div class="row m-2">

            <!-- START MAP SIDEBAR DIV -->
            {{-- <div class="col-2 p-0">
            <div class="card p-0 m-0"
                style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important">
                <div class="card-header"><strong> NAVIGATION</strong></div>
                <div class="card-body">
                    <!-- MAP SIDEBAR LAYERS SELECTOR -->
                    <div class="side-bar" style="height: 569px !important; overflow-y: scroll;">
                      


                        <details class="mb-3" open>
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


                        <!-- END MAP SIDEBAR DETAILS -->
                    </div>
                </div>
            </div>
        </div> --}}
            <!-- END MAP SIDEBAR DIV -->

            <!-- START MAP  DIV -->
            <div class="col-12 p-0 ">
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

    </div>
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
    @include('partials.map-js')


    <script>
        var tbl_savr = '';

        var main = '';
        main = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
            layers: 'cite:tbl_savr',
            format: 'image/png',
            maxZoom: 21,
            transparent: true
        }, {
            buffer: 10
        })

        map.addLayer(main)
        main.bringToFront()


        groupedOverlays = {
            "POI": {
                'BA': boundary3,
                'Tiang Talian': main,
            }
        };

        var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: true,
            position: 'topright'
            // groupCheckboxes: true
        }).addTo(map);

        function addRemoveBundary(param, paramY, paramX) {
            if (boundary3 != '') {
                map.removeLayer(boundary3)
            }
            if (main != '') {
                map.removeLayer(main)
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
            if (tbl_savr != '') {

                map.removeLayer(tbl_savr)

            }

            tbl_savr = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_savr',
                format: 'image/png',
                cql_filter: "ba='" + param + "'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(tbl_savr)
            tbl_savr.bringToFront()

            sel_lyr = tbl_savr;


        }


        function showModalData(data, id) {
            var str = '';

            $('#exampleModalLabel').html("Substation Info")
            str = ` <tr>
        <tr><th>Ba</th><td>${data.ba}</td> </tr>
        <tr><th>Section From</th><td>${data.section_from}</td> </tr>
        <tr><th>Section To</th><td>${data.section_to}</td> </tr>
        <th>Actual Date</th><td>${data.actual_date}</td> </tr>
        <th>Planed Date</th><td>${data.planed_date}</td> </tr>
   
        <tr><th>Coordinate</th><td>${data.coordinate}</td> </tr>
        <tr><th>Created At</th><td>${data.created_at}</td> </tr>
        <tr><th>Detail</th><td class="text-center">    <a href="/{{app()->getLocale()}}/tiang-talian-vt-and-vr/${data.id}" target="_blank" class="btn btn-sm btn-secondary">Detail</a>
            </td> </tr>
        `
            $("#my_data").html(str);
            $('#myModal').modal('show');

        }
    </script>
@endsection
