<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gépek</title>

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
            display: inline-block;
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin: 0 15px;
        }

        nav a:hover {
            color: #93c5fd;
        }

        .oldal {
            max-width: 1400px;
            margin: 0 auto;
            padding: 35px 20px;
        }

        h1 {
            text-align: center;
            margin: 0 0 10px;
        }

        .bevezeto {
            text-align: center;
            color: #64748b;
            margin-bottom: 28px;
        }

        .tabla-doboz {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 12px 10px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background: #eaf1f8;
            color: #1e293b;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .lapozo {
            margin-top: 20px;
        }

        .lapozo nav {
            background: transparent;
            padding: 0;
            text-align: left;
        }

        .lapozo nav a {
            color: #2563eb;
        }

        @media (max-width: 600px) {
            .oldal {
                padding: 25px 12px;
            }

            .tabla-doboz {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <a href="{{ url('/') }}">Főoldal</a>
        <a href="{{ route('kapcsolat.index') }}">Kapcsolat</a>
        <a href="{{ route('gepek.index') }}">Gépek</a>
    </nav>

    <main class="oldal">
        <h1>Gépek</h1>
        <p class="bevezeto">
            A nyilvántartásban szereplő gépek adatai
        </p>

        <div class="tabla-doboz">
            <table>
                <thead>
                    <tr>
                        <th>Gyártó</th>
                        <th>Típus</th>
                        <th>Kijelző</th>
                        <th>Memória</th>
                        <th>Merevlemez</th>
                        <th>Videóvezérlő</th>
                        <th>Ár</th>
                        <th>Processzor</th>
                        <th>Operációs rendszer</th>
                        <th>Darab</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($gepek as $gep)
                        <tr>
                            <td>{{ $gep->gyarto }}</td>
                            <td>{{ $gep->tipus }}</td>
                            <td>{{ $gep->kijelzo }}</td>
                            <td>{{ $gep->memoria }}</td>
                            <td>{{ $gep->merevlemez }}</td>
                            <td>{{ $gep->videovezerlo }}</td>
                            <td>{{ number_format((float) $gep->ar, 0, ',', ' ') }} Ft</td>
                            <td>
                                {{ $gep->processzor?->gyarto }}
                                {{ $gep->processzor?->tipus }}
                            </td>
                            <td>{{ $gep->oprendszer?->nev }}</td>
                            <td>{{ $gep->db }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">Nincs megjeleníthető gép.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="lapozo">
                @if ($gepek->onFirstPage())
        <span>« Előző</span>
    @else
        <a href="{{ $gepek->previousPageUrl() }}">« Előző</a>
    @endif

    <span>
        {{ $gepek->firstItem() }}–{{ $gepek->lastItem() }}
        / összesen {{ $gepek->total() }} gép
    </span>

    @if ($gepek->hasMorePages())
        <a href="{{ $gepek->nextPageUrl() }}">Következő »</a>
    @else
        <span>Következő »</span>
    @endif
            </div>
        </div>
    </main>

</body>
</html>
