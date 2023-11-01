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
<link rel="stylesheet" href="{{ URL::asset('assets/pannellum/pannellum.css') }}" />

<script src="{{ URL::asset('assets/pannellum/pannellum.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('assets/pannellum/lib/window-engine.css') }}" />
<script src="{{ URL::asset('assets/pannellum/lib/window-engine.js') }}"></script>

<style>
    .leaflet-control-attribution.leaflet-control {
        display: none;
    }

    input {
        min-width: 16px !important;
     }



    .side-bar::-webkit-scrollbar ,
    .lb-outerContainer ,.lb-closeContainer {
        display: none;
    }

    #panorama {
        width: 400px;
        height: 400px;
    }

    .windowGroup {
        z-index: 99999;
    }

    .form-input {
        border: 0
    }
</style>
