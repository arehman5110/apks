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
    var sel_lyr = '';
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


    // Map on click
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
                    var splitKey = '';
                    for (key in data.features[0].properties) {

                        splitKey = key.split("_");
                        str += '<tr>';


                        str +=
                            `<th class="text-capitalize">${splitKey.map(part => part.charAt(0).toUpperCase() + part.slice(1)).join(' ')}</th>`;
                        if (splitKey.includes('image') || splitKey.includes('images')) {

                            if (data.features[0].properties[key] == '') {
                                str = str + `<td>no image found</td></tr>`;
                            } else {
                                str = str +
                                    `<td><a href="${data.features[0].properties[key]}" data-lightbox="roadtrip">
                                                    <img src="${data.features[0].properties[key]}" alt=""
                                                    width="20px" height="20px" class="adjust-height ml-5  "></a></td></tr>`;
                            }
                            // str = str + '<tr><td>' + key + '</td><td><a href="' + data.features[
                            //         0].properties[key] +
                            //     '" class=\'example-image-link\' data-lightbox=\'example-set\' title=\'&lt;button class=&quot;primary &quot; onclick= rotate_img(&quot;pic1&quot)  &gt;Rotate image&lt;/button&gt;\'><img src="' +
                            //     data.features[0].properties[key] +
                            //     '" width="20px" height="20px"></a></td></tr>'

                        } else {
                            str = str + `<td>${data.features[0].properties[key]}</td></tr>`;
                        }


                    }
                    if ($('#tableLayer').val() == 'supervise' || $('#tableLayer').val() ==
                        'notice') {
                        str = str +
                            `<tr><td> Report</td><td> <a href="/generate-third-party-pdf/${data.features[0].properties.id}" target="_blank"><button class="btn btn-sm btn-success">Download</button></a></td></tr>`

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
                    ['BANGI', 'BANGI',2.965810949933260,101.81881303103104],
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
