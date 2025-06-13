@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="full-width w-md-a ">
                            <h4 class="">Edit Order</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('laundry.update', $laundry->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Order ID</label>
                                <div class="col-md-6">
                                    <input type="text" name="order_id" class="form-control"
                                        value="{{ old('order_id', $laundry->order_id) }}" required readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Customer Name</label>
                                <div class="col-md-6">

                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        value="{{ old('customer_name', $laundry->customer_name) }}" required>
                                </div>
                                @error('customer_name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $laundry->phone_number) }}" required>
                                </div>
                                @error('phone_number')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Shoes</label>
                                <div class="col-md-6">
                                    <div id="shoes-container">
                                        @php
                                            $shoes = old('shoes', json_decode($laundry->shoes, true) ?? []);
                                        @endphp

                                        @foreach ($shoes as $index => $shoe)
                                            <div class="shoe-entry mb-2 d-flex gap-2">
                                                <input type="text" name="shoes[{{ $index }}][merch]"
                                                    class="form-control" placeholder="Merch"
                                                    value="{{ $shoe['merch'] ?? '' }}" required>
                                                <input type="text" name="shoes[{{ $index }}][color]"
                                                    class="form-control" placeholder="Color"
                                                    value="{{ $shoe['color'] ?? '' }}" required>
                                                <button type="button" class="btn btn-danger btn-sm remove-shoe">X</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm mt-2" id="add-shoe">+ Add
                                        Shoe</button>
                                </div>
                            </div>



                            {{-- <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Shoe Merchandise</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="shoe_merch" name="shoe_merch"
                                        value="{{ old('shoe_merch', $laundry->shoe_merch) }}" required>
                                </div>
                                @error('shoe_merch')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Shoe Color</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="shoe_color" name="shoe_color"
                                        value="{{ old('shoe_color', $laundry->shoe_color) }}" required>
                                </div>
                                @error('shoe_color')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            @php
                                $services = [
                                    'Cuci Biasa',
                                    'Deep Clean',
                                    'Unyellowing',
                                    'Repaint',
                                    'Repair',
                                    'Fast Service (Express)',
                                ];
                                $payment_methods = ['Cash', 'Bayar Akhir', 'Transfer', 'Qris'];
                                $payment_statuses = ['Belum Bayar', 'Sudah Bayar'];
                                $working_statuses = ['Belum', 'On Progress', 'Finish'];
                            @endphp


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Service</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('service') is-invalid @enderror service-dropdown"
                                        name="service" required autocomplete="service" autofocus id="service">
                                        <option value="" disabled hidden> --- Select service ---
                                        </option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service }}"
                                                @if (old('service') == $service) selected @endif>{{ $service }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Address</label>
                                <div class="col-md-6">
                                    <textarea name="address" class="form-control" rows="4">{{ old('address', $laundry->address) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Price</label>
                                <div class="col-md-6">
                                    {{-- <input type="number" name="price" class="form-control" step="1000" --}}
                                    <input type="text" id="price" name="price" class="form-control"
                                        value="{{ old('price', $laundry->price) }}" required>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Payment Method</label>
                                <div class="col-md-6">
                                    <select name="payment_method" class="form-control" required>
                                        <option value="" disabled
                                            {{ old('payment_method', $laundry->payment_method ?? '') == '' ? 'selected' : '' }}>
                                            --- Choose Payment Method ---
                                        </option>
                                        @foreach ($payment_methods as $method)
                                            <option value="{{ $method }}"
                                                {{ old('payment_method', $laundry->payment_method ?? '') == $method ? 'selected' : '' }}>
                                                {{ $method }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Payment Status</label>
                                <div class="col-md-6">
                                    <select name="payment_status" class="form-control" required>
                                        <option value="" disabled
                                            {{ old('payment_status', $laundry->payment_status ?? '') == '' ? 'selected' : '' }}>
                                            --- Choose Payment status ---
                                        </option>
                                        @foreach ($payment_statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ old('payment_status', $laundry->payment_status ?? '') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Working Status</label>
                                <div class="col-md-6">
                                    <select name="working_status" class="form-control" required>
                                        <option value="" disabled
                                            {{ old('working_status', $laundry->working_status ?? '') == '' ? 'selected' : '' }}>
                                            --- Choose working status ---
                                        </option>
                                        @foreach ($working_statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ old('working_status', $laundry->working_status ?? '') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @foreach (['order_start' => 'Order Start', 'estimated' => 'Estimated Finish'] as $field => $label)
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
                                    <div class="col-md-6">
                                        <input type="date" name="{{ $field }}" class="form-control"
                                            value="{{ old($field, optional($laundry)->$field ? \Carbon\Carbon::parse($laundry->$field)->format('Y-m-d') : '') }}">
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Note</label>
                                <div class="col-md-6">
                                    <textarea name="note" class="form-control" rows="4">{{ old('note', $laundry->note) }}</textarea>
                                </div>
                                @error('note')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>


                            <button type="submit" class="mt-3 btn btn-primary">Update Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-shoe').addEventListener('click', function() {
            const container = document.getElementById('shoes-container');
            const index = container.querySelectorAll('.shoe-entry').length;
            const entry = document.createElement('div');
            entry.classList.add('shoe-entry', 'mb-2', 'd-flex', 'gap-2');

            entry.innerHTML = `
                <input type="text" name="shoes[${index}][merch]" class="form-control" placeholder="Merch" required>
                <input type="text" name="shoes[${index}][color]" class="form-control" placeholder="Color" required>
                <button type="button" class="btn btn-danger btn-sm remove-shoe">X</button>
            `;
            container.appendChild(entry);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-shoe')) {
                e.target.closest('.shoe-entry').remove();
            }
        });
    </script>


    <script>
        const priceField = document.getElementById('price');

        // Cegah penghapusan awalan Rp
        priceField.addEventListener('keydown', function(e) {
            const cursorPos = priceField.selectionStart;

            // Cegah backspace/delete jika di posisi "Rp "
            if ((e.key === 'Backspace' || e.key === 'Delete') && cursorPos <= 3) {
                e.preventDefault();
            }
        });

        // Format saat user mengetik
        priceField.addEventListener('input', function() {
            let value = priceField.value.replace(/[^0-9]/g, '');

            if (value === '') {
                priceField.value = 'Rp ';
                return;
            }

            const formatted = new Intl.NumberFormat('id-ID').format(parseInt(value));
            priceField.value = 'Rp ' + formatted;
        });

        // Format saat halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            let raw = priceField.value.replace(/[^0-9]/g, '');
            if (raw) {
                const formatted = new Intl.NumberFormat('id-ID').format(parseInt(raw));
                priceField.value = 'Rp ' + formatted;
            } else {
                priceField.value = 'Rp ';
            }
        });
    </script>

    <script>
        function cleanPrice() {
            const priceField = document.getElementById('price');
            // Ambil hanya angka
            priceField.value = priceField.value.replace(/[^0-9]/g, '');
            return true; // tetap lanjutkan submit
        }
    </script>




    <script>
        const phoneField = document.getElementById('phone_number');
        const phoneWarning = document.getElementById('phone_warning');

        phoneField.addEventListener('input', function(event) {
            let raw = phoneField.value;

            // Ambil hanya angka
            raw = raw.replace(/[^0-9]/g, '');

            // Hilangkan nol di depan jika ada
            raw = raw.replace(/^0+/, '');

            // Pastikan awalan 62
            if (!raw.startsWith('62')) {
                raw = '62' + raw;
            }

            // Ambil bagian nomor setelah '62'
            let numberPart = raw.substring(2);

            // Format jadi: +62 819-9919-5871
            let formatted = '+62';
            if (numberPart.length > 0) {
                formatted += ' ';
                if (numberPart.length <= 3) {
                    formatted += numberPart;
                } else if (numberPart.length <= 7) {
                    formatted += numberPart.substring(0, 3) + '-' + numberPart.substring(3);
                } else if (numberPart.length <= 11) {
                    formatted += numberPart.substring(0, 3) + '-' + numberPart.substring(3, 7) + '-' + numberPart
                        .substring(7);
                } else {
                    formatted += numberPart.substring(0, 3) + '-' + numberPart.substring(3, 7) + '-' + numberPart
                        .substring(7, 11);
                }
            }

            phoneField.value = formatted;

            // Validasi: hanya jika digit angka setelah +62 antara 9-12 digit (total 11-14 angka)
            const validLength = numberPart.length >= 9 && numberPart.length <= 17;
            phoneWarning.style.display = validLength ? 'none' : 'block';
        });

        // Tambah +62 saat halaman load jika kosong
        window.addEventListener('DOMContentLoaded', function() {
            if (!phoneField.value.startsWith('+62')) {
                phoneField.value = '+62 ';
            }
        });
    </script>
@endsection
