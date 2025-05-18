@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-9">
            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-sm mb-4 text-uppercase font-weight-bold">Cashout</h4>
                                    <h5 class="font-weight-bolder text-danger">
                                        {{-- Menampilkan total price --}}
                                        Rp {{ number_format($totalCashout, 2, ',', '.') }} {{-- Format angka dengan 2 desimal --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-sm mb-4 text-uppercase font-weight-bold">Total Order</h4>
                                    <h5 class="font-weight-bolder">
                                        {{ $laundryCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-sm mb-4 text-uppercase font-weight-bold">Income</h4>
                                    <h5 class="font-weight-bolder text-success">
                                        {{-- Menampilkan total price --}}
                                        Rp {{ number_format($totalPrice, 2, ',', '.') }} {{-- Format angka dengan 2 desimal --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-sm mb-4 text-uppercase font-weight-bold">Modal</h4>
                                    <h5 class="font-weight-bolder text-success">
                                        {{-- Menampilkan total price --}}
                                        Rp {{ number_format($totalInvest, 2, ',', '.') }} {{-- Format angka dengan 2 desimal --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-sm mb-4 text-uppercase font-weight-bold">Sisa Modal</h4>
                                    <h5 class="font-weight-bolder text-danger">
                                        {{-- Menampilkan total price --}}
                                        Rp {{ number_format($remainingInvest, 2, ',', '.') }} {{-- Format angka dengan 2 desimal --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-12">
                <div class="card">
                    <div class="card-header pb-2">
                        <h3 class="ml-5 mr-12 d-flex mb-2">Notes</h3>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row">
                            <!-- Left Column: Belum Selesai -->
                            <div class="col-md-6">
                                <h4 class="mt-1 ml-4 mb-2">Belum Selesai</h4>
                                <ul class="list-group mb-4">
                                    @forelse ($notes->where('status', 'belum selesai') as $note)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><strong>{{ $note->date }}</strong>: {{ $note->note }}</span>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ingin menyelesaikan ini?');"
                                                action="{{ route('maintenance.updateStatus', $note->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="px-3 py-1 text-white text-bold bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                                    Tandai Selesai
                                                </button>
                                            </form>
                                        </li>
                                    @empty
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tidak ada catatan maintenance yang belum selesai.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>

                            <!-- Right Column: Sudah Selesai -->
                            <div class="col-md-6">
                                <h4 class="mt-1 ml-4 mb-2">Sudah Selesai</h4>
                                <ul class="list-group mb-4">
                                    @forelse ($notes->where('status', 'selesai') as $note)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><strong>{{ $note->date }}</strong>: {{ $note->note }}</span>
                                            <span class="badge bg-green-500 text-white px-3 py-1 rounded-lg">Selesai</span>
                                        </li>
                                    @empty
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tidak ada catatan maintenance yang sudah selesai.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
@endsection
