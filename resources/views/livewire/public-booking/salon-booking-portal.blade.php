<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
    
    <!-- Salon Header Card -->
    <div class="glass-panel rounded-2xl p-6 md:p-8 mb-8 border gold-border shadow-lg text-center relative overflow-hidden">
        <div class="inline-flex w-14 h-14 rounded-2xl bg-gradient-to-tr from-salon-600 to-amber-500 text-white items-center justify-center text-2xl mb-3 shadow-md">
            <i class="fa-solid fa-spa"></i>
        </div>
        <h1 class="font-serif text-2xl md:text-3xl font-bold text-slate-900">{{ $salon->name }}</h1>
        <p class="text-xs md:text-sm text-slate-500 mt-1 max-w-md mx-auto">{{ $salon->tagline }}</p>
        
        <div class="flex flex-wrap items-center justify-center gap-4 text-xs text-slate-500 mt-4 pt-4 border-t gold-border">
            <span><i class="fa-solid fa-location-dot text-salon-500 mr-1.5"></i> {{ $salon->address }}, {{ $salon->city }}</span>
            <span>&bull;</span>
            <span><i class="fa-solid fa-phone text-salon-500 mr-1.5"></i> {{ $salon->phone }}</span>
            <span>&bull;</span>
            <span><i class="fa-regular fa-clock text-salon-500 mr-1.5"></i> {{ $salon->opening_time }} - {{ $salon->closing_time }}</span>
        </div>
    </div>

    <!-- Booking Multi-Step Wizard Card -->
    <div class="glass-panel rounded-2xl p-6 md:p-8 border gold-border shadow-md">
        
        <!-- Step Indicators -->
        @if($step < 5)
        <div class="flex items-center justify-between mb-8 pb-4 border-b gold-border text-xs">
            <button wire:click="$set('step', 1)" class="flex items-center gap-2 {{ $step >= 1 ? 'font-bold text-salon-600' : 'text-slate-400' }}">
                <span class="w-6 h-6 rounded-full flex items-center justify-center text-[11px] {{ $step >= 1 ? 'bg-salon-500 text-white' : 'bg-slate-200' }}">1</span>
                <span class="hidden sm:inline">Treatment</span>
            </button>
            <div class="w-8 h-0.5 {{ $step >= 2 ? 'bg-salon-500' : 'bg-slate-200' }}"></div>

            <button wire:click="{{ $selectedServiceId ? '$set(\'step\', 2)' : '' }}" class="flex items-center gap-2 {{ $step >= 2 ? 'font-bold text-salon-600' : 'text-slate-400' }}">
                <span class="w-6 h-6 rounded-full flex items-center justify-center text-[11px] {{ $step >= 2 ? 'bg-salon-500 text-white' : 'bg-slate-200' }}">2</span>
                <span class="hidden sm:inline">Artisan</span>
            </button>
            <div class="w-8 h-0.5 {{ $step >= 3 ? 'bg-salon-500' : 'bg-slate-200' }}"></div>

            <button wire:click="{{ ($selectedServiceId && $selectedStaffId) ? '$set(\'step\', 3)' : '' }}" class="flex items-center gap-2 {{ $step >= 3 ? 'font-bold text-salon-600' : 'text-slate-400' }}">
                <span class="w-6 h-6 rounded-full flex items-center justify-center text-[11px] {{ $step >= 3 ? 'bg-salon-500 text-white' : 'bg-slate-200' }}">3</span>
                <span class="hidden sm:inline">Date & Time</span>
            </button>
            <div class="w-8 h-0.5 {{ $step >= 4 ? 'bg-salon-500' : 'bg-slate-200' }}"></div>

            <span class="flex items-center gap-2 {{ $step === 4 ? 'font-bold text-salon-600' : 'text-slate-400' }}">
                <span class="w-6 h-6 rounded-full flex items-center justify-center text-[11px] {{ $step === 4 ? 'bg-salon-500 text-white' : 'bg-slate-200' }}">4</span>
                <span class="hidden sm:inline">Details</span>
            </span>
        </div>
        @endif

        <!-- STEP 1: Select Service -->
        @if($step === 1)
        <div>
            <h3 class="font-serif text-lg font-bold text-slate-900 mb-1">Select a Treatment</h3>
            <p class="text-xs text-slate-500 mb-4">Choose from our signature salon rituals and treatments</p>

            <!-- Category Pills -->
            <div class="flex flex-wrap gap-1.5 mb-6">
                <button wire:click="$set('selectedCategoryId', 'all')" class="px-3 py-1 rounded-lg text-xs font-semibold {{ $selectedCategoryId === 'all' ? 'bg-salon-500 text-white shadow-sm' : 'bg-white border gold-border text-slate-600' }}">
                    All
                </button>
                @foreach($categories as $cat)
                <button wire:click="$set('selectedCategoryId', {{ $cat->id }})" class="px-3 py-1 rounded-lg text-xs font-semibold {{ $selectedCategoryId == $cat->id ? 'bg-salon-500 text-white shadow-sm' : 'bg-white border gold-border text-slate-600' }}">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>

            <!-- Services List -->
            <div class="space-y-3">
                @foreach($services as $s)
                <div class="p-4 rounded-xl border gold-border bg-white hover:border-salon-400 transition flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <h4 class="text-sm font-bold text-slate-900">{{ $s->name }}</h4>
                            @if($s->is_popular)
                            <span class="text-[9px] bg-amber-100 text-amber-800 border border-amber-300 px-1.5 rounded-full font-bold">Signature</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $s->description }}</p>
                        <span class="text-[11px] text-slate-400 mt-2 block"><i class="fa-regular fa-clock mr-1"></i> {{ $s->formatted_duration }}</span>
                    </div>

                    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2">
                        <span class="font-mono font-bold text-base text-slate-900">{{ $salon->currency }}{{ number_format($s->price, 2) }}</span>
                        <button wire:click="selectService({{ $s->id }})" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-sm transition">
                            Select & Continue &rarr;
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- STEP 2: Select Stylist -->
        @if($step === 2)
        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Choose Your Stylist</h3>
                    <p class="text-xs text-slate-500">Selected treatment: <span class="font-bold text-salon-600">{{ $selectedService->name }}</span> ({{ $selectedService->formatted_price }})</p>
                </div>
                <button wire:click="$set('step', 1)" class="text-xs text-slate-500 hover:text-slate-700">&larr; Back</button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Any Stylist Option -->
                <button wire:click="selectStaff('any')" class="p-4 rounded-xl border gold-border bg-white hover:border-salon-400 transition text-left flex items-center space-x-3.5 group">
                    <div class="w-12 h-12 rounded-xl bg-salon-50 text-salon-500 flex items-center justify-center text-lg group-hover:bg-salon-500 group-hover:text-white transition">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Any Available Professional</h4>
                        <p class="text-[11px] text-slate-500">First available master artisan</p>
                    </div>
                </button>

                @foreach($staffMembers as $staff)
                <button wire:click="selectStaff({{ $staff->id }})" class="p-4 rounded-xl border gold-border bg-white hover:border-salon-400 transition text-left flex items-center space-x-3.5 group">
                    <img src="{{ $staff->avatar_url }}" alt="{{ $staff->name }}" class="w-12 h-12 rounded-xl object-cover border border-salon-300">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-bold text-slate-900 truncate">{{ $staff->name }}</h4>
                        <p class="text-[11px] text-salon-600 truncate">{{ $staff->title }}</p>
                        <span class="text-[10px] text-amber-500 font-bold"><i class="fa-solid fa-star text-[9px]"></i> {{ $staff->rating }}</span>
                    </div>
                </button>
                @endforeach
            </div>
        </div>
        @endif

        <!-- STEP 3: Select Date & Time -->
        @if($step === 3)
        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Select Date & Time Slot</h3>
                    <p class="text-xs text-slate-500">Stylist: <span class="font-bold text-salon-600">{{ $selectedStaff ? $selectedStaff->name : 'Any Available' }}</span></p>
                </div>
                <button wire:click="$set('step', 2)" class="text-xs text-slate-500 hover:text-slate-700">&larr; Back</button>
            </div>

            <!-- Date Selector -->
            <div class="mb-6 max-w-xs">
                <label class="block text-xs font-semibold text-slate-700 mb-1">Appointment Date</label>
                <input wire:model.live="selectedDate" type="date" min="{{ now()->format('Y-m-d') }}" class="w-full px-3 py-2 rounded-xl border gold-border text-xs bg-white focus:outline-none focus:ring-2 focus:ring-salon-500">
            </div>

            <!-- Available Slots -->
            <div>
                <h4 class="text-xs font-bold text-slate-700 mb-3 uppercase tracking-wider">Available Times</h4>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2.5">
                    @foreach($timeSlots as $slot)
                    <button wire:click="selectDateTime('{{ $slot }}')" class="py-2.5 px-3 rounded-xl border gold-border bg-white hover:bg-salon-500 hover:text-white hover:border-salon-500 transition text-xs font-semibold font-mono text-slate-800 shadow-xs">
                        {{ $slot }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- STEP 4: Client Info & Confirm -->
        @if($step === 4)
        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900">Your Contact Information</h3>
                    <p class="text-xs text-slate-500">Complete your reservation details</p>
                </div>
                <button wire:click="$set('step', 3)" class="text-xs text-slate-500 hover:text-slate-700">&larr; Back</button>
            </div>

            <!-- Booking Summary Pill -->
            <div class="p-4 rounded-xl bg-salon-50/70 border gold-border mb-6 flex flex-wrap items-center justify-between gap-3 text-xs">
                <div>
                    <span class="font-bold text-slate-900">{{ $selectedService->name }}</span>
                    <p class="text-slate-500 text-[11px]">{{ $selectedDate }} at {{ $selectedTime }} &bull; {{ $selectedStaff ? $selectedStaff->name : 'Artisan' }}</p>
                </div>
                <span class="font-mono font-bold text-base text-slate-900">{{ $salon->currency }}{{ number_format($selectedService->price, 2) }}</span>
            </div>

            <form wire:submit.prevent="submitBooking" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name *</label>
                    <input wire:model="clientName" type="text" placeholder="e.g. Jessica Taylor" class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500">
                    @error('clientName') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Mobile Phone *</label>
                        <input wire:model="clientPhone" type="text" placeholder="+1 (555) 000-0000" class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500">
                        @error('clientPhone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email Address</label>
                        <input wire:model="clientEmail" type="email" placeholder="jessica@email.com" class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Special Requests / Preferences</label>
                    <textarea wire:model="clientNotes" rows="2" placeholder="Allergies, hair history, preferences..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500"></textarea>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-bold shadow-lg shadow-salon-500/30 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i>
                    <span>Confirm & Reserve Appointment</span>
                </button>
            </form>
        </div>
        @endif

        <!-- STEP 5: Success Screen -->
        @if($step === 5 && $confirmedAppointment)
        <div class="text-center py-8">
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-check text-2xl"></i>
            </div>

            <h3 class="font-serif text-2xl font-bold text-slate-900">Your Appointment is Confirmed!</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                Thank you, {{ $confirmedAppointment->client->name }}. We look forward to welcoming you at {{ $salon->name }}.
            </p>

            <div class="my-6 max-w-md mx-auto p-5 rounded-2xl bg-white border gold-border text-left text-xs space-y-2.5">
                <div class="flex justify-between">
                    <span class="text-slate-400">Treatment:</span>
                    <span class="font-bold text-slate-900">{{ $confirmedAppointment->service->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Stylist:</span>
                    <span class="font-bold text-slate-900">{{ $confirmedAppointment->staffMember->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Date & Time:</span>
                    <span class="font-bold text-slate-900">{{ $confirmedAppointment->appointment_date->format('l, F j, Y') }} at {{ $confirmedAppointment->start_time }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Location:</span>
                    <span class="font-bold text-slate-900">{{ $salon->address }}, {{ $salon->city }}</span>
                </div>
                <div class="pt-2 border-t gold-border flex justify-between font-bold text-slate-900">
                    <span>Estimated Total:</span>
                    <span class="font-mono text-salon-600">{{ $salon->currency }}{{ number_format($confirmedAppointment->final_price, 2) }}</span>
                </div>
            </div>

            <button wire:click="resetBooking" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold">
                Book Another Appointment
            </button>
        </div>
        @endif

    </div>

    <!-- Footer -->
    <div class="text-center text-xs text-slate-400 mt-8">
        Powered by <span class="font-bold text-slate-600">GlowSuite B2B</span> &bull; Salon Cloud Platform
    </div>
</div>
