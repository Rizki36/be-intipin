@extends('layouts.admin.main')

@section('title', 'Lokasi')

@section('content')
    <div class="page-heading">
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div> Tabel Lokasi </div>
                    <div>
                        <a href="{{ route('lokasi.create') }}" class="btn btn-primary">
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
