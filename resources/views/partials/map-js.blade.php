<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="{{ URL::asset('map/draw/leaflet.draw.css') }}" />

<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

<script src="{{ URL::asset('map/draw/leaflet.draw-custom.js') }}"></script>

<script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js') }}"></script>

<script type="text/javascript">
    var baseLayers = '';
    var identifyme = '';
    var boundary3 = '';
    var boundary2 = '';
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

    map.addLayer(boundary3)
        map.setView([2.59340882301331, 101.07054901123], 8);

    var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
        collapsed: true,
        position: 'topright'
        // groupCheckboxes: true
    }).addTo(map);

   




</script>



<script>


$(document).ready(function() {
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
                        ['RAWANG', 'RAWANG', 3.47839445121726, 101.622905486475],
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
        });
        function getWorkPackage(param) {
            var splitVal = param.value.split(',');

            addRemoveBundary(splitVal[1], splitVal[2], splitVal[3])
            var zone = $('#search_zone').val();

        }

</script>

