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
                    <div class="card-header">
                        <h5 class="card-title text-center">Image Slider</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <input id="image_slider" name="image_slider" type="file">
                                    @if ($errors->has('image_slider'))
                                        <div class="form-group">
                                            <input type="hidden"
                                                class="form-control @error('image_slider') is-invalid @enderror">
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('image_slider') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Tambah Slider</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="row gallery">
                            @foreach ($gallery as $item)
                                <div class="border col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2 position-relative">
                                    <img style="width: 100%;aspect-ratio:16/9;object-fit: cover" class="w-100 active"
                                        src="{{ asset("images/$item->filename") }}" alt="">
                                    <form action="{{ route('gallery.destroy', ['id' => $item->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm position-absolute top-0 left-0 mt-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

            $('#image_slider').filepond({
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
