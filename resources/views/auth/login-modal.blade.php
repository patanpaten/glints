<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal Login</title>
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
    }
    .modal-content {
      background: white;
      width: 500px;
      height: 400px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      transition: height 0.3s ease;
      margin: 20px;
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
    #loginStep2 a { text-align: center; }
    .modal-body h3 { font-size: 18px; margin-bottom: 20px; font-weight: semibold; text-align: left; }
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
    .login-field input:focus + label, .login-field input:not(:placeholder-shown) + label { top: -8px; left: 8px; font-size: 12px; color: #007bff; }
    .error-message { font-size: 12px; color: red; margin-top: 4px; display: none; }
    .toggle-password { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 16px; color: #777; }
    .btn-submit { width: 100%; padding: 12px; margin-bottom: 25px; background-color: rgb(230, 175, 24); box-shadow: 5px 5px 0 rgb(204, 12, 12); border: none; border-radius: 6px; color: white; font-size: 16px; cursor: pointer; font-weight: bold; }
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
    </div>

    <!-- Step 2 -->
    <div class="modal-body" id="loginStep2">
      <h3>Masuk ke Glints untuk melanjutkan</h3>
      <div class="login-field">
        <input type="email" id="emailInput" placeholder=" " required>
        <label for="emailInput">Alamat email</label>
        <small class="error-message">Email wajib diisi</small>
      </div>
      <div class="login-field">
        <input type="password" id="passwordInput" placeholder=" " required>
        <label for="passwordInput">Kata sandi</label>
        <span class="toggle-password">👁</span>
      </div>
      <a href="#">Lupa kata sandi?</a>
      <button class="btn-submit">MASUK</button>
      <div class="divider"><span>ATAU</span></div>
      <div class="social-login">
        <img src="{{ asset('images/google.png') }}" alt="Google" class="google-logo">
        <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
        <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn">
      </div>
    </div>

    <div class="modal-footer">
      <div class="footer-top">
        <span>Tidak punya akun Glints?</span>
        <a href="#">Daftar</a>
      </div>
      <div class="footer-bottom">
        Untuk perusahaan, kunjungi <a href="#">laman</a> berikut.
      </div>
    </div>
  </div>
</div>

<script>
  const step1 = document.getElementById('loginStep1');
  const step2 = document.getElementById('loginStep2');
  const emailBtn = document.getElementById('emailLoginBtn');
  const closeBtn = document.getElementById('closeModal');
  const modal = document.getElementById('loginModal');
  const modalContent = document.querySelector('.modal-content');

  emailBtn?.addEventListener('click', (e) => {
    e.preventDefault();
    step1.style.display = 'none';
    step2.style.display = 'block';
    modalContent.classList.add('step2');
  });

  closeBtn?.addEventListener('click', () => {
    modal.style.display = 'none';
    step2.style.display = 'none';
    step1.style.display = 'block';
    modalContent.classList.remove('step2');
  });

  document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = icon.previousElementSibling;
      if (input?.type === 'password') {
        input.type = 'text';
        icon.textContent = '🙈';
      } else {
        input.type = 'password';
        icon.textContent = '👁️';
      }
    });
  });
</script>
</body>
</html>
