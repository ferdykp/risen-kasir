<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Laundry - {{ $laundry->order_id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            html,
            body {
                width: 100%;
                height: 100%;
            }
        }
    </style>
</head>

<body class="bg-gray-600 min-h-screen flex items-center justify-center p-4 sm:p-6 relative">
    <!-- Background -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/img/bg-risen.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
    </div>

    <!-- Nota Container -->
    <div
        class="w-full max-w-[65%] lg:max-w-md min-h-[50vh] lg:min-h-fit bg-white shadow-md rounded-[20px] border relative z-10 text-sm sm:text-base">
        <!-- Sobekan Atas -->
        {{-- <div
            class="h-4 bg-white relative overflow-hidden before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[radial-gradient(circle,_white_5px,_transparent_6px)] before:bg-repeat-x before:bg-[length:16px_16px] before:-top-3">
        </div> --}}

        <!-- Isi Nota -->
        <div class="p-5 font-mono text-gray-800">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/img/logo-risen.png') }}" class="w-24 sm:w-32">
            </div>
            <div class="text-center mb-4">
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold">Risen+</h2>
                <h3 class="text-sm sm:text-base md:text-lg">Cuci Sepatu Kediri</h3>
                <p class="text-sm sm:text-base md:text-lg">Jl. HML Winarto</p>
                <p class="text-sm sm:text-base md:text-lg"><i class="fab fa-instagram"></i>: risenplus</p>
            </div>

            <div class="mb-3 space-y-1">
                <div class="flex justify-between"><span>Order ID:</span> <span>{{ $laundry->order_id }}</span></div>
                <div class="flex justify-between"><span>Pelanggan:</span> <span>{{ $laundry->customer_name }}</span>
                </div>
                <div class="flex justify-between"><span>Tgl Pesan:</span>
                    <span>{{ \Carbon\Carbon::parse($laundry->order_start)->format('d-m-Y') }}</span>
                </div>
                <div class="flex justify-between"><span>Estimasi:</span>
                    <span>{{ \Carbon\Carbon::parse($laundry->estimated)->format('d-m-Y') }}</span>
                </div>
            </div>

            <hr class="my-3 border-dashed">

            <div class="mb-3">
                <div class="text-center font-bold mb-2">
                    <h1 class="text-base">-- Promo Reopening --</h1>
                </div>
                <strong>{{ $laundry->service }}</strong>
                {{-- @if ($laundry->shoe_merch || $laundry->shoe_color)
                    <p class="text-gray-600">{{ $laundry->shoe_merch }} - {{ $laundry->shoe_color }}</p>
                @endif --}}
                @if (!empty($shoes))
                    <ul>
                        @foreach ($shoes as $shoe)
                            <li>{{ $shoe['merch'] }} - {{ $shoe['color'] }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada data sepatu.</p>
                @endif

                <div class="flex justify-between mt-1">
                    <span>Harga:</span>
                    <span>Rp {{ number_format($laundry->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <hr class="my-3 border-dashed">

            <div class="mb-3 space-y-1">
                <div class="flex justify-between"><span>Metode Bayar:</span>
                    <span>{{ ucfirst($laundry->payment_method) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Status Bayar:</span>
                    <span class="{{ $laundry->payment_status == 'paid' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $laundry->payment_status == 'paid' ? 'Lunas' : 'Belum' }}
                    </span>
                </div>
            </div>

            <hr class="my-3 border-dashed">

            <div class="mb-3">
                <div class="flex justify-between"><span>Catatan:</span> <span>{{ $laundry->note ?? '-' }}</span></div>
            </div>

            <!-- Status Pesanan -->
            <!--<hr class="my-3 border-dashed">-->

            <!--<div class="mb-3 space-y-1">-->
            <!--    <h4 class="font-semibold text-center mb-1">Status Pesanan</h4>-->
            <!--    <div class="flex justify-between"><span>Dibuat:</span>-->
            <!--        <span>{{ \Carbon\Carbon::parse($laundry->created_at)->format('d-m-Y H:i') }}</span>-->
            <!--    </div>-->
            <!--    <div class="flex justify-between"><span>Diproses:</span>-->
            <!--        <span>{{ $laundry->processed_at ? \Carbon\Carbon::parse($laundry->updated_at)->format('d-m-Y H:i') : '-' }}</span>-->
            <!--    </div>-->
            <!--    <div class="flex justify-between"><span>Selesai:</span>-->
            <!--        <span>{{ $laundry->finished_at ? \Carbon\Carbon::parse($laundry->finished_at)->format('d-m-Y H:i') : '-' }}</span>-->
            <!--    </div>-->
            <!--</div>-->

            <hr class="my-3 border-dashed">

            <div class="text-center text-xs text-gray-400">
                Terima kasih telah menggunakan layanan kami
            </div>

        </div>
    </div>
</body>

</html>
