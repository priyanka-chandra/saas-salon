<div>
    <!-- Top Filter Bar -->
    <div class="glass-panel p-5 rounded-2xl mb-6 shadow-sm border gold-border">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Date Filters -->
            <div class="flex items-center space-x-2">
                <button wire:click="$set('selectedDate', '{{ now()->format('Y-m-d') }}')" type="button" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition {{ $selectedDate === now()->format('Y-m-d') ? 'bg-salon-500 text-white shadow-sm' : 'bg-white hover:bg-salon-50 text-slate-700 border gold-border' }}">
                    Today
                </button>
                <button wire:click="$set('selectedDate', '{{ now()->tomorrow()->format('Y-m-d') }}')" type="button" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition {{ $selectedDate === now()->tomorrow()->format('Y-m-d') ? 'bg-salon-500 text-white shadow-sm' : 'bg-white hover:bg-salon-50 text-slate-700 border gold-border' }}">
                    Tomorrow
                </button>
                <input wire:model.live="selectedDate" type="date" class="px-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500">
            </div>

            <!-- Stylist & Search Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <select wire:model.live="staffFilter" class="px-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500">
                    <option value="all">All Stylists</option>
                    @foreach($staffMembers as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>

                <select wire:model.live="statusFilter" class="px-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500">
                    <option value="all">All Statuses</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
                    <input wire:model.live.debounce.300ms="searchQuery" type="text" placeholder="Search client or phone..." class="pl-8 pr-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500 w-48">
                </div>

                <button wire:click="openCreateModal" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <span>+ New Booking</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Appointment Schedule Matrix -->
    <div class="glass-panel rounded-2xl overflow-hidden shadow-sm border gold-border">
        <div class="px-6 py-4 border-b gold-border bg-white/50 flex items-center justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-slate-900">
                    Bookings for {{ \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}
                </h3>
                <p class="text-xs text-slate-500">{{ $appointments->count() }} appointments scheduled</p>
            </div>
        </div>

        @if($appointments->isEmpty())
        <div class="py-16 text-center">
            <div class="w-16 h-16 rounded-full bg-salon-50 text-salon-500 flex items-center justify-center mx-auto mb-3">
                <i class="fa-regular fa-calendar-xmark text-2xl"></i>
            </div>
            <h4 class="text-sm font-bold text-slate-800">No appointments found for this selection</h4>
            <p class="text-xs text-slate-400 mt-1">Try selecting another date or click below to schedule a new client.</p>
            <button wire:click="openCreateModal" class="mt-4 px-4 py-2 rounded-xl bg-salon-500 text-white text-xs font-semibold hover:bg-salon-600 transition">
                + Schedule Appointment
            </button>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/70 border-b gold-border text-[11px] uppercase tracking-wider text-slate-400 font-bold">
                    <tr>
                        <th class="py-3 px-6">Time Slot</th>
                        <th class="py-3 px-6">Client</th>
                        <th class="py-3 px-6">Service & Treatment</th>
                        <th class="py-3 px-6">Artistic Stylist</th>
                        <th class="py-3 px-6">Amount</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($appointments as $appt)
                    <tr class="hover:bg-salon-50/30 transition">
                        <!-- Time -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="font-mono font-bold text-slate-900 text-sm">{{ $appt->start_time }}</span>
                            <span class="text-slate-400 text-[11px]"> - {{ $appt->end_time }}</span>
                            <div class="text-[10px] text-slate-400 font-medium mt-0.5">
                                {{ $appt->service->formatted_duration }}
                            </div>
                        </td>

                        <!-- Client -->
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-8 h-8 rounded-full bg-salon-100 text-salon-700 font-bold flex items-center justify-center text-xs">
                                    {{ substr($appt->client->name ?? 'G', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold text-slate-900">{{ $appt->client->name }}</span>
                                        @if($appt->client->vip_status)
                                        <span class="text-[9px] bg-amber-100 text-amber-800 border border-amber-300 px-1 rounded-full font-bold">VIP</span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-slate-400">{{ $appt->client->phone }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Service -->
                        <td class="py-4 px-6">
                            <span class="font-semibold text-slate-900">{{ $appt->service->name }}</span>
                            <div class="text-[11px] text-salon-600 font-medium">
                                {{ $appt->service->category->name ?? 'Service' }}
                            </div>
                        </td>

                        <!-- Stylist -->
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <img src="{{ $appt->staffMember->avatar_url }}" class="w-6 h-6 rounded-full object-cover border border-salon-300">
                                <span class="font-medium text-slate-800">{{ $appt->staffMember->name }}</span>
                            </div>
                        </td>

                        <!-- Price -->
                        <td class="py-4 px-6 font-mono whitespace-nowrap">
                            <span class="font-bold text-slate-900">{{ $salon->currency }}{{ number_format($appt->final_price, 2) }}</span>
                            @if($appt->payment_status === 'paid')
                            <span class="ml-1 text-[10px] text-emerald-600 bg-emerald-50 px-1 py-0.5 rounded font-bold">PAID</span>
                            @else
                            <span class="ml-1 text-[10px] text-amber-600 bg-amber-50 px-1 py-0.5 rounded font-bold">UNPAID</span>
                            @endif
                        </td>

                        <!-- Status Changer -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            @php $badge = $appt->status_badge; @endphp
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="px-2.5 py-1 rounded-full text-xs font-bold border transition flex items-center gap-1.5 {{ $badge['bg'] }}">
                                    <span>{{ $badge['label'] }}</span>
                                    <i class="fa-solid fa-chevron-down text-[8px]"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute left-0 mt-1 w-36 bg-white rounded-lg shadow-xl border gold-border py-1 z-30 text-xs">
                                    <button wire:click="updateStatus({{ $appt->id }}, 'confirmed')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-emerald-600 font-medium">&bull; Confirmed</button>
                                    <button wire:click="updateStatus({{ $appt->id }}, 'in_progress')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-amber-600 font-medium">&bull; In Progress</button>
                                    <button wire:click="updateStatus({{ $appt->id }}, 'completed')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-purple-600 font-medium">&bull; Completed</button>
                                    <button wire:click="updateStatus({{ $appt->id }}, 'cancelled')" @click="open = false" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 text-rose-600 font-medium">&bull; Cancel</button>
                                </div>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('pos.index') }}" title="Checkout at POS" class="p-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition">
                                    <i class="fa-solid fa-cash-register"></i>
                                </a>
                                <button wire:click="deleteAppointment({{ $appt->id }})" wire:confirm="Are you sure you want to cancel and remove this booking?" title="Cancel Booking" class="p-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Create Appointment Modal -->
    @if($showCreateModal)
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Schedule New Appointment</h3>
                    <p class="text-xs text-slate-500">Add a client booking to the salon calendar</p>
                </div>
                <button wire:click="closeCreateModal" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form wire:submit.prevent="saveAppointment" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
                
                <!-- Client Selection Mode -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-semibold text-slate-700">Client Information</label>
                        <button type="button" wire:click="$toggle('isNewClient')" class="text-xs text-salon-600 font-semibold hover:underline">
                            {{ $isNewClient ? '&larr; Select Existing Client' : '+ Create New Client' }}
                        </button>
                    </div>

                    @if(!$isNewClient)
                    <div>
                        <select wire:model="clientId" class="w-full px-3 py-2 rounded-xl border gold-border text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-salon-500">
                            <option value="">-- Choose Existing Client --</option>
                            @foreach($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->phone }})</option>
                            @endforeach
                        </select>
                        @error('clientId') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    @else
                    <div class="space-y-2 p-3 bg-salon-50/50 rounded-xl border gold-border">
                        <input wire:model="newClientName" type="text" placeholder="Client Full Name *" class="w-full px-3 py-2 rounded-lg border gold-border text-xs bg-white">
                        @error('newClientName') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror

                        <input wire:model="newClientPhone" type="text" placeholder="Phone Number *" class="w-full px-3 py-2 rounded-lg border gold-border text-xs bg-white">
                        @error('newClientPhone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror

                        <input wire:model="newClientEmail" type="email" placeholder="Email Address (Optional)" class="w-full px-3 py-2 rounded-lg border gold-border text-xs bg-white">
                    </div>
                    @endif
                </div>

                <!-- Service Selection -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Select Service *</label>
                    <select wire:model="serviceId" class="w-full px-3 py-2 rounded-xl border gold-border text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-salon-500">
                        @foreach($services as $s)
                        <option value="{{ $s->id }}">{{ $s->name }} - {{ $s->formatted_price }} ({{ $s->duration_minutes }}m)</option>
                        @endforeach
                    </select>
                    @error('serviceId') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <!-- Stylist Selection -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Select Stylist *</label>
                    <select wire:model="staffMemberId" class="w-full px-3 py-2 rounded-xl border gold-border text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-salon-500">
                        @foreach($staffMembers as $st)
                        <option value="{{ $st->id }}">{{ $st->name }} ({{ $st->title }})</option>
                        @endforeach
                    </select>
                    @error('staffMemberId') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <!-- Date & Start Time -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Date *</label>
                        <input wire:model="appointmentDate" type="date" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        @error('appointmentDate') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Start Time *</label>
                        <input wire:model="startTime" type="time" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        @error('startTime') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Discount -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Discount Amount ($)</label>
                    <input wire:model="discount" type="number" step="0.01" min="0" placeholder="0.00" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Client Preferences / Notes</label>
                    <textarea wire:model="notes" rows="2" placeholder="e.g. Scalp sensitivity, requested espresso coffee..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs"></textarea>
                </div>

                <!-- Modal Actions -->
                <div class="pt-4 border-t gold-border flex items-center justify-end space-x-3">
                    <button type="button" wire:click="closeCreateModal" class="px-4 py-2 rounded-xl border gold-border text-xs font-medium text-slate-600 hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-md shadow-salon-500/20 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-check"></i>
                        <span>Confirm Appointment</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
