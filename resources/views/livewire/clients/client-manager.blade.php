<div>
    <!-- Top Filter & Search Header -->
    <div class="glass-panel p-5 rounded-2xl mb-8 shadow-sm border gold-border">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search client by name, phone or email..." class="pl-8 pr-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500 w-72">
                </div>

                <select wire:model.live="vipFilter" class="px-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500">
                    <option value="all">All Clients</option>
                    <option value="vip">VIP Only</option>
                </select>
            </div>

            <button wire:click="openNewClientModal" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-sm transition flex items-center gap-1.5">
                <i class="fa-solid fa-user-plus"></i>
                <span>Add New Client</span>
            </button>
        </div>
    </div>

    <!-- Clients Table -->
    <div class="glass-panel rounded-2xl overflow-hidden shadow-sm border gold-border">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/70 border-b gold-border text-[11px] uppercase tracking-wider text-slate-400 font-bold">
                    <tr>
                        <th class="py-3 px-6">Client Name</th>
                        <th class="py-3 px-6">Contact Info</th>
                        <th class="py-3 px-6">VIP Status</th>
                        <th class="py-3 px-6">Loyalty Points</th>
                        <th class="py-3 px-6">Total Visits</th>
                        <th class="py-3 px-6">Total Spend</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($clients as $c)
                    <tr class="hover:bg-salon-50/30 transition">
                        <!-- Client Name -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-xl bg-salon-100 text-salon-700 font-bold flex items-center justify-center text-xs">
                                    {{ substr($c->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900">{{ $c->name }}</span>
                                    @if($c->notes)
                                    <p class="text-[10px] text-slate-400 truncate max-w-xs">{{ $c->notes }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Contact -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <p class="font-medium text-slate-800">{{ $c->phone }}</p>
                            <p class="text-[11px] text-slate-400">{{ $c->email ?: 'No email' }}</p>
                        </td>

                        <!-- VIP -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <button wire:click="toggleVip({{ $c->id }})" class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition flex items-center gap-1 {{ $c->vip_status ? 'bg-amber-100 text-amber-800 border-amber-300' : 'bg-slate-100 text-slate-500 border-slate-200 hover:bg-slate-200' }}">
                                <i class="fa-solid fa-crown text-[9px] {{ $c->vip_status ? 'text-amber-600' : 'text-slate-400' }}"></i>
                                <span>{{ $c->vip_status ? 'VIP Member' : 'Standard' }}</span>
                            </button>
                        </td>

                        <!-- Points -->
                        <td class="py-4 px-6 font-mono font-bold text-slate-800 whitespace-nowrap">
                            <span class="text-salon-600">{{ $c->loyalty_points }}</span> pts
                        </td>

                        <!-- Visits -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="font-bold text-slate-900">{{ $c->appointments_count ?: $c->visits_count }}</span>
                            <span class="text-[10px] text-slate-400">visits</span>
                        </td>

                        <!-- Spend -->
                        <td class="py-4 px-6 font-mono font-bold text-slate-900 whitespace-nowrap">
                            {{ $salon->currency }}{{ number_format($c->total_spent, 2) }}
                        </td>

                        <!-- Actions -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-2">
                                <button wire:click="viewHistory({{ $c->id }})" title="View History" class="p-1.5 rounded-lg text-salon-600 hover:bg-salon-50">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </button>
                                <button wire:click="editClient({{ $c->id }})" title="Edit" class="p-1.5 rounded-lg text-slate-600 hover:bg-slate-100">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button wire:click="deleteClient({{ $c->id }})" wire:confirm="Remove this client?" title="Delete" class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-xs text-slate-400">
                            No clients matching criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Client History Modal -->
    @if($showHistoryModal && $selectedClient)
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span>{{ $selectedClient->name }}</span>
                        @if($selectedClient->vip_status)
                        <span class="text-[10px] bg-amber-100 text-amber-800 border border-amber-300 px-1.5 py-0.2 rounded-full font-bold">VIP</span>
                        @endif
                    </h3>
                    <p class="text-xs text-slate-500">{{ $selectedClient->phone }} &bull; {{ $selectedClient->email }}</p>
                </div>
                <button wire:click="$set('showHistoryModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <div class="p-6 max-h-[70vh] overflow-y-auto space-y-6">
                <!-- Notes -->
                @if($selectedClient->notes)
                <div class="p-3.5 bg-salon-50/70 rounded-xl border gold-border">
                    <span class="text-[10px] uppercase font-bold tracking-wider text-salon-800 block mb-1">Stylist Notes & Formulas:</span>
                    <p class="text-xs text-slate-700">{{ $selectedClient->notes }}</p>
                </div>
                @endif

                <!-- Appointment History -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Booking History</h4>
                    @if($selectedClient->appointments->isEmpty())
                    <p class="text-xs text-slate-400">No appointments recorded yet.</p>
                    @else
                    <div class="space-y-2">
                        @foreach($selectedClient->appointments as $apt)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                            <div>
                                <span class="font-bold text-slate-900">{{ $apt->service->name ?? 'Treatment' }}</span>
                                <div class="text-[11px] text-slate-500">
                                    {{ $apt->appointment_date->format('M d, Y') }} at {{ $apt->start_time }} &bull; Stylist: {{ $apt->staffMember->name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-mono font-bold text-slate-900">{{ $salon->currency }}{{ number_format($apt->final_price, 2) }}</span>
                                <span class="block text-[10px] capitalize text-slate-500">{{ $apt->status }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-4 bg-slate-50 border-t gold-border text-right">
                <button wire:click="$set('showHistoryModal', false)" class="px-4 py-2 rounded-xl bg-slate-800 text-white text-xs font-semibold">Close</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Add/Edit Client Modal -->
    @if($showClientModal)
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">{{ $editingClientId ? 'Edit Client' : 'Register New Client' }}</h3>
                    <p class="text-xs text-slate-500">Salon client database & loyalty profile</p>
                </div>
                <button wire:click="$set('showClientModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form wire:submit.prevent="saveClient" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name *</label>
                    <input wire:model="name" type="text" placeholder="e.g. Victoria Sterling" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    @error('name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Phone Number *</label>
                        <input wire:model="phone" type="text" placeholder="+1 (555) 000-0000" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        @error('phone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                        <input wire:model="email" type="email" placeholder="client@email.com" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Loyalty Points</label>
                        <input wire:model="loyaltyPoints" type="number" min="0" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Birth Date</label>
                        <input wire:model="birthDate" type="date" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Stylist Preferences / Color Formulas</label>
                    <textarea wire:model="notes" rows="2" placeholder="Formulas, allergies, coffee preferences..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs"></textarea>
                </div>

                <div class="pt-2">
                    <label class="flex items-center space-x-2 text-xs font-medium text-slate-700 cursor-pointer">
                        <input wire:model="vipStatus" type="checkbox" class="rounded text-salon-500">
                        <span>VIP Elite Member Status</span>
                    </label>
                </div>

                <div class="pt-4 border-t gold-border flex items-center justify-end space-x-3">
                    <button type="button" wire:click="$set('showClientModal', false)" class="px-4 py-2 rounded-xl border gold-border text-xs font-medium text-slate-600">Cancel</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-md shadow-salon-500/20">Save Client</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
