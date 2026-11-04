<x-layout>
  <div class="container my-5 d-flex justify-content-center">
    <div style="width: 100%; max-width: 520px;">
      
      <!-- Felső keretes visszagomb -->
      <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm mb-4">
        &larr; Vissza a főoldalra
      </a>

      <div class="p-4 p-sm-5 rounded-4 shadow-lg" style="background-color: #151e2e; border: 1px solid #1e2c42;">
        
        <div class="text-center mb-4">
          <h2 class="fw-bold text-white mb-2">Kapcsolat</h2>
          <p class="small mb-0" style="color: #94a3b8;">Kérdésed van vagy árajánlatot szeretnél? Írj nekünk!</p>
        </div>

        @if(session('success'))
          <div class="alert alert-success py-2 small mb-3">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/kapcsolat') }}">
          @csrf

          <div class="mb-3">
            <label for="nev" class="form-label small" style="color: #94a3b8;">Név</label>
            <input type="text" name="nev" id="nev" 
                   class="form-control text-white @error('nev') is-invalid @enderror" 
                   placeholder="Add meg a neved" value="{{ old('nev') }}" required
                   style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px; padding: 10px 14px;">
            @error('nev')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label small" style="color: #94a3b8;">E-mail cím</label>
            <input type="email" name="email" id="email" 
                   class="form-control text-white @error('email') is-invalid @enderror" 
                   placeholder="pelda@email.com" value="{{ old('email') }}" required
                   style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px; padding: 10px 14px;">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="uzenet" class="form-label small" style="color: #94a3b8;">Üzenet</label>
            <textarea name="uzenet" id="uzenet" rows="4" 
                      class="form-control text-white @error('uzenet') is-invalid @enderror" 
                      placeholder="Miben segíthetünk?" required
                      style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px; padding: 10px 14px;">{{ old('uzenet') }}</textarea>
            @error('uzenet')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn w-100 text-white fw-semibold" 
                  style="background-color: #14b8a6; border-radius: 8px; padding: 11px; border: none;">
            Üzenet elküldése
          </button>
        </form>

      </div>
    </div>
  </div>
</x-layout>