<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salon Portal Sign In | GlowSuite B2B</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        salon: {
                            400: '#DFAB96',
                            500: '#D48166',
                            600: '#C26548',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-slate-100 flex items-center justify-center p-4 bg-gradient-to-br from-slate-950 via-slate-900 to-[#1e1310]">
    <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 rounded-2xl overflow-hidden shadow-2xl border border-slate-800 bg-slate-900/90 backdrop-blur-xl">
        
        <!-- Left Side: Luxury Salon Hero Showcase -->
        <div class="p-8 md:p-10 flex flex-col justify-between relative bg-cover bg-center border-b md:border-b-0 md:border-r border-slate-800" style="background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1000&auto=format&fit=crop&q=80');">
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-salon-600 to-amber-500 flex items-center justify-center text-white shadow-lg shadow-salon-500/20">
                        <i class="fa-solid fa-spa text-lg"></i>
                    </div>
                    <span class="font-serif text-2xl font-bold tracking-tight text-white">GlowSuite <span class="text-salon-400 font-sans text-xs px-2 py-0.5 rounded bg-salon-500/20 border border-salon-500/30">B2B SaaS</span></span>
                </div>
                
                <h3 class="font-serif text-2xl md:text-3xl text-white font-semibold leading-snug">
                    Next-Generation Salon & Spa Management
                </h3>
                <p class="text-xs text-slate-400 mt-3 leading-relaxed">
                    Powering luxury salons, hair studios, medi-spas, and aesthetic clinics with real-time appointments, stylist commission tracking, client CRM, and high-velocity POS.
                </p>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-800/80">
                <div class="space-y-2">
                    <div class="flex items-center text-xs text-slate-300">
                        <i class="fa-solid fa-check text-salon-400 mr-2.5"></i> Multi-tenant business management
                    </div>
                    <div class="flex items-center text-xs text-slate-300">
                        <i class="fa-solid fa-check text-salon-400 mr-2.5"></i> Interactive Livewire booking calendar
                    </div>
                    <div class="flex items-center text-xs text-salon-400">
                        <i class="fa-solid fa-check text-salon-400 mr-2.5"></i> Instant client self-service portal
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="<?php echo e(route('saas.landing')); ?>" class="text-xs text-salon-400 hover:text-white transition flex items-center gap-1 font-medium">
                        <i class="fa-solid fa-globe"></i> Visit SaaS Homepage &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form & 1-Click Demo Logins -->
        <div class="p-8 md:p-10 flex flex-col justify-between bg-slate-900/60">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="font-serif text-xl font-bold text-white">Welcome Back</h4>
                        <p class="text-xs text-slate-400">Sign in to your salon workspace</p>
                    </div>
                </div>

                <!-- 1-Click Quick Demo Switchers (Super Convenient) -->
                <div class="mb-6 p-3.5 rounded-xl bg-slate-800/60 border border-slate-700">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-salon-400 mb-2.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-bolt text-amber-400"></i> Instant 1-Click Demo Login
                    </div>
                    <div class="space-y-2">
                        <a href="<?php echo e(route('quick.login', 'owner@luxe.com')); ?>" class="w-full flex items-center justify-between px-3 py-2 rounded-lg bg-slate-700/60 hover:bg-slate-700 text-xs text-slate-200 transition border border-slate-600/50">
                            <span class="font-medium text-white flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-salon-500"></span> Luxe & Co. (Owner)
                            </span>
                            <span class="text-[10px] text-salon-300">Enter &rarr;</span>
                        </a>
                        <a href="<?php echo e(route('quick.login', 'owner@velvet.com')); ?>" class="w-full flex items-center justify-between px-3 py-2 rounded-lg bg-slate-700/60 hover:bg-slate-700 text-xs text-slate-200 transition border border-slate-600/50">
                            <span class="font-medium text-white flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Velvet Aura Spa (Owner)
                            </span>
                            <span class="text-[10px] text-emerald-400">Enter &rarr;</span>
                        </a>
                        <a href="<?php echo e(route('quick.login', 'admin@glowsuite.io')); ?>" class="w-full flex items-center justify-between px-3 py-2 rounded-lg bg-slate-700/60 hover:bg-slate-700 text-xs text-slate-200 transition border border-slate-600/50">
                            <span class="font-medium text-white flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-400"></span> SaaS Super Admin
                            </span>
                            <span class="text-[10px] text-amber-300">Enter &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Standard Email Login -->
                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="email" class="block text-xs font-medium text-slate-300 mb-1">Email Address</label>
                        <input id="email" type="email" name="email" value="<?php echo e(old('email', 'owner@luxe.com')); ?>" required class="w-full px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-salon-500">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-xs text-rose-400 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-xs font-medium text-slate-300">Password</label>
                            <span class="text-[11px] text-slate-400">Demo: <span class="text-salon-400 font-mono">password</span></span>
                        </div>
                        <input id="password" type="password" name="password" value="password" required class="w-full px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-salon-500">
                    </div>

                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember" class="w-4 h-4 rounded text-salon-500 focus:ring-salon-500 border-slate-700 bg-slate-800">
                        <label for="remember" class="ml-2 text-xs text-slate-400">Remember credentials</label>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 rounded-lg bg-salon-500 hover:bg-salon-600 text-white text-sm font-semibold shadow-lg shadow-salon-500/20 transition flex items-center justify-center gap-2">
                        <span>Sign In to Dashboard</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center text-xs text-slate-500">
                GlowSuite B2B Salon Architecture &bull; Laravel 12 & Livewire 4 &bull; MySQL
            </div>
        </div>

    </div>
</body>
</html>
<?php /**PATH D:\test\saas\resources\views/auth/login.blade.php ENDPATH**/ ?>