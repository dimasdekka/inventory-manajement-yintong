<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Yintong Inventory') }}</title>
    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfcfc;
            color: #111111;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            position: relative;
        }
        /* Geometric clean background accent */
        body::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 60%;
            height: 80%;
            background: radial-gradient(circle, rgba(230, 230, 230, 0.4) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: 1;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 60%;
            height: 80%;
            background: radial-gradient(circle, rgba(230, 230, 230, 0.4) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: 1;
        }
        .auth-container {
            z-index: 2;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        .auth-card {
            background-color: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 40px 35px;
            transition: all 0.3s ease;
        }
        .auth-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            border-color: #d5d5d5;
        }
        .auth-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #111111;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .auth-logo i {
            font-size: 24px;
        }
        .auth-subtitle {
            color: #666666;
            font-size: 14px;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-size: 13px;
            font-weight: 550;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #444444;
            margin-bottom: 6px;
        }
        .form-control {
            border: 1px solid #d5d5d5;
            border-radius: 6px;
            padding: 11px 15px;
            font-size: 14px;
            color: #111111;
            background-color: #fafafa;
            transition: all 0.2s ease-in-out;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #111111;
            box-shadow: none;
            color: #111111;
        }
        .btn-primary-custom {
            background-color: #111111;
            border: 1px solid #111111;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            padding: 12px;
            border-radius: 6px;
            width: 100%;
            transition: all 0.2s ease;
            font-size: 15px;
            letter-spacing: 0.5px;
        }
        .btn-primary-custom:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
        }
        .btn-primary-custom:active {
            background-color: #000000;
            border-color: #000000;
        }
        .input-group-text-custom {
            background-color: #fafafa;
            border: 1px solid #d5d5d5;
            border-left: none;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            cursor: pointer;
            color: #666666;
            transition: all 0.2s ease;
        }
        .input-group-text-custom:hover {
            color: #111111;
        }
        .form-control-has-group {
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .form-control-has-group:focus + .input-group-text-custom {
            border-color: #111111;
            background-color: #ffffff;
        }
        .alert-custom {
            border-radius: 6px;
            font-size: 13.5px;
            padding: 12px 15px;
            border: 1px solid #f5c2c2;
            background-color: #fdf2f2;
            color: #9b1c1c;
            margin-bottom: 20px;
        }
        .alert-success-custom {
            border-radius: 6px;
            font-size: 13.5px;
            padding: 12px 15px;
            border: 1px solid #def7ec;
            background-color: #f3faf7;
            color: #03543f;
            margin-bottom: 20px;
        }
        .copyright {
            font-size: 11px;
            color: #888888;
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
