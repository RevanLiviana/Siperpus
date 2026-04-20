<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiPerpus - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            background: linear-gradient(135deg, #e94560, #c73652);
            padding: 35px 30px;
            text-align: center;
            color: #fff;
        }

        .login-header h3 {
            font-weight: 700;
            margin: 10px 0 5px;
        }

        .login-header p {
            margin: 0;
            opacity: 0.85;
            font-size: 14px;
        }

        .login-body {
            padding: 35px 30px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #444;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1.5px solid #e0e0e0;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #e94560;
            box-shadow: 0 0 0 3px rgba(233,69,96,0.15);
        }

        .input-group .form-control {
            border-right: none;
        }

        .input-group-text {
            background: #fff;
            border: 1.5px solid #e0e0e0;
            border-left: none;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            color: #aaa;
        }

        .btn-login {
            background: linear-gradient(135deg, #e94560, #c73652);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 15px;
            color: #fff;
            width: 100%;
            transition: opacity 0.2s;
        }

        .btn-login:hover {
            opacity: 0.9;
            color: #fff;
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <i class="bi bi-book-half" style="font-size: 2.5rem;"></i>
        <h3>SiPerpus</h3>
        <p>Sistem Informasi Perpustakaan</p>
    </div>

    <div class="login-body">
        <h5 class="fw-bold mb-1">Selamat Datang!</h5>
        <p class="text-muted mb-4" style="font-size:13px;">Silakan login untuk melanjutkan</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="email@siperpus.com"
                    autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="passwordInput"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password">
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-muted" for="remember" style="font-size:13px;">
                        Ingat saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </form>

        <div class="footer-text">
            &copy; {{ date('Y') }} SiPerpus. All rights reserved.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
</body>
</html>