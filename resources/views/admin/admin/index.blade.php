@extends('layouts.admin.main')

@section('title', 'Admin Page')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    Tabel Admin
                </div>
                <div>
                    <a href="{{ route('admin.create') }}" class="btn btn-primary">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
