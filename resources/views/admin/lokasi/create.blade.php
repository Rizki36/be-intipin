@extends('layouts.admin.main')

@section('title')
    @if (isset($lokasi))
        Edit Lokasi
    @else
        Tambah Lokasi
    @endif
@endsection


@section('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/pages/filepond.css') }}">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>

    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        .description-img {
            border-radius: 9px;
            width: 100%;
            aspect-ratio: 16/9;
            overflow: hidden;
            object-fit: cover;
            margin-bottom: 14px;
        }

        .no-image {
            width: 100%;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid currentColor;
            border-radius: 9px;
            margin-bottom: 14px;
        }

    </style>
@endsection

@section('content')
    <section class="section" x-data="alpine()">
        <div class="card">
            <div class="card-body">
                <form id="lokasi-form" method="POST"
                    action="{{ isset($lokasi) ? route('lokasi.update', ['lokasi' => $lokasi->id]) : route('lokasi.store') }}"
                    class="form form-horizontal">
                    @csrf

                    @if (isset($lokasi))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif

                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative p-3" style="height: 98%">
                                    <div id="map"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select name="id_kecamatan" x-on:change="handleChangeKecamatan()"
                                            x-model="id_kecamatan" id="kecamatan" class="form-control">
                                            <option value="">Pilih Kecamatan</option>
                                            <template x-for="item in list_kecamatan" x-key="item.id">
                                                <option :value="item.id" x-text="item.nama"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <select name="id_kelurahan" x-model="id_kelurahan" id="kelurahan"
                                            class="form-control">
                                            <option value="">Pilih Kelurahan</option>
                                            <template x-for="item in list_kelurahan" x-key="item.id">
                                                <option :value="item.id" x-text="item.nama"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="lat">Lat</label>
                                        <input name="lat" type="text" id="lat" class="form-control"
                                            value="{{ @$lokasi->lat }}" readonly>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="lng">Lng</label>
                                        <input name="lng" type="text" id="lng" class="form-control"
                                            value="{{ @$lokasi->lng }}" readonly>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="nama">Nama Lokasi</label>
                                        <input name="nama" type="text" id="nama" class="form-control"
                                            placeholder="Masukkan Nama Lokasi" value="{{ @$lokasi->nama }}">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="alamat">Alamat Lokasi</label>
                                        <input name="alamat" type="text" id="alamat" class="form-control"
                                            placeholder="Masukkan Alamat Lokasi" value="{{ @$lokasi->alamat }}">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="tipe">Tipe Lokasi</label>
                                        <select name="tipe" id="tipe" class="form-control" value="{{ @$lokasi->tipe }}">
                                            <option value="">Pilih Tipe Lokasi</option>
                                            <option value="1" {{ (int) @$lokasi->tipe === 1 ? 'selected' : '' }}>1 :
                                                Pondok
                                                Pesantren</option>
                                            <option value="2" {{ (int) @$lokasi->tipe === 2 ? 'selected' : '' }}>2 :
                                                Produk
                                                Unggulan</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="link_google_maps">Link Google Maps</label>
                                        <input name="link_google_maps" type="text" id="link_google_maps"
                                            class="form-control" placeholder="Masukkan Link Google Maps"
                                            value="{{ @$lokasi->link_google_maps }}">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="2" class="form-control">{{ @$lokasi->deskripsi }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                @if (isset($lokasi))
                                    @if ($lokasi->foto != '')
                                        <img class="description-img" src="{{ asset("images/$lokasi->foto") }}" alt="">
                                    @else
                                        <div class="no-image">
                                            Tidak ada gambar
                                        </div>
                                    @endif
                                @endif

                                <input id="foto" name="foto" type="file">
                            </div>


                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button id="btn-submit" type="submit" class="btn btn-primary me-1 mb-1">
                                    @if (isset($lokasi))
                                        Update
                                    @else
                                        Buat
                                    @endif
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <a href="{{ url()->previous() }}" role="button" class="btn btn-ghost">Kembali</a>
@endsection

@push('scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>


    <script>
        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v10', // style URL
            center: new mapboxgl.LngLat(112.226479, -7.546839), // starting position
            zoom: 10 // starting zoom
        });

        const marker = new mapboxgl.Marker()
            .setLngLat([0, 0])
            .addTo(map);

        map.on('load', () => {
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

            map.on('click', 'kecamatan_poligon', (e) => {
                let coordinates = e.lngLat;
                marker.setLngLat(coordinates)
                $('#lat').val(coordinates.lat)
                $('#lng').val(coordinates.lng)
            });

            $('#kecamatan').on('change', function() {
                updatePoligon();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // First register any plugins
            $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

            $('#foto').filepond({
                storeAsFile: true,
            })
        })

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
                    marker.setLngLat([0, 0])
                    $('#lat').val(null)
                    $('#lng').val(null)
                }
            }
        }

        $('#lokasi-form').on('submit', function(e) {
            e.preventDefault()

            // get form data
            let formData = new FormData(this);

            // ajax request
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Lokasi berhasil dibuat',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href =
                                "{{ route('lokasi.index') }}";
                        }
                    })
                },
                error: function(xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    var errorString = '';
                    $.each(response.errors, function(key, value) {
                        errorString += value + '<br>';
                    });
                    Swal.fire({
                        title: 'Gagal',
                        html: errorString,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    })
                }
            });
        })
    </script>
@endpush
