<x-layout>
  <div class="container my-5">

    <!-- Felső sáv: Vissza a főoldalra és Új gép gomb -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
      <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Vissza a főoldalra
      </a>
      <a href="{{ route('gepek.create') }}" class="btn btn-teal btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Új gép rögzítése
      </a>
    </div>

    <!-- Cím és alcím -->
    <div class="mb-4">
      <h2 class="fw-bold text-white mb-1">Gépek nyilvántartása</h2>
      <p class="small mb-0" style="color: #94a3b8;">Az adatbázisban tárolt konfigurációk és készletadatok</p>
    </div>

    @if(session('siker') || session('success'))
      <div class="alert alert-success d-flex align-items-center mb-4" style="background-color: rgba(20, 184, 166, 0.15); border: 1px solid #14b8a6; color: #2dd4bf;" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('siker') ?? session('success') }}</div>
      </div>
    @endif

    @if(session('failed') || session('error'))
      <div class="alert alert-danger d-flex align-items-center mb-4" style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171;" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>{{ session('failed') ?? session('error') }}</div>
      </div>
    @endif

    <!-- Táblázat Rentiz kártyában -->
    <div class="p-3 p-md-4 rounded-4 shadow-lg overflow-hidden" style="background-color: #151e2e; border: 1px solid #1e2c42;">
      <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0" style="background-color: transparent;">
          <thead>
            <tr style="border-bottom: 2px solid #23334d; color: #2dd4bf; font-size: 0.8rem; letter-spacing: 0.5px; text-transform: uppercase;">
              <th scope="col" class="py-3">#</th>
              <th scope="col" class="py-3">Gyártó</th>
              <th scope="col" class="py-3">Típus</th>
              <th scope="col" class="py-3">Kijelző</th>
              <th scope="col" class="py-3">Memória</th>
              <th scope="col" class="py-3">Tárhely</th>
              <th scope="col" class="py-3">Videovezérlő</th>
              <th scope="col" class="py-3">Ár</th>
              <th scope="col" class="py-3 text-center">Darab</th>
              <th scope="col" class="py-3 text-end">Műveletek</th>
            </tr>
          </thead>
          <tbody style="font-size: 0.88rem;">
            @forelse($gepek as $gep)
              <tr style="border-bottom: 1px solid #1e2c42;">
                <td class="text-secondary">#{{ $gep->id }}</td>
                <td>
                  <span class="badge" style="background-color: #12222d; border: 1px solid #1a3842; color: #2dd4bf; font-weight: 600;">
                    {{ $gep->gyarto }}
                  </span>
                </td>
                <td class="fw-semibold text-white">{{ $gep->tipus }}</td>
                <td style="color: #cbd5e1;">{{ $gep->kijelzo }}"</td>
                <td style="color: #cbd5e1;">{{ $gep->memoria }} MB</td>
                <td style="color: #cbd5e1;">{{ $gep->merevlemez }} GB</td>
                <td style="color: #cbd5e1; max-width: 200px;">
                  <span class="text-truncate d-inline-block" style="max-width: 190px;" title="{{ $gep->videovezerlo }}">
                    {{ $gep->videovezerlo }}
                  </span>
                </td>
                <td class="fw-bold text-nowrap" style="color: #5eead4;">
                  {{ number_format($gep->ar, 0, ',', ' ') }} Ft
                </td>
                <td class="text-center">
                  @if($gep->db > 0)
                    <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 px-2 py-1">
                      {{ $gep->db }} db
                    </span>
                  @else
                    <span class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-25 px-2 py-1">
                      0 db
                    </span>
                  @endif
                </td>
                <td class="text-end text-nowrap">
                  <a href="{{ route('gepek.edit', $gep->id) }}" class="btn btn-sm btn-outline-info me-1" style="font-size: 0.78rem; padding: 4px 10px;">
                    <i class="bi bi-pencil-square"></i> Módosítás
                  </a>
                  <form action="{{ route('gepek.destroy', $gep->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törölni szeretnéd ezt a gépet?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 0.78rem; padding: 4px 10px;">
                      <i class="bi bi-trash"></i> Törlés
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="10" class="text-center py-5" style="color: #94a3b8;">
                  Nincs rögzített gép az adatbázisban.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if(method_exists($gepek, 'hasPages') && $gepek->hasPages())
        <div class="mt-4 d-flex justify-content-center">
          {{ $gepek->links('pagination::bootstrap-5') }}
        </div>
      @endif
    </div>

  </div>
</x-layout>
