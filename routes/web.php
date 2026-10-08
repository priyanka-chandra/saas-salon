<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Appointments\AppointmentManager;
use App\Livewire\Clients\ClientManager;
use App\Livewire\Dashboard;
use App\Livewire\Pos\PointOfSale;
use App\Livewire\PublicBooking\SalonBookingPortal;
use App\Livewire\SaaS\LandingPage;
use App\Livewire\Services\ServiceManager;
use App\Livewire\Settings\TenantSettings;
use App\Livewire\Staff\StaffManager;
use Illuminate\Support\Facades\Route;

// Public SaaS Platform Landing Page
Route::get('/', LandingPage::class)->name('saas.landing');

// Authentication & Demo Switchers
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/quick-login/{email}', [AuthController::class, 'quickLogin'])->name('quick.login');
Route::get('/switch-salon/{id}', [AuthController::class, 'switchSalon'])->name('switch.salon');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Customer Booking Portal for each Salon Tenant
Route::get('/book/{slug}', SalonBookingPortal::class)->name('public.booking');

// Authenticated Salon Portal (or accessible for direct testing)
Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/appointments', AppointmentManager::class)->name('appointments.index');
    Route::get('/services', ServiceManager::class)->name('services.index');
    Route::get('/staff', StaffManager::class)->name('staff.index');
    Route::get('/clients', ClientManager::class)->name('clients.index');
    Route::get('/pos', PointOfSale::class)->name('pos.index');
    Route::get('/settings', TenantSettings::class)->name('settings.index');
});
