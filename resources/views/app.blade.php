<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Smart Finance Tracking</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-surface text-ink overflow-x-hidden relative">
    {{-- Noise dot pattern background --}}
    <div class="fixed inset-0 z-0 pointer-events-none"
        style="background-image: radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.1) 1px, transparent 0); background-size: 20px 20px;">
    </div>

    {{-- NAVIGATION --}}
    <nav id="nav"
        class="fixed top-0 inset-x-0 z-50 bg-white/70 backdrop-blur-lg border-b border-primary/10 transition-all duration-300">
        <div class="container flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-2.5 group">
                <span
                    class="size-8 rounded-lg bg-primary flex items-center justify-center text-white font-bold text-sm tracking-tight select-none">W</span>
                <span
                    class="text-lg font-bold tracking-tight text-ink group-hover:text-primary transition-colors">MyWallet</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="#features"
                    class="hidden md:block text-sm font-medium text-ink-muted hover:text-primary transition-colors">Features</a>
                <a href="#screenshots"
                    class="hidden md:block text-sm font-medium text-ink-muted hover:text-primary transition-colors">Screenshots</a>
                <a href="#how"
                    class="hidden md:block text-sm font-medium text-ink-muted hover:text-primary transition-colors">How
                    It Works</a>
                <a href="#download"
                    class="hidden md:block text-sm font-medium text-ink-muted hover:text-primary transition-colors">Download</a>
                <a href="/app"
                    class="bg-primary text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-primary-deep transition-colors hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/25 active:translate-y-0 duration-200">
                    Launch App
                </a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="min-h-screen pt-16 flex items-center relative">
        {{-- Decorative background shapes --}}
        <div
            class="absolute top-24 -left-32 size-96 rounded-full bg-primary-muted opacity-60 blur-3xl animate-float pointer-events-none">
        </div>
        <div class="absolute bottom-12 -right-24 size-72 rounded-full bg-primary-muted opacity-40 blur-3xl animate-float pointer-events-none"
            style="animation-delay:3s"></div>

        <div class="container relative z-10 py-20 md:py-28">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_0.85fr] gap-16 items-center">
                {{-- Left — copy --}}
                <div class="space-y-8">
                    <div
                        class="hero-badge inline-flex items-center gap-2 bg-primary-muted text-primary text-xs font-semibold tracking-wide uppercase px-3 py-1.5 rounded-full">
                        <span class="size-1.5 rounded-full bg-accent-green animate-pulse-soft"></span>
                        Now Available
                    </div>

                    <h1 class="hero-title text-5xl md:text-6xl lg:text-[4.25rem] font-bold leading-[1.1] text-ink">
                        Your money,<br class="hidden sm:block">
                        <span class="text-primary">crystal clear.</span>
                    </h1>

                    <p class="hero-subtitle text-lg md:text-xl text-ink-muted leading-relaxed max-w-lg">
                        Track every dollar coming in and going out. Choose your currency, categorize, analyze, and take
                        control — all in one clean, minimal app.
                    </p>

                    <div class="hero-cta flex flex-wrap items-center gap-4 pt-2">
                        <a href="/app"
                            class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-7 py-3 rounded-xl hover:bg-primary-deep hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30 active:translate-y-0 transition-all duration-200 group">
                            Get Started Free
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <span class="text-xs text-ink-muted">No credit card required</span>
                    </div>

                    {{-- Micro stats --}}
                    <div class="hero-stats flex items-center gap-8 pt-4">
                        <div>
                            <p class="text-2xl font-bold text-ink">1K<span class="text-primary">+</span></p>
                            <p class="text-xs text-ink-muted mt-0.5">Active users</p>
                        </div>
                        <div class="w-px h-10 bg-primary/15"></div>
                        <div>
                            <p class="text-2xl font-bold text-ink">4.9<span class="text-primary">/5</span></p>
                            <p class="text-xs text-ink-muted mt-0.5">User rating</p>
                        </div>
                        <div class="w-px h-10 bg-primary/15"></div>
                        <div>
                            <p class="text-2xl font-bold text-ink">1M<span class="text-primary">+</span></p>
                            <p class="text-xs text-ink-muted mt-0.5">Txns tracked</p>
                        </div>
                    </div>
                </div>

                {{-- Right — animated mockup card --}}
                <div class="hero-card relative">
                    {{-- Glow behind card --}}
                    <div class="absolute -inset-4 bg-primary/8 rounded-3xl blur-2xl -z-10"></div>

                    <div
                        class="bg-white rounded-2xl border border-primary/10 shadow-xl shadow-primary/5 overflow-hidden">
                        {{-- Card header --}}
                        <div class="px-6 pt-6 pb-4 border-b border-primary/5">
                            <p class="text-xs text-ink-muted tracking-wide uppercase">Overview</p>
                            <p class="text-3xl font-bold text-ink mt-1">$ 45,280<span class="text-primary">.50</span>
                            </p>
                            <div class="flex items-center gap-1.5 mt-2">
                                <span
                                    class="inline-flex items-center gap-1 bg-accent-green/15 text-accent-green text-xs font-semibold px-2 py-0.5 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                    12.4%
                                </span>
                                <span class="text-xs text-ink-muted">vs last month</span>
                            </div>
                        </div>

                        {{-- Mini bar chart --}}
                        <div class="px-6 py-4 border-b border-primary/5">
                            <div class="flex items-end gap-1.5 h-16">
                                <div class="chart-bar flex-1 bg-primary-muted rounded-t h-[40%]"></div>
                                <div class="chart-bar flex-1 bg-primary-muted rounded-t h-[65%]"></div>
                                <div class="chart-bar flex-1 bg-primary-muted rounded-t h-[45%]"></div>
                                <div class="chart-bar flex-1 bg-primary-muted rounded-t h-[80%]"></div>
                                <div class="chart-bar flex-1 bg-primary-light rounded-t h-[55%]"></div>
                                <div class="chart-bar flex-1 bg-primary rounded-t h-[90%]"></div>
                                <div class="chart-bar flex-1 bg-primary-muted rounded-t h-[35%]"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-ink-muted mt-2">
                                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span
                                    class="font-semibold text-primary">Sat</span><span>Sun</span>
                            </div>
                        </div>

                        {{-- Transaction list --}}
                        <div class="divide-y divide-primary/5">
                            <div class="transaction income flex items-center gap-3 px-6 py-3.5">
                                <div
                                    class="txn-icon size-9 rounded-lg bg-accent-green/15 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 text-accent-green">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-ink truncate">Salary Deposit</p>
                                    <p class="text-xs text-ink-muted">Today, 9:30 AM</p>
                                </div>
                                <span class="text-sm font-semibold text-accent-green">+$ 85,000</span>
                            </div>

                            <div class="transaction flex items-center gap-3 px-6 py-3.5">
                                <div
                                    class="txn-icon size-9 rounded-lg bg-accent-red/15 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 text-accent-red">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 4.5l-15 15m0 0h11.25M4.5 19.5V8.25" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-ink truncate">Grocery Shopping</p>
                                    <p class="text-xs text-ink-muted">Today, 2:15 PM</p>
                                </div>
                                <span class="text-sm font-semibold text-accent-red">-$ 3,450</span>
                            </div>

                            <div class="transaction flex items-center gap-3 px-6 py-3.5">
                                <div class="txn-icon size-9 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 text-primary">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0H21M3.375 14.25h-.375a3 3 0 013-3h.008L12 5.25l6 6h.008a3 3 0 013 3v.375" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-ink truncate">Uber Ride</p>
                                    <p class="text-xs text-ink-muted">Yesterday, 6:45 PM</p>
                                </div>
                                <span class="text-sm font-semibold text-accent-red">-$ 780</span>
                            </div>

                            <div class="transaction income flex items-center gap-3 px-6 py-3.5">
                                <div
                                    class="txn-icon size-9 rounded-lg bg-accent-green/15 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 text-accent-green">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-ink truncate">Freelance Payment</p>
                                    <p class="text-xs text-ink-muted">Yesterday, 11:00 AM</p>
                                </div>
                                <span class="text-sm font-semibold text-accent-green">+$ 12,500</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MARQUEE STRIP --}}
    <div class="bg-primary text-white py-3 overflow-hidden">
        <div class="marquee-track flex whitespace-nowrap gap-12 text-sm font-medium tracking-wide">
            <span>Track Income</span>
            <span class="opacity-40">●</span>
            <span>Manage Expenses</span>
            <span class="opacity-40">●</span>
            <span>Categorize Spending</span>
            <span class="opacity-40">●</span>
            <span>Export Reports</span>
            <span class="opacity-40">●</span>
            <span>Multiple Payment Methods</span>
            <span class="opacity-40">●</span>
            <span>Secure & Private</span>
            <span class="opacity-40">●</span>
            <span>Track Income</span>
            <span class="opacity-40">●</span>
            <span>Manage Expenses</span>
            <span class="opacity-40">●</span>
            <span>Categorize Spending</span>
            <span class="opacity-40">●</span>
            <span>Export Reports</span>
            <span class="opacity-40">●</span>
            <span>Multiple Payment Methods</span>
            <span class="opacity-40">●</span>
            <span>Secure & Private</span>
            <span class="opacity-40">●</span>
        </div>
    </div>

    {{-- FEATURES — Bento Grid --}}
    <section id="features" class="py-24 bg-white">
        <div class="container">
            <div class="features-header text-center max-w-2xl mx-auto mb-16">
                <p class="text-sm font-semibold text-primary tracking-wide uppercase mb-3">Features</p>
                <h2 class="text-4xl md:text-5xl font-bold text-ink leading-tight">Everything you need,<br>nothing you
                    don't.</h2>
                <p class="text-ink-muted mt-4 text-lg">Designed for simplicity. Built for power.</p>
            </div>

            {{-- Bento Grid --}}
            <div class="features-grid grid grid-cols-1 md:grid-cols-6 gap-4 auto-rows-[180px]">

                {{-- Large — Tracking --}}
                <div
                    class="feature-item group md:col-span-4 md:row-span-2 bg-surface-alt rounded-2xl border border-primary/8 p-8 flex flex-col justify-between overflow-hidden relative hover:border-primary/25 transition-all duration-300">
                    <div class="relative z-10">
                        <div class="size-11 rounded-xl bg-primary/10 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-ink mb-2">Effortless Tracking</h3>
                        <p class="text-ink-muted max-w-sm">Log every income and expense in seconds. Smart categories
                            learn from your habits to auto-suggest.</p>
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 size-48 rounded-full bg-primary/5 group-hover:bg-primary/8 transition-colors duration-500">
                    </div>
                </div>

                {{-- Small — Categories --}}
                <div
                    class="feature-item group md:col-span-2 bg-white rounded-2xl border border-primary/8 p-6 flex flex-col justify-between hover:border-primary/25 transition-all duration-300">
                    <div class="size-11 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-ink">Categories</h3>
                        <p class="text-sm text-ink-muted mt-1">Custom tags for every spend.</p>
                    </div>
                </div>

                {{-- Small — Payment Methods --}}
                <div
                    class="feature-item group md:col-span-2 bg-white rounded-2xl border border-primary/8 p-6 flex flex-col justify-between hover:border-primary/25 transition-all duration-300">
                    <div class="size-11 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-ink">Payment Methods</h3>
                        <p class="text-sm text-ink-muted mt-1">Cash, card, bank — all in one.</p>
                    </div>
                </div>

                {{-- Medium — Analytics --}}
                <div
                    class="feature-item group md:col-span-3 bg-surface-alt rounded-2xl border border-primary/8 p-8 flex flex-col justify-between hover:border-primary/25 transition-all duration-300">
                    <div class="size-11 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-ink">See Where It Goes</h3>
                        <p class="text-sm text-ink-muted mt-1">Visual breakdowns by category, method, and time period.
                        </p>
                    </div>
                </div>

                {{-- Medium — Security --}}
                <div
                    class="feature-item group md:col-span-3 bg-white rounded-2xl border border-primary/8 p-8 flex flex-col justify-between hover:border-primary/25 transition-all duration-300">
                    <div class="size-11 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-ink">Private & Secure</h3>
                        <p class="text-sm text-ink-muted mt-1">Your data stays yours. Encrypted storage, no third-party
                            access.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- APP SCREENSHOTS --}}
    <section id="screenshots" class="py-24 bg-gray-50">
        <div class="container">
            <div class="screenshots-header text-center max-w-2xl mx-auto mb-16">
                <p class="text-sm font-semibold text-primary tracking-wide uppercase mb-3">Overview</p>
                <h2 class="text-4xl md:text-5xl font-bold text-ink leading-tight">See it in action.</h2>
                <p class="text-ink-muted mt-4 text-lg">A clean, intuitive interface designed for everyday use.</p>
            </div>

            <div class="screenshots-grid grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Screenshot 1 — Dashboard --}}
                <div class="screenshot-item group">
                    <div
                        class="bg-white rounded-2xl border border-primary/8 overflow-hidden shadow-sm hover:shadow-lg hover:shadow-primary/10 transition-all duration-300">
                        <img src="/img/payment-ss.png" />
                        <div class="px-5 py-4">
                            <h3 class="font-semibold text-ink">Payments Overview</h3>
                            <p class="text-sm text-ink-muted mt-1">Track your payments effortlessly.</p>
                        </div>
                    </div>
                </div>

                {{-- Screenshot 2 — Transactions --}}
                <div class="screenshot-item group">
                    <div
                        class="bg-white rounded-2xl border border-primary/8 overflow-hidden shadow-sm hover:shadow-lg hover:shadow-primary/10 transition-all duration-300">
                        <img src="/img/analysis-ss.png" />
                        <div class="px-5 py-4">
                            <h3 class="font-semibold text-ink">Yearly Transactions Analysis</h3>
                            <p class="text-sm text-ink-muted mt-1">Analyze your transactions over the year for better
                                insights.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section id="how" class="py-24 bg-white">
        <div class="container">
            <div class="how-header text-center max-w-2xl mx-auto mb-16">
                <p class="text-sm font-semibold text-primary tracking-wide uppercase mb-3">How It Works</p>
                <h2 class="text-4xl md:text-5xl font-bold text-ink leading-tight">Three steps to<br>financial clarity.
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="step-item text-center md:text-left space-y-4">
                    <div
                        class="inline-flex items-center justify-center size-14 rounded-2xl bg-primary text-white text-xl font-bold">
                        1</div>
                    <h3 class="text-xl font-bold text-ink">Sign Up Instantly</h3>
                    <p class="text-ink-muted">Create your account in under 30 seconds. No credit card, no hassle.</p>
                </div>
                <div class="step-item text-center md:text-left space-y-4">
                    <div
                        class="inline-flex items-center justify-center size-14 rounded-2xl bg-primary-light text-white text-xl font-bold">
                        2</div>
                    <h3 class="text-xl font-bold text-ink">Log Transactions</h3>
                    <p class="text-ink-muted">Add income and expenses with one tap. Smart categories make it
                        effortless.</p>
                </div>
                <div class="step-item text-center md:text-left space-y-4">
                    <div
                        class="inline-flex items-center justify-center size-14 rounded-2xl bg-primary-muted text-primary text-xl font-bold">
                        3</div>
                    <h3 class="text-xl font-bold text-ink">Gain Insights</h3>
                    <p class="text-ink-muted">See clear breakdowns by category and time. Know exactly where your money
                        goes.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- DOWNLOAD APP --}}
    <section id="download" class="py-24 bg-surface">
        <div class="container">
            <div class="download-section bg-white rounded-3xl border border-primary/8 overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    {{-- Left — content --}}
                    <div class="p-10 md:p-16 flex flex-col justify-center space-y-6">
                        <div
                            class="inline-flex items-center gap-2 bg-accent-red/15 text-accent-red text-xs font-semibold tracking-wide uppercase px-3 py-1.5 rounded-full w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5-10.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Coming Soon
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-ink leading-tight">Take MyWallet<br>everywhere
                            you go.</h2>
                        <p class="text-ink-muted text-lg max-w-md">Mobile app launching soon. Be the first to know -
                            sign up for early access. Available for iOS and Android.</p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            {{-- Email Signup --}}
                            <form class="flex gap-2 w-full md:w-auto">
                                <input type="email" placeholder="Enter your email"
                                    class="flex-1 md:flex-none px-4 py-3 rounded-xl border border-primary/20 focus:border-primary outline-none transition-colors text-sm"
                                    required>
                                <button type="submit"
                                    class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-xl hover:bg-primary-deep transition-colors font-semibold">
                                    Notify Me
                                </button>
                            </form>
                        </div>
                        <p class="text-xs text-ink-muted">Syncs with web app in real time</p>
                    </div>

                    {{-- Right — phone mockup with coming soon overlay --}}
                    <div class="bg-surface-alt flex items-center justify-center p-8 md:p-12 relative">
                        <div class="phone-mockup relative w-64 md:w-lg">
                            <img src="/img/coming-soon.png" alt="Mobile app is launching soon"
                                class="rounded-md shadow-md">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-white">
        <div class="container">
            <div
                class="cta-section bg-primary rounded-3xl px-8 md:px-16 py-16 md:py-20 text-center relative overflow-hidden">
                {{-- Decorative shapes --}}
                <div class="absolute top-0 left-0 size-48 rounded-full bg-white/5 -translate-x-1/2 -translate-y-1/2">
                </div>
                <div class="absolute bottom-0 right-0 size-64 rounded-full bg-white/5 translate-x-1/3 translate-y-1/3">
                </div>

                <div class="relative z-10 max-w-xl mx-auto space-y-6">
                    <h2 class="text-3xl md:text-5xl font-bold text-white leading-tight">Start tracking today.</h2>
                    <p class="text-lg text-white/70">Join thousands who've taken control of their finances with
                        MyWallet.</p>
                    <a href="/app"
                        class="inline-flex items-center gap-2 bg-white text-primary font-semibold px-8 py-3.5 rounded-xl hover:bg-surface hover:shadow-lg transition-all duration-200 group">
                        Launch App
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="border-t border-primary/10 bg-ink text-white pt-16 pb-8">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                {{-- Brand & About --}}
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-2.5">
                        <span
                            class="size-8 rounded-lg bg-primary flex items-center justify-center text-white text-sm font-bold">W</span>
                        <span class="text-lg font-bold">MyWallet</span>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed max-w-sm">
                        MyWallet is a simple, powerful personal finance tracker. Record your income and expenses,
                        organize spending by categories and payment methods, and gain clarity over your financial life.
                    </p>
                    {{-- Social Media --}}
                    <div class="flex items-center gap-3 pt-2">
                        <a href="#" aria-label="Twitter"
                            class="size-9 rounded-lg bg-white/10 hover:bg-primary/80 flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Facebook"
                            class="size-9 rounded-lg bg-white/10 hover:bg-primary/80 flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram"
                            class="size-9 rounded-lg bg-white/10 hover:bg-primary/80 flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn"
                            class="size-9 rounded-lg bg-white/10 hover:bg-primary/80 flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="space-y-4">
                    <h4 class="font-semibold text-sm uppercase tracking-wider text-white/80">Product</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#features"
                                class="text-sm text-white/50 hover:text-white transition-colors">Features</a></li>
                        <li><a href="#screenshots"
                                class="text-sm text-white/50 hover:text-white transition-colors">Screenshots</a></li>
                        <li><a href="#download"
                                class="text-sm text-white/50 hover:text-white transition-colors">Download App</a></li>
                        <li><a href="#how" class="text-sm text-white/50 hover:text-white transition-colors">How It
                                Works</a></li>
                        <li><a href="/app" class="text-sm text-white/50 hover:text-white transition-colors">Launch
                                Web App</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div class="space-y-4">
                    <h4 class="font-semibold text-sm uppercase tracking-wider text-white/80">Legal</h4>
                    <ul class="space-y-2.5">
                        <li><a href="/terms" class="text-sm text-white/50 hover:text-white transition-colors">Terms &
                                Conditions</a></li>
                        <li><a href="/privacy"
                                class="text-sm text-white/50 hover:text-white transition-colors">Privacy Policy</a>
                        </li>
                        <li><a href="mailto:support@mywallet.app"
                                class="text-sm text-white/50 hover:text-white transition-colors">Contact Support</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-white/40">&copy; {{ date('Y') }} MyWallet. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
