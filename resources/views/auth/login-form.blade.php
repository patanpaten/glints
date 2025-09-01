<div class="login-form-container">
    <h3>Masuk ke Glints</h3>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <!-- Email Field -->
        <div class="login-field">
            <input type="email" 
                   name="email" 
                   id="email" 
                   placeholder=" " 
                   value="{{ old('email') }}"
                   required>
            <label for="email">Alamat email</label>
            @error('email')
                <small class="error-message" style="display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <!-- Password Field -->
        <div class="login-field">
            <input type="password" 
                   name="password" 
                   id="password" 
                   placeholder=" " 
                   required>
            <label for="password">Kata sandi</label>
            <button type="button" class="toggle-password" onclick="togglePassword()">
                <i id="toggleIcon" class="fas fa-eye-slash"></i>
            </button>
            @error('password')
                <small class="error-message" style="display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <!-- Forgot Password -->
        <div class="forgot-password">
            <a href="#">Lupa kata sandi?</a>
        </div>
        
        <!-- Submit Button -->
        <div class="login-btn-container">
            <button type="submit" class="login-btn" data-cy="submit_btn_login">
                MASUK
            </button>
        </div>
        
        <!-- Divider -->
        <div class="divider"><span>ATAU</span></div>
        
        <!-- Social Login -->
        <div class="social-login">
            <img src="{{ asset('images/google.png') }}" alt="Google" class="google-logo">
            <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
            <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn">
        </div>
    </form>
</div>

<style>
.login-form-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

.login-form-container h3 {
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 600;
    text-align: center;
}

.login-field {
    margin-bottom: 18px;
    position: relative;
}

.login-field label {
    font-size: 14px;
    margin-bottom: 6px;
    display: block;
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

.login-field input {
    width: 100%;
    padding: 14px 40px 14px 12px;
    border: 1px solid #ccc;
    background-color: white;
    font-size: 15px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

.login-field input:focus {
    border-color: #007bff;
    background-color: #fff;
    outline: none;
}

.login-field input:focus + label,
.login-field input:not(:placeholder-shown) + label {
    top: -1px;
    left: 8px;
    font-size: 12px;
    color: #007bff;
}

.error-message {
    font-size: 12px;
    color: red;
    margin-top: 4px;
    display: none;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 16px;
    color: #777;
    background: none;
    border: none;
}

.forgot-password {
    text-align: center;
    margin-bottom: 20px;
}

.forgot-password a {
    color: #007bff;
    text-decoration: none;
    font-size: 14px;
}

.forgot-password a:hover {
    text-decoration: underline;
}

.btn-submit {
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

.btn-submit:hover {
    background-color: rgb(230, 175, 24);
    box-shadow: 5px 5px 0 rgb(0, 0, 0);
}

.divider {
    display: flex;
    align-items: center;
    color: #777;
    font-size: 13px;
    margin: 20px 0;
}

.divider::before,
.divider::after {
    content: "";
    flex: 1;
    height: 1px;
    background: #ddd;
}

.divider span {
    margin: 0 10px;
    font-weight: bold;
}

.social-login {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
}

.google-logo {
    background: #fff;
    border-radius: 50%;
    padding: 8px;
    border: 1px solid #ddd;
    width: 48px;
    height: 48px;
    object-fit: contain;
}

.social-login img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    cursor: pointer;
}
</style>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}
</script>