<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új gép felvitele</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px 15px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button, .back {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        .back {
            background: #6b7280;
            margin-left: 8px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Új gép felvitele</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gepek.store') }}" method="POST">
        @csrf

        <label>Gyártó</label>
        <input type="text" name="gyarto" value="{{ old('gyarto') }}" required>

        <label>Típus</label>
        <input type="text" name="tipus" value="{{ old('tipus') }}" required>

        <label>Kijelző</label>
        <input type="text" name="kijelzo" value="{{ old('kijelzo') }}" required>

        <label>Memória</label>
        <input type="text" name="memoria" value="{{ old('memoria') }}" required>

        <label>Merevlemez</label>
        <input type="text" name="merevlemez" value="{{ old('merevlemez') }}" required>

        <label>Videovezérlő</label>
        <input type="text" name="videovezerlo" value="{{ old('videovezerlo') }}" required>

        <label>Ár</label>
        <input type="number" name="ar" min="0" step="0.01" value="{{ old('ar') }}" required>

        <label>Processzor</label>
        <select name="processzorid" required>
            <option value="">Válassz processzort!</option>
            @foreach ($processzorok as $processzor)
                <option value="{{ $processzor->id }}"
                    {{ old('processzorid') == $processzor->id ? 'selected' : '' }}>
                    {{ $processzor->gyarto }} {{ $processzor->tipus }}
                </option>
            @endforeach
        </select>

        <label>Operációs rendszer</label>
        <select name="oprendszerid" required>
            <option value="">Válassz operációs rendszert!</option>
            @foreach ($oprendszerek as $oprendszer)
                <option value="{{ $oprendszer->id }}"
                    {{ old('oprendszerid') == $oprendszer->id ? 'selected' : '' }}>
                    {{ $oprendszer->nev }}
                </option>
            @endforeach
        </select>

        <label>Darabszám</label>
        <input type="number" name="db" min="0" value="{{ old('db', 0) }}" required>

        <button type="submit">Gép mentése</button>
        <a href="{{ route('gepek.index') }}" class="back">Vissza</a>
    </form>
</div>

</body>
</html>
