@extends('layouts.client.main')

@section('container')
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <h1 class="section-header">
                <p>Produk Unggulan</p>
            </h1>
            <div class="row gy-4">
                <div class="col-12" style="min-height: 500px">
                    <div class="position-relative p-3" style="height: 98%">
                        <div class="form-group rounded p-3"
                            style="background-color: white;position: absolute;z-index: 9;width: 300px;top: 20;left:40px">
                            <label>Kecamatan</label>
                            <select id="kecamatan-filter" class="form-control">
                                <option value="">Filter Kecamatan</option>
                                @foreach ($kecamatan as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ======= Footer ======= -->

    <!-- End Footer -->

    <style>
        #img-detail {
            height: 400px;
            width: 100%;
            object-fit: cover;
        }

    </style>
    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal-title" class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="img-detail">
                    <div class="d-flex gap-5 mt-3 mb-2">
                        <div>Kecamatan : <span id="kecamatan-detail"></span></div>
                        <div>Kelurahan : <span id="Kelurahan-detail"></span></div>
                    </div>
                    <p>Alamat : <span id="alamat-detail"></span></p>
                    <p>Deskripsi : <br> <span id="deskripsi-detail"></span></p>
                    <div class="d-flex justify-content-center mt-4">
                        <a class="btn btn-primary" id="link-detail">Link Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // --- elements ---
        var $modalEl = getById('modal-detail') // relatedTarget
        var $modalTitle = getById('modal-title')
        var $kecamatanDetail = getById('kecamatan-detail')
        var $KelurahanDetail = getById('Kelurahan-detail')
        var $alamatDetail = getById('alamat-detail')
        var $deskripsiDetail = getById('deskripsi-detail')
        var $linkDetail = getById('link-detail')
        var $imgDetail = getById('img-detail')
        var $kecamatanFilter = getById('kecamatan-filter')

        // --- variables ---
        var modalDetail = new bootstrap.Modal($modalEl)
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v10', // style URL
            center: new mapboxgl.LngLat(112.226479, -7.546839), // starting position
            zoom: 10 // starting zoom
        });

        const json_lokasi = '{!! $lokasi !!}';
        const lokasi = JSON.parse(json_lokasi);

        let places = {
            'type': 'FeatureCollection',
            'features': []
        }

        // transform data
        lokasi.forEach(function(lk) {
            console.log('lk', lk)
            places.features.push({
                'type': 'Feature',
                'geometry': {
                    'type': 'Point',
                    'coordinates': [lk.lng, lk.lat]
                },
                'properties': {
                    ...lk,
                    nama_kecamatan: lk.kecamatan.nama,
                    nama_kelurahan: lk.kelurahan.nama,
                    'icon': 'marker'
                }
            })
        })

        // mapbox load
        map.on('load', () => {
            // Add an image to use as a custom marker
            map.loadImage(
                '{{ asset('assets/img/produk.png') }}',
                (error, image) => {
                    if (error) throw error;
                    map.addImage('custom-marker', image);


                    // Add a data source containing GeoJSON data.
                    map.addSource('kecamatan_poligon', {
                        'type': 'geojson',
                        'data': {
                            'type': 'Feature',
                            'geometry': {
                                'type': 'Polygon',
                                // These coordinates outline kecamatan_poligon.
                                'coordinates': []
                            }
                        }
                    });

                    // Add a new layer to visualize the polygon.
                    map.addLayer({
                        'id': 'kecamatan_poligon',
                        'type': 'fill',
                        'source': 'kecamatan_poligon', // reference the data source
                        'layout': {},
                        'paint': {
                            'fill-color': '#0080ff', // blue color fill
                            'fill-opacity': 0.5
                        }
                    });

                    map.addSource('places', {
                        'type': 'geojson',
                        'data': places
                    });

                    // Add a symbol layer
                    map.addLayer({
                        'id': 'places',
                        'type': 'symbol',
                        'source': 'places',
                        'layout': {
                            'icon-image': 'custom-marker',
                            // get the title name from the source's "nama" property
                            'text-field': ['get', 'nama'],
                            'text-font': [
                                'Open Sans Semibold',
                                'Arial Unicode MS Bold'
                            ],
                            'text-offset': [0, 1.25],
                            'text-anchor': 'top'
                        }
                    });

                    map.on('click', 'places', handleClickMarker);

                    $kecamatanFilter.addEventListener('change', handleChangeKecamatan);
                })
        })


        // --- functions ---

        function handleClickMarker(e) {
            map.flyTo({
                center: e.features[0].geometry.coordinates
            });

            console.log(e.features[0].properties)
            showModal(e.features[0].properties)
            modalDetail.show($modalEl)
        }

        function handleChangeKecamatan() {
            const kecamatan = this.value;
            if (kecamatan == '') {
                map.setFilter('places', null);
                map.getSource('kecamatan_poligon').setData({
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Polygon',
                        'coordinates': []
                    }
                });
                return;
            }

            const layerID = `kec-${kecamatan}`;
            map.setFilter('places', ['==', 'id_kecamatan', kecamatan]);

            updatePoligon()
        }


        function updatePoligon() {
            // ajax request file geojson
            $.ajax({
                url: "{{ asset('geojson') }}/" + $('#kecamatan-filter').val() + '.geojson',
                type: "GET",
                dataType: 'json',
                data: {},
                success: (res) => {
                    map.getSource('kecamatan_poligon').setData(res);
                },
                error: (xhr, status, error) => {
                    console.log(error);
                }
            });
        }

        function showModal(data) {
            $modalTitle.innerHTML = data?.nama
            $kecamatanDetail.innerHTML = data?.nama_kecamatan
            $KelurahanDetail.innerHTML = data?.nama_kelurahan
            $alamatDetail.innerHTML = data?.alamat
            $deskripsiDetail.innerHTML = data?.deskripsi
            $linkDetail.href = data?.link_google_maps
            $imgDetail.src = `{{ asset('images') }}/${data?.foto}`

            modalDetail.show($modalEl)
        }
    </script>
@endpush
