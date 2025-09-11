<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    body { font-family: Arial, sans-serif; margin:0; padding:0; }
    .modal {
      display: none; /* awalnya tersembunyi */
      justify-content: center;
      align-items: flex-start;
      position: fixed;
      top:0; left:0; right:0; bottom:0;
      background: rgba(0,0,0,0.5);
      padding-top: 80px;
      overflow-y: hidden;
      z-index: 9999;
    }
    .modal-content {
      background: white;
      width: 500px;
      height: 400px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      transition: height 0.3s ease;
      margin: 20px;
      border-radius: 6px;
    }
    .modal-content.step2 {
      min-height: 550px;
      max-height: 90vh;
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 6px 16px;
      border-bottom: 1px solid #ddd;
    }
    .modal-header h2 { font-size: 18px; font-weight: bold; margin:0; }
    .close { font-size: 30px; color: gray; cursor: pointer; border:none; background:none; }
    .modal-body { padding: 20px; text-align: center; }
    #loginStep2 { display: none; text-align: center; padding: 20px; }
    #loginStep2 .login-field { text-align: left; }
    #loginStep2 a { text-align: center; display: block; margin-bottom: 15px; }
    .modal-body h3 { font-size: 18px; margin-bottom: 20px; font-weight: 600; text-align: left; }
    .social-login { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; }
    .google-logo { background: #fff; border-radius: 50%; padding: 8px; border: 1px solid #ddd; width: 48px; height: 48px; object-fit: contain; }
    .social-login img { width: 40px; height: 40px; object-fit: contain; cursor: pointer; }
    .divider { display: flex; align-items: center; color: #777; font-size: 13px; margin: 20px 0; }
    .divider::before, .divider::after { content: ""; flex: 1; height: 1px; background: #ddd; }
    .divider span { margin: 0 10px; font-weight: bold; }
    .email-login { text-align: center; font-size: 17px; text-decoration: underline; margin: 10px 0; }
    .email-login a { color: #007bff; }
    .email-login a:hover { color: rgb(1, 96, 197); text-decoration: underline; }
    .modal-footer { border-top: 1px solid #ddd; padding: 30px 40px; font-size: 15px; color: gray; }
    .footer-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .footer-top a { color: #007bff; font-size: 17px; text-decoration: underline; font-weight: 500; }
    .footer-top a:hover { color: rgb(1, 96, 197); text-decoration: underline; }
    .footer-bottom { text-align: left; font-size: 15px; color: #666; }
    .footer-bottom a { color: #007bff; text-decoration: none; }
    #loginStep2 h3 { font-size: 16px; margin-bottom: 10px; font-weight: 600; line-height: 1.2; }
    .login-field { margin-bottom: 18px; position: relative; }
    .login-field label { font-size: 14px; margin-bottom: 6px; display: block; position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #777; font-size: 14px; pointer-events: none; transition: 0.2s ease all; background: #fff; padding: 0 4px; }
    .login-field input { width: 100%; padding: 14px 40px 14px 12px; border: 1px solid #ccc; background-color: white; font-size: 15px; box-sizing: border-box; transition: all 0.3s ease; }
    .login-field input:focus { border-color: #007bff; background-color:#fff; outline: none; }
    .login-field input:focus + label, .login-field input:not(:placeholder-shown) + label { top: -1px; left: 8px; font-size: 12px; color: #007bff; }
    .error-message { font-size: 12px; color: red; margin-top: 4px; display: none; }
    .toggle-password { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 16px; color: #777; background: none; border: none; }
    .btn-submit { margin-top: 20px; width: 100%; padding: 12px; margin-bottom: 25px; background-color: rgb(230, 175, 24); box-shadow: 5px 5px 0 rgb(204, 12, 12); border: none; border-radius: 6px; color: white; font-size: 16px; cursor: pointer; font-weight: bold; }
    .btn-submit:hover { background-color: rgb(230, 175, 24); box-shadow: 5px 5px 0 rgb(0, 0, 0); }
    .back-link { display: block; margin-top: 10px; font-size: 13px; color: #007bff; cursor:pointer; text-align: left; text-decoration: none; }
  </style>
</head>
<body>

<div class="modal" id="loginModal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Login</h2>
      <button class="close" id="closeModal">&times;</button>
    </div>

    <!-- Step 1 -->
    <div class="modal-body" id="loginStep1">
      <h3>Masuk ke Glints untuk melanjutkan</h3>
      <div class="social-login">
        <img src="{{ asset('images/google.png') }}" alt="Google" class="google-logo">
        <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
        <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn">
      </div>
      <div class="divider"><span>ATAU</span></div>
      <div class="email-login">
        <a href="#" id="emailLoginBtn">Masuk dengan Email</a>
      </div>
      
      <!-- Modal Footer hanya di Step 1 -->
      <div class="modal-footer">
        <div class="footer-top">
          <span>Tidak punya akun Glints?</span>
          <a href="{{ route('register') }}">Daftar</a>
        </div>
        <div class="footer-bottom">
          Untuk perusahaan, kunjungi <a href="#">laman</a> berikut.
        </div>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="modal-body" id="loginStep2">
      <h3>Masuk ke Glints untuk melanjutkan</h3>
      <form id="loginForm">
        @csrf
        <input type="hidden" name="login_from" value="modal">
        
        <div class="login-field">
          <input type="email" name="email" id="emailInput" placeholder=" " value="{{ old('email') }}" required>
          <label for="emailInput">Alamat email</label>
          <small class="error-message" id="emailError"></small>
        </div>
        
        <div class="login-field">
          <input type="password" name="password" id="password" placeholder=" " required>
          <label for="password">Kata sandi</label>
          <button type="button" class="toggle-password" onclick="togglePassword()">
            <i id="toggleIcon" class="fas fa-eye-slash"></i>
          </button>
          <small class="error-message" id="passwordError"></small>
        </div>
        
        <a href="#">Lupa kata sandi?</a>
        <button type="submit" class="btn-submit" id="loginSubmitBtn">MASUK</button>
      </form>
      
      <div class="divider"><span>ATAU</span></div>
      <div class="social-login">
        <img src="{{ asset('images/google.png') }}" alt="Google" class="google-logo">
        <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
        <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn">
      </div>
    </div>

  </div>
</div>

<script>
  const modal = document.getElementById('loginModal');
  const step1 = document.getElementById('loginStep1');
  const step2 = document.getElementById('loginStep2');
  const emailBtn = document.getElementById('emailLoginBtn');
  const closeBtn = document.getElementById('closeModal');
  const modalContent = document.querySelector('.modal-content');
  const loginForm = document.getElementById('loginForm');
  const loginSubmitBtn = document.getElementById('loginSubmitBtn');
  const emailError = document.getElementById('emailError');
  const passwordError = document.getElementById('passwordError');

  function openModal() {
    modal.style.display = 'flex';
  }

  function clearErrors() {
    emailError.style.display = 'none';
    emailError.textContent = '';
    passwordError.style.display = 'none';
    passwordError.textContent = '';
  }

  emailBtn.addEventListener('click', (e) => {
    e.preventDefault();
    step1.style.display = 'none';
    step2.style.display = 'block';
    modalContent.classList.add('step2');
    clearErrors();
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    step1.style.display = 'block';
    step2.style.display = 'none';
    modalContent.classList.remove('step2');
    clearErrors();
    loginForm.reset();
  });

  // Close modal when clicking outside
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
      step1.style.display = 'block';
      step2.style.display = 'none';
      modalContent.classList.remove('step2');
      clearErrors();
      loginForm.reset();
    }
  });

  // Handle form submission
  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();
    
    // Disable submit button
    loginSubmitBtn.disabled = true;
    loginSubmitBtn.textContent = 'MEMPROSES...';
    
    const formData = new FormData(loginForm);
    
    try {
      const response = await fetch('{{ route("login") }}', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || document.querySelector('input[name="_token"]').value
        }
      });
      
      const data = await response.json();
      
      if (data.success) {
        // Login berhasil, redirect ke dashboard
        window.location.href = data.redirect_url;
      } else {
        // Login gagal, tampilkan error
        if (data.errors) {
          if (data.errors.email) {
            emailError.textContent = data.errors.email[0];
            emailError.style.display = 'block';
          }
          if (data.errors.password) {
            passwordError.textContent = data.errors.password[0];
            passwordError.style.display = 'block';
          }
        }
      }
    } catch (error) {
      console.error('Login error:', error);
      emailError.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
      emailError.style.display = 'block';
    } finally {
      // Re-enable submit button
      loginSubmitBtn.disabled = false;
      loginSubmitBtn.textContent = 'MASUK';
    }
  });

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
</body>
</html>
