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

    <script>
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Setelah dihapus, data tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                focusCancel: true,
                customClass: {
                    actions: 'd-flex gap-2'
                }
            }).then((result) => {
                if (!result.isConfirmed) return;

                deleteRequest(url)
                    .done(() => {
                        // reload datatable
                        $('#datatable').DataTable().ajax.reload();
                    }).fail((err) => {
                        console.log(err)
                    })
            });
        });

        function deleteRequest(url) {
            return $.ajax({
                type: "POST",
                url,
                data: {
                    _method: 'DELETE',
                },
                dataType: "json"
            })
        }
    </script>
@endpush
