<div class="bg-[#FAF7F5] min-h-screen text-slate-800 selection:bg-salon-500 selection:text-white">
    
    <!-- Top Nav Header -->
    <header class="border-b gold-border bg-white/80 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-salon-600 to-amber-500 flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-spa text-lg"></i>
                </div>
                <div class="font-serif text-2xl font-bold text-slate-900 tracking-tight">
                    GlowSuite <span class="text-salon-500 font-sans text-xs px-2 py-0.5 rounded-full bg-salon-50 font-bold border border-salon-200">B2B SaaS</span>
                </div>
            </div>

            <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-slate-600">
                <a href="#features" class="hover:text-salon-600 transition">Features</a>
                <a href="#salons" class="hover:text-salon-600 transition">Tenant Demo Salons</a>
                <a href="#pricing" class="hover:text-salon-600 transition">Pricing Plans</a>
                <a href="#tech" class="hover:text-salon-600 transition">Stack Architecture</a>
            </nav>

            <div class="flex items-center space-x-3">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl border gold-border text-xs font-semibold hover:bg-salon-50 transition">
                    Sign In
                </a>
                <a href="{{ route('quick.login', 'owner@luxe.com') }}" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-md shadow-salon-500/20 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt text-amber-300"></i>
                    <span>Live Salon Demo</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-16 pb-24 overflow-hidden border-b gold-border bg-gradient-to-b from-white via-[#FAF7F5] to-[#FAF7F5]">
        <div class="max-w-7xl mx-auto px-6 text-center">
            
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-salon-50 border border-salon-200 text-salon-700 text-xs font-semibold mb-6 shadow-xs">
                <span class="w-2 h-2 rounded-full bg-salon-500 animate-pulse"></span>
                <span>The Premier B2B Operating System for High-End Salons & Spas</span>
            </div>

            <h1 class="font-serif text-4xl sm:text-6xl font-bold text-slate-900 tracking-tight max-w-4xl mx-auto leading-tight">
                Elevate Every Appointment with <span class="text-transparent bg-clip-text bg-gradient-to-r from-salon-600 via-amber-600 to-salon-500">Intelligent SaaS</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto mt-6 leading-relaxed">
                Streamline client bookings, track stylist commissions in real-time, process high-velocity POS payments, and provide branded self-service booking portals for every tenant salon.
            </p>

            <!-- CTA Actions -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('quick.login', 'owner@luxe.com') }}" class="px-6 py-3.5 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs sm:text-sm font-bold shadow-xl shadow-salon-500/30 transition flex items-center gap-2">
                    <i class="fa-solid fa-play text-xs"></i>
                    <span>Launch Luxe & Co. Workspace</span>
                </a>
                <a href="{{ route('quick.login', 'owner@velvet.com') }}" class="px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs sm:text-sm font-bold shadow-md transition flex items-center gap-2">
                    <i class="fa-solid fa-spa text-emerald-400 text-xs"></i>
                    <span>Launch Velvet Spa Workspace</span>
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3.5 rounded-xl border gold-border bg-white hover:bg-salon-50 text-slate-800 text-xs sm:text-sm font-semibold transition">
                    SuperAdmin Login
                </a>
            </div>

            <!-- Dashboard Preview Mockup Card -->
            <div class="mt-14 max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-2xl border gold-border bg-white p-3">
                <div class="rounded-2xl overflow-hidden border border-slate-200">
                    <div class="bg-obsidian-950 p-3 flex items-center justify-between text-xs text-slate-400">
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                            <span class="ml-4 font-mono text-[11px] text-slate-500">app.glowsuite.io/dashboard</span>
                        </div>
                        <span class="font-serif text-salon-400 font-bold">Luxe & Co. Hair & Beauty Lounge</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1600&auto=format&fit=crop&q=80" alt="Salon Dashboard Preview" class="w-full h-80 sm:h-96 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Core Features Grid -->
    <section id="features" class="py-20 border-b gold-border">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-salon-600 bg-salon-50 px-3 py-1 rounded-full">Engineered for Salons</span>
                <h2 class="font-serif text-3xl font-bold text-slate-900 mt-2">Everything You Need to Scale Your Beauty Business</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="glass-panel p-8 rounded-3xl border gold-border hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-2xl bg-salon-50 text-salon-600 flex items-center justify-center text-xl mb-6">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Real-Time Booking Matrix</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Interactive Livewire-powered calendar that handles appointments, walk-ins, buffer times, and auto-calculates completion times seamlessly.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-panel p-8 rounded-3xl border gold-border hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Stylist Roster & Commissions</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Track artistic team performance, star ratings, and automatic tiered commission percentage splits on every service rendered.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-panel p-8 rounded-3xl border gold-border hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-cash-register"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Integrated POS Register</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        High-velocity checkout terminal with instant service additions, custom discounts, sales tax computation, and printable client receipts.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="glass-panel p-8 rounded-3xl border gold-border hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">VIP Client CRM</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Store color formulas, hair history, visit frequency, lifetime spend, and loyalty points for complete client personalization.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="glass-panel p-8 rounded-3xl border gold-border hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Self-Service Booking Portal</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Every salon tenant receives their own dedicated white-labeled client booking web portal at <code>/book/{salon-slug}</code>.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="glass-panel p-8 rounded-3xl border gold-border hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Multi-Tenant Architecture</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Clean database multi-tenancy backed by MySQL, scoped data isolation, customizable brand palettes, and tiered SaaS subscription limits.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Tenant Salons Section -->
    <section id="salons" class="py-20 border-b gold-border bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-salon-600 bg-salon-50 px-3 py-1 rounded-full">Multi-Tenancy in Action</span>
                <h2 class="font-serif text-3xl font-bold text-slate-900 mt-2">Explore Sample Live Salons</h2>
                <p class="text-xs text-slate-500 mt-2">Test both the owner management dashboard and the client booking portals</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($salons as $s)
                <div class="glass-panel rounded-3xl p-8 border gold-border shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs uppercase font-bold tracking-wider px-2.5 py-1 rounded-full bg-salon-50 text-salon-700 border border-salon-200">
                                {{ $s->subscription_plan }} Plan
                            </span>
                            <span class="text-xs text-slate-400 font-mono">{{ $s->city }}</span>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-slate-900">{{ $s->name }}</h3>
                        <p class="text-xs text-slate-500 mt-1">{{ $s->tagline }}</p>

                        <div class="grid grid-cols-2 gap-4 my-6 text-xs text-slate-600">
                            <div class="p-3 bg-slate-50 rounded-xl">
                                <span class="text-slate-400 text-[10px] block uppercase font-bold">Services</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $s->services->count() }} Treatments</span>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-xl">
                                <span class="text-slate-400 text-[10px] block uppercase font-bold">Artisans</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $s->staffMembers->count() }} Stylists</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t gold-border flex flex-wrap items-center gap-3">
                        <a href="{{ route('switch.salon', $s->id) }}" class="flex-1 py-2.5 px-4 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold text-center shadow-sm transition">
                            Open Salon Workspace
                        </a>
                        <a href="{{ route('public.booking', $s->slug) }}" target="_blank" class="py-2.5 px-4 rounded-xl border gold-border hover:bg-slate-50 text-slate-700 text-xs font-semibold transition flex items-center gap-1.5">
                            <span>Client Portal</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Plans Section -->
    <section id="pricing" class="py-20 border-b gold-border">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-salon-600 bg-salon-50 px-3 py-1 rounded-full">Transparent SaaS Pricing</span>
                <h2 class="font-serif text-3xl font-bold text-slate-900 mt-2">Predictable Plans for Every Stage</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Starter -->
                <div class="glass-panel p-8 rounded-3xl border gold-border bg-white flex flex-col justify-between shadow-sm">
                    <div>
                        <h4 class="font-serif text-lg font-bold text-slate-900">Starter Boutique</h4>
                        <p class="text-xs text-slate-500 mt-1">Solo studios & boutique chairs</p>
                        <div class="my-6">
                            <span class="font-serif text-4xl font-bold text-slate-900">$29</span>
                            <span class="text-xs text-slate-400">/month</span>
                        </div>
                        <ul class="space-y-3 text-xs text-slate-600 mb-8">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Up to 3 Stylists</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Online Client Booking Portal</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Client CRM & Notes</li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="w-full py-3 rounded-xl border gold-border hover:bg-slate-50 text-slate-800 text-xs font-bold text-center transition">
                        Get Started
                    </a>
                </div>

                <!-- Growth -->
                <div class="glass-panel p-8 rounded-3xl border-2 border-salon-500 bg-salon-50/40 relative flex flex-col justify-between shadow-lg">
                    <div class="absolute -top-3 right-6 bg-gradient-to-r from-salon-500 to-amber-500 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-0.5 rounded-full shadow-sm">
                        Popular Choice
                    </div>
                    <div>
                        <h4 class="font-serif text-lg font-bold text-slate-900">Growth Studio</h4>
                        <p class="text-xs text-slate-500 mt-1">Expanding beauty lounges</p>
                        <div class="my-6">
                            <span class="font-serif text-4xl font-bold text-slate-900">$79</span>
                            <span class="text-xs text-slate-400">/month</span>
                        </div>
                        <ul class="space-y-3 text-xs text-slate-600 mb-8">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Up to 10 Stylists</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> High-Velocity POS & Checkout</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Stylist Commission Splits</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> VIP Loyalty Points Program</li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="w-full py-3 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-bold text-center shadow-md shadow-salon-500/20 transition">
                        Start 14-Day Free Trial
                    </a>
                </div>

                <!-- Enterprise -->
                <div class="glass-panel p-8 rounded-3xl border gold-border bg-white flex flex-col justify-between shadow-sm">
                    <div>
                        <h4 class="font-serif text-lg font-bold text-slate-900">Luxury Enterprise</h4>
                        <p class="text-xs text-slate-500 mt-1">Chains & multi-chair salons</p>
                        <div class="my-6">
                            <span class="font-serif text-4xl font-bold text-slate-900">$199</span>
                            <span class="text-xs text-slate-400">/month</span>
                        </div>
                        <ul class="space-y-3 text-xs text-slate-600 mb-8">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Unlimited Stylists & Stations</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Multi-Location Architecture</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Custom Domain & White-labeling</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500"></i> Dedicated Account Manager</li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="w-full py-3 rounded-xl border gold-border hover:bg-slate-50 text-slate-800 text-xs font-bold text-center transition">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-obsidian-950 text-slate-400 text-xs">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg bg-salon-500 flex items-center justify-center text-white">
                    <i class="fa-solid fa-spa text-sm"></i>
                </div>
                <span class="font-serif text-base font-bold text-white">GlowSuite B2B</span>
            </div>
            <div class="text-slate-500 text-center sm:text-right">
                Built with Laravel 12 &bull; Livewire 4 &bull; MySQL Multi-Tenancy
            </div>
        </div>
    </footer>

</div>
