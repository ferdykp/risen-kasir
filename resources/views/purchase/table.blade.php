@forelse ($data as $index => $item)
    <tr>
        {{-- @if (Auth::user()->role == 'admin')
            <td class="text-center">
                <input type="checkbox" class="checkbox_id" value="{{ $item->id }}">
            </td>
        @endif --}}
        <td class="text-center">
            {{ $index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->object_name }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{-- {{ $item->purchase_date }} --}}
            {{ \Carbon\Carbon::parse($item->purchase_date)->format('d-m-Y') }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->quantity }}
            {{ $item->unit }}

        </td>

        <td style="white-space: nowrap;" class="text-center">
            Rp {{ number_format($item->price, 0, ',', '.') }}
        </td>

        <td style="white-space: nowrap;" class="text-center">
            Rp {{ number_format($item->total_price, 0, ',', '.') }}
        </td>

        <td class="text-center align-middle">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                @if ($item->pict_nota)
                    <img src="{{ asset('storage/' . $item->pict_nota) }}" alt="Gambar Produk"
                        style="width: 100px; height: auto;">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
            </div>
        </td>


        {{-- @if (Auth::user()->role == 'admin') --}}
        <td class="d-flex justify-content-center">
            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('purchase.destroy', $item->id) }}"
                method="POST" class="d-flex gap-2">
                <a href="{{ route('purchase.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
        {{-- @endif --}}
    </tr>
@empty
    <tr>
        <td colspan="50">
            <div class="alert alert-danger text-center text-dark">
                Data Barang belum tersedia.
            </div>
        </td>
    </tr>
@endforelse

<style>
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: bold;
        color: white;
    }

    .tidak-tersedia {
        background-color: red;
    }

    .tersedia {
        background-color: green;
    }
</style>
