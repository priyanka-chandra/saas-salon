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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="hover:bg-salon-50/30 transition">
                        <!-- Client Name -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-xl bg-salon-100 text-salon-700 font-bold flex items-center justify-center text-xs">
                                    <?php echo e(substr($c->name, 0, 1)); ?>

                                </div>
                                <div>
                                    <span class="font-bold text-slate-900"><?php echo e($c->name); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->notes): ?>
                                    <p class="text-[10px] text-slate-400 truncate max-w-xs"><?php echo e($c->notes); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </td>

                        <!-- Contact -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <p class="font-medium text-slate-800"><?php echo e($c->phone); ?></p>
                            <p class="text-[11px] text-slate-400"><?php echo e($c->email ?: 'No email'); ?></p>
                        </td>

                        <!-- VIP -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <button wire:click="toggleVip(<?php echo e($c->id); ?>)" class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition flex items-center gap-1 <?php echo e($c->vip_status ? 'bg-amber-100 text-amber-800 border-amber-300' : 'bg-slate-100 text-slate-500 border-slate-200 hover:bg-slate-200'); ?>">
                                <i class="fa-solid fa-crown text-[9px] <?php echo e($c->vip_status ? 'text-amber-600' : 'text-slate-400'); ?>"></i>
                                <span><?php echo e($c->vip_status ? 'VIP Member' : 'Standard'); ?></span>
                            </button>
                        </td>

                        <!-- Points -->
                        <td class="py-4 px-6 font-mono font-bold text-slate-800 whitespace-nowrap">
                            <span class="text-salon-600"><?php echo e($c->loyalty_points); ?></span> pts
                        </td>

                        <!-- Visits -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="font-bold text-slate-900"><?php echo e($c->appointments_count ?: $c->visits_count); ?></span>
                            <span class="text-[10px] text-slate-400">visits</span>
                        </td>

                        <!-- Spend -->
                        <td class="py-4 px-6 font-mono font-bold text-slate-900 whitespace-nowrap">
                            <?php echo e($salon->currency); ?><?php echo e(number_format($c->total_spent, 2)); ?>

                        </td>

                        <!-- Actions -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-2">
                                <button wire:click="viewHistory(<?php echo e($c->id); ?>)" title="View History" class="p-1.5 rounded-lg text-salon-600 hover:bg-salon-50">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </button>
                                <button wire:click="editClient(<?php echo e($c->id); ?>)" title="Edit" class="p-1.5 rounded-lg text-slate-600 hover:bg-slate-100">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button wire:click="deleteClient(<?php echo e($c->id); ?>)" wire:confirm="Remove this client?" title="Delete" class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="7" class="py-12 text-center text-xs text-slate-400">
                            No clients matching criteria.
                        </td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Client History Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showHistoryModal && $selectedClient): ?>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span><?php echo e($selectedClient->name); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedClient->vip_status): ?>
                        <span class="text-[10px] bg-amber-100 text-amber-800 border border-amber-300 px-1.5 py-0.2 rounded-full font-bold">VIP</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </h3>
                    <p class="text-xs text-slate-500"><?php echo e($selectedClient->phone); ?> &bull; <?php echo e($selectedClient->email); ?></p>
                </div>
                <button wire:click="$set('showHistoryModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <div class="p-6 max-h-[70vh] overflow-y-auto space-y-6">
                <!-- Notes -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedClient->notes): ?>
                <div class="p-3.5 bg-salon-50/70 rounded-xl border gold-border">
                    <span class="text-[10px] uppercase font-bold tracking-wider text-salon-800 block mb-1">Stylist Notes & Formulas:</span>
                    <p class="text-xs text-slate-700"><?php echo e($selectedClient->notes); ?></p>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Appointment History -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Booking History</h4>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedClient->appointments->isEmpty()): ?>
                    <p class="text-xs text-slate-400">No appointments recorded yet.</p>
                    <?php else: ?>
                    <div class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedClient->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                            <div>
                                <span class="font-bold text-slate-900"><?php echo e($apt->service->name ?? 'Treatment'); ?></span>
                                <div class="text-[11px] text-slate-500">
                                    <?php echo e($apt->appointment_date->format('M d, Y')); ?> at <?php echo e($apt->start_time); ?> &bull; Stylist: <?php echo e($apt->staffMember->name ?? 'N/A'); ?>

                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-mono font-bold text-slate-900"><?php echo e($salon->currency); ?><?php echo e(number_format($apt->final_price, 2)); ?></span>
                                <span class="block text-[10px] capitalize text-slate-500"><?php echo e($apt->status); ?></span>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="p-4 bg-slate-50 border-t gold-border text-right">
                <button wire:click="$set('showHistoryModal', false)" class="px-4 py-2 rounded-xl bg-slate-800 text-white text-xs font-semibold">Close</button>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Add/Edit Client Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showClientModal): ?>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900"><?php echo e($editingClientId ? 'Edit Client' : 'Register New Client'); ?></h3>
                    <p class="text-xs text-slate-500">Salon client database & loyalty profile</p>
                </div>
                <button wire:click="$set('showClientModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form wire:submit.prevent="saveClient" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name *</label>
                    <input wire:model="name" type="text" placeholder="e.g. Victoria Sterling" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-rose-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Phone Number *</label>
                        <input wire:model="phone" type="text" placeholder="+1 (555) 000-0000" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-rose-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\test\saas\resources\views/livewire/clients/client-manager.blade.php ENDPATH**/ ?>