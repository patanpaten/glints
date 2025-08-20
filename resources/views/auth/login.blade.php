<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        
        .login-container {
            text-align: center;
            color: white;
        }
        
        .login-container h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        
        .login-container p {
            font-size: 18px;
            margin-bottom: 32px;
            opacity: 0.9;
        }
        
        .btn-open-modal {
            background: linear-gradient(135deg, #00d4aa 0%, #00a693 100%);
            border: none;
            border-radius: 12px;
            padding: 16px 32px;
            color: white;
            font-weight: 600;
            font-size: 18px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(0, 212, 170, 0.3);
        }
        
        .btn-open-modal:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(0, 212, 170, 0.4);
            color: white;
        }
        
        .register-link {
            margin-top: 24px;
        }
        
        .register-link a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Selamat Datang di Glints</h1>
        <p>Temukan peluang karir terbaik untuk masa depan Anda</p>
        
        <button type="button" class="btn-open-modal" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fas fa-sign-in-alt me-2"></i>
            Masuk ke Akun Anda
        </button>
        
        <div class="register-link">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        </div>
    </div>
    
    <!-- Include Login Modal -->
    @include('auth.login-modal')
    
    <!-- Show modal automatically if there are errors -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
                // Show email form if there are errors
                setTimeout(function() {
                    showEmailForm();
                }, 100);
            });
        </script>
    @endif
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
