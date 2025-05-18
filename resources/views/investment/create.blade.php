@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="w-100 w-md-auto ">
                            <h4 class="">Invest</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('investment.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Investor</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_invest" class="col-md-4 col-form-label text-md-right">Tanggal Pembelian
                                </label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('date_invest') is-invalid @enderror"
                                        name="date_invest" value="{{ old('date_invest') }}" required
                                        autocomplete="date_invest" autofocus>
                                    @error('date_invest')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="invest" class="col-md-4 col-form-label text-md-right">
                                    Jumlah Invest</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('invest') is-invalid @enderror"
                                        name="invest" id="invest" value="{{ old('invest') }}" required
                                        autocomplete="invest" autofocus>
                                    @error('invest')
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
        const priceField = document.getElementById('invest');

        // Fungsi untuk membersihkan format Rp dan mengambil angka murni
        function cleanRp(value) {
            return parseInt(value.replace(/[^0-9]/g, '')) || 0;
        }

        // Format angka menjadi Rp saat user mengetik
        priceField.addEventListener('input', function() {
            let value = priceField.value.replace(/[^0-9]/g, '');

            if (value === '') {
                priceField.value = 'Rp ';
                return;
            }

            const formatted = new Intl.NumberFormat('id-ID').format(parseInt(value));
            priceField.value = 'Rp ' + formatted;

            // Memastikan kursor tetap di akhir input
            setTimeout(() => {
                priceField.selectionStart = priceField.selectionEnd = priceField.value.length;
            }, 0);
        });

        // Mencegah penghapusan "Rp " di awal input
        priceField.addEventListener('keydown', function(e) {
            const cursorPos = priceField.selectionStart;
            if ((e.key === 'Backspace' || e.key === 'Delete') && cursorPos <= 3) {
                e.preventDefault();
            }
        });

        // Format saat halaman pertama dimuat
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
@endsection
