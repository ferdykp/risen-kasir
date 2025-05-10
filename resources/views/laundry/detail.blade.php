<div class="bg-white p-6 rounded-lg shadow-md text-sm font-sans space-y-4">
    <div class="text-center border-b pb-4">
        <h2 class="text-xl font-bold text-gray-800">Nota Laundry</h2>
        <p class="text-gray-600">{{ \Carbon\Carbon::parse($laundry->order_start)->translatedFormat('d F Y') }}</p>
        <p class="text-xs text-gray-500">Order ID: {{ $laundry->order_id }}</p>
    </div>

    <div class="space-y-2">
        <h3 class="text-gray-700 font-semibold">Data Pelanggan</h3>
        <div class="flex justify-between">
            <span class="text-gray-600">Nama:</span>
            <span class="text-gray-900">{{ $laundry->customer_name }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">No. HP:</span>
            <span class="text-gray-900">{{ $laundry->phone_number }}</span>
        </div>
    </div>

    <div class="space-y-2">
        <h3 class="text-gray-700 font-semibold">Detail Pesanan</h3>
        <div class="flex justify-between">
            <span class="text-gray-600">Merk Sepatu:</span>
            <span class="text-gray-900">{{ $laundry->shoe_merch }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Warna Sepatu:</span>
            <span class="text-gray-900">{{ $laundry->shoe_color }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Layanan:</span>
            <span class="text-gray-900">{{ $laundry->service }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Catatan:</span>
            <span class="text-gray-900">{{ $laundry->note ?? '-' }}</span>
        </div>
    </div>

    <div class="space-y-2">
        <h3 class="text-gray-700 font-semibold">Status</h3>
        <div class="flex justify-between">
            <span class="text-gray-600">Metode Pembayaran:</span>
            <span class="text-gray-900">{{ ucfirst($laundry->payment_method) }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Status Pembayaran:</span>
            <span class="text-gray-900">{{ ucfirst($laundry->payment_status) }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Progress Pengerjaan:</span>
            <span class="text-gray-900">{{ ucfirst($laundry->working_status) }}</span>
        </div>
    </div>

    <div class="space-y-2">
        <h3 class="text-gray-700 font-semibold">Waktu</h3>
        <div class="flex justify-between">
            <span class="text-gray-600">Tanggal Masuk:</span>
            <span
                class="text-gray-900">{{ \Carbon\Carbon::parse($laundry->order_start)->translatedFormat('d F Y') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Estimasi Selesai:</span>
            <span
                class="text-gray-900">{{ \Carbon\Carbon::parse($laundry->estimated)->translatedFormat('d F Y') }}</span>
        </div>
        @if ($laundry->order_finish)
            <div class="flex justify-between">
                <span class="text-gray-600">Tanggal Selesai:</span>
                <span
                    class="text-gray-900">{{ \Carbon\Carbon::parse($laundry->order_finish)->translatedFormat('d F Y H:i') }}</span>
            </div>
        @endif
    </div>

    <div class="border-t pt-4 text-right">
        <div class="text-gray-600">Total Harga</div>
        <div class="text-xl font-bold text-gray-900">Rp {{ number_format($laundry->price, 0, ',', '.') }}</div>
    </div>
</div>
<!-- Tombol Kirim WhatsApp -->
<div class="pt-4 text-right">
    {{-- @php
        // $nomorWA = preg_replace('/^0/', '62', $laundry->phone_number);
        $nomorWA = preg_replace('/^0/', '', preg_replace('/\D/', '', $laundry->phone_number));

        $linkNota = route('laundry.print', $laundry->id);
        $pesanWA = urlencode(
            "Halo *{$laundry->customer_name}*, berikut adalah link nota laundry kamu:\n\n{$linkNota}\n\nTerima kasih telah menggunakan layanan kami!",
        );
        // $waUrl = "https://web.whatsapp.com/send?phone={$nomorWA}&text={$pesanWA}";
        $waUrl = "https://wa.me/{$nomorWA}?text={$pesanWA}";

    @endphp --}}
    {{-- @php
        use Illuminate\Support\Facades\Crypt;

        $encryptedId = Crypt::encrypt($laundry->id);
        $linkNota = route('laundry.print', $encryptedId);

        $pesanWA = urlencode(
            "Halo *{$laundry->customer_name}*, berikut adalah link nota laundry kamu:\n\n{$linkNota}\n\nTerima kasih telah menggunakan layanan kami!",
        );

        $nomorWA = preg_replace('/^0/', '', preg_replace('/\D/', '', $laundry->phone_number));
        $waUrl = "https://wa.me/{$nomorWA}?text={$pesanWA}";
    @endphp --}}
    @php
        use Vinkla\Hashids\Facades\Hashids;

        $hash = Hashids::encode($laundry->id);
        $linkNota = route('laundry.print', $hash);

        $pesanWA = urlencode(
            "Halo *{$laundry->customer_name}*, berikut adalah link nota laundry kamu:\n\n{$linkNota}\n\nTerima kasih telah menggunakan layanan kami!",
        );

        $nomorWA = preg_replace('/^0/', '', preg_replace('/\D/', '', $laundry->phone_number));
        $waUrl = "https://wa.me/{$nomorWA}?text={$pesanWA}";
    @endphp


    <a href="{{ $waUrl }}" target="_blank"
        class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition">
        Kirim ke WhatsApp
    </a>
    <a href="{{ route('laundry.print', $laundry->id) }}" target="_blank"
        class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition">
        Print / Simpan PDF
    </a>
</div>
