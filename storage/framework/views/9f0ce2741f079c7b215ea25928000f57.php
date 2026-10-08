<div class="h-[calc(100vh-8.5rem)] flex flex-col lg:flex-row gap-6">
    
    <!-- Left Column: Services & Treatment Selector -->
    <div class="flex-1 flex flex-col overflow-hidden glass-panel rounded-2xl border gold-border p-5">
        <!-- Search & Category Filters -->
        <div class="space-y-3 pb-4 border-b gold-border flex-shrink-0">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-xs text-slate-400"></i>
                <input wire:model.live.debounce.250ms="searchService" type="text" placeholder="Quick search service by name..." class="w-full pl-9 pr-3 py-2 rounded-xl border gold-border bg-white text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-salon-500">
            </div>

            <div class="flex flex-wrap gap-1.5 overflow-x-auto pb-1">
                <button wire:click="$set('selectedCategoryId', 'all')" class="px-3 py-1 rounded-lg text-xs font-semibold transition <?php echo e($selectedCategoryId === 'all' ? 'bg-salon-500 text-white shadow-sm' : 'bg-white hover:bg-salon-50 text-slate-600 border gold-border'); ?>">
                    All
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <button wire:click="$set('selectedCategoryId', <?php echo e($cat->id); ?>)" class="px-3 py-1 rounded-lg text-xs font-semibold transition <?php echo e($selectedCategoryId == $cat->id ? 'bg-salon-500 text-white shadow-sm' : 'bg-white hover:bg-salon-50 text-slate-600 border gold-border'); ?>">
                    <?php echo e($cat->name); ?>

                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        <!-- Scrollable Service Grid -->
        <div class="flex-1 overflow-y-auto pt-4 pr-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <button wire:click="addToCart(<?php echo e($srv->id); ?>)" class="p-3.5 rounded-xl bg-white hover:bg-salon-50/70 border gold-border hover:border-salon-400 text-left transition flex flex-col justify-between group shadow-xs">
                    <div>
                        <div class="flex items-center justify-between text-[10px] text-slate-400 font-semibold mb-1">
                            <span class="truncate"><?php echo e($srv->category->name ?? 'Treatment'); ?></span>
                            <span class="text-salon-600"><i class="fa-regular fa-clock"></i> <?php echo e($srv->duration_minutes); ?>m</span>
                        </div>
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-salon-700 transition leading-snug line-clamp-2">
                            <?php echo e($srv->name); ?>

                        </h4>
                    </div>
                    <div class="mt-3 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-mono font-bold text-sm text-slate-900">
                            <?php echo e($salon->currency); ?><?php echo e(number_format($srv->price, 2)); ?>

                        </span>
                        <span class="w-6 h-6 rounded-lg bg-salon-500/10 text-salon-600 flex items-center justify-center text-xs group-hover:bg-salon-500 group-hover:text-white transition">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                        </span>
                    </div>
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Right Column: Interactive Register Cart & Billing -->
    <div class="w-full lg:w-96 flex flex-col glass-panel rounded-2xl border gold-border p-5 shadow-md flex-shrink-0">
        
        <!-- Ticket Header -->
        <div class="flex items-center justify-between pb-3 border-b gold-border">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-receipt text-salon-500"></i>
                <h3 class="font-serif text-base font-bold text-slate-900">Current Ticket</h3>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($cart)): ?>
            <button wire:click="clearCart" class="text-[11px] text-rose-500 hover:text-rose-700 font-medium">
                Clear All
            </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Ticket Client & Stylist Selectors -->
        <div class="py-3 border-b gold-border space-y-2">
            <div>
                <label class="block text-[11px] font-semibold text-slate-500 mb-0.5">Attach Client (Optional)</label>
                <select wire:model="clientId" class="w-full px-2.5 py-1.5 rounded-lg border gold-border text-xs bg-white text-slate-800 focus:outline-none">
                    <option value="">-- Walk-in Guest --</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?> (<?php echo e($c->phone); ?>)</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>
        </div>

        <!-- Cart Item List -->
        <div class="flex-1 overflow-y-auto py-3 space-y-2.5 min-h-[160px]">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="p-2.5 rounded-xl bg-white/80 border gold-border flex items-center justify-between text-xs">
                <div class="flex-1 min-w-0 pr-2">
                    <h5 class="font-bold text-slate-800 truncate"><?php echo e($item['name']); ?></h5>
                    <span class="text-[11px] font-mono text-slate-500"><?php echo e($salon->currency); ?><?php echo e(number_format($item['price'], 2)); ?> each</span>
                </div>

                <!-- Qty Controller -->
                <div class="flex items-center space-x-1.5">
                    <button wire:click="updateQuantity(<?php echo e($index); ?>, -1)" class="w-5 h-5 rounded bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-[10px] font-bold">
                        -
                    </button>
                    <span class="font-mono font-bold text-xs w-4 text-center"><?php echo e($item['quantity']); ?></span>
                    <button wire:click="updateQuantity(<?php echo e($index); ?>, 1)" class="w-5 h-5 rounded bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-[10px] font-bold">
                        +
                    </button>
                </div>

                <!-- Item Total -->
                <div class="text-right pl-3 font-mono font-bold text-slate-900">
                    <?php echo e($salon->currency); ?><?php echo e(number_format($item['total'], 2)); ?>

                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="py-10 text-center text-xs text-slate-400">
                <i class="fa-solid fa-basket-shopping text-2xl text-slate-300 mb-2"></i>
                <p>No treatments in ticket.</p>
                <p class="text-[11px] mt-0.5">Click services on the left to add.</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Billing Summary Calculation -->
        <div class="pt-3 border-t gold-border space-y-1.5 text-xs">
            <div class="flex justify-between text-slate-500">
                <span>Subtotal</span>
                <span class="font-mono"><?php echo e($salon->currency); ?><?php echo e(number_format($this->subtotal, 2)); ?></span>
            </div>

            <div class="flex items-center justify-between text-slate-500">
                <span>Discount ($)</span>
                <input wire:model.live.debounce.300ms="discountAmount" type="number" step="0.5" min="0" placeholder="0.00" class="w-20 px-2 py-0.5 rounded border gold-border text-right font-mono text-xs">
            </div>

            <div class="flex justify-between text-slate-500">
                <span>Sales Tax (<?php echo e($salon->tax_percentage); ?>%)</span>
                <span class="font-mono"><?php echo e($salon->currency); ?><?php echo e(number_format($this->taxAmount, 2)); ?></span>
            </div>

            <div class="flex justify-between items-baseline pt-2 border-t gold-border text-slate-900 font-bold">
                <span class="font-serif text-sm">Total Due</span>
                <span class="font-mono text-lg text-salon-600">
                    <?php echo e($salon->currency); ?><?php echo e(number_format($this->totalAmount, 2)); ?>

                </span>
            </div>
        </div>

        <!-- Payment Methods & Checkout Button -->
        <div class="pt-4 space-y-2">
            <div class="grid grid-cols-3 gap-1.5">
                <button type="button" wire:click="$set('paymentMethod', 'card')" class="py-1.5 rounded-lg text-xs font-semibold border transition <?php echo e($paymentMethod === 'card' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'); ?>">
                    <i class="fa-solid fa-credit-card mr-1"></i> Card
                </button>
                <button type="button" wire:click="$set('paymentMethod', 'cash')" class="py-1.5 rounded-lg text-xs font-semibold border transition <?php echo e($paymentMethod === 'cash' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'); ?>">
                    <i class="fa-solid fa-money-bill mr-1"></i> Cash
                </button>
                <button type="button" wire:click="$set('paymentMethod', 'apple_pay')" class="py-1.5 rounded-lg text-xs font-semibold border transition <?php echo e($paymentMethod === 'apple_pay' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'); ?>">
                    <i class="fa-brands fa-apple mr-1"></i> Pay
                </button>
            </div>

            <button wire:click="processCheckout" class="w-full py-3 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-bold shadow-lg shadow-salon-500/30 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-cash-register"></i>
                <span>Complete Checkout &bull; <?php echo e($salon->currency); ?><?php echo e(number_format($this->totalAmount, 2)); ?></span>
            </button>
        </div>

    </div>

    <!-- Printable Receipt Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showReceiptModal && $completedInvoice): ?>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl border gold-border p-6 text-center animate-in zoom-in-95 duration-150">
            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-check text-xl"></i>
            </div>
            
            <h4 class="font-serif text-lg font-bold text-slate-900">Payment Completed!</h4>
            <p class="text-xs text-slate-400 font-mono mt-0.5"><?php echo e($completedInvoice->invoice_number); ?></p>

            <div class="my-4 p-4 rounded-xl bg-slate-50 border border-slate-200 text-left text-xs space-y-2">
                <div class="flex justify-between font-semibold text-slate-700">
                    <span><?php echo e($salon->name); ?></span>
                    <span class="capitalize text-emerald-600 font-bold"><?php echo e($completedInvoice->payment_method); ?></span>
                </div>
                <div class="divide-y divide-slate-200 pt-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $completedInvoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="py-1.5 flex justify-between">
                        <span><?php echo e($itm->item_name); ?> (x<?php echo e($itm->quantity); ?>)</span>
                        <span class="font-mono font-bold"><?php echo e($salon->currency); ?><?php echo e(number_format($itm->total_price, 2)); ?></span>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <div class="pt-2 border-t border-slate-200 flex justify-between font-bold text-slate-900">
                    <span>Total Paid</span>
                    <span class="font-mono text-salon-600"><?php echo e($salon->currency); ?><?php echo e(number_format($completedInvoice->total_amount, 2)); ?></span>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <button onclick="window.print()" class="flex-1 py-2 rounded-xl border gold-border text-xs font-semibold text-slate-700 hover:bg-slate-50">
                    <i class="fa-solid fa-print mr-1"></i> Print Receipt
                </button>
                <button wire:click="$set('showReceiptModal', false)" class="flex-1 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold">
                    Done
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH D:\test\saas\resources\views/livewire/pos/point-of-sale.blade.php ENDPATH**/ ?>