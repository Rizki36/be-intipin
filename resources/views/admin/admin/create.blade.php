@extends('layouts.admin.main')

@section('title')
    @if (isset($user))
        Edit Admin
    @else
        Tambah Admin
    @endif
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST"
                    action="{{ isset($user) ? route('admin.update', ['admin' => $user->id]) : route('admin.store') }}"
                    class="form form-horizontal">
                    @csrf

                    @if (isset($user))
                        @method('PUT')
                    @endif

                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="name">Nama</label>
                                <input name="name" type="text" id="name" placeholder="Masukkan Nama"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', @$user->name) }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                                    value="{{ old('email', @$user->email) }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="username">Username</label>
                                <input name="username" type="text" id="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Masukkan Username" value="{{ old('username', @$user->username) }}">
                                @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>

                            {{-- hide password saat edit --}}
                            @if (!isset($user))
                                <div class="col-lg-6 form-group">
                                    <label for="password">Password</label>
                                    <input name="password" type="text"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Masukkan Password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            @endif

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
