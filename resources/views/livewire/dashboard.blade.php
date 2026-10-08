<div>
    <!-- Salon Welcome Hero Banner -->
    <div class="relative overflow-hidden rounded-2xl luxury-gradient text-white p-6 md:p-8 mb-8 border border-slate-800 shadow-xl">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-salon-500/20 text-salon-300 border border-salon-500/30">
                        {{ $salon->subscription_plan }} Plan Active
                    </span>
                    <span class="text-xs text-slate-400">&bull; {{ $salon->city }}</span>
                </div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold tracking-tight text-white">
                    {{ $salon->name }}
                </h1>
                <p class="text-xs md:text-sm text-slate-300 mt-1 max-w-xl">
                    {{ $salon->tagline ?? 'Modern Salon & Spa Management Portal' }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('public.booking', $salon->slug) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur-md border border-white/20 transition flex items-center gap-2">
                    <i class="fa-solid fa-link text-salon-400"></i>
                    <span>Public Booking Page</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
                <a href="{{ route('appointments.index') }}" class="px-4 py-2.5 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-lg shadow-salon-500/30 transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Appointment</span>
                </a>
            </div>
        </div>

        <!-- Decorative background glow -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-salon-500/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Metric 1: Today's Appointments -->
        <div class="glass-panel p-5 rounded-2xl shadow-sm hover:shadow-md transition border gold-border">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Today's Bookings</span>
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-salon-500 flex items-center justify-center">
                    <i class="fa-regular fa-calendar-check text-lg"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <div class="text-2xl font-bold font-serif text-slate-900">{{ $todayAppointmentsCount }}</div>
                <span class="text-xs text-emerald-600 font-semibold flex items-center">
                    <i class="fa-solid fa-arrow-trend-up text-[10px] mr-1"></i> +12%
                </span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Scheduled for {{ now()->format('M j') }}</p>
        </div>

        <!-- Metric 2: Today's Revenue -->
        <div class="glass-panel p-5 rounded-2xl shadow-sm hover:shadow-md transition border gold-border">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Today's Revenue</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-dollar-sign text-lg"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <div class="text-2xl font-bold font-serif text-slate-900">{{ $salon->currency }}{{ number_format($todayRevenue, 2) }}</div>
                <span class="text-xs text-emerald-600 font-semibold flex items-center">
                    <i class="fa-solid fa-arrow-trend-up text-[10px] mr-1"></i> Live POS
                </span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Gross settlements</p>
        </div>

        <!-- Metric 3: Stylists on Duty -->
        <div class="glass-panel p-5 rounded-2xl shadow-sm hover:shadow-md transition border gold-border">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Stylists on Duty</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i class="fa-solid fa-user-tie text-lg"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <div class="text-2xl font-bold font-serif text-slate-900">{{ $activeStaffCount }}</div>
                <span class="text-xs text-slate-500 font-medium">All Available</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">100% station utilization</p>
        </div>

        <!-- Metric 4: VIP & CRM Clients -->
        <div class="glass-panel p-5 rounded-2xl shadow-sm hover:shadow-md transition border gold-border">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Clients</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <i class="fa-solid fa-crown text-lg"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <div class="text-2xl font-bold font-serif text-slate-900">{{ $totalClientsCount }}</div>
                <span class="text-xs text-purple-600 font-semibold">
                    {{ $vipClientsCount }} VIP
                </span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">High retention rate</p>
        </div>
    </div>

    <!-- Main Grid: Appointments & Salon Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Today's Appointments Schedule Matrix -->
        <div class="lg:col-span-2 space-y-8">
            <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
                <div class="flex items-center justify-between pb-4 border-b gold-border mb-4">
                    <div>
                        <h3 class="font-serif text-lg font-bold text-slate-900">Today's Appointment Schedule</h3>
                        <p class="text-xs text-slate-500">Real-time schedule for {{ now()->format('l, F j') }}</p>
                    </div>
                    <a href="{{ route('appointments.index') }}" class="text-xs text-salon-600 hover:text-salon-700 font-semibold flex items-center gap-1">
                        View All Bookings &rarr;
                    </a>
                </div>

                @if($todayAppointments->isEmpty())
                <div class="py-12 text-center">
                    <div class="w-12 h-12 rounded-full bg-salon-50 text-salon-500 flex items-center justify-center mx-auto mb-3">
                        <i class="fa-regular fa-calendar text-xl"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-700">No appointments scheduled today</p>
                    <p class="text-xs text-slate-400 mt-1">Book your first walk-in or phone client below.</p>
                    <a href="{{ route('appointments.index') }}" class="mt-4 inline-flex items-center px-4 py-2 rounded-lg bg-salon-500 text-white text-xs font-semibold shadow-sm hover:bg-salon-600 transition">
                        + Add Booking
                    </a>
                </div>
                @else
                <div class="divide-y divide-slate-100">
                    @foreach($todayAppointments as $appt)
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-salon-50/40 p-2 rounded-xl transition">
                        <!-- Client & Service Info -->
                        <div class="flex items-start space-x-3.5">
                            <div class="w-10 h-10 rounded-xl bg-salon-100 text-salon-700 font-serif font-bold flex items-center justify-center text-sm flex-shrink-0">
                                {{ substr($appt->client->name ?? 'G', 0, 1) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-sm font-bold text-slate-900">{{ $appt->client->name }}</h4>
                                    @if($appt->client->vip_status)
                                    <span class="text-[10px] bg-amber-100 text-amber-800 border border-amber-300 px-1.5 py-0.2 rounded-full font-bold flex items-center gap-1">
                                        <i class="fa-solid fa-crown text-[8px]"></i> VIP
                                    </span>
                                    @endif
                                </div>
                                <p class="text-xs font-medium text-salon-700 mt-0.5">{{ $appt->service->name }}</p>
                                <div class="flex items-center gap-3 text-[11px] text-slate-400 mt-1">
                                    <span><i class="fa-regular fa-clock mr-1 text-slate-400"></i> {{ $appt->start_time }} - {{ $appt->end_time }}</span>
                                    <span>&bull;</span>
                                    <span><i class="fa-solid fa-user-tie mr-1 text-slate-400"></i> {{ $appt->staffMember->name }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price & Live Status Pill with Quick Switcher -->
                        <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2">
                            <div class="text-sm font-bold text-slate-900 font-mono">
                                {{ $salon->currency }}{{ number_format($appt->final_price, 2) }}
                            </div>

                            <!-- Livewire Status Controller -->
                            <div class="flex items-center gap-1.5" x-data="{ open: false }">
                                @php $badge = $appt->status_badge; @endphp
                                <div class="relative">
                                    <button @click="open = !open" type="button" class="px-2.5 py-1 rounded-full text-xs font-bold border transition flex items-center gap-1.5 {{ $badge['bg'] }}">
                                        <span>{{ $badge['label'] }}</span>
                                        <i class="fa-solid fa-chevron-down text-[8px]"></i>
                                    </button>

                                    <!-- Dropdown for live status update -->
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-1 w-36 bg-white rounded-lg shadow-xl border gold-border py-1 z-30 text-xs">
                                        <button wire:click="updateAppointmentStatus({{ $appt->id }}, 'confirmed')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-emerald-600 font-medium">
                                            &bull; Confirmed
                                        </button>
                                        <button wire:click="updateAppointmentStatus({{ $appt->id }}, 'in_progress')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-amber-600 font-medium">
                                            &bull; In Progress
                                        </button>
                                        <button wire:click="updateAppointmentStatus({{ $appt->id }}, 'completed')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-purple-600 font-medium">
                                            &bull; Completed
                                        </button>
                                        <button wire:click="updateAppointmentStatus({{ $appt->id }}, 'cancelled')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-rose-600 font-medium">
                                            &bull; Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Trending Signature Treatments -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
                <div class="flex items-center justify-between pb-4 border-b gold-border mb-4">
                    <div>
                        <h3 class="font-serif text-lg font-bold text-slate-900">Popular Signature Services</h3>
                        <p class="text-xs text-slate-500">Most requested catalog items</p>
                    </div>
                    <a href="{{ route('services.index') }}" class="text-xs text-salon-600 hover:text-salon-700 font-semibold">
                        Manage Catalog &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($topServices as $service)
                    <div class="p-4 rounded-xl bg-white/70 border gold-border hover:border-salon-400 transition flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-salon-600 bg-salon-50 px-2 py-0.5 rounded">
                                    {{ $service->category->name ?? 'General' }}
                                </span>
                                <span class="text-xs font-mono font-bold text-slate-900">
                                    {{ $service->formatted_price }}
                                </span>
                            </div>
                            <h4 class="text-xs font-bold text-slate-900 line-clamp-1">{{ $service->name }}</h4>
                            <p class="text-[11px] text-slate-500 line-clamp-2 mt-1">{{ $service->description }}</p>
                        </div>
                        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                            <span><i class="fa-regular fa-clock mr-1"></i> {{ $service->formatted_duration }}</span>
                            <span class="text-salon-600 font-medium">Active</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right 1 Col: Stylists & POS Feed -->
        <div class="space-y-8">
            
            <!-- Stylists on Duty -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
                <div class="flex items-center justify-between pb-4 border-b gold-border mb-4">
                    <h3 class="font-serif text-lg font-bold text-slate-900">Artistic Team</h3>
                    <a href="{{ route('staff.index') }}" class="text-xs text-salon-600 hover:text-salon-700 font-semibold">
                        View Team &rarr;
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach($stylists as $stylist)
                    <div class="flex items-center space-x-3 p-2.5 rounded-xl hover:bg-salon-50/50 transition">
                        <img src="{{ $stylist->avatar_url }}" alt="{{ $stylist->name }}" class="w-11 h-11 rounded-xl object-cover border border-salon-300">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-slate-900 truncate">{{ $stylist->name }}</h4>
                            <p class="text-[11px] text-salon-600 truncate">{{ $stylist->title }}</p>
                            <div class="flex items-center space-x-2 text-[10px] text-slate-400 mt-0.5">
                                <span class="text-amber-500 font-semibold"><i class="fa-solid fa-star text-[9px]"></i> {{ $stylist->rating }}</span>
                                <span>&bull;</span>
                                <span>{{ $stylist->commission_rate }}% Comm.</span>
                            </div>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm" title="Available"></span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Invoices & Billing Summary -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
                <div class="flex items-center justify-between pb-4 border-b gold-border mb-4">
                    <h3 class="font-serif text-lg font-bold text-slate-900">Recent Transactions</h3>
                    <a href="{{ route('pos.index') }}" class="text-xs text-salon-600 hover:text-salon-700 font-semibold">
                        POS &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentInvoices as $inv)
                    <div class="p-3 rounded-xl bg-white/70 border gold-border flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-[11px] font-bold text-slate-900">{{ $inv->invoice_number }}</span>
                                <span class="text-[10px] uppercase font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.2 rounded">
                                    {{ $inv->payment_method }}
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-0.5">{{ $inv->client->name ?? 'Walk-in Guest' }}</p>
                        </div>
                        <div class="text-right">
                            <span class="font-mono text-xs font-bold text-slate-900">
                                {{ $salon->currency }}{{ number_format($inv->total_amount, 2) }}
                            </span>
                            <p class="text-[10px] text-slate-400">{{ $inv->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="py-6 text-center text-xs text-slate-400">
                        No transactions recorded yet today.
                    </div>
                    @endforelse
                </div>

                <div class="mt-4 pt-4 border-t gold-border">
                    <a href="{{ route('pos.index') }}" class="w-full py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold flex items-center justify-center gap-2 shadow-sm transition">
                        <i class="fa-solid fa-cash-register text-salon-400"></i>
                        <span>Open Point of Sale (POS)</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
