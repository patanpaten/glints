@extends('layouts.navbar-regis')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    body {
        background: #f8f9fa;
    }

    .register-container {
        min-height: calc(100vh -00px);
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
    
    .register-sub-title {
        font-size: 15px;
        font-weight: 500;
        color: rgb(88, 88, 88);
        text-align: center;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .register-card {
        background: white;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 400px;
        width: 100%;
        overflow: hidden;
    }

    .register-body {
        padding: 30px 25px;
        text-align: center;
    }

    .login-field {
        margin-bottom: 18px;
        position: relative;
    }

    .textfield-container {
        position: relative;
        background: white;
    }

    .textfield-input:focus {
        border-color: #007bff;
        background-color: #fff;
    }

    .textfield-container.error .textfield-input {
        border-color: #EC272B;
    }

    .textfield-input {
        width: 100%;
        padding: 14px 40px 14px 12px;
        border: 1px solid #ccc;
        background-color: white;
        font-size: 15px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        outline: none;
    }

    .textfield-label {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
        font-size: 14px;
        pointer-events: none;
        transition: 0.2s ease all;
        background: #fff;
        padding: 0 4px;
    }

    .textfield-input:focus + .textfield-label,
    .textfield-input:not(:placeholder-shown) + .textfield-label {
        top: -8px;
        left: 8px;
        font-size: 12px;
        color: #007bff;
    }

    .textfield-container.error .textfield-label {
        color: #EC272B;
    }

    .icon-container {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 16px;
        color: #777;
    }

    .validation-error {
        color: #EC272B;
        font-size: 12px;
        margin-top: 8px;
        display: none;
    }

    .validation-error.show {
        display: block;
    }

    .forgot-password {
        text-align: left;
        margin-bottom: 15px;
    }

    .forgot-password-link {
        background: none;
        border: none;
        color: #007bff;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        padding: 0;
    }

    .forgot-password-link:hover {
        text-decoration: underline;
    }

    .login-btn-container {
        margin-bottom: 15px;
        position: relative;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        margin-bottom: 25px;
        background-color: rgb(230, 175, 24);
        box-shadow: 5px 5px 0 rgb(204, 12, 12);
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
    }

    .login-btn:hover {
        background-color: rgb(230, 175, 24);
        box-shadow: 5px 5px 0 rgb(0, 0, 0);
    }

    .login-btn span {
        font-weight: 600;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #ddd;
    }

    .divider-text {
        margin: 0 10px;
        font-weight: bold;
        font-size: 14px;
        color: #777;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-icons img {
        width: 40px;
        height: 40px;
        cursor: pointer;
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
    <h1 class="register-title">Selamat Datang Kembali!</h1>
    <h1 class="register-sub-title">Masuk ke akun Glints kamu</h1>

    <div class="register-card">
        <!-- Card Body -->
        <div class="register-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Field -->
                <div class="login-field">
                    <div class="textfield-container">
                        <input type="email" 
                               aria-label="Alamat email" 
                               name="email" 
                               id="login-form-email" 
                               class="textfield-input" 
                               placeholder=" "
                               value="">
                        <label class="textfield-label">Alamat email</label>
                    </div>
                    <p class="validation-error" data-cy="login-error-message">Email wajib diisi</p>
                </div>

                <!-- Password Field -->
                <div class="login-field">
                    <div class="textfield-container">
                        <input type="password" 
                               aria-label="Kata sandi" 
                               name="password" 
                               id="login-form-password" 
                               class="textfield-input" 
                               placeholder=" "
                               value="">
                        <label class="textfield-label">Kata sandi</label>
                        <span class="icon-container" onclick="togglePassword()" id="password-toggle">👁</span>
                    </div>
                </div>

                <!-- Forgot Password -->
                <div class="forgot-password">
                    <button type="button" class="forgot-password-link">Lupa kata sandi?</button>
                </div>

                <!-- Login Button -->
                <div class="login-btn-container">
                    <button type="submit" class="login-btn" data-cy="submit_btn_login">
                        MASUK
                    </button>
                </div>

                <!-- Divider -->
                <div class="divider">
                    <div class="divider-text">ATAU</div>
                </div>

                <!-- Social Icons -->
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('images/google.png') }}" alt="Google"></a>
                    <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn"></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('login-form-password');
    const passwordToggle = document.getElementById('password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        passwordToggle.textContent = '👁';
    }
}
</script>

@endsection