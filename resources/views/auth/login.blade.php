<x-layout>
  <div class="container my-5 d-flex justify-content-center">
    <div style="width: 100%; max-width: 500px;">
      <div class="p-4 p-sm-5 rounded-4 shadow-lg" style="background-color: #151e2e; border: 1px solid #1e2c42;">
        
        <h2 class="fw-bold text-white text-center mb-4">Bejelentkezés</h2>

        @if(session('success'))
          <div class="alert alert-success py-2 small mb-3">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label small" style="color: #94a3b8;">E-mail cím</label>
            <input type="email" name="email" id="email" 
                   class="form-control text-white @error('email') is-invalid @enderror" 
                   placeholder="pelda@email.com" value="{{ old('email') }}" required autofocus
                   style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px; padding: 10px 14px;">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password" class="form-label small" style="color: #94a3b8;">Jelszó</label>
            <input type="password" name="password" id="password" 
                   class="form-control text-white @error('password') is-invalid @enderror" 
                   placeholder="Add meg a jelszavad" required
                   style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px; padding: 10px 14px;">
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn w-100 text-white fw-semibold mb-4" 
                  style="background-color: #14b8a6; border-radius: 8px; padding: 11px; border: none;">
            Bejelentkezés
          </button>
        </form>

        <!-- Alsó elválasztó és lábléc pontosan egy sorban -->
        <div class="d-flex justify-content-between align-items-center pt-3 mt-2" 
             style="border-top: 1px solid #23334d; font-size: 0.88rem;">
          <a href="{{ url('/') }}" class="text-decoration-none text-nowrap" style="color: #94a3b8;">
            &larr; Vissza a főoldalra
          </a>
          <span class="text-nowrap" style="color: #94a3b8;">
            Még nincs fiókod? <a href="{{ url('/register') }}" class="fw-semibold text-decoration-none ms-1" style="color: #2dd4bf;">Regisztráció</a>
          </span>
        </div>

      </div>
    </div>
  </div>
</x-layout>