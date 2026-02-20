<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - {{ $title ?? 'Smart Finance Tracking' }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- HTML Meta Tags -->
    <meta name="description"
        content="MyWallet is a simple, powerful personal finance tracker. Record your income and expenses, organize spending by categories and payment methods, and gain clarity over your financial life.">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://mywalletcash.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="MyWalletCash - Smart Finance Tracking">
    <meta property="og:description"
        content="MyWallet is a simple, powerful personal finance tracker. Record your income and expenses, organize spending by categories and payment methods, and gain clarity over your financial life.">
    <meta property="og:image" content="https://mywalletcash.com/img/og-cover.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="mywalletcash.com">
    <meta property="twitter:url" content="https://mywalletcash.com">
    <meta name="twitter:title" content="MyWalletCash - Smart Finance Tracking">
    <meta name="twitter:description"
        content="MyWallet is a simple, powerful personal finance tracker. Record your income and expenses, organize spending by categories and payment methods, and gain clarity over your financial life.">
    <meta name="twitter:image" content="https://mywalletcash.com/img/og-cover.png">

    <!-- Meta Tags Generated via https://www.opengraph.xyz -->

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
