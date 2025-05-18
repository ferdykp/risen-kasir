@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="w-100 w-md-auto ">
                            <h4 class="">Add Purchase</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('purchase.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="object_name" class="col-md-4 col-form-label text-md-right">Product Name</label>

                                <div class="col-md-6">
                                    <input id="object_name" type="text"
                                        class="form-control @error('object_name') is-invalid @enderror" name="object_name"
                                        value="{{ old('object_name') }}" required autocomplete="object_name" autofocus>

                                    @error('object_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="purchase_date" class="col-md-4 col-form-label text-md-right">Tanggal Pembelian
                                </label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror"
                                        name="purchase_date" value="{{ old('purchase_date') }}" required
                                        autocomplete="purchase_date" autofocus>
                                    @error('purchase_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Jumlah</label>
                                <div class="col-md-6">
                                    <div id="shoes-container">
                                        {{-- Tampilkan 1 baris input kosong saat create --}}
                                        <div class="shoe-entry mb-2 d-flex gap-2">
                                            <input type="number" name="quantity" class="form-control w-75"
                                                placeholder="Jumlah" value="{{ old('quantity') }}" required>
                                            <select name="unit" class="form-control w-25" required>
                                                <option value="">--Pilih Satuan--</option>
                                                @foreach (['Ml', 'Paket', 'Pcs', 'Gram'] as $unit)
                                                    <option value="{{ $unit }}"
                                                        {{ old('unit') == $unit ? 'selected' : '' }}>
                                                        {{ $unit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">
                                    Harga Satuan</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price" id="price" value="{{ old('price') }}" required
                                        autocomplete="price" autofocus>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total_price" class="col-md-4 col-form-label text-md-right">
                                    Harga Total</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('total_price') is-invalid @enderror"
                                        name="total_price" id="total_price" value="{{ old('total_price') }}" readonly>

                                    @error('total_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="pict_nota" class="col-md-4 col-form-label text-md-right">Product Image</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('pict_nota') is-invalid @enderror"
                                        name="pict_nota" accept="image/*">
                                    @error('pict_nota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const priceField = document.getElementById('price');
        const totalField = document.getElementById('total_price');
        const quantityField = document.querySelector('input[name="quantity"]');

        // Fungsi membersihkan format Rp
        function cleanRp(value) {
            return parseInt(value.replace(/[^0-9]/g, '')) || 0;
        }

        // Fungsi update total
        function updateTotal() {
            const quantity = parseFloat(quantityField.value) || 0;
            const price = cleanRp(priceField.value);
            const total = quantity * price;

            totalField.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        // Format Rp untuk input harga satuan (price)
        priceField.addEventListener('keydown', function(e) {
            const cursorPos = priceField.selectionStart;
            if ((e.key === 'Backspace' || e.key === 'Delete') && cursorPos <= 3) {
                e.preventDefault();
            }
        });

        priceField.addEventListener('input', function() {
            let value = priceField.value.replace(/[^0-9]/g, '');

            if (value === '') {
                priceField.value = 'Rp ';
                updateTotal();
                return;
            }

            const formatted = new Intl.NumberFormat('id-ID').format(parseInt(value));
            priceField.value = 'Rp ' + formatted;
            updateTotal();
        });

        // Update total jika quantity berubah
        quantityField.addEventListener('input', updateTotal);

        // Saat halaman pertama kali dimuat
        window.addEventListener('DOMContentLoaded', function() {
            let raw = priceField.value.replace(/[^0-9]/g, '');
            if (raw) {
                const formatted = new Intl.NumberFormat('id-ID').format(parseInt(raw));
                priceField.value = 'Rp ' + formatted;
            } else {
                priceField.value = 'Rp ';
            }
            updateTotal();
        });
    </script>
@endsection
