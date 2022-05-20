<a class="btn btn-sm btn-warning" href="{{ route('admin.edit', ['admin' => $id]) }}">
    <i class="bi bi-pencil"></i>
</a>

<a class="btn btn-sm btn-danger btn-delete" href="{{ route('admin.destroy', ['admin' => $id]) }}">
    <i class="bi bi-trash"></i>
</a>
