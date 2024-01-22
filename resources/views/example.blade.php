<!DOCTYPE html>
<html>
<head>
    {{-- <title>{{ $title }}</title> --}}
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</head>
</head>
<body>
    <div class="container-">
        <h1 class="text-center">etc ba LKS</h1>

        @foreach ($data as $datas)
            
        
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>WP NAME</th>
                <th>VISIT DATE</th>
                <th>TIME</th>
                <th>READING START</th>
                <th>READING END</th>
                <th>CYCLE</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{$datas->id}}</td>
                    <td>{{$datas->wp_name}}</td>
                    <td>{{ date('Y-m-d', strtotime($datas->visit_date)) }} </td>
                    <td>{{$datas->time}} </td>
                    <td>{{$datas->reading_start}} </td>
                    <td>{{$datas->reading_end}} </td>
                    <td>{{$datas->cycle}} </td>
                </tr>
            </tbody>
        </table>
        <div class="container p-5 ms-auto">
            <div id="map-{{$datas->id}}" class="map" style="height: 300px;width:800px; marign :20px ;"></div>

        </div>



        <script>
            map = L.map("map-{{$datas->id}}").setView([3.016603, 101.858382], 5);
            document.getElementById("map-{{$datas->id}}").style.cursor = "pointer"
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
            // L.marker(['.$item->y.', '.$item->x.']).addTo(map)
        </script>
        @endforeach
        {{-- <div id="map" style="height: 400px;"></div>  --}}

    </div>

        <script>
            // Initialize the map
            var mymap = L.map('map').setView([51.505, -0.09], 13);

            // Add a tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(mymap);

            // Add a marker
            L.marker([51.505, -0.09]).addTo(mymap)
                .bindPopup('A sample popup!').openPopup();
        </script>

</body>
</html>
