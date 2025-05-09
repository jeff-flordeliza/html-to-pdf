<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    
</head>

<body>
    <div>
        {{ $slot }}
    </div>
    <!-- <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1> -->
</body>

</html>