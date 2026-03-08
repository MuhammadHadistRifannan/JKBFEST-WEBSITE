<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>Admin Login - JKB Fest 2026</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4A154D 0%, #D81E76 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-wrapper {
            background-color: #FFFFFF;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: flex;
        }

        .login-left {
            background-color: #FCEDF2;
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Perbaikan styling gambar agar tidak dipaksa melebar berlebihan */
        .login-logo {
            width: 160px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            margin-bottom: 24px;
        }

        .login-right {
            width: 50%;
            padding: 50px 40px;
            background-color: #FFFFFF;
        }

        .text-custom-purple { color: #4A154D; }
        
        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .input-group-text {
            background-color: #F8F9FA;
            border: 1px solid #EAEAEA;
            color: #6c757d;
        }

        .form-control {
            background-color: #F8F9FA;
            border: 1px solid #EAEAEA;
            padding: 12px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #D81E76;
            background-color: #FFFFFF;
        }

        .form-control:focus + .input-group-text, 
        .input-group-text:has(+ .form-control:focus) {
            border-color: #D81E76;
            background-color: #FFFFFF;
        }

        .btn-login {
            background: linear-gradient(135deg, #D81E76 0%, #4A154D 100%);
            color: #FFFFFF;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: opacity 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            opacity: 0.9;
            color: #FFFFFF;
        }

        @media (max-width: 768px) {
            .login-wrapper { flex-direction: column; max-width: 450px; }
            .login-left, .login-right { width: 100%; }
            .login-left { padding: 30px; display: none; }
            .login-right { padding: 40px 30px; }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        
        <div class="login-left d-none d-md-flex">
            <img src="{{ asset('images/logo-jkb-fes.png') }}" alt="Logo JKB Fest" class="login-logo">
            <h4 class="fw-bold text-custom-purple mb-2">JKB FEST 2026</h4>
            <p class="text-muted" style="font-size: 13px;">Sistem Panel Administrator Manajemen Kompetisi</p>
        </div>

        <div class="login-right">
            <h4 class="fw-bold text-dark mb-1">Welcome Back, Admin!</h4>
            <p class="text-muted mb-4" style="font-size: 13px;">Silakan masukkan email dan password Anda.</p>
            
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="admin@jkbfest.com" required>
                    </div>
                        @error(
                            'email'
                        )
                        {{ $message }}
                        @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0 ps-0" placeholder="••••••••" required>
                        <span class="input-group-text border-start-0" style="cursor: pointer;" onclick="togglePassword()">
                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                        </span>
                    </div>
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-login shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                </button>
            </form>
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("bi-eye-slash");
                eyeIcon.classList.add("bi-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("bi-eye");
                eyeIcon.classList.add("bi-eye-slash");
            }
        }
    </script>
</body>
</html>
@include('sweetalert::alert')