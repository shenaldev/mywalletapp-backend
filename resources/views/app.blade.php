<x-layouts.main-layout>
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
                        <a href={{ env('FRONTEND_URL') }}
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
                        <h2 class="text-3xl md:text-4xl font-bold text-ink leading-tight">Take
                            MyWalletCash<br>everywhere
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
                        MyWalletCash.</p>
                    <a href="{{ env('FRONTEND_URL') }}"
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

</x-layouts.main-layout>
