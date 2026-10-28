<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapcsolat</title>

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

        .oldal {
            min-height: calc(100vh - 58px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 16px;
        }

        .kapcsolat-doboz {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .bevezeto {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
        }

        .mezo {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font: inherit;
        }

        input:focus,
        textarea:focus {
            outline: 2px solid #93c5fd;
            border-color: #2563eb;
        }

        textarea {
            resize: vertical;
            min-height: 140px;
        }

        button {
            display: block;
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .hibak {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 18px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .siker {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 500px) {
            .kapcsolat-doboz {
                padding: 24px 18px;
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
        <section class="kapcsolat-doboz">
            <h1>Kapcsolat</h1>
            <p class="bevezeto">
                Kérdésed vagy üzeneted van? Írj nekünk!
            </p>

            @if (session('siker'))
                <div class="siker">
                    {{ session('siker') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="hibak">
                    <strong>Kérjük, javítsd a hibákat:</strong>
                    <ul>
                        @foreach ($errors->all() as $hiba)
                            <li>{{ $hiba }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kapcsolat.kuldes') }}" method="POST">
                @csrf

                <div class="mezo">
                    <label for="nev">Név</label>
                    <input
                        type="text"
                        id="nev"
                        name="nev"
                        value="{{ old('nev') }}"
                        maxlength="100"
                        required
                    >
                </div>

                <div class="mezo">
                    <label for="email">E-mail-cím</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="255"
                        required
                    >
                </div>

                <div class="mezo">
                    <label for="targy">Tárgy</label>
                    <input
                        type="text"
                        id="targy"
                        name="targy"
                        value="{{ old('targy') }}"
                        maxlength="150"
                        required
                    >
                </div>

                <div class="mezo">
                    <label for="uzenet">Üzenet</label>
                    <textarea
                        id="uzenet"
                        name="uzenet"
                        minlength="10"
                        maxlength="5000"
                        required
                    >{{ old('uzenet') }}</textarea>
                </div>

                <button type="submit">Üzenet küldése</button>
            </form>
        </section>
    </main>

</body>
</html>
