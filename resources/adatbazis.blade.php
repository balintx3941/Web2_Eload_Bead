<x-layout>
  <div class="container my-4">

    <!-- Fejléc & Kereső -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
      <div>
        <h2 class="fw-bold text-white mb-1">Katalógus Adatbázis</h2>
        <p class="text-secondary small mb-0">3 tábla összekapcsolt adatai: Gépek, Processzorok és Operációs rendszerek (Eloquent ORM)</p>
      </div>

      <!-- Kereső & Szűrő form -->
      <form method="GET" action="{{ route('adatbazis') }}" class="d-flex flex-wrap gap-2">
        <input type="text" name="search" class="form-control form-control-sm bg-dark text-white border-secondary" 
               placeholder="Keresés gyártó, típus..." value="{{ request('search') }}" style="max-width: 200px;">
        
        <select name="oprendszer_id" class="form-select form-select-sm bg-dark text-white border-secondary" style="max-width: 170px;">
          <option value="">Összes OS</option>
          @foreach($oprendszerek as $os)
            <option value="{{ $os->id }}" {{ request('oprendszer_id') == $os->id ? 'selected' : '' }}>
              {{ $os->nev ?? $os->tipus ?? $os->id }}
            </option>
          @endforeach
        </select>

        <button type="submit" class="btn btn-teal btn-sm">Szűrés</button>
        @if(request()->hasAny(['search', 'oprendszer_id']))
          <a href="{{ route('adatbazis') }}" class="btn btn-outline-secondary btn-sm">Visszaállítás</a>
        @endif
      </form>
    </div>

    <!-- 3 Táblás Adattábla -->
    <div class="custom-card p-3 overflow-hidden">
      <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0" style="background-color: transparent;">
          <thead>
            <tr style="border-bottom: 2px solid var(--card-border); color: var(--teal-light); font-size: 0.85rem;">
              <th>ID</th>
              <th>GYÁRTÓ & TÍPUS</th>
              <th>PROCESSZOR (2. TÁBLA)</th>
              <th>OPERÁCIÓS RENDSZER (3. TÁBLA)</th>
              <th>MEMÓRIA / TÁRHELY</th>
              <th>KIJELZŐ & GPU</th>
              <th class="text-end">ÁR</th>
            </tr>
          </thead>
          <tbody style="font-size: 0.9rem;">
            @forelse($gepek as $gep)
              <tr style="border-bottom: 1px solid var(--card-border);">
                <td class="text-secondary">#{{ $gep->id }}</td>
                <td>
                  <strong class="text-white">{{ $gep->gyarto }}</strong>
                  <div class="text-secondary small">{{ $gep->tipus }}</div>
                </td>
                <td>
                  @if($gep->processzor)
                    <span class="text-info fw-semibold">{{ $gep->processzor->gyarto ?? '' }} {{ $gep->processzor->tipus ?? '' }}</span>
                    <div class="text-muted small">{{ $gep->processzor->ora_jel ?? $gep->processzor->orajel ?? '' }}</div>
                  @else
                    <span class="text-muted">N/A</span>
                  @endif
                </td>
                <td>
                  @if($gep->oprendszer)
                    <span class="badge-teal-pill">{{ $gep->oprendszer->nev ?? $gep->oprendszer->tipus ?? 'Telepítve' }}</span>
                  @else
                    <span class="text-muted">Nincs OS</span>
                  @endif
                </td>
                <td>
                  <div>{{ $gep->memoria }} MB RAM</div>
                  <div class="text-secondary small">{{ $gep->merevlemez }} GB HDD/SSD</div>
                </td>
                <td>
                  <div>{{ $gep->kijelzo }}"</div>
                  <div class="text-secondary small">{{ Str::limit($gep->videovezerlo, 20) }}</div>
                </td>
                <td class="text-end">
                  <span class="fw-bold" style="color: var(--teal-light);">{{ number_format($gep->ar, 0, ',', ' ') }} Ft</span>
                  <div class="text-muted small">{{ $gep->db }} db raktáron</div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">
                  Nincs a keresési feltételeknek megfelelő konfiguráció az adatbázisban.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Lapozó -->
      <div class="mt-3 d-flex justify-content-center">
        {{ $gepek->links('pagination::bootstrap-5') }}
      </div>
    </div>

  </div>
</x-layout>