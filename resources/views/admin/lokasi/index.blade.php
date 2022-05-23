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
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tipe Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dale</td>
                                <td>fringilla.euismod.enim@quam.ca</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
