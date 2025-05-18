<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Laundry;
use App\Models\Purchase;
use App\Models\Investment;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            // Query untuk masing-masing tabel
            $laundryQuery = Laundry::query();
            $purchaseQuery = Purchase::query();
            $investmentQuery = Investment::query();

            // Hitung total price
            $totalPrice = $laundryQuery->sum('price'); // Menghitung jumlah total price
            $totalCashout = $purchaseQuery->sum('total_price');
            $totalInvest = $investmentQuery->sum('invest');

            // Hitung selisih invest dan cashout
            $remainingInvest = $totalInvest - $totalCashout;




            // Hitung total data untuk masing-masing kategori
            $dataCounts = [
                'laundryCount' => $laundryQuery->count(),
                'totalPrice' => $totalPrice, // Menambahkan total price ke data
                'totalCashout' => $totalCashout,
                'totalInvest' => $totalInvest,
                'remainingInvest' => $remainingInvest, // Tambahan variabel baru



            ];

            // Kirim semua data ke view
            $view->with($dataCounts);
        });

    }
}
