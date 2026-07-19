<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class BarcodeService
{
    /**
     * Generate QR Code dari Kode Barang dan simpan ke storage.
     * Mengembalikan path relatif untuk disimpan di database.
     */
    public function generateQRCode(string $kodeBarang): string
    {
        $fileName = 'qrcode_' . $kodeBarang . '.svg';
        $directory = 'public/barcodes';
        
        // Buat direktori jika belum ada
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $path = $directory . '/' . $fileName;

        // Generate QR code content as SVG
        $qrCodeContent = QrCode::format('svg')
            ->size(200)
            ->margin(1)
            ->generate($kodeBarang);

        Storage::put($path, $qrCodeContent);

        // Path relatif untuk asset() di Laravel setelah storage link dibuat
        return 'storage/barcodes/' . $fileName;
    }
}
