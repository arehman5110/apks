@extends('layouts.app', ['page_title' => 'Index'])

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
        #map {
            height: 400px;
            z-index: 1;
        }
</style>
@section('css')
@endsection



@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>APKS</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="/get-all-work-packages">index</a></li>
                        <li class="breadcrumb-item active">detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Work Package Detail
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4"><label for=""> Name</label></div>
                                <div class="col-md-4"><input disabled class="form-control" value="{{$rec->package_name}}"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="">Zone</label></div>
                                <div class="col-md-4"><input disabled class="form-control" value="{{$rec->zone}}"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="">Ba</label></div>
                                <div class="col-md-4"><input disabled class="form-control" value="{{$rec->ba}}"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="">Created At</label></div>
                                <div class="col-md-4"><input disabled class="form-control" value="{{$rec->created_at}}"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"><label for="">No of Roads</label></div>
                                <div class="col-md-4"><input disabled class="form-control" value="{{$rec->diging_count}}"></div>
                            </div>


                            <h4 class="text-center mt-3">Road Details</h4>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
@endsection



@section('script')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

<script type="text/javascript">
 var baseLayers
        var identifyme = '';
        map = L.map('map').setView([{{$wp->y}}, {{$wp->x}}], 14);

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

        wp = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_workpackage',
                format: 'image/png',
                cql_filter: "package_name='{{$rec->package_name}}'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            wp.addTo(map)

//             var bounds = L.latLngBounds(L.latLng(minLat, minLng), L.latLng(maxLat, maxLng));

// map.fitBounds(bounds);


</script>

@endsection
