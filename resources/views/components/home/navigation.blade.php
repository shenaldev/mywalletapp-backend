 <nav id="nav"
     class="fixed top-0 inset-x-0 z-50 bg-white/70 backdrop-blur-lg border-b border-primary/10 transition-all duration-300">
     <div class="container flex items-center justify-between h-16">
         <a href="/" class="flex items-center gap-2.5 group">
             <img src="/img/logo.png" alt="Logo" class="max-w-48 w-full md:max-w-56">
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
             <a href={{ env('FRONTEND_URL') }}
                 class="bg-primary text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-primary-deep transition-colors hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/25 active:translate-y-0 duration-200">
                 Launch App
             </a>
         </div>
     </div>
 </nav>
