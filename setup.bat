@echo off
title Setup Yintong Inventory System
color 0A
echo ======================================================================
echo          YINTONG INVENTORY SYSTEM - INSTANT SETUP SCRIPT              
echo ======================================================================
echo.

:: 1. Copy file .env jika belum ada
if not exist .env (
    echo [1/6] Menyalin .env.example ke .env...
    copy .env.example .env
    echo [OK] File .env berhasil dibuat.
) else (
    echo [1/6] File .env sudah ada.
)

:: 2. Composer Dependencies (PHP)
echo.
echo [2/6] Menginstal dependency PHP via Composer...
call composer install --no-interaction --prefer-dist
if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Composer install gagal! 
    echo Pastikan PHP dan Composer sudah terinstal dan terdaftar di PATH environment variables.
    pause
    exit /b %errorlevel%
)

:: 3. NPM Dependencies (JavaScript)
echo.
echo [3/6] Menginstal dependency JavaScript via NPM...
call npm install
if %errorlevel% neq 0 (
    echo.
    echo [ERROR] NPM install gagal! 
    echo Pastikan Node.js dan NPM sudah terinstal.
    pause
    exit /b %errorlevel%
)

:: 4. Generate App Key Laravel
echo.
echo [4/6] Membuat Application Encryption Key Laravel...
call php artisan key:generate --force

:: 5. Storage Link
echo.
echo [5/6] Membuat link simbolik folder storage upload...
call php artisan storage:link --quiet

:: 6. Build Assets Vite
echo.
echo [6/6] Mem-build asset frontend dengan Vite...
call npm run build

:: Inisialisasi Database
echo.
echo ======================================================================
echo                      PERSIAPAN DATABASE MYSQL                         
echo ======================================================================
echo Pastikan server MySQL (XAMPP / Laragon / MariaDB) sudah RUNNING!
echo Nama database pada file .env: inventori_kantor
echo.
set /p run_migration="Apakah Anda ingin menjalankan migrasi database & data awal (seed) sekarang? (Y/N): "
if /i "%run_migration%"=="Y" (
    echo.
    echo Menjalankan php artisan migrate:fresh --seed...
    call php artisan migrate:fresh --seed
)

echo.
echo ======================================================================
echo          SETUP SELESAI & BERHASIL DILAKUKAN!                         
echo ======================================================================
echo Sekarang Anda dapat menjalankan 'start.bat' untuk membuka aplikasi.
echo.
pause
