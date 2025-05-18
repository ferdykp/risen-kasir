@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="full-width w-md-a ">
                            <h4 class="">Edit Purchase</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('purchase.update', $purchase->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="object_name" class="col-md-4 col-form-label text-md-right">Product Name</label>
                                <div class="col-md-6">
                                    <input id="object_name" type="text"
                                        class="form-control @error('object_name') is-invalid @enderror" name="object_name"
                                        value="{{ old('object_name', $purchase->object_name) }}" required>
                                    @error('object_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="purchase_date" class="col-md-4 col-form-label text-md-right">Tanggal
                                    Pembelian</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror"
                                        name="purchase_date"
                                        value="{{ old('purchase_date', $purchase->purchase_date ? \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d') : '') }}"
                                        required>

                                    @error('purchase_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Jumlah</label>
                                <div class="col-md-6 d-flex gap-2">
                                    <input type="number" name="quantity" class="form-control" placeholder="Jumlah"
                                        value="{{ old('quantity', $purchase->quantity) }}" required>
                                    <select name="unit" class="form-control w-auto" required>
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach (['Ml', 'Paket', 'Pcs', 'Gram'] as $unit)
                                            <option value="{{ $unit }}"
                                                {{ old('unit', $purchase->unit) == $unit ? 'selected' : '' }}>
                                                {{ $unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Harga Satuan</label>
                                <div class="col-md-6">
                                    <input type="text" id="price"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ 'Rp ' . number_format($purchase->price, 0, ',', '.') }}" required>
                                    @error('price')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total_price" class="col-md-4 col-form-label text-md-right">Harga Total</label>
                                <div class="col-md-6">
                                    <input type="text" id="total_price"
                                        class="form-control @error('total_price') is-invalid @enderror" name="total_price"
                                        value="{{ 'Rp ' . number_format($purchase->total_price, 0, ',', '.') }}" required>
                                    @error('total_price')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pict_nota" class="col-md-4 col-form-label text-md-right">Product Image</label>
                                <div class="col-md-6">
                                    @if ($purchase->pict_nota)
                                        <div class="mb-2 text-center">
                                            <img src="{{ asset('storage/' . $purchase->pict_nota) }}" alt="Nota"
                                                style="width: 100px; height: auto;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('pict_nota') is-invalid @enderror"
                                        name="pict_nota" accept="image/*">
                                    @error('pict_nota')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update Purchase</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk format harga --}}
    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            if (value === '') {
                input.value = 'Rp ';
                return;
            }
            input.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(parseInt(value));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const price = document.getElementById('price');
            const total = document.getElementById('total_price');

            if (price) price.addEventListener('input', () => formatRupiah(price));
            if (total) total.addEventListener('input', () => formatRupiah(total));

            formatRupiah(price);
            formatRupiah(total);
        });
    </script>
@endsection
