<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Laundry - {{ $laundry->order_id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan ini di bagian <head> -->
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

<body class="bg-gray-200 min-h-screen flex items-center justify-center p-4">

    <div class="w-[360px] bg-white shadow-md rounded-b-2xl border relative">
        <!-- Sobekan Atas -->
        <div
            class="h-4 bg-white relative overflow-hidden before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[radial-gradient(circle,_white_5px,_transparent_6px)] before:bg-repeat-x before:bg-[length:16px_16px] before:-top-3">
        </div>

        <!-- Isi Nota -->
        <div class="p-4 font-mono text-xs text-gray-800">
            <div class="text-center mb-3">
                <h2 class="text-base font-bold">Risen+</h2>
                <h3>Cuci Sepatu Kediri</h3>
                <p>
                    <i class="fab fa-instagram"></i>: risenplus
                </p>
            </div>


            {{-- <div class="flex justify-center mb-2">
                <img src="data:image/png;base64,{{ $qr }}" alt="QR Code" class="w-24 h-24">
            </div> --}}

            <div class="mb-3">
                <div class="flex justify-between"><span>Order ID:</span> <span>{{ $laundry->order_id }}</span></div>
                <div class="flex justify-between"><span>Pelanggan:</span> <span>{{ $laundry->customer_name }}</span>
                </div>
                {{-- <div class="flex justify-between"><span>HP:</span> <span>{{ $laundry->phone_number }}</span></div> --}}
                <div class="flex justify-between"><span>Tgl Pesan:</span>
                    <span>{{ \Carbon\Carbon::parse($laundry->order_start)->format('d-m-Y') }}</span>
                </div>
                <div class="flex justify-between"><span>Estimasi:</span>
                    <span>{{ \Carbon\Carbon::parse($laundry->estimated)->format('d-m-Y') }}</span>
                </div>
            </div>

            <hr class="my-2 border-dashed">

            <div class="mb-2">
                <center><strong>
                        <h1>--Promo Reopening--</h1>
                        <br>
                    </strong></center>
                <strong>{{ $laundry->service }}</strong>
                @if ($laundry->shoe_merch || $laundry->shoe_color)
                    <p class="text-gray-600">{{ $laundry->shoe_merch }} - {{ $laundry->shoe_color }}</p>
                @endif
                <div class="flex justify-between">
                    <span>Harga:</span>
                    <span>Rp {{ number_format($laundry->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <hr class="my-2 border-dashed">

            <div class="mb-2">
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

            <hr class="my-2 border-dashed">

            <div class="mb-2">
                <div class="flex justify-between"><span>Catatan:</span> <span>{{ $laundry->note ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Status:</span>
                    <span>{{ ucfirst($laundry->working_status) }}</span>
                </div>
                {{-- <div class="flex justify-between"><span>Selesai:</span>
                    <span>{{ $laundry->order_finish ? \Carbon\Carbon::parse($laundry->order_finish)->format('d-m-Y H:i') : '-' }}</span>
                </div> --}}
            </div>

            <hr class="my-2 border-dashed">

            <div class="text-center text-[10px] text-gray-400">
                Terima kasih telah menggunakan layanan kami
            </div>
        </div>
    </div>

    <script>
        window.onload = () => {
            window.print();
        };
    </script>


</body>

</html>
