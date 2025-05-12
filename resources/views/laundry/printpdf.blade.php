<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Laundry - {{ $laundry->order_id }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @media print {
            @page {
                margin: 0;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                width: 58mm;
                font-family: monospace;
                font-size: 10px;
                background: white;
            }
        }

        body {
            font-family: monospace;
            font-size: 10px;
            background: white;
            padding: 0;
            margin: 0;
        }

        .nota {
            width: 58mm;
            margin: 0 auto;
            padding: 4px;
        }

        .center {
            text-align: center;
        }

        hr {
            border-top: 1px dashed #000;
            margin: 4px 0;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="nota">
        <div class="center">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/img/logo-risen.png') }}" style="width: 50px">
            </div>
            <strong>Risen+</strong><br>
            Cuci Sepatu Kediri<br>
            Jl. HM. Winarto<br>
            <i class="fab fa-instagram"></i> risenplus
        </div>

        <hr>

        <div class="flex-between"><span>Order ID:</span> <span>{{ $laundry->order_id }}</span></div>
        <div class="flex-between"><span>Pelanggan:</span> <span>{{ $laundry->customer_name }}</span></div>
        <div class="flex-between"><span>Tgl Pesan:</span>
            <span>{{ \Carbon\Carbon::parse($laundry->order_start)->format('d-m-Y') }}</span>
        </div>
        <div class="flex-between"><span>Estimasi:</span>
            <span>{{ \Carbon\Carbon::parse($laundry->estimated)->format('d-m-Y') }}</span>
        </div>

        <hr>

        <div class="center"><strong>--Promo Reopening--</strong></div>
        <br>
        <div><strong>{{ $laundry->service }}</strong></div>
        @if (!empty($shoes))
            @foreach ($shoes as $shoe)
                <li>{{ $shoe['merch'] }} - {{ $shoe['color'] }}</li>
            @endforeach
        @else
            <p>Tidak ada data sepatu.</p>
        @endif

        {{-- @if ($laundry->shoe_merch || $laundry->shoe_color)
            <div>{{ $laundry->shoe_merch }} - {{ $laundry->shoe_color }}</div>
        @endif --}}
        <div class="flex-between"><span>Harga:</span> <span>Rp {{ number_format($laundry->price, 0, ',', '.') }}</span>
        </div>

        <hr>

        <div class="flex-between"><span>Metode:</span> <span>{{ ucfirst($laundry->payment_method) }}</span></div>
        <div class="flex-between"><span>Status:</span>
            <span style="color:{{ $laundry->payment_status == 'paid' ? 'green' : 'red' }}">
                {{ $laundry->payment_status == 'paid' ? 'Lunas' : 'Belum' }}
            </span>
        </div>

        <hr>

        <div class="flex-between"><span>Catatan:</span> <span>{{ $laundry->note ?? '-' }}</span></div>

        <hr>

        <div class="center">Terima kasih telah menggunakan layanan kami</div>
    </div>
</body>

</html>
