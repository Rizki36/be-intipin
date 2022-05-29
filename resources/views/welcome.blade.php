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
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div data-aos="fade-up">{!! $description_1 !!}}</div>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                        </div>
                    </div>
                </div>
                @if ($image_1 != '')
                    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">`
                        <img src="{{ asset("images/$image_1") }}" class="img-fluid" alt="" />
                    </div>
                @endif
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

                <!-- ======= Values Section ======= -->
                {{-- <section id="values" class="values">

                    <div class="container" data-aos="fade-up">

                        <header class="section-header">
                            <p>Intipin Apa Ajasih</p>
                        </header>

                        <div class="row">

                            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                                <div class="box">
                                    <img src="assets/img/values-1.png" class="img-fluid" alt="">
                                    <h3>Ad cupiditate sed est odio</h3>
                                    <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et
                                        veritatis id.</p>
                                </div>
                            </div>

                            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                                <div class="box">
                                    <img src="assets/img/values-2.png" class="img-fluid" alt="">
                                    <h3>Voluptatem voluptatum alias</h3>
                                    <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit
                                        non.</p>
                                </div>
                            </div>

                            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                                <div class="box">
                                    <img src="assets/img/values-3.png" class="img-fluid" alt="">
                                    <h3>Fugit cupiditate alias nobis.</h3>
                                    <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem
                                        commodi.</p>
                                </div>
                            </div>

                        </div>

                    </div>

                </section> --}}
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        // init mapbox
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v10', // style URL
            center: new mapboxgl.LngLat(112.226479, -7.546839), // starting position
            zoom: 12 // starting zoom
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
                }
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

        }

        // mapbox load
        map.on('load', () => {
            // load all markers
            loadMarkers(async (imagePondok, imageProduk) => {
                map.addImage('pondok-marker', imagePondok);
                map.addImage('produk-marker', imageProduk);

                // get lokasi
                const lokasi = await getLokasi();

                // render marker
                renderMarker(lokasi);

                map.on('click', 'layer-pondok', handleClickMarker)
                map.on('click', 'layer-produk', handleClickMarker)
            })
        })
    </script>
@endpush
