@echo off
title Starting Yintong Inventory System
color 0B
echo ======================================================================
echo          MENJALANKAN SISTEM INFORMASI INVENTORI YINTONG               
echo ======================================================================
echo.
echo Membuka Laravel Server (http://127.0.0.1:8000)...
echo Membuka Vite Dev Server...
echo.

:: 1. Jalankan Laravel Serve di jendela command prompt terpisah
start "Yintong Backend Server (Laravel)" cmd /k "php artisan serve"

:: 2. Jalankan Vite Dev Server di jendela command prompt terpisah
start "Yintong Frontend Assets (Vite)" cmd /k "npm run dev"

:: 3. Tunggu 3 detik lalu buka browser secara otomatis
timeout /t 3 /nobreak >nul
start http://127.0.0.1:8000

echo.
echo ======================================================================
echo APLIKASI SUDAH BERJALAN!
echo Alamat Lokal : http://127.0.0.1:8000
echo.
echo Catatan: Jangan tutup 2 jendela Command Prompt yang baru saja terbuka 
echo (Laravel Server & Vite Server) selama Anda menguji/menggunakan aplikasi.
echo ======================================================================
echo.
pause
