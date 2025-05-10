@forelse ($data as $index => $item)
    <tr>
        <td class="text-center">
            <input type="checkbox" class="checkbox_id" value="{{ $item->id }}">
        </td>
        <td class="text-center">
            {{ $index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->name }}
        </td>

        <td class="d-flex justify-content-center gap-2">
            <button class="btn btn-sm btn-primary" onclick="editModal({{ $item }})">Edit</button>
            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('categories.destroy', $item->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="50">
            <div class="alert alert-danger text-center">
                Data Barang belum tersedia.
            </div>
        </td>
    </tr>
@endforelse
