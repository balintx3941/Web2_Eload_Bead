<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Notebook Webáruház' }}</title>
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
    <div class="header">
       @include('components.header')
    </div>

    <div>
        {{ $content1 ?? '' }}
    </div>

    <div class="content" style="padding: 20px;">
        {{ $slot }}
    </div>

    <footer style="text-align: center; margin-top: 50px; padding: 10px; background: #f1f1f1;">
        Készítette: Horváth Gréta - AZQ13J & Bódi Bálint -KLNK5L
    </footer>
</body>
</html>