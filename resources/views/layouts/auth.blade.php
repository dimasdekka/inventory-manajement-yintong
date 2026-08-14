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
        :root {
            --navy-primary: #0F2942;
            --navy-hover: #1E3A5F;
            --bg-app: #F8FAFC;
            --border-color: #E2E8F0;
            --text-main: #0F172A;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            position: relative;
        }
        /* Soft geometric background accent */
        body::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 60%;
            height: 80%;
            background: radial-gradient(circle, rgba(15, 41, 66, 0.04) 0%, rgba(248, 250, 252, 0) 70%);
            z-index: 1;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 60%;
            height: 80%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.04) 0%, rgba(248, 250, 252, 0) 70%);
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
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            padding: 40px 35px;
            transition: all 0.3s ease;
        }
        .auth-card:hover {
            box-shadow: 0 14px 40px rgba(15, 23, 42, 0.07);
            border-color: #CBD5E1;
        }
        .auth-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--navy-primary);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .auth-subtitle {
            color: var(--text-muted);
            font-size: 13.5px;
            text-align: center;
            margin-bottom: 24px;
        }
        .form-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 11px 15px;
            font-size: 14px;
            color: var(--text-main);
            background-color: #F8FAFC;
            transition: all 0.2s ease-in-out;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--navy-primary);
            box-shadow: 0 0 0 3px rgba(15, 41, 66, 0.1);
            color: var(--text-main);
        }
        .btn-primary-custom {
            background-color: var(--navy-primary);
            border: 1px solid var(--navy-primary);
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            transition: all 0.2s ease;
            font-size: 14.5px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 14px rgba(15, 41, 66, 0.2);
            cursor: pointer;
        }
        .btn-primary-custom:hover {
            background-color: var(--navy-hover);
            border-color: var(--navy-hover);
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 41, 66, 0.28);
        }
        .input-group-text-custom {
            background-color: #F8FAFC;
            border: 1px solid var(--border-color);
            border-left: none;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            cursor: pointer;
            color: var(--text-muted);
            padding: 0 14px;
            display: flex;
            align-items: center;
        }
        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .form-check-input:checked {
            background-color: var(--navy-primary);
            border-color: var(--navy-primary);
        }
        .alert-custom {
            font-size: 13px;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 20px;
            background-color: #FEF2F2;
            border: 1px solid #FEE2E2;
            color: #991B1B;
        }
        .alert-success-custom {
            font-size: 13px;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 20px;
            background-color: #F0FDF4;
            border: 1px solid #DCFCE7;
            color: #166534;
        }
        .copyright {
            margin-top: 25px;
            font-size: 12px;
            color: #94A3B8;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle visibility
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    if (eyeIcon) {
                        eyeIcon.classList.toggle('fa-eye');
                        eyeIcon.classList.toggle('fa-eye-slash');
                    }
                });
            }
        });
    </script>
</body>
</html>
