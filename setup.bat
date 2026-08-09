@echo off
title Setup Yintong Inventory System
color 0A
echo ======================================================================
echo          YINTONG INVENTORY SYSTEM - INSTANT SETUP SCRIPT              
echo ======================================================================
echo.

:: ----------------------------------------------------------------------
:: 1. AUTO-DETECT & SETUP PHP
:: ----------------------------------------------------------------------
set "PHP_CMD=php"
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [1/7] PHP tidak terdeteksi di System PATH. Mencari lokasi PHP Laragon / XAMPP...
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

"%PHP_CMD%" -v >nul 2>&1
if %errorlevel% neq 0 (
    echo.
    echo [ERROR CRITICAL] PHP tidak ditemukan di sistem ini!
    echo Pastikan Laragon atau XAMPP sudah terinstal di Drive C, D, E, atau F.
    echo.
    pause
    exit /b 1
)
echo [OK] PHP terdeteksi.

:: ----------------------------------------------------------------------
:: 2. AUTO-DETECT & AUTO-DOWNLOAD COMPOSER
:: ----------------------------------------------------------------------
echo.
echo [2/7] Memeriksa ketersediaan Composer...
set "COMPOSER_CMD=composer"
where composer >nul 2>&1
if %errorlevel% neq 0 (
    for %%D in (C D E F) do (
        if exist "%%D:\laragon\bin\composer\composer.bat" set "COMPOSER_CMD=%%D:\laragon\bin\composer\composer.bat"
        if exist "%%D:\laragon\bin\composer\composer.phar" set "COMPOSER_CMD="%PHP_CMD%" %%D:\laragon\bin\composer\composer.phar"
    )
    if exist "C:\ProgramData\ComposerSetup\bin\composer.bat" set "COMPOSER_CMD=C:\ProgramData\ComposerSetup\bin\composer.bat"
)

:: Pengujian Composer
call %COMPOSER_CMD% --version >nul 2>&1
if %errorlevel% neq 0 (
    if exist composer.phar (
        set "COMPOSER_CMD="%PHP_CMD%" composer.phar"
    ) else (
        echo [INFO] Perintah 'composer' tidak ditemukan di Windows.
        echo [INFO] Mengunduh composer.phar secara otomatis untuk Anda...
        powershell -Command "[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12; (New-Object Net.WebClient).DownloadFile('https://getcomposer.org/composer.phar', 'composer.phar')"
        if exist composer.phar (
            set "COMPOSER_CMD="%PHP_CMD%" composer.phar"
            echo [OK] composer.phar berhasil diunduh otomatis!
        ) else (
            echo.
            echo [ERROR] Gagal mengunduh composer.phar secara otomatis.
            echo Silakan buka Terminal Laragon lalu ketik: composer install
            pause
            exit /b 1
        )
    )
)
echo [OK] Composer siap digunakan.

:: ----------------------------------------------------------------------
:: 3. AUTO-DETECT NODE / NPM
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
    )
)

:: ----------------------------------------------------------------------
:: 4. MEMASANG DEPENDENCY & PROSES PROJEK
:: ----------------------------------------------------------------------
if not exist .env (
    echo.
    echo [3/7] Menyalin .env.example ke .env...
    copy .env.example .env
) else (
    echo.
    echo [3/7] File .env sudah ada.
)

echo.
echo [4/7] Menginstal dependency PHP via Composer...
call %COMPOSER_CMD% install --no-interaction --prefer-dist --ignore-platform-reqs
if %errorlevel% neq 0 (
    echo [ERROR] Composer install mengalami kegagalan.
    pause
    exit /b %errorlevel%
)

echo.
echo [5/7] Menginstal dependency JavaScript via NPM...
call npm install
if %errorlevel% neq 0 (
    echo [ERROR] NPM install mengalami kegagalan. Pastikan Node.js terinstal.
    pause
    exit /b %errorlevel%
)

echo.
echo [6/7] Membuat Encryption Key & Storage Link...
call "%PHP_CMD%" artisan key:generate --force
call "%PHP_CMD%" artisan storage:link --quiet

echo.
echo [7/7] Mem-build asset frontend dengan Vite...
call npm run build

:: ----------------------------------------------------------------------
:: 5. MIGRASI DATABASE
:: ----------------------------------------------------------------------
echo.
echo ======================================================================
echo                      PERSIAPAN DATABASE MYSQL                         
echo ======================================================================
echo Pastikan server MySQL di Laragon / XAMPP sudah RUNNING (Start All)!
echo Nama database pada file .env: inventori_kantor
echo.
set /p run_migration="Apakah Anda ingin menjalankan migrasi database & data awal (seed) sekarang? (Y/N): "
if /i "%run_migration%"=="Y" (
    echo.
    echo Menjalankan php artisan migrate:fresh --seed...
    call "%PHP_CMD%" artisan migrate:fresh --seed
)

echo.
echo ======================================================================
echo          SETUP SELESAI & BERHASIL DILAKUKAN!                         
echo ======================================================================
echo Sekarang Anda dapat menjalankan 'start.bat' untuk membuka aplikasi.
echo.
pause
