<div class="bootstrap-modal">
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 16px; padding: 32px; border: none; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">

      {{-- Header --}}
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Login</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      {{-- Step 1 --}}
      <div id="loginStep1">
        <p class="text-center mb-4 text-muted">Masuk ke Glints untuk melanjutkan</p>
        
        <div class="d-flex justify-content-center gap-3 mb-4">
          <a href="#" class="btn btn-light border rounded-circle p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-google fa-lg text-danger"></i>
          </a>
          <a href="#" class="btn btn-light border rounded-circle p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-facebook-f fa-lg text-primary"></i>
          </a>
          <a href="#" class="btn btn-light border rounded-circle p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-linkedin-in fa-lg" style="color: #0077b5;"></i>
          </a>
        </div>

        <div class="d-flex align-items-center mb-4">
          <div class="flex-grow-1" style="height: 1px; background-color: #dee2e6;"></div>
          <span class="mx-3 small text-muted fw-bold">ATAU</span>
          <div class="flex-grow-1" style="height: 1px; background-color: #dee2e6;"></div>
        </div>

        <div class="text-center mb-4">
          <a href="{{ route('login-email') }}" id="emailLoginBtn" class="fw-bold" style="color: #0dcaf0; text-decoration: none;">Masuk dengan Email</a>
        </div>

        <div class="text-center small text-muted">
          <p class="mb-2">Tidak punya akun Glints? <a href="{{ route('register') }}" style="color: #0dcaf0; text-decoration: none;">Daftar</a></p>
          <p class="mb-0">Untuk perusahaan, kunjungi <a href="#" style="color: #0dcaf0; text-decoration: none;">laman berikut</a>.</p>
        </div>
      </div>

      {{-- Step 2 (Email Form) --}}
      <div id="loginStep2" style="display:none;">
        <div class="d-flex align-items-center mb-4">
          <button id="backToStep1" class="btn btn-sm btn-link p-0 me-3" style="color: #0dcaf0; text-decoration: none;">
            <i class="fas fa-arrow-left"></i>
          </button>
          <h4 class="mb-0 fw-bold">Selamat Datang Kembali!</h4>
        </div>
        
        <p class="text-center mb-4 text-muted">Masuk ke akun Glints kamu</p>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          
          <!-- Email Field -->
          <div class="login-field mb-3">
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
          <div class="login-field mb-3">
              <div class="textfield-container">
                  <input type="password" 
                         aria-label="Kata sandi" 
                         name="password" 
                         id="login-form-password" 
                         class="textfield-input" 
                         placeholder=" "
                         value="">
                  <label class="textfield-label">Kata sandi</label>
                  <div class="icon-container" onclick="togglePassword()">
                      <svg id="password-icon" width="1em" height="1em" fill="currentColor" viewBox="0 0 100 100">
                          <path d="M30.823 70.148l4.332-7.83a24.865 24.865 0 0 1-10.274-20.105c0-4.388 1.166-8.72 3.388-12.496-8.664 4.443-15.884 11.44-21.16 19.604 5.776 8.942 13.94 16.44 23.714 20.827zm21.605-42.153c0-1.444-1.222-2.666-2.666-2.666-9.275 0-16.884 7.609-16.884 16.884 0 1.444 1.222 2.665 2.666 2.665s2.666-1.221 2.666-2.665c0-6.387 5.22-11.552 11.552-11.552 1.444 0 2.666-1.222 2.666-2.666zm20.16-10.608c0 .111 0 .389-.056.5-11.718 20.938-23.325 41.987-35.044 62.924l-2.721 4.943a1.84 1.84 0 0 1-1.555.889c-1 0-6.276-3.221-7.442-3.888a1.773 1.773 0 0 1-.89-1.555c0-.888 1.89-3.888 2.445-4.832C16.55 71.481 7.498 63.15 1.11 53.154A7.028 7.028 0 0 1 0 49.32c0-1.332.389-2.72 1.11-3.832 10.997-16.883 28.158-28.157 48.652-28.157 3.332 0 6.72.333 9.997.944l2.999-5.387A1.773 1.773 0 0 1 64.313 12c1 0 6.22 3.221 7.386 3.888.556.333.889.888.889 1.5zm2.055 24.826c0 10.33-6.387 19.549-15.995 23.214l15.55-27.88c.278 1.555.445 3.11.445 4.666zm24.88 7.108c0 1.444-.388 2.61-1.11 3.833-1.722 2.832-3.888 5.553-6.054 8.053C81.474 73.703 66.48 81.31 49.762 81.31l4.11-7.30c16.161-1.39 29.879-11.22 38.543-24.66-4.11-6.386-9.386-11.996-15.662-16.328l3.5-6.22c6.886 4.61 13.828 11.552 18.16 18.716.722 1.222 1.11 2.388 1.11 3.832z"></path>
                      </svg>
                  </div>
              </div>
          </div>

          <!-- Forgot Password -->
          <div class="forgot-password">
              <button type="button" class="forgot-password-link">Lupa kata sandi?</button>
          </div>

          <!-- Login Button -->
          <div class="login-btn-container">
              <button type="submit" class="login-btn" data-cy="submit_btn_login">
                  <span>MASUK</span>
              </button>
          </div>
        </form>
        
        <!-- Divider -->
        <div class="divider">
          <div class="divider-text">atau</div>
        </div>
        
        <!-- Social Icons -->
        <div class="social-icons">
          <a href="#"><img src="{{ asset('images/google.png') }}" alt="Google"></a>
          <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
          <a href="#"><img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn"></a>
        </div>
      </div>

      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
  .login-field {
    margin-bottom: 24px;
    position: relative;
  }

  .textfield-container {
    position: relative;
    border: 2px solid #e1e5e9;
    border-radius: 4px;
    background: white;
    transition: border-color 0.3s;
  }

  .textfield-container:focus-within {
    border-color: #007bff;
  }

  .textfield-container.error {
    border-color: #EC272B;
  }

  .textfield-input {
    width: 100%;
    padding: 20px 16px 8px 16px;
    border: none;
    outline: none;
    font-size: 16px;
    background: transparent;
    box-sizing: border-box;
  }

  .textfield-label {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #666;
    pointer-events: none;
    transition: all 0.3s ease;
    background: white;
    padding: 0 4px;
  }

  .textfield-input:focus + .textfield-label,
  .textfield-input:not(:placeholder-shown) + .textfield-label {
    top: 0;
    font-size: 12px;
    color: #007bff;
    transform: translateY(-50%);
  }

  .textfield-container.error .textfield-label {
    color: #EC272B;
  }

  .icon-container {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
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
    text-align: right;
    margin-bottom: 24px;
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
    margin-bottom: 24px;
    position: relative;
  }

  .login-btn {
    width: 100%;
    padding: 16px 24px;
    background: #ffd700;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    color: #000;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .login-btn:hover {
    background: #ffed4e;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
    background: #e1e5e9;
  }

  .divider-text {
    color: #777;
    font-size: 14px;
    margin: 0 15px;
  }

  .social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
  }

  .social-icons img {
    width: 40px;
    height: 40px;
    cursor: pointer;
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const step1 = document.getElementById('loginStep1');
    const step2 = document.getElementById('loginStep2');

    document.getElementById('emailLoginBtn').addEventListener('click', function(e) {
      e.preventDefault();
      step1.style.display = 'none';
      step2.style.display = 'block';
    });

    document.getElementById('backToStep1').addEventListener('click', function() {
      step2.style.display = 'none';
      step1.style.display = 'block';
    });
  });
  
  function togglePassword() {
    const passwordInput = document.getElementById('login-form-password');
    const passwordIcon = document.getElementById('password-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        // Change to visible eye icon (eye-slash equivalent)
        passwordIcon.innerHTML = '<path d="M12.79 5.23l3.78 3.78a8.15 8.15 0 0 1 0 11.56l-3.78 3.78a1 1 0 1 1-1.41-1.41l3.78-3.78a6.15 6.15 0 0 0 0-8.74l-3.78-3.78a1 1 0 0 1 1.41-1.41zM2.22 2.22a1 1 0 0 1 1.41 0L50 48.59a1 1 0 0 1-1.41 1.41L2.22 3.63a1 1 0 0 1 0-1.41z"></path>';
    } else {
        passwordInput.type = 'password';
        // Change back to hidden eye icon
        passwordIcon.innerHTML = '<path d="M30.823 70.148l4.332-7.83a24.865 24.865 0 0 1-10.274-20.105c0-4.388 1.166-8.72 3.388-12.496-8.664 4.443-15.884 11.44-21.16 19.604 5.776 8.942 13.94 16.44 23.714 20.827zm21.605-42.153c0-1.444-1.222-2.666-2.666-2.666-9.275 0-16.884 7.609-16.884 16.884 0 1.444 1.222 2.665 2.666 2.665s2.666-1.221 2.666-2.665c0-6.387 5.22-11.552 11.552-11.552 1.444 0 2.666-1.222 2.666-2.666zm20.16-10.608c0 .111 0 .389-.056.5-11.718 20.938-23.325 41.987-35.044 62.924l-2.721 4.943a1.84 1.84 0 0 1-1.555.889c-1 0-6.276-3.221-7.442-3.888a1.773 1.773 0 0 1-.89-1.555c0-.888 1.89-3.888 2.445-4.832C16.55 71.481 7.498 63.15 1.11 53.154A7.028 7.028 0 0 1 0 49.32c0-1.332.389-2.72 1.11-3.832 10.997-16.883 28.158-28.157 48.652-28.157 3.332 0 6.72.333 9.997.944l2.999-5.387A1.773 1.773 0 0 1 64.313 12c1 0 6.22 3.221 7.386 3.888.556.333.889.888.889 1.5zm2.055 24.826c0 10.33-6.387 19.549-15.995 23.214l15.55-27.88c.278 1.555.445 3.11.445 4.666zm24.88 7.108c0 1.444-.388 2.61-1.11 3.833-1.722 2.832-3.888 5.553-6.054 8.053C81.474 73.703 66.48 81.31 49.762 81.31l4.11-7.30c16.161-1.39 29.879-11.22 38.543-24.66-4.11-6.386-9.386-11.996-15.662-16.328l3.5-6.22c6.886 4.61 13.828 11.552 18.16 18.716.722 1.222 1.11 2.388 1.11 3.832z"></path>';
    }
  }
</script>
@endpush