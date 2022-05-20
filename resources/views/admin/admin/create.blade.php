@extends('layouts.admin.main')

@section('title', 'Tambah admin')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal">
                    @csrf
                    @php
                    @endphp
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="name">Nama</label>
                                <input type="text" id="name" placeholder="Masukkan Nama"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Masukkan Username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Masukkan Password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Buat</button>
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

@section('scripts')
    <script></script>
@endsection
