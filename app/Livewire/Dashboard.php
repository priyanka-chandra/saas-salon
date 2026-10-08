<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\StaffMember;
use App\Traits\WithActiveSalon;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    use WithActiveSalon;

    public function updateAppointmentStatus($appointmentId, $newStatus)
    {
        $salon = $this->getActiveSalon();
        $appointment = Appointment::where('salon_id', $salon->id)->find($appointmentId);

        if ($appointment) {
            $appointment->status = $newStatus;
            if ($newStatus === 'completed') {
                $appointment->payment_status = 'paid';
            }
            $appointment->save();

            session()->flash('success', "Appointment status updated to {$newStatus}.");
        }
    }

    public function render()
    {
        $salon = $this->getActiveSalon();
        $today = Carbon::today()->format('Y-m-d');

        // Metrics
        $todayAppointmentsCount = Appointment::where('salon_id', $salon->id)
            ->whereDate('appointment_date', $today)
            ->count();

        $todayRevenue = Invoice::where('salon_id', $salon->id)
            ->whereDate('created_at', $today)
            ->where('status', 'paid')
            ->sum('total_amount');

        // Fallback for demo if no invoices created today: sum final_price of today's paid appointments
        if ($todayRevenue == 0) {
            $todayRevenue = Appointment::where('salon_id', $salon->id)
                ->whereDate('appointment_date', $today)
                ->where('payment_status', 'paid')
                ->sum('final_price');
        }

        $activeStaffCount = StaffMember::where('salon_id', $salon->id)
            ->where('is_active', true)
            ->count();

        $totalClientsCount = Client::where('salon_id', $salon->id)->count();
        $vipClientsCount = Client::where('salon_id', $salon->id)->where('vip_status', true)->count();

        // Today's appointments
        $todayAppointments = Appointment::with(['client', 'staffMember', 'service'])
            ->where('salon_id', $salon->id)
            ->whereDate('appointment_date', $today)
            ->orderBy('start_time')
            ->get();

        // Top Services
        $topServices = Service::where('salon_id', $salon->id)
            ->where('is_active', true)
            ->withCount('appointments')
            ->orderByDesc('is_popular')
            ->orderByDesc('appointments_count')
            ->take(4)
            ->get();

        // Top Stylists
        $stylists = StaffMember::where('salon_id', $salon->id)
            ->where('is_active', true)
            ->withCount('appointments')
            ->orderByDesc('rating')
            ->take(3)
            ->get();

        // Recent Invoices
        $recentInvoices = Invoice::with(['client', 'appointment'])
            ->where('salon_id', $salon->id)
            ->latest()
            ->take(4)
            ->get();

        return view('livewire.dashboard', [
            'salon' => $salon,
            'todayAppointmentsCount' => $todayAppointmentsCount,
            'todayRevenue' => $todayRevenue,
            'activeStaffCount' => $activeStaffCount,
            'totalClientsCount' => $totalClientsCount,
            'vipClientsCount' => $vipClientsCount,
            'todayAppointments' => $todayAppointments,
            'topServices' => $topServices,
            'stylists' => $stylists,
            'recentInvoices' => $recentInvoices,
        ])->layout('layouts.app', ['title' => 'Dashboard | ' . $salon->name]);
    }
}
