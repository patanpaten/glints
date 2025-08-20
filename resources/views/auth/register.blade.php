@extends('layouts.navbar-regis')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    body {
        background: #f8f9fa;
    }

    .register-container {
        min-height: calc(100vh - 200px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .register-title {
        font-size: 28px;
        font-weight: 700;
        color: #000;
        text-align: center;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .register-card {
        background: white;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 350px;
        width: 100%;
        overflow: hidden;
    }

    .register-body {
        padding: 30px 25px;
        text-align: center;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 15px;
    }

    .social-icons img {
        width: 40px;
        height: 40px;
        cursor: pointer;
    }

    .divider-text {
        color: #777;
        font-size: 14px;
        margin: 10px 0;
    }

    .email-link {
        color: #007bff;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
    }

    .email-link:hover {
        text-decoration: underline;
    }

    .terms-box {
        background: #f8f9fa;
        padding: 12px;
        font-size: 12px;
        color: #555;
        margin-top: 15px;
    }

    .terms-box a {
        color: #007bff;
        text-decoration: none;
    }

    .terms-box a:hover {
        text-decoration: underline;
    }

    .register-footer {
        border-top: 1px solid #e5e5e5;
        padding: 15px 20px;
        font-size: 13px;
        color: #555;
        text-align: center;
    }

    .register-footer a {
        color: #007bff;
        text-decoration: none;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-container">
    <!-- Title outside card -->
    <h1 class="register-title">Mari bergabung<br>dengan Glints</h1>

    <div class="register-card">
        <!-- Card Body -->
        <div class="register-body">
            <!-- Social Icons -->
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/google.png') }}" alt="Google"></a>
                <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
            </div>

            <div class="divider-text">atau</div>

            <!-- Email Register Link -->
            <a href="#" class="email-link">Daftar dengan Email</a>

            <!-- Terms -->
            <div class="terms-box">
                Dengan mendaftar, saya setuju dengan <a href="#">Ketentuan Layanan</a>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="register-footer">
            <p>Sudah punya akun Glints? <a href="#">Masuk</a></p>
            <p>Untuk perusahaan, kunjungi <a href="#">laman</a> berikut.</p>
        </div>
    </div>
</div>
@endsection
