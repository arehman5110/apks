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
        /* .sidebar-mini.sidebar-collapse .content-wrapper,
        .sidebar-mini.sidebar-collapse .main-footer,
        .sidebar-mini.sidebar-collapse .main-header {
            margin-left: 0rem !important;
        }

        .sidebar-mini.sidebar-collapse .main-sidebar,
        .sidebar-mini.sidebar-collapse .main-sidebar::before {
            margin-left: 0;
            width: 0rem !important;
        } */
        .leaflet-control-attribution.leaflet-control {
    display: none;
}

        input {
            min-width: 16px !important;
        }

        div#lightbox {
            display: none;
        }


        .side-bar::-webkit-scrollbar,
        .lb-outerContainer {
            display: none;
        }
    </style>
