<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gépek listája</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 24px;
        }

        .tabla-tarolo {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        nav {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Gépek listája</h1>

    <p>Összes gép: {{ $gepek->total() }}</p>

    <div class="tabla-tarolo">
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
                    <th>Db</th>
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
                        <td>{{ number_format($gep->ar, 0, ',', ' ') }} Ft</td>
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
    </div>

    <nav>
        {{ $gepek->links() }}
    </nav>
</body>
</html>
