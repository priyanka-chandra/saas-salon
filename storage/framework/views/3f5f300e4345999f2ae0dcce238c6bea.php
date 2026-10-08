<div class="space-y-8 max-w-5xl">
    
    <!-- SaaS Subscription Plans Section -->
    <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
        <div class="flex items-center justify-between pb-4 border-b gold-border mb-6">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-salon-600 bg-salon-50 px-2 py-0.5 rounded">B2B SaaS Tier</span>
                <h3 class="font-serif text-lg font-bold text-slate-900 mt-1">Platform Subscription Plan</h3>
                <p class="text-xs text-slate-500">Manage your salon software subscription, limits, and multi-tenant perks</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">
                Status: Active
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Starter Plan -->
            <div class="p-5 rounded-2xl border transition <?php echo e($subscriptionPlan === 'starter' ? 'border-salon-500 ring-2 ring-salon-500/20 bg-salon-50/40' : 'gold-border bg-white'); ?>">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-bold text-slate-900 text-sm">Starter Boutique</h4>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subscriptionPlan === 'starter'): ?>
                    <span class="text-[10px] bg-salon-500 text-white font-bold px-2 py-0.5 rounded-full">ACTIVE</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="flex items-baseline gap-1 my-3">
                    <span class="text-2xl font-bold font-serif text-slate-900">$29</span>
                    <span class="text-xs text-slate-400">/month</span>
                </div>
                <ul class="space-y-2 text-xs text-slate-600 my-4">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> 1 Salon Location</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Up to 3 Stylists</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Client Booking Portal</li>
                </ul>
                <button wire:click="upgradePlan('starter')" class="w-full py-2 rounded-xl text-xs font-semibold transition <?php echo e($subscriptionPlan === 'starter' ? 'bg-slate-200 text-slate-700 cursor-default' : 'bg-slate-900 hover:bg-slate-800 text-white'); ?>">
                    <?php echo e($subscriptionPlan === 'starter' ? 'Current Plan' : 'Select Starter'); ?>

                </button>
            </div>

            <!-- Growth Plan -->
            <div class="p-5 rounded-2xl border transition relative <?php echo e($subscriptionPlan === 'growth' ? 'border-salon-500 ring-2 ring-salon-500/20 bg-salon-50/40' : 'gold-border bg-white'); ?>">
                <div class="absolute -top-3 right-4 bg-gradient-to-r from-salon-500 to-amber-500 text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full shadow-sm">
                    Most Popular
                </div>
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-bold text-slate-900 text-sm">Growth Studio</h4>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subscriptionPlan === 'growth'): ?>
                    <span class="text-[10px] bg-salon-500 text-white font-bold px-2 py-0.5 rounded-full">ACTIVE</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="flex items-baseline gap-1 my-3">
                    <span class="text-2xl font-bold font-serif text-slate-900">$79</span>
                    <span class="text-xs text-slate-400">/month</span>
                </div>
                <ul class="space-y-2 text-xs text-slate-600 my-4">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Up to 10 Stylists</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Advanced POS & Invoicing</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> SMS & Email Reminders</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> VIP Loyalty Tracking</li>
                </ul>
                <button wire:click="upgradePlan('growth')" class="w-full py-2 rounded-xl text-xs font-semibold transition <?php echo e($subscriptionPlan === 'growth' ? 'bg-slate-200 text-slate-700 cursor-default' : 'bg-salon-500 hover:bg-salon-600 text-white'); ?>">
                    <?php echo e($subscriptionPlan === 'growth' ? 'Current Plan' : 'Upgrade to Growth'); ?>

                </button>
            </div>

            <!-- Enterprise Plan -->
            <div class="p-5 rounded-2xl border transition <?php echo e($subscriptionPlan === 'enterprise' ? 'border-salon-500 ring-2 ring-salon-500/20 bg-salon-50/40' : 'gold-border bg-white'); ?>">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-bold text-slate-900 text-sm">Luxury Enterprise</h4>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subscriptionPlan === 'enterprise'): ?>
                    <span class="text-[10px] bg-salon-500 text-white font-bold px-2 py-0.5 rounded-full">ACTIVE</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="flex items-baseline gap-1 my-3">
                    <span class="text-2xl font-bold font-serif text-slate-900">$199</span>
                    <span class="text-xs text-slate-400">/month</span>
                </div>
                <ul class="space-y-2 text-xs text-slate-600 my-4">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Unlimited Stylists & Chairs</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Multi-Location Chains</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> Custom Domain & Branding</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-salon-500 text-[10px]"></i> 24/7 Dedicated Concierge</li>
                </ul>
                <button wire:click="upgradePlan('enterprise')" class="w-full py-2 rounded-xl text-xs font-semibold transition <?php echo e($subscriptionPlan === 'enterprise' ? 'bg-slate-200 text-slate-700 cursor-default' : 'bg-slate-900 hover:bg-slate-800 text-white'); ?>">
                    <?php echo e($subscriptionPlan === 'enterprise' ? 'Current Plan' : 'Upgrade to Enterprise'); ?>

                </button>
            </div>
        </div>
    </div>

    <!-- Public Booking Page Embed Link -->
    <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h4 class="font-serif text-base font-bold text-slate-900">Client Self-Service Booking Widget</h4>
                <p class="text-xs text-slate-500">Share this direct link with your salon clients or embed on your website</p>
                <code class="mt-2 inline-block px-3 py-1.5 rounded-lg bg-slate-100 text-salon-700 font-mono text-xs select-all">
                    <?php echo e(url('/book/' . $salon->slug)); ?>

                </code>
            </div>
            <a href="<?php echo e(route('public.booking', $salon->slug)); ?>" target="_blank" class="px-4 py-2 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold flex items-center justify-center gap-2 self-start sm:self-center shadow-sm">
                <span>Test Booking Page</span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
            </a>
        </div>
    </div>

    <!-- Business Details Form -->
    <div class="glass-panel rounded-2xl p-6 shadow-sm border gold-border">
        <h3 class="font-serif text-lg font-bold text-slate-900 mb-1">Business Profile & Operational Hours</h3>
        <p class="text-xs text-slate-500 pb-4 border-b gold-border mb-6">General information printed on customer receipts and booking portals</p>

        <form wire:submit.prevent="saveSettings" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Salon Name *</label>
                    <input wire:model="name" type="text" class="w-full px-3 py-2 rounded-xl border gold-border text-xs focus:ring-2 focus:ring-salon-500">
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
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tagline</label>
                    <input wire:model="tagline" type="text" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Business Phone</label>
                    <input wire:model="phone" type="text" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Business Email</label>
                    <input wire:model="email" type="email" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">City / State</label>
                    <input wire:model="city" type="text" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Full Physical Address</label>
                <input wire:model="address" type="text" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Currency Symbol</label>
                    <input wire:model="currency" type="text" class="w-full px-3 py-2 rounded-xl border gold-border text-xs font-mono">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Sales Tax (%)</label>
                    <input wire:model="taxPercentage" type="number" step="0.1" class="w-full px-3 py-2 rounded-xl border gold-border text-xs font-mono">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Opening Time</label>
                    <input wire:model="openingTime" type="time" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Closing Time</label>
                    <input wire:model="closingTime" type="time" class="w-full px-3 py-2 rounded-xl border gold-border text-xs">
                </div>
            </div>

            <div class="pt-4 border-t gold-border flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold shadow-md shadow-salon-500/20 transition flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH D:\test\saas\resources\views/livewire/settings/tenant-settings.blade.php ENDPATH**/ ?>