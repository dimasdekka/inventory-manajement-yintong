<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\Barang;
use App\Models\Peminjaman;

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
        if ($this->app->environment('production') || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        View::composer('layouts.app', function ($view) {
            if (auth()->check()) {
                // Notifikasi Stok Minimum
                $notifStok = Barang::whereColumn('jumlah', '<=', 'stok_minimum')
                    ->with('kategori')
                    ->take(5)
                    ->get();

                // Notifikasi Peminjaman Aktif
                $notifPinjam = Peminjaman::where('status', 'dipinjam')
                    ->with(['barang', 'peminjam'])
                    ->latest()
                    ->take(5)
                    ->get();

                $totalNotif = $notifStok->count() + $notifPinjam->count();

                $view->with(compact('notifStok', 'notifPinjam', 'totalNotif'));
            }
        });
    }
}
