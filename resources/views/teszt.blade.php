<x-layout>
  <div class="container my-5 d-flex justify-content-center">
    <div style="width: 100%; max-width: 480px;">

      <!-- Vissza a főoldalra gomb a kártya felett balra -->
      <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm mb-4">
        &larr; Vissza a főoldalra
      </a>

      <!-- Számológép kártya -->
      <div class="p-4 p-sm-5 rounded-4 shadow-lg" style="background-color: #151e2b; border: 1px solid #202d3f;">
        
        <div class="text-center mb-4">
          <h2 class="fw-bold text-white d-flex align-items-center justify-content-center gap-2 mb-1">
            <span style="font-size: 1.8rem;">🧮</span> Számológép
          </h2>
        </div>

        @if(session()->has('result'))
          <div class="p-3 mb-4 rounded-3 text-center" style="background-color: rgba(20, 184, 166, 0.15); border: 1px solid #14b8a6;">
            <div class="small" style="color: #2dd4bf;">Eredmény:</div>
            <div class="fs-3 fw-bold text-white">{{ session('result') }}</div>
          </div>
        @endif

        <form method="POST" action="{{ url('/teszt') }}">
          @csrf

          <!-- Első szám (A) -->
          <div class="mb-3">
            <label for="a" class="form-label small" style="color: #cbd5e1;">Első szám (A)</label>
            <input type="number" step="any" name="a" id="a" 
                   class="form-control text-white @error('a') is-invalid @enderror" 
                   value="{{ old('a') }}" required
                   style="background-color: #0d141f; border: 1px solid #202d3f; border-radius: 8px; padding: 10px 14px;">
            @error('a')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Művelet -->
          <div class="mb-3">
            <label for="operation" class="form-label small" style="color: #cbd5e1;">Művelet</label>
            <select name="operation" id="operation" 
                    class="form-select text-white @error('operation') is-invalid @enderror" required
                    style="background-color: #0d141f; border: 1px solid #202d3f; border-radius: 8px; padding: 10px 14px;">
              <option value="+" {{ old('operation') == '+' ? 'selected' : '' }}>Összeadás (+)</option>
              <option value="-" {{ old('operation') == '-' ? 'selected' : '' }}>Kivonás (-)</option>
              <option value="*" {{ old('operation') == '*' ? 'selected' : '' }}>Szorzás (*)</option>
              <option value="/" {{ old('operation') == '/' ? 'selected' : '' }}>Osztás (/)</option>
            </select>
            @error('operation')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Második szám (B) -->
          <div class="mb-4">
            <label for="b" class="form-label small" style="color: #cbd5e1;">Második szám (B)</label>
            <input type="number" step="any" name="b" id="b" 
                   class="form-control text-white @error('b') is-invalid @enderror" 
                   value="{{ old('b') }}" required
                   style="background-color: #0d141f; border: 1px solid #202d3f; border-radius: 8px; padding: 10px 14px;">
            @error('b')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Kiszámol gomb -->
          <button type="submit" class="btn w-100 text-white fw-semibold" 
                  style="background-color: #14b8a6; border-radius: 8px; padding: 12px; border: none;">
            Kiszámol
          </button>
        </form>

      </div>
    </div>
  </div>
</x-layout>