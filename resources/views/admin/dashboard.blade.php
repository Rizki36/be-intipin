@extends('layouts.admin.main')

@section('head')
@section('title', 'Tambah Data')
<link rel="stylesheet" href="{{ asset('assets/admin/css/pages/filepond.css') }}">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

</style>
@endsection


@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-body text-primary">
                <h5 class="card-title">Jumlah Pondok</h5>
                <h6 class="card-text">10</h6>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-body text-primary">
                <h5 class="card-title">Jumlah Produk Unggulan</h5>
                <h6 class="card-text">10</h6>
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
    mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v10', // style URL
        center: new mapboxgl.LngLat(112.226479, -7.546839), // starting position
        zoom: 10 // starting zoom
    });
</script>
@endpush
