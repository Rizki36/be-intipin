@extends('layouts.admin.main')

@section('title', 'Setting Page')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/pages/filepond.css') }}">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .description-img {
            border-radius: 9px;
            width: 100%;
            aspect-ratio: 16/9;
            overflow: hidden;
            object-fit: cover
        }

        .no-image {
            width: 100%;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid currentColor;
            border-radius: 9px;
        }

    </style>
@endsection

@section('content')
    <section class="section">
        <form action="{{ route('setting.update_all') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Deskripsi 1</h5>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if ($image_1 != '')
                                    <img class="description-img" src="{{ asset("images/$image_1") }}" alt="">
                                @else
                                    <div class="no-image">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="my-3">
                                    <textarea id="description_1" name="description_1">{{ old('description_1', $description_1) }}</textarea>
                                    @if ($errors->has('description_1'))
                                        <div class="form-group">
                                            <input type="hidden"
                                                class="form-control @error('description_1') is-invalid @enderror">
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('description_1') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <input id="image_1" name="image_1" type="file">
                                    @if ($errors->has('image_1'))
                                        <div class="form-group">
                                            <input type="hidden"
                                                class="form-control @error('image_1') is-invalid @enderror">
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('image_1') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Deskripsi 2</h5>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if ($image_2 != '')
                                    <img class="description-img" src="{{ asset("images/$image_2") }}" alt="">
                                @else
                                    <div class="no-image">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="my-3">
                                    <textarea id="description_2" name="description_2">{{ old('description_2', $description_2) }}</textarea>
                                    @if ($errors->has('description_2'))
                                        <div class="form-group">
                                            <input type="hidden"
                                                class="form-control @error('description_2') is-invalid @enderror">
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('description_2') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <input id="image_2" name="image_2" type="file">
                                    @if ($errors->has('image_2'))
                                        <div class="form-group">
                                            <input type="hidden"
                                                class="form-control @error('image_2') is-invalid @enderror">
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('image_2') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Update Deskripsi</button>
                </div>
            </div>
        </form>
    </section>

    <hr>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Image Slider</h5>
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                    <div class="card-body">
                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="#">
                                    <img class="w-100 active"
                                        src="https://images.unsplash.com/photo-1633008808000-ce86bff6c1ed?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                                        data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                </a>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="#">
                                    <img class="w-100"
                                        src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80"
                                        data-bs-target="#Gallerycarousel" data-bs-slide-to="1">
                                </a>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="#">
                                    <img class="w-100"
                                        src="https://images.unsplash.com/photo-1632951634308-d7889939c125?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                                        data-bs-target="#Gallerycarousel" data-bs-slide-to="2">
                                </a>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="#">
                                    <img class="w-100"
                                        src="https://images.unsplash.com/photo-1632949107130-fc0d4f747b26?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3OHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                                        data-bs-target="#Gallerycarousel" data-bs-slide-to="3">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle">Image Slider Beranda</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="3"
                                aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100"
                                    src="https://images.unsplash.com/photo-1633008808000-ce86bff6c1ed?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="https://images.unsplash.com/photo-1632951634308-d7889939c125?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="https://images.unsplash.com/photo-1632949107130-fc0d4f747b26?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3OHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"
        integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            // First register any plugins
            $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

            $('#image_1').filepond({
                storeAsFile: true,
            })

            $('#image_2').filepond({
                storeAsFile: true,
            });

            $('#description_1').summernote({
                placeholder: 'Deskripsi 1',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('#description_2').summernote({
                placeholder: 'Deskripsi 2',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
