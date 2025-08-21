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
          <a href="#" id="emailLoginBtn" class="fw-bold" style="color: #0dcaf0; text-decoration: none;">Masuk dengan Email</a>
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
          <h4 class="mb-0 fw-bold">Login dengan Email</h4>
        </div>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email" class="form-control" style="padding: 12px; border-radius: 8px; border: 1px solid #dee2e6;" placeholder="Masukkan email Anda" required>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" type="password" name="password" class="form-control" style="padding: 12px; border-radius: 8px; border: 1px solid #dee2e6;" placeholder="Masukkan password Anda" required>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn text-white fw-bold" style="background-color: #0dcaf0; border: none; padding: 12px; border-radius: 8px; font-size: 16px;">Masuk</button>
          </div>
        </form>
      </div>

      </div>
    </div>
  </div>
</div>

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
</script>
@endpush
