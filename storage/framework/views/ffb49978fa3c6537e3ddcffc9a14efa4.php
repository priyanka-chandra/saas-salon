<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-[#FAF7F5]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Dashboard'); ?> | <?php echo e(config('app.name', 'GlowSuite B2B')); ?></title>

    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        salon: {
                            50: '#FDF9F6',
                            100: '#FAF2EC',
                            200: '#F4E3D7',
                            300: '#EBCBBA',
                            400: '#DFAB96',
                            500: '#D48166', // Signature Rose Gold
                            600: '#C26548',
                            700: '#A14D35',
                            800: '#83402E',
                            900: '#6C3829',
                        },
                        obsidian: {
                            800: '#1A202C',
                            900: '#111827',
                            950: '#0B0F17',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        [x-cloak] { display: none !important; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(229, 221, 213, 0.7);
        }
        .luxury-gradient {
            background: linear-gradient(135deg, #1A202C 0%, #2D3748 100%);
        }
        .rose-gold-gradient {
            background: linear-gradient(135deg, #D48166 0%, #B8674D 100%);
        }
        .gold-border {
            border-color: #E8D8CB;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F5EFEB;
        }
        ::-webkit-scrollbar-thumb {
            background: #D48166;
            border-radius: 9999px;
        }
    </style>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="h-full font-sans antialiased text-slate-800 bg-[#FAF7F5] flex overflow-hidden">
    <?php
        $activeSalonId = session('active_salon_id');
        $activeSalon = \App\Models\Salon::find($activeSalonId) ?? \App\Models\Salon::first();
        $allSalons = \App\Models\Salon::all();
        $currentUser = Auth::user();
    ?>

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-obsidian-950 text-slate-200 flex flex-col flex-shrink-0 z-30 border-r border-slate-800 select-none shadow-2xl">
        <!-- Brand Header -->
        <div class="p-5 border-b border-slate-800/80">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl rose-gold-gradient flex items-center justify-center text-white shadow-lg shadow-salon-500/20">
                    <i class="fa-solid fa-spa text-lg"></i>
                </div>
                <div>
                    <h1 class="font-serif text-lg font-bold tracking-tight text-white flex items-center gap-1.5">
                        GlowSuite <span class="text-salon-400 font-sans text-xs px-1.5 py-0.5 rounded bg-salon-500/20 font-semibold tracking-wider">B2B</span>
                    </h1>
                    <p class="text-[11px] text-slate-400 truncate max-w-[140px]"><?php echo e($activeSalon->name ?? 'Salon Management'); ?></p>
                </div>
            </div>

            <!-- Active Tenant Card -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeSalon): ?>
            <div class="mt-4 p-2.5 rounded-lg bg-slate-900/90 border border-slate-800 flex items-center justify-between">
                <div class="flex items-center space-x-2 truncate">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-medium text-slate-300 truncate"><?php echo e($activeSalon->name); ?></span>
                </div>
                <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-salon-500/20 text-salon-300 border border-salon-500/30">
                    <?php echo e($activeSalon->subscription_plan); ?>

                </span>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto text-sm">
            <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">Salon Operations</div>

            <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('dashboard') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-solid fa-chart-line w-5 text-center mr-3 <?php echo e(request()->routeIs('dashboard') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?php echo e(route('appointments.index')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('appointments.*') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-regular fa-calendar-check w-5 text-center mr-3 <?php echo e(request()->routeIs('appointments.*') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span class="flex-1">Appointments</span>
                <span class="text-[10px] bg-slate-800 text-salon-300 border border-salon-500/30 px-2 py-0.5 rounded-full font-bold">
                    <?php echo e(\App\Models\Appointment::where('salon_id', $activeSalon->id ?? 1)->whereDate('appointment_date', today())->count()); ?>

                </span>
            </a>

            <a href="<?php echo e(route('services.index')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('services.*') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-solid fa-scissors w-5 text-center mr-3 <?php echo e(request()->routeIs('services.*') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span>Services & Catalog</span>
            </a>

            <a href="<?php echo e(route('staff.index')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('staff.*') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-solid fa-user-tie w-5 text-center mr-3 <?php echo e(request()->routeIs('staff.*') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span>Staff & Stylists</span>
            </a>

            <a href="<?php echo e(route('clients.index')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('clients.*') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-solid fa-users w-5 text-center mr-3 <?php echo e(request()->routeIs('clients.*') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span>Clients CRM</span>
            </a>

            <a href="<?php echo e(route('pos.index')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('pos.*') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-solid fa-cash-register w-5 text-center mr-3 <?php echo e(request()->routeIs('pos.*') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span class="flex-1">Point of Sale (POS)</span>
                <span class="text-[10px] bg-emerald-950 text-emerald-400 border border-emerald-500/30 px-1.5 py-0.5 rounded font-bold">Checkout</span>
            </a>

            <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">SaaS & Configuration</div>

            <a href="<?php echo e(route('settings.index')); ?>" class="flex items-center px-3 py-2.5 rounded-lg transition-all <?php echo e(request()->routeIs('settings.*') ? 'bg-salon-500 text-white font-medium shadow-md shadow-salon-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60'); ?>">
                <i class="fa-solid fa-sliders w-5 text-center mr-3 <?php echo e(request()->routeIs('settings.*') ? 'text-white' : 'text-salon-400'); ?>"></i>
                <span>Salon Settings & Plan</span>
            </a>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeSalon): ?>
            <a href="<?php echo e(route('public.booking', $activeSalon->slug)); ?>" target="_blank" class="flex items-center px-3 py-2.5 rounded-lg transition-all text-slate-400 hover:text-salon-300 hover:bg-slate-900/60 group">
                <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center mr-3 text-salon-400 group-hover:scale-110 transition-transform"></i>
                <span class="flex-1">Public Booking Page</span>
                <i class="fa-solid fa-external-link text-[10px] text-slate-500"></i>
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <a href="<?php echo e(route('saas.landing')); ?>" target="_blank" class="flex items-center px-3 py-2.5 rounded-lg transition-all text-slate-400 hover:text-salon-300 hover:bg-slate-900/60 group">
                <i class="fa-solid fa-gem w-5 text-center mr-3 text-amber-400 group-hover:scale-110 transition-transform"></i>
                <span class="flex-1">SaaS Platform Home</span>
            </a>
        </nav>

        <!-- User Profile Footer -->
        <div class="p-3 border-t border-slate-800 bg-obsidian-900">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5 truncate">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentUser && $currentUser->avatar): ?>
                        <img src="<?php echo e($currentUser->avatar); ?>" alt="<?php echo e($currentUser->name); ?>" class="w-8 h-8 rounded-full object-cover border border-salon-500/40">
                    <?php else: ?>
                        <div class="w-8 h-8 rounded-full bg-salon-500/30 text-salon-300 font-bold flex items-center justify-center text-xs border border-salon-500/40">
                            <?php echo e($currentUser ? substr($currentUser->name, 0, 1) : 'U'); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-slate-200 truncate"><?php echo e($currentUser->name ?? 'Guest User'); ?></p>
                        <p class="text-[10px] text-slate-400 capitalize"><?php echo e($currentUser->role ?? 'Staff'); ?></p>
                    </div>
                </div>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-lg transition">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Workspace Area -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Top App Bar -->
        <header class="h-16 bg-white border-b gold-border px-6 flex items-center justify-between flex-shrink-0 z-20 shadow-sm">
            <div class="flex items-center space-x-4">
                <h2 class="font-serif text-xl font-bold text-slate-900 tracking-tight">
                    <?php echo e($header ?? 'Dashboard'); ?>

                </h2>
                <span class="text-slate-300">|</span>
                <span class="text-xs font-medium text-slate-500 flex items-center gap-1.5">
                    <i class="fa-regular fa-clock text-salon-500"></i>
                    <?php echo e(now()->format('l, F j, Y')); ?>

                </span>
            </div>

            <!-- Top Actions & Tenant Switcher -->
            <div class="flex items-center space-x-3">
                <!-- Multi-Tenant Salon Switcher Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="flex items-center space-x-2 px-3 py-1.5 rounded-lg border gold-border bg-salon-50 text-slate-700 hover:bg-salon-100 transition text-xs font-medium">
                        <i class="fa-solid fa-store text-salon-500"></i>
                        <span class="font-semibold"><?php echo e($activeSalon->name ?? 'Select Salon'); ?></span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                    </button>

                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-64 rounded-xl bg-white shadow-2xl border gold-border py-2 z-50">
                        <div class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b gold-border">
                            Switch Salon Tenant
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allSalons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('switch.salon', $salon->id)); ?>" class="flex items-center justify-between px-3 py-2 text-xs hover:bg-salon-50 transition <?php echo e($activeSalon && $activeSalon->id == $salon->id ? 'bg-salon-100/70 font-semibold text-salon-700' : 'text-slate-600'); ?>">
                            <div class="flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full <?php echo e($salon->id == 1 ? 'bg-salon-500' : 'bg-emerald-500'); ?>"></span>
                                <span class="truncate"><?php echo e($salon->name); ?></span>
                            </div>
                            <span class="text-[10px] text-slate-400 uppercase font-mono"><?php echo e($salon->subscription_plan); ?></span>
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>

                <!-- Quick Action Buttons -->
                <a href="<?php echo e(route('appointments.index')); ?>" class="px-3.5 py-1.5 rounded-lg bg-salon-500 hover:bg-salon-600 text-white text-xs font-semibold flex items-center space-x-1.5 shadow-sm shadow-salon-500/30 transition">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>New Booking</span>
                </a>

                <a href="<?php echo e(route('pos.index')); ?>" class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium flex items-center space-x-1.5 shadow-sm transition">
                    <i class="fa-solid fa-receipt text-xs text-salon-400"></i>
                    <span>Quick POS</span>
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="bg-emerald-50 border-b border-emerald-200 px-6 py-2.5 flex items-center justify-between text-xs text-emerald-800">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                <span class="font-medium"><?php echo e(session('success')); ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="bg-rose-50 border-b border-rose-200 px-6 py-2.5 flex items-center justify-between text-xs text-rose-800">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation text-rose-500"></i>
                <span class="font-medium"><?php echo e(session('error')); ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Main Dynamic View Container -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 bg-[#FAF7F5]">
            <?php echo e($slot ?? ''); ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Alpine.js (bundled or loaded) & Livewire scripts -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH D:\test\saas\resources\views/layouts/app.blade.php ENDPATH**/ ?>