@extends('layouts.app')
@section('styles')
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper p-5">
        {{-- <div class="container-fluid text-light">
            <div class="row p-5" style="background-color: #1265A8;">
                <div class="col-lg-6 col-sm-4">
                    <div class="form-group align-items-center d-flex">
                        <label for="klien" class="col-4 mr-2">Monitoring Jaringan :</label>
                        <select class="form-control" id="klien" name="klien">
                            <option value="">Pilih Klien</option>
                        </select>
                    </div>
                </div>
            </div>
        </div> --}}

        <div id="map" class=""></div>
    </div>
@endsection

@section('js')
    <script>
        var user = @json($user);
        var monitoring = user.map((x) => L.marker([x.latitude, x.longitude]).bindPopup(x.name, {autoClose:false}));

        var locations = L.layerGroup(monitoring);

        const map = L.map('map', {
            center: [-5.3647543, 105.2723488],
            zoom: 12,
            layers: [locations]
        });

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 16,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        monitoring.forEach(marker => marker.openPopup());

    </script>
@endsection