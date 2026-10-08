<div>
    <!-- Header Actions & Categories Navigation -->
    <div class="glass-panel p-5 rounded-2xl mb-8 shadow-sm border gold-border">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b gold-border">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search treatments..." class="pl-8 pr-3 py-1.5 rounded-lg border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500 w-64">
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button wire:click="$set('showCategoryModal', true)" class="px-3.5 py-1.5 rounded-lg border gold-border bg-white hover:bg-salon-50 text-slate-700 text-xs font-semibold transition">
                    + New Category
                </button>
                <button wire:click="openNewServiceModal" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Service</span>
                </button>
            </div>
        </div>

        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 pt-4">
            <button wire:click="$set('activeCategoryId', 'all')" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition <?php echo e($activeCategoryId === 'all' ? 'bg-salon-500 text-white shadow-sm' : 'bg-white hover:bg-salon-50 text-slate-600 border gold-border'); ?>">
                All Treatments (<?php echo e($services->count()); ?>)
            </button>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <button wire:click="$set('activeCategoryId', <?php echo e($cat->id); ?>)" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 <?php echo e($activeCategoryId == $cat->id ? 'bg-salon-500 text-white shadow-sm' : 'bg-white hover:bg-salon-50 text-slate-600 border gold-border'); ?>">
                <span><?php echo e($cat->name); ?></span>
                <span class="text-[10px] px-1 rounded-full <?php echo e($activeCategoryId == $cat->id ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'); ?>">
                    <?php echo e($cat->services_count); ?>

                </span>
            </button>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    <!-- Services Grid -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->isEmpty()): ?>
    <div class="glass-panel rounded-2xl p-16 text-center shadow-sm border gold-border">
        <div class="w-16 h-16 rounded-full bg-salon-50 text-salon-500 flex items-center justify-center mx-auto mb-3">
            <i class="fa-solid fa-scissors text-2xl"></i>
        </div>
        <h4 class="text-sm font-bold text-slate-800">No services found</h4>
        <p class="text-xs text-slate-400 mt-1">Get started by adding treatments and pricing to your salon catalog.</p>
        <button wire:click="openNewServiceModal" class="mt-4 px-4 py-2 rounded-xl bg-salon-500 text-white text-xs font-semibold hover:bg-salon-600 transition">
            + Create Service
        </button>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="glass-panel rounded-2xl p-5 shadow-sm hover:shadow-md transition border gold-border flex flex-col justify-between <?php echo e(!$srv->is_active ? 'opacity-60 bg-slate-50/60' : ''); ?>">
            <div>
                <!-- Category & Popular Badge -->
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-salon-100 text-salon-800 border border-salon-200">
                        <?php echo e($srv->category->name ?? 'General'); ?>

                    </span>
                    <button wire:click="togglePopular(<?php echo e($srv->id); ?>)" title="Toggle Popular" class="text-xs <?php echo e($srv->is_popular ? 'text-amber-500' : 'text-slate-300 hover:text-amber-400'); ?>">
                        <i class="fa-solid fa-star"></i>
                    </button>
                </div>

                <!-- Service Name & Price -->
                <div class="flex items-baseline justify-between gap-2">
                    <h4 class="text-sm font-bold text-slate-900 leading-snug"><?php echo e($srv->name); ?></h4>
                    <span class="text-base font-bold font-mono text-slate-900 flex-shrink-0">
                        <?php echo e($salon->currency); ?><?php echo e(number_format($srv->price, 2)); ?>

                    </span>
                </div>

                <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                    <?php echo e($srv->description ?: 'No detailed description provided.'); ?>

                </p>
            </div>

            <div class="mt-5 pt-3 border-t gold-border">
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center gap-3 text-slate-400 text-[11px]">
                        <span><i class="fa-regular fa-clock mr-1"></i> <?php echo e($srv->formatted_duration); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($srv->buffer_time_minutes > 0): ?>
                        <span>&bull; +<?php echo e($srv->buffer_time_minutes); ?>m buffer</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="flex items-center space-x-1">
                        <button wire:click="toggleActive(<?php echo e($srv->id); ?>)" title="<?php echo e($srv->is_active ? 'Active' : 'Inactive'); ?>" class="p-1.5 rounded-lg text-xs <?php echo e($srv->is_active ? 'text-emerald-600 bg-emerald-50 hover:bg-emerald-100' : 'text-slate-400 bg-slate-100'); ?>">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                        <button wire:click="editService(<?php echo e($srv->id); ?>)" title="Edit" class="p-1.5 rounded-lg text-slate-600 hover:bg-salon-50 hover:text-salon-700">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <button wire:click="deleteService(<?php echo e($srv->id); ?>)" wire:confirm="Are you sure you want to delete this service?" title="Delete" class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Add/Edit Service Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showServiceModal): ?>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-lg font-bold text-slate-900"><?php echo e($editingServiceId ? 'Edit Treatment' : 'Add New Treatment'); ?></h3>
                    <p class="text-xs text-slate-500">Configure treatment details and pricing</p>
                </div>
                <button wire:click="$set('showServiceModal', false)" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form wire:submit.prevent="saveService" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Service Name *</label>
                    <input wire:model="name" type="text" placeholder="e.g. Couture Balayage & Gloss" class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500">
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
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Category *</label>
                    <select wire:model="categoryId" class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Price ($) *</label>
                        <input wire:model="price" type="number" step="0.01" min="0" placeholder="0.00" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-rose-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Duration (Min) *</label>
                        <input wire:model="durationMinutes" type="number" step="5" min="5" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Buffer (Min)</label>
                        <input wire:model="bufferTimeMinutes" type="number" step="5" min="0" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Description</label>
                    <textarea wire:model="description" rows="3" placeholder="Explain what the service includes..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs"></textarea>
                </div>

                <div class="flex items-center space-x-6 pt-2">
                    <label class="flex items-center space-x-2 text-xs font-medium text-slate-700 cursor-pointer">
                        <input wire:model="isPopular" type="checkbox" class="rounded text-salon-500">
                        <span>Feature as Signature / Popular</span>
                    </label>
                    <label class="flex items-center space-x-2 text-xs font-medium text-slate-700 cursor-pointer">
                        <input wire:model="isActive" type="checkbox" class="rounded text-salon-500">
                        <span>Active for Booking</span>
                    </label>
                </div>

                <div class="pt-4 border-t gold-border flex items-center justify-end space-x-3">
                    <button type="button" wire:click="$set('showServiceModal', false)" class="px-4 py-2 rounded-xl border gold-border text-xs font-medium text-slate-600">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-md shadow-salon-500/20">
                        Save Service
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Add Category Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showCategoryModal): ?>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl border gold-border animate-in fade-in zoom-in duration-150">
            <div class="p-5 border-b gold-border bg-slate-50 flex items-center justify-between">
                <h3 class="font-serif text-lg font-bold text-slate-900">Add Service Category</h3>
                <button wire:click="$set('showCategoryModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form wire:submit.prevent="saveCategory" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Category Title *</label>
                    <input wire:model="newCategoryName" type="text" placeholder="e.g. Medi-Spa & Body Rituals" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newCategoryName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-rose-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Description</label>
                    <textarea wire:model="newCategoryDescription" rows="2" placeholder="Brief category summary..." class="w-full px-3 py-2 rounded-xl border gold-border text-xs"></textarea>
                </div>
                <div class="pt-4 border-t gold-border flex items-center justify-end space-x-3">
                    <button type="button" wire:click="$set('showCategoryModal', false)" class="px-4 py-2 rounded-xl border gold-border text-xs">Cancel</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-salon-500 text-white text-xs font-semibold">Save Category</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\test\saas\resources\views/livewire/services/service-manager.blade.php ENDPATH**/ ?>