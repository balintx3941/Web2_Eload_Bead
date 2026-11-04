<x-layout>
  <div class="container my-5 d-flex justify-content-center">
    <div style="width: 100%; max-width: 720px;">
      
      <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm">
          &larr; Vissza a főoldalra
        </a>
        <a href="{{ route('gepek.index') }}" class="btn btn-outline-secondary btn-sm text-light">
          &larr; Vissza a gépekhez
        </a>
      </div>

      <div class="p-4 p-sm-5 rounded-4 shadow-lg" style="background-color: #151e2e; border: 1px solid #1e2c42;">
        
        <div class="mb-4">
          <h2 class="fw-bold text-white mb-1">Új gép rögzítése</h2>
          <p class="small mb-0" style="color: #94a3b8;">Töltsd ki az adatlapot az új notebook rögzítéséhez</p>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger py-2 small mb-3" style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171;">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('gepek.store') }}" method="POST">
          @csrf

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label small" style="color: #94a3b8;">Gyártó</label>
              <input type="text" name="gyarto" value="{{ old('gyarto') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-6">
              <label class="form-label small" style="color: #94a3b8;">Típus</label>
              <input type="text" name="tipus" value="{{ old('tipus') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-4">
              <label class="form-label small" style="color: #94a3b8;">Kijelző (col)</label>
              <input type="number" step="0.1" name="kijelzo" value="{{ old('kijelzo') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-4">
              <label class="form-label small" style="color: #94a3b8;">Memória (MB)</label>
              <input type="number" name="memoria" value="{{ old('memoria') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-4">
              <label class="form-label small" style="color: #94a3b8;">Merevlemez (GB)</label>
              <input type="number" name="merevlemez" value="{{ old('merevlemez') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-6">
              <label class="form-label small" style="color: #94a3b8;">Videovezérlő</label>
              <input type="text" name="videovezerlo" value="{{ old('videovezerlo') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-6">
              <label class="form-label small" style="color: #94a3b8;">Ár (Ft)</label>
              <input type="number" name="ar" value="{{ old('ar') }}" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>

            <div class="col-md-6">
              <label class="form-label small" style="color: #94a3b8;">Processzor</label>
              <select name="processzorid" required class="form-select text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
                <option value="" disabled selected>Válassz processzort...</option>
                @foreach($processzorok as $proc)
                  <option value="{{ $proc->id }}" {{ old('processzorid') == $proc->id ? 'selected' : '' }}>
                    {{ $proc->gyarto }} {{ $proc->tipus }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label small" style="color: #94a3b8;">Operációs rendszer</label>
              <select name="oprendszerid" required class="form-select text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
                <option value="" disabled selected>Válassz operációs rendszert...</option>
                @foreach($oprendszerek as $op)
                  <option value="{{ $op->id }}" {{ old('oprendszerid') == $op->id ? 'selected' : '' }}>
                    {{ $op->nev }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label small" style="color: #94a3b8;">Darabszám készleten</label>
              <input type="number" name="db" value="{{ old('db', 1) }}" min="0" required class="form-control text-white" style="background-color: #0c131f; border: 1px solid #23334d; border-radius: 8px;">
            </div>
          </div>

          <div class="mt-4 pt-2">
            <button type="submit" class="btn btn-teal w-100 py-2">
              <i class="bi bi-save me-1"></i> Gép mentése
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-layout>