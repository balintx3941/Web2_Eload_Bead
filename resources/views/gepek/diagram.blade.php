<x-layout>
  <div class="container my-5">

    <!-- Vissza a főoldalra gomb -->
    <div class="mb-4">
      <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Vissza a főoldalra
      </a>
    </div>

    <!-- Diagram kártya Rentiz stílusban -->
    <div class="p-4 p-md-5 rounded-4 shadow-lg" style="background-color: #151e2e; border: 1px solid #1e2c42;">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-white mb-2">Gépek gyártónként</h2>
        <p class="small mb-0" style="color: #94a3b8;">Az adatbázisban szereplő gépek száma gyártók szerinti megoszlásban.</p>
      </div>

      <div style="position: relative; height: 460px; max-width: 950px; margin: 0 auto;">
        <canvas id="gyartoDiagram"></canvas>
      </div>
    </div>

  </div>

  <!-- Chart.js könyvtár és inicializálás -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const gyartok = @json($gyartok);
    const darabok = @json($darabok);

    new Chart(document.getElementById('gyartoDiagram'), {
      type: 'bar',
      data: {
        labels: gyartok,
        datasets: [{
          label: 'Gépek száma',
          data: darabok,
          backgroundColor: 'rgba(20, 184, 166, 0.75)',
          borderColor: 'rgba(45, 212, 191, 1)',
          borderWidth: 1.5,
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            labels: {
              color: '#cbd5e1',
              font: { size: 13 }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0,
              color: '#94a3b8'
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.08)'
            },
            title: {
              display: true,
              text: 'Darabszám (db)',
              color: '#94a3b8',
              font: { weight: 'bold' }
            }
          },
          x: {
            ticks: {
              color: '#cbd5e1'
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.04)'
            },
            title: {
              display: true,
              text: 'Gyártó',
              color: '#94a3b8',
              font: { weight: 'bold' }
            }
          }
        }
      }
    });
  </script>
</x-layout>