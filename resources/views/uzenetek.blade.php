<x-layout>
  <div class="container my-5">

    <!-- Vissza a főoldalra gomb a cím felett -->
    <div class="mb-3">
      <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm">
        &larr; Vissza a főoldalra
      </a>
    </div>

    <!-- Cím és alcím -->
    <div class="mb-4">
      <h2 class="fw-bold text-white mb-1">Beérkezett üzenetek</h2>
      <p class="small mb-0" style="color: #94a3b8;">A kapcsolatfelvételi űrlapon beküldött megkeresések</p>
    </div>

    <!-- Üzenetek táblázata kártyában -->
    <div class="p-3 p-md-4 rounded-4 shadow-lg overflow-hidden" style="background-color: #151e2e; border: 1px solid #1e2c42;">
      <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0" style="background-color: transparent;">
          <thead>
            <tr style="border-bottom: 2px solid #23334d; color: #2dd4bf; font-size: 0.85rem; letter-spacing: 0.5px;">
              <th scope="col" class="py-3">#</th>
              <th scope="col" class="py-3">NÉV</th>
              <th scope="col" class="py-3">E-MAIL CÍM</th>
              <th scope="col" class="py-3">ÜZENET</th>
              <th scope="col" class="py-3 text-end text-nowrap">KÜLDÉS IDEJE</th>
            </tr>
          </thead>
          <tbody style="font-size: 0.9rem;">
            @forelse($messages as $msg)
              <tr style="border-bottom: 1px solid #1e2c42;">
                <td class="text-secondary">#{{ $msg->id }}</td>
                <td class="fw-semibold text-white text-nowrap">{{ $msg->nev }}</td>
                <td>
                  <a href="mailto:{{ $msg->email }}" class="text-decoration-none text-nowrap" style="color: #2dd4bf;">
                    {{ $msg->email }}
                  </a>
                </td>
                <td style="max-width: 420px;">
                  <div class="text-light" style="white-space: pre-line; word-break: break-word;">{{ $msg->uzenet }}</div>
                </td>
                <td class="text-end text-nowrap small" style="color: #94a3b8;">
                  {{ $msg->created_at->format('Y.m.d H:i:s') }}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-5" style="color: #94a3b8;">
                  Még nem érkezett kapcsolatfelvételi üzenet az adatbázisba.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($messages->hasPages())
        <div class="mt-4 d-flex justify-content-center">
          {{ $messages->links('pagination::bootstrap-5') }}
        </div>
      @endif
    </div>

  </div>
</x-layout>