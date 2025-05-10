@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="full-width w-md-a ">
                            <h4 class="">Edit Inventory Sparepart</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('sparepart.update', $sparepart->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_sparepart" class="form-control-label">Nama Sparepart:</label>
                                <input type="text" class="form-control" id="nama_sparepart" name="nama_sparepart"
                                    value="{{ old('nama_sparepart', $sparepart->nama_sparepart) }}" required>
                                @error('nama_sparepart')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori" class="form-control-label">Kategori:</label>
                                <input type="text" class="form-control" id="kategori" name="kategori"
                                    value="{{ old('kategori', $sparepart->kategori) }}" required>
                                @error('kategori')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok" class="form-control-label">Stock:</label>
                                <input type="number" class="form-control" id="stock" name="stok"
                                    value="{{ old('stok', $sparepart->stok) }}" required>
                                @error('stok')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="update_stok" class="form-control-label">Update Stock:</label>
                                <input type="date" class="form-control" id="update_stok" name="update_stok"
                                    value="{{ old('update_stok', $sparepart->update_stok) }}" required>
                                @error('update_stok')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_penyimpanan" class="form-control-label">Lokasi Penyimpanan:</label>
                                <select id="lokasi_penyimpanan" class="form-control mb-3" name="lokasi_penyimpanan"
                                    required>
                                    <option value="" disabled hidden>--- Select Lokasi Penyimpanan ---</option>
                                    @foreach ($location as $item)
                                        <option value="{{ $item->location_name }}"
                                            {{ old('lokasi_penyimpanan') == $item->location_name ? 'selected' : '' }}>
                                            {{ $item->location_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lokasi_penyimpanan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror status-dropdown"
                                    name="status" required autocomplete="status" autofocus id="status">
                                    <option value="" disabled hidden> --- Select Status ---
                                    </option>
                                    <option value="Tidak Tersedia" data-color="red">Tidak Tersedia</option>
                                    <option value="Tersedia" data-color="green">Tersedia</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan" class="form-control-label">Catatan:</label>
                                <input type="text" class="form-control" id="catatan" name="catatan"
                                    value="{{ old('catatan', $sparepart->catatan) }}" required>
                                @error('catatan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="mt-3 btn btn-primary">Update Inventory Sparepart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
