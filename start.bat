@echo off
title Starting Yintong Inventory System
color 0B
echo ======================================================================
echo          MENJALANKAN SISTEM INFORMASI INVENTORI YINTONG               
echo ======================================================================
echo.

:: ----------------------------------------------------------------------
:: 1. AUTO-DETECT PHP EXECUTABLE
:: ----------------------------------------------------------------------
set "PHP_CMD=php"
where php >nul 2>&1
if %errorlevel% neq 0 (
    for %%D in (C D E F) do (
        if exist "%%D:\laragon\bin\php" (
            for /d %%P in ("%%D:\laragon\bin\php\php-*") do (
                if exist "%%P\php.exe" (
                    set "PHP_CMD=%%P\php.exe"
                    set "PATH=%%P;%PATH%"
                )
            )
        )
        if exist "%%D:\xampp\php\php.exe" (
            set "PHP_CMD=%%D:\xampp\php\php.exe"
            set "PATH=%%D:\xampp\php;%PATH%"
        )
    )
)

:: ----------------------------------------------------------------------
:: 2. AUTO-DETECT NODE / NPM
:: ----------------------------------------------------------------------
where npm >nul 2>&1
if %errorlevel% neq 0 (
    for %%D in (C D E F) do (
        if exist "%%D:\laragon\bin\nodejs" (
            for /d %%N in ("%%D:\laragon\bin\nodejs\node-*") do (
                if exist "%%N\npm.cmd" set "PATH=%%N;%PATH%"
            )
        )
        if exist "C:\Program Files\nodejs\npm.cmd" set "PATH=C:\Program Files\nodejs;%PATH%"
        if exist "C:\Program Files (x86)\nodejs\npm.cmd" set "PATH=C:\Program Files (x86)\nodejs;%PATH%"
    )
)

:: ----------------------------------------------------------------------
:: 3. PERIKSA APAKAH NODE_MODULES SUDAH ADA
:: ----------------------------------------------------------------------
if not exist node_modules (
    echo [INFO] Folder node_modules belum ada. Menginstal dependency NPM otomatis...
    call npm install
)

echo.
echo Membuka Laravel Server (http://127.0.0.1:8000)...
echo Membuka Vite Dev Server...
echo.

:: 1. Jalankan Laravel Serve di jendela command prompt terpisah
start "Yintong Backend Server (Laravel)" cmd /k ""%PHP_CMD%" artisan serve"

:: 2. Jalankan Vite Dev Server jika npm tersedia
where npm >nul 2>&1
if %errorlevel% equ 0 (
    start "Yintong Frontend Assets (Vite)" cmd /k "npm run dev"
)

:: 3. Tunggu 3 detik lalu buka browser secara otomatis
timeout /t 3 /nobreak >nul
start http://127.0.0.1:8000

echo.
echo ======================================================================
echo APLIKASI SUDAH BERJALAN!
echo Alamat Lokal : http://127.0.0.1:8000
echo.
echo Catatan: Jangan tutup jendela Command Prompt yang terbuka 
echo (Laravel Server & Vite Server) selama Anda menguji/menggunakan aplikasi.
echo ======================================================================
echo.
pause
