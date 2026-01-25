<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Kota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .back-button a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-button a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-5px);
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .login-header i {
            font-size: 4rem;
            margin-bottom: 15px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .login-body {
            padding: 40px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
        }

        .demo-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
        }

        .demo-info h6 {
            color: #2563eb;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .demo-badge {
            display: inline-block;
            background: white;
            padding: 8px 15px;
            border-radius: 8px;
            margin: 5px;
            font-size: 0.85rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="back-button">
        <a href="{{ route('home') }}">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Beranda
        </a>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="bi bi-book-fill"></i>
                <h2 class="mb-0">Perpustakaan Kota</h2>
                <p class="mb-0 mt-2 opacity-75">Sistem Informasi Perpustakaan</p>
            </div>

            <div class="login-body">
                        @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px; border: 2px solid #e0e0e0;">
                                        <i class="bi bi-person-fill text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username') }}"
                                        placeholder="Masukkan username" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px; border: 2px solid #e0e0e0;">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukkan password" required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-login">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login Sekarang
                                </button>
                            </div>
                        </form>

                        <div class="demo-info">
                            <h6><i class="bi bi-info-circle-fill me-2"></i>Akun Demo</h6>
                            <div class="d-flex flex-wrap">
                                <span class="demo-badge">admin / password</span>
                                <span class="demo-badge">staff / password</span>
                                <span class="demo-badge">staffstock / password</span>
                                <span class="demo-badge">budi / password</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="text-muted mb-2">Belum punya akun?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-person-plus me-2"></i>
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 text-white">
                    <small>&copy; 2026 Perpustakaan Kota. UAS Pengolahan Basis Data</small>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>