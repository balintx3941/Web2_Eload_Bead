<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gépek diagramja</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        nav {
            background: #1e293b;
            padding: 18px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin: 0 15px;
        }

        nav a:hover {
            color: #93c5fd;
        }

        main {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 18px;
        }

        .diagram-doboz {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
            color: #64748b;
        }

        .diagram-helye {
            position: relative;
            height: 450px;
            max-width: 900px;
            margin: 25px auto 0;
        }

        @media (max-width: 600px) {
            .diagram-helye {
                height: 350px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ url('/') }}">Főoldal</a>
        <a href="{{ route('kapcsolat.index') }}">Kapcsolat</a>
        <a href="{{ route('gepek.index') }}">Gépek</a>
        <a href="{{ route('diagram.index') }}">Diagram</a>
    </nav>

    <main>
        <div class="diagram-doboz">
            <h1>Gépek gyártónként</h1>
            <p>Az adatbázisban szereplő gépek száma gyártónként.</p>

            <div class="diagram-helye">
                <canvas id="gyartoDiagram"></canvas>
            </div>
        </div>
    </main>

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
                    backgroundColor: 'rgba(37, 99, 235, 0.7)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        title: {
                            display: true,
                            text: 'Gépek száma'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Gyártó'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
