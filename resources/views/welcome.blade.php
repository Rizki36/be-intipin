@extends('layouts.client.main')

@section('head')
    <style>
        #map {
            position: center;
            border: 20px solid #ffffff;
            border-radius: 8px;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }

    </style>
@endsection

@section('container')
    <section>
        <div class="position-relative" style="height: 90vh">
            <div id="map"></div>
        </div>
    </section>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                @if ($image_1 != '')
                    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">`
                        <img src="{{ asset("images/$image_1") }}" class="img-fluid" alt="" />
                    </div>
                @endif
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div data-aos="fade-up">{!! $description_1 !!}</div>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <section id="portfolio-details" class="portfolio-details">
                <div class="container">

                    <div class="row gy-4">

                        <div class="col-lg-12">
                            <div class="portfolio-details-slider swiper">
                                <div class="swiper-wrapper align-items-center">
                                    @foreach ($gallery as $item)
                                        <div class="swiper-slide">
                                            <img src="{{ asset("images/$item->filename") }}" alt="">
                                        </div>
                                    @endforeach

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
        </section>
        <!-- End About Section -->

        <!-- ======= Values Section ======= -->
        <section id="values" class="values">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <p></p>
                </header>

                <!-- Feature Tabs -->
                <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="d-flex align-items-center mb-2">
                                </div>
                                {!! $description_2 !!}
                            </div>
                        </div>
                    </div>

                    @if ($image_2 != '')
                        <div class="col-lg-6">
                            <img src="{{ asset("images/$image_2") }}" class="img-fluid" alt="" />
                        </div>
                    @endif
                </div>
                <!-- End Feature Tabs -->
            </div>
        </section>
    </main>

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
        var modalDetail = new bootstrap.Modal($modalEl)


        // init mapbox
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v10', // style URL
            center: new mapboxgl.LngLat(112.226479, -7.546839), // starting position
            zoom: 9.5 // starting zoom
        });



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

        function loadPolygon() {
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
            map.flyTo({
                center: e.features[0].geometry.coordinates
            });

            console.log(e.features[0].properties)
            showModal(e.features[0].properties)
            modalDetail.show($modalEl)
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

        // mapbox load
        map.on('load', () => {
            // load all markers
            loadMarkers(async (imagePondok, imageProduk) => {
                map.addImage('pondok-marker', imagePondok);
                map.addImage('produk-marker', imageProduk);

                // get lokasi
                const lokasi = await getLokasi();

                loadPolygon();

                // render marker
                renderMarker(lokasi);

                map.on('click', 'layer-pondok', handleClickMarker)
                map.on('click', 'layer-produk', handleClickMarker)
            })
        })
    </script>
@endpush
