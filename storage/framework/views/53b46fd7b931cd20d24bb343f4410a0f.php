<div>
    <!-- Top Action Header -->
    <div class="glass-panel p-5 rounded-2xl mb-8 shadow-sm border gold-border flex items-center justify-between">
        <div>
            <h3 class="font-serif text-lg font-bold text-slate-900">Salon Artisans & Stylists</h3>
            <p class="text-xs text-slate-500">Manage your team of professionals, commission tiers, and schedules</p>
        </div>
        <button wire:click="openNewStaffModal" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-sm transition flex items-center gap-1.5">
            <i class="fa-solid fa-user-plus"></i>
            <span>Add Stylist</span>
        </button>
    </div>

    <!-- Stylist Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="glass-panel rounded-2xl p-6 shadow-sm hover:shadow-md transition border gold-border flex flex-col justify-between <?php echo e(!$staff->is_active ? 'opacity-60 bg-slate-50/60' : ''); ?>">
            <div>
                <!-- Top Row: Avatar & Status -->
                <div class="flex items-start justify-between mb-4">
                    <div class="relative">
                        <img src="<?php echo e($staff->avatar_url); ?>" alt="<?php echo e($staff->name); ?>" class="w-16 h-16 rounded-2xl object-cover border-2 border-salon-300 shadow-md">
                        <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white <?php echo e($staff->is_active ? 'bg-emerald-500' : 'bg-slate-400'); ?>" title="<?php echo e($staff->is_active ? 'Active' : 'Inactive'); ?>"></span>
                    </div>

                    <div class="flex items-center space-x-1">
                        <button wire:click="editStaff(<?php echo e($staff->id); ?>)" title="Edit" class="p-1.5 rounded-lg text-slate-600 hover:bg-salon-50 hover:text-salon-700 text-xs">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <button wire:click="deleteStaff(<?php echo e($staff->id); ?>)" wire:confirm="Remove this stylist?" title="Delete" class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 text-xs">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>

                <!-- Info -->
                <h4 class="font-serif text-base font-bold text-slate-900"><?php echo e($staff->name); ?></h4>
                <p class="text-xs font-medium text-salon-700 mt-0.5"><?php echo e($staff->title); ?></p>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($staff->bio): ?>
                <p class="text-[11px] text-slate-500 mt-2 line-clamp-2 leading-relaxed"><?php echo e($staff->bio); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Contact details -->
                <div class="mt-4 pt-3 border-t gold-border space-y-1.5 text-[11px] text-slate-500">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($staff->phone): ?>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-salon-500 w-3"></i>
                        <span><?php echo e($staff->phone); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($staff->email): ?>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-envelope text-salon-500 w-3"></i>
                        <span class="truncate"><?php echo e($staff->email); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <!-- Bottom Stats -->
            <div class="mt-5 pt-3 border-t gold-border grid grid-cols-3 gap-2 text-center">
                <div class="bg-salon-50/50 p-2 rounded-xl">
                    <span class="block text-[10px] text-slate-400 font-semibold uppercase">Rating</span>
                    <span class="text-xs font-bold text-amber-500 flex items-center justify-center gap-0.5">
                        <i class="fa-solid fa-star text-[9px]"></i> <?php echo e($staff->rating); ?>

                    </span>
                </div>
                <div class="bg-salon-50/50 p-2 rounded-xl">
                    <span class="block text-[10px] text-slate-400 font-semibold uppercase">Commission</span>
                    <span class="text-xs font-bold font-mono text-slate-900"><?php echo e($staff->commission_rate); ?>%</span>
                </div>
                <div class="bg-salon-50/50 p-2 rounded-xl">
                    <span class="block text-[10px] text-slate-400 font-semibold uppercase">Bookings</span>
                    <span class="text-xs font-bold font-mono text-slate-900"><?php echo e($staff->appointments_count); ?></span>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    <!-- Add/Edit Stylist Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showStaffModal): ?>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900"><?php echo e($editingStaffId ? 'Edit Stylist' : 'Add New Stylist'); ?></h3>
                    <p class="text-xs text-slate-500">Professional profile & commission settings</p>
                </div>
                <button wire:click="$set('showStaffModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form wire:submit.prevent="saveStaff" class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name *</label>
                        <input wire:model="name" type="text" placeholder="e.g. Camille Dubois" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-rose-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Title / Specialization *</label>
                        <input wire:model="title" type="text" placeholder="e.g. Master Colorist" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-rose-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Phone</label>
                        <input wire:model="phone" type="text" placeholder="+1 (555) 000-0000" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                        <input wire:model="email" type="email" placeholder="stylist@salon.com" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Commission Rate (%) *</label>
                        <input wire:model="commissionRate" type="number" step="0.5" min="0" max="100" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Avatar Photo URL</label>
                        <input wire:model="avatarUrl" type="text" placeholder="https://..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Bio / Expertise</label>
                    <textarea wire:model="bio" rows="2" placeholder="Experience, credentials, background..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs"></textarea>
                </div>

                <div class="pt-2">
                    <label class="flex items-center space-x-2 text-xs font-medium text-slate-700 cursor-pointer">
                        <input wire:model="isActive" type="checkbox" class="rounded text-salon-500">
                        <span>Active Stylist on Duty</span>
                    </label>
                </div>

                <div class="pt-4 border-t gold-border flex items-center justify-end space-x-3">
                    <button type="button" wire:click="$set('showStaffModal', false)" class="px-4 py-2 rounded-xl border gold-border text-xs font-medium text-slate-600">Cancel</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-md shadow-salon-500/20">Save Stylist</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\test\saas\resources\views/livewire/staff/staff-manager.blade.php ENDPATH**/ ?>