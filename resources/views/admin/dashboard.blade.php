@extends('layouts.admin.main')

@section('title', 'Tambah Data')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/pages/filepond.css') }}">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>

    <style>
        .card {
            position: relative;
        }

        .card-text {
            font-size: 25px;
            text-align: right
        }

        #form-group-kecamatan {
            z-index: 9;
            top: 30px;
            left: 30px;
            position: absolute;
            min-width: 250px;
        }

        #map {
            position: center;
            border: 20px solid #ffffff;
            border-radius: 8px;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 30pc;
        }

        /* TODO : hapus */
        .marker {
            background-image: url('mapbox-icon.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body text-primary">
                    <h5 class="card-title">Jumlah Pondok</h5>
                    <h6 class="card-text">{{ $jmlPondok }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body text-primary">
                    <h5 class="card-title">Jumlah Produk Unggulan</h5>
                    <h6 class="card-text">{{ $jmlProduk }}</h6>
                </div>
            </div>
        </div>
    </div>

    <section class="section" x-data="alpine()">
        <div class="card">
            <div class="card-body-map">
                <div id="form-group-kecamatan" class="form-group">
                    <select name="id_kecamatan" x-on:change="handleChangeKecamatan()" x-model="id_kecamatan" id="kecamatan"
                        class="form-control">
                        <option value="">Pilih Kecamatan</option>
                        <template x-for="item in list_kecamatan" x-key="item.id">
                            <option :value="item.id" x-text="item.nama"></option>
                        </template>
                    </select>
                </div>
                <div class="row">
                    <div class="col-lg-12 justify-content-center">
                        <div class="position-relative" style="height: 98%">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // init mapbox
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v10', // style URL
            center: new mapboxgl.LngLat(112.226479, -7.546839), // starting position
            zoom: 10 // starting zoom
        });

        // init marker
        let places = {
            'type': 'FeatureCollection',
            'features': []
        }


        function renderMarker(lokasi) {
            const features = [];

            for (let i = 0; i < lokasi.length; i++) {
                const lk = lokasi[i];
                features.push({
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Point',
                        'coordinates': [lk.lng, lk.lat]
                    },
                    'properties': {
                        ...lk,
                        nama_kecamatan: lk.kecamatan?.nama,
                        nama_kelurahan: lk.kelurahan?.nama,
                        'icon': 'marker'
                    }
                });
            }

            map.addSource('places', {
                'type': 'geojson',
                'data': {
                    'type': 'FeatureCollection',
                    features
                },
                cluster: true,
                clusterMaxZoom: 0, // Max zoom to cluster points on
                clusterRadius: 0
            });


            addLayers()
        }

        function getLokasi() {
            return $.ajax({
                url: '{{ route('api.lokasi') }}',
                type: 'GET',
                dataType: 'JSON',
            });
        }

        function loadMarkers(callback) {
            map.loadImage(
                '{{ asset('assets/img/pondok.png') }}',
                (error, imagePondok) => {
                    map.loadImage(
                        '{{ asset('assets/img/produk.png') }}',
                        (error, imageProduk) => {
                            callback(imagePondok, imageProduk);
                        })
                })
        }

        function addLayers() {
            // Add layer pondok
            map.addLayer({
                'id': 'layer-pondok',
                'type': 'symbol',
                'source': 'places',
                'layout': {
                    'icon-image': 'pondok-marker',
                    // get the title name from the source's "nama" property
                    'text-field': ['get', 'nama'],
                    'text-font': [
                        'Open Sans Semibold',
                        'Arial Unicode MS Bold'
                    ],
                    'text-offset': [0, 1.25],
                    'text-anchor': 'top'
                },
                'filter': ['==', 'tipe', 1]
            });

            // Add layer produk
            map.addLayer({
                'id': 'layer-produk',
                'type': 'symbol',
                'source': 'places',
                'layout': {
                    'icon-image': 'produk-marker',
                    // get the title name from the source's "title" property
                    'text-field': ['get', 'nama'],
                    'text-font': [
                        'Open Sans Semibold',
                        'Arial Unicode MS Bold'
                    ],
                    'text-offset': [0, 1.25],
                    'text-anchor': 'top'
                },
                'filter': ['==', 'tipe', 2]
            });
        }

        function handleClickMarker(e) {
            window.location.href = '{{ route('lokasi.edit', ':id') }}'
                .replace(':id', e.features[0].properties.id);
        }

        // mapbox load
        map.on('load', () => {
            // load all markers
            loadMarkers(async (imagePondok, imageProduk) => {
                map.addImage('pondok-marker', imagePondok);
                map.addImage('produk-marker', imageProduk);

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

                // get lokasi
                const lokasi = await getLokasi();

                // render marker
                renderMarker(lokasi);
                updatePoligonKabupaten();

                map.on('click', 'layer-pondok', handleClickMarker)
                map.on('click', 'layer-produk', handleClickMarker)

                $('#kecamatan').on('change', function() {
                    const id_kecamatan = $(this).val();

                    if (id_kecamatan == '') {
                        map.setFilter('layer-pondok', ['==', 'tipe', 1]);
                        map.setFilter('layer-produk', ['==', 'tipe', 2]);
                        map.getSource('kecamatan_poligon').setData({
                            'type': 'Feature',
                            'geometry': {
                                'type': 'Polygon',
                                'coordinates': []
                            }
                        });

                        updatePoligonKabupaten();
                        return;
                    }

                    map.setFilter('layer-pondok', [
                        'all',
                        ['==', ['get', 'id_kecamatan'], id_kecamatan],
                        ['==', ['get', 'tipe'], 1],
                    ]);

                    map.setFilter('layer-produk', [
                        'all',
                        ['==', ['get', 'id_kecamatan'], id_kecamatan],
                        ['==', ['get', 'tipe'], 2],
                    ]);

                    updatePoligon();
                });
            })

            
            function updatePoligon() {
                // ajax request file geojson
                $.ajax({
                    url: "{{ asset('geojson') }}/" + $('#kecamatan').val() + '.geojson',
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

            function updatePoligonKabupaten() {
                // ajax request file geojson
                $.ajax({
                    url: "{{ asset('geojson') }}/kab-jombang.geojson",
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
        })
    </script>


    <script>
        function alpine() {
            return {
                id_kecamatan: "{{ @$lokasi->id_kecamatan }}",
                id_kelurahan: "{{ @$lokasi->id_kelurahan }}",
                list_kecamatan: [],
                list_kelurahan: [],
                async init() {
                    await this.getKecamatan();
                    if (this.id_kecamatan != '') $('#kecamatan').val(this.id_kecamatan);

                    if (this.id_kelurahan != '') {
                        await this.getKelurahan();
                        $('#kelurahan').val(this.id_kelurahan);
                    }

                },
                getKecamatan() {
                    return $.ajax({
                        url: "{{ route('kecamatan.index') }}",
                        type: "GET",
                        success: (res) => {
                            this.list_kecamatan = res.data;
                        },
                        error: (xhr, status, error) => {
                            alert('Gagal mengambil data kecamatan')
                        }
                    });
                },
                getKelurahan() {
                    return $.ajax({
                        url: `{{ route('kecamatan.index') }}/${this.id_kecamatan}`,
                        type: "GET",
                        data: {},
                        success: (res) => {
                            this.list_kelurahan = res.kelurahan;
                        },
                        error: (xhr, status, error) => {
                            alert('Gagal mengambil data kecamatan')
                        }
                    });
                },
                handleChangeKecamatan() {
                    this.getKelurahan();

                    this.id_kelurahan = ''
                    $('#lat').val(null)
                    $('#lng').val(null)
                }
            }
        }
    </script>
@endpush
