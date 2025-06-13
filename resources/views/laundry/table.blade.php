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
            {{ $item->order_id }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->customer_name }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->service }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->payment_method }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->payment_status }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{-- {{ $item->working_status }} --}}
            <span class="status-badge {{ strtolower(str_replace(' ', '-', $item->working_status)) }}">
                {{ $item->working_status }}
            </span>
        </td>

        {{-- @if (Auth::user()->role == 'admin') --}}
        <td class="d-flex justify-content-center gap-2">
            <button class="btn btn-sm btn-warning btn-report-detail" data-id="{{ $item->id }}">
                Detail
            </button>
            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('laundry.destroy', $item->id) }}"
                method="POST" class="d-flex gap-2">
                <a href="{{ route('laundry.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
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

    .belum {
        background-color: grey;
    }

    .on-progress {
        background-color: orange;
    }

    .finish {
        background-color: green;
    }
</style>
