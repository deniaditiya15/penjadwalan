<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Sistem</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    :root {
        --primary-color: #465C88;
        --primary-dark: #3b4e72;
        --secondary-color: #6A7BB0;
        --accent-color: #FF6B6B;
        --gradient-start: #465C88;
        --gradient-end: #6A7BB0;
        --text-dark: #2D3748;
        --text-light: #718096;
        --light-bg: #F7FAFC;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        color: var(--text-dark);
    }

    .login-container {
        width: 100%;
        max-width: 450px;
        margin: 20px;
    }
    
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-weight: 600;
        font-size: 1.5rem;
        text-align: center;
        border-bottom: none;
        padding: 1.5rem;
        position: relative;
    }
    
    .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
    
    .card-body {
        padding: 2.5rem;
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
        display: flex;
        align-items: center;
    }
    
    .form-label i {
        margin-right: 8px;
        color: var(--primary-color);
    }
    
    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        transition: all 0.3s;
        font-size: 0.95rem;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(70, 92, 136, 0.2);
    }
    
    .form-control::placeholder {
        color: #a0aec0;
    }
    
    .input-group {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-light);
        z-index: 5;
        background: none;
        border: none;
        font-size: 1.2rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 10px;
        padding: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(70, 92, 136, 0.25);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(70, 92, 136, 0.35);
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .form-check-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(70, 92, 136, 0.25);
    }
    
    .form-check-label {
        color: var(--text-light);
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .card-header {
            padding: 1.25rem;
            font-size: 1.35rem;
        }
    }
</style>
</head>
<body>

<div class="login-container">
    <div class="card">
        <div class="card-header">
            {{ __('Selamat Datang Kembali') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope-fill"></i>{{ __('Alamat Email') }}
                    </label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           placeholder="Masukkan email Anda">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock-fill"></i>{{ __('Kata Sandi') }}
                    </label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Ingat Saya') }}</label>
                </div>

                <div class="d-grid gap-2 mb-4">
                    <button type="submit" class="btn btn-primary py-2">
                        <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
    }
}
</script>
</body>
</html>
