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




    // ADD LAYERS GROUPED OVER LAYS
    groupedOverlays = {
        "POI": {
        }
    };

    var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
        collapsed: true,
        position: 'topright'
        // groupCheckboxes: true
    }).addTo(map);





 
</script>

