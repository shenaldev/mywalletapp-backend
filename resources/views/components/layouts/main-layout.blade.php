<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - {{ $title ?? 'Smart Finance Tracking' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
</head>

<body class="{{ $bodyClass ?? 'bg-surface text-ink overflow-x-hidden relative' }}">
    {{-- Noise dot pattern background --}}
    <div class="fixed inset-0 z-0 pointer-events-none"
        style="background-image: radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.1) 1px, transparent 0); background-size: 20px 20px;">
    </div>

    {{-- Navigation --}}
    <x-home.navigation />

    {{-- Main content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-home.footer />
</body>

</html>
