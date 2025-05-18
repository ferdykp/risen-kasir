@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="w-100 w-md-auto">
                            <h4 class="">Add Order</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('laundry.store') }}" enctype="multipart/form-data"
                            onsubmit="return cleanPrice()">
                            @csrf

                            @php
                                $services = [
                                    'Cuci Biasa',
                                    'Deep Clean',
                                    'Unyellowing',
                                    'Repaint',
                                    'Repair',
                                    'Fast Service (Express)',
                                ];
                                $payment_methods = ['Cash', 'Qris', 'Bayar Akhir'];
                                $payment_statuses = ['Belum Bayar', 'Sudah Bayar'];
                                $working_statuses = ['On Progress', 'Finish'];
                            @endphp

                            {{-- Order ID --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Order ID</label>
                                <div class="col-md-6">
                                    <input type="text" name="order_id" class="form-control" value="{{ $order_id }}"
                                        readonly>
                                </div>
                            </div>

                            {{-- Customer Name --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Customer Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="customer_name" class="form-control"
                                        value="{{ old('customer_name') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                <div class="col-md-6">
                                    {{-- <input type="text" id="phone_number" name="phone_number" class="form-control"
                                        value="{{ old('phone_number') }}" maxlength="15" placeholder="Enter phone number"> --}}
                                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', '+62 ') }}" placeholder="Enter phone number">

                                    <small id="phone_warning" class="text-danger" style="display: none;">Format Phone Number
                                        not Valid</small>
                                </div>
                            </div>

                            {{-- Shoe Merch --}}
                            {{-- <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Shoe Merchandise</label>
                                <div class="col-md-6">
                                    <input type="text" name="shoe_merch" class="form-control"
                                        value="{{ old('shoe_merch') }}">
                                </div>
                            </div> --}}

                            {{-- Shoe Color --}}
                            {{-- <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Shoe Color</label>
                                <div class="col-md-6">
                                    <input type="text" name="shoe_color" class="form-control"
                                        value="{{ old('shoe_color') }}">
                                </div>
                            </div> --}}
                            {{-- Shoe Items --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Shoes</label>
                                <div class="col-md-6">
                                    <div id="shoes-container">
                                        {{-- Tampilkan 1 baris input kosong saat create --}}
                                        <div class="shoe-entry mb-2 d-flex gap-2">
                                            <input type="text" name="shoes[0][merch]" class="form-control"
                                                placeholder="Merch" value="{{ old('shoes.0.merch') }}" required>
                                            <input type="text" name="shoes[0][color]" class="form-control"
                                                placeholder="Color" value="{{ old('shoes.0.color') }}" required>
                                            <button type="button" class="btn btn-danger btn-sm remove-shoe"
                                                style="margin: auto">X</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm mt-2" id="add-shoe">+
                                        Add
                                        Shoe</button>
                                </div>
                            </div>



                            {{-- Service --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Service</label>
                                <div class="col-md-6">
                                    <select name="service" class="form-control">
                                        <option value="" disabled selected>--- Choose Service ---</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service }}"
                                                @if (old('service') == $service) selected @endif>{{ $service }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Address</label>
                                <div class="col-md-6">
                                    <textarea name="address" class="form-control" rows="4">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Price</label>
                                <div class="col-md-6">
                                    {{-- <input type="number" name="price" class="form-control" step="1000" --}}
                                    <input type="text" id="price" name="price" class="form-control"
                                        value="{{ old('price', 'Rp ') }}">

                                    {{-- value="{{ old('price') }}"> --}}
                                </div>
                            </div>


                            {{-- Payment Method --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Payment Method</label>
                                <div class="col-md-6">
                                    <select name="payment_method" class="form-control">
                                        <option value="" disabled selected>--- Choose Payment Method ---</option>
                                        @foreach ($payment_methods as $method)
                                            <option value="{{ $method }}"
                                                @if (old('payment_method') == $method) selected @endif>{{ $method }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Payment Status --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Payment Status</label>
                                <div class="col-md-6">
                                    <select name="payment_status" class="form-control">
                                        <option value="" disabled selected>--- Choose Payment Status ---</option>
                                        @foreach ($payment_statuses as $status)
                                            <option value="{{ $status }}"
                                                @if (old('payment_status') == $status) selected @endif>{{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Working Status --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Working Status</label>
                                <div class="col-md-6">
                                    <select name="working_status" class="form-control">
                                        <option value="" disabled selected>--- Choose Working Status ---</option>
                                        @foreach ($working_statuses as $status)
                                            <option value="{{ $status }}"
                                                @if (old('working_status') == $status) selected @endif>{{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Dates --}}
                            {{-- @foreach (['order_start' => 'Order Start', 'estimated' => 'Estimated Finish', 'order_finish' => 'Order Finish'] as $field => $label)
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
                                    <div class="col-md-6">
                                        <input type="date" name="{{ $field }}" class="form-control"
                                            value="{{ old($field) }}">
                                    </div>
                                </div>
                            @endforeach --}}

                            @foreach (['order_start' => 'Order Start', 'estimated' => 'Estimated Finish'] as $field => $label)
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
                                    <div class="col-md-6">
                                        <input type="date" name="{{ $field }}" class="form-control"
                                            value="{{ old($field) }}">
                                    </div>
                                </div>
                            @endforeach


                            {{-- Note --}}
                            {{-- Note --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Note</label>
                                <div class="col-md-6">
                                    <textarea name="note" class="form-control" rows="4">{{ old('note') }}</textarea>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Real-time validation for phone number
        document.getElementById('phone_number').addEventListener('input', function(event) {
            const phoneField = event.target;
            const phoneWarning = document.getElementById('phone_warning');
            const value = phoneField.value;

            // Remove non-numeric and allowed characters
            phoneField.value = value.replace(/[^0-9\+\-\(\)\s]/g, '');

            // Validate the phone number format
            const phoneRegex = /^\+?[0-9\s\-\(\)]{10,15}$/;
            if (!phoneRegex.test(phoneField.value)) {
                phoneWarning.style.display = 'block'; // Show warning
            } else {
                phoneWarning.style.display = 'none'; // Hide warning
            }
        });
    </script> --}}

    <script>
        let shoeIndex = 1;

        document.getElementById('add-shoe').addEventListener('click', function() {
            const container = document.getElementById('shoes-container');

            const div = document.createElement('div');
            div.classList.add('shoe-entry', 'mb-2', 'd-flex', 'gap-2');
            div.innerHTML = `
                <input type="text" name="shoes[${shoeIndex}][merch]" class="form-control" placeholder="Merch" required>
                <input type="text" name="shoes[${shoeIndex}][color]" class="form-control" placeholder="Color" required>
                <button type="button" class="btn btn-danger btn-sm remove-shoe">X</button>
            `;

            container.appendChild(div);
            shoeIndex++;
        });

        // Remove shoe entry
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
