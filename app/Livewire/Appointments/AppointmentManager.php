<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Models\StaffMember;
use App\Traits\WithActiveSalon;
use Carbon\Carbon;
use Livewire\Component;

class AppointmentManager extends Component
{
    use WithActiveSalon;

    public $selectedDate;
    public $statusFilter = 'all';
    public $staffFilter = 'all';
    public $searchQuery = '';

    // Modal state for creating new appointment
    public $showCreateModal = false;
    public $clientId = '';
    public $newClientName = '';
    public $newClientPhone = '';
    public $newClientEmail = '';
    public $isNewClient = false;

    public $serviceId = '';
    public $staffMemberId = '';
    public $appointmentDate = '';
    public $startTime = '10:00';
    public $notes = '';
    public $discount = 0;

    public function mount()
    {
        $this->selectedDate = Carbon::today()->format('Y-m-d');
        $this->appointmentDate = Carbon::today()->format('Y-m-d');
    }

    public function openCreateModal()
    {
        $this->resetValidation();
        $this->showCreateModal = true;
        $this->appointmentDate = $this->selectedDate;
        
        $salon = $this->getActiveSalon();
        $firstService = Service::where('salon_id', $salon->id)->where('is_active', true)->first();
        if ($firstService) {
            $this->serviceId = $firstService->id;
        }

        $firstStaff = StaffMember::where('salon_id', $salon->id)->where('is_active', true)->first();
        if ($firstStaff) {
            $this->staffMemberId = $firstStaff->id;
        }
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function updateStatus($appointmentId, $newStatus)
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

    public function saveAppointment()
    {
        $salon = $this->getActiveSalon();

        $this->validate([
            'serviceId' => 'required|exists:services,id',
            'staffMemberId' => 'required|exists:staff_members,id',
            'appointmentDate' => 'required|date',
            'startTime' => 'required',
        ]);

        // Client handling
        if ($this->isNewClient) {
            $this->validate([
                'newClientName' => 'required|string|min:2',
                'newClientPhone' => 'required',
            ]);

            $client = Client::create([
                'salon_id' => $salon->id,
                'name' => $this->newClientName,
                'phone' => $this->newClientPhone,
                'email' => $this->newClientEmail ?: null,
            ]);
            $resolvedClientId = $client->id;
        } else {
            $this->validate([
                'clientId' => 'required|exists:clients,id',
            ]);
            $resolvedClientId = $this->clientId;
        }

        $service = Service::findOrFail($this->serviceId);

        // Calculate end time
        $startCarbon = Carbon::createFromFormat('H:i', $this->startTime);
        $endCarbon = (clone $startCarbon)->addMinutes($service->duration_minutes);
        $endTime = $endCarbon->format('H:i');

        $price = $service->price;
        $discount = floatval($this->discount);
        $finalPrice = max(0, $price - $discount);

        Appointment::create([
            'salon_id' => $salon->id,
            'client_id' => $resolvedClientId,
            'staff_member_id' => $this->staffMemberId,
            'service_id' => $this->serviceId,
            'appointment_date' => $this->appointmentDate,
            'start_time' => $this->startTime,
            'end_time' => $endTime,
            'status' => 'confirmed',
            'price' => $price,
            'discount' => $discount,
            'final_price' => $finalPrice,
            'payment_status' => 'unpaid',
            'notes' => $this->notes,
            'booking_source' => 'internal',
        ]);

        $this->showCreateModal = false;
        $this->reset(['newClientName', 'newClientPhone', 'newClientEmail', 'notes', 'discount', 'isNewClient']);
        
        session()->flash('success', 'Appointment successfully scheduled!');
    }

    public function deleteAppointment($appointmentId)
    {
        $salon = $this->getActiveSalon();
        $appointment = Appointment::where('salon_id', $salon->id)->find($appointmentId);

        if ($appointment) {
            $appointment->delete();
            session()->flash('success', 'Appointment cancelled and removed.');
        }
    }

    public function render()
    {
        $salon = $this->getActiveSalon();

        $query = Appointment::with(['client', 'staffMember', 'service'])
            ->where('salon_id', $salon->id);

        if ($this->selectedDate) {
            $query->whereDate('appointment_date', $this->selectedDate);
        }

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->staffFilter !== 'all') {
            $query->where('staff_member_id', $this->staffFilter);
        }

        if ($this->searchQuery) {
            $search = '%' . $this->searchQuery . '%';
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('phone', 'like', $search);
            });
        }

        $appointments = $query->orderBy('start_time')->get();

        $clients = Client::where('salon_id', $salon->id)->orderBy('name')->get();
        $services = Service::where('salon_id', $salon->id)->where('is_active', true)->orderBy('name')->get();
        $staffMembers = StaffMember::where('salon_id', $salon->id)->where('is_active', true)->orderBy('name')->get();

        return view('livewire.appointments.appointment-manager', [
            'salon' => $salon,
            'appointments' => $appointments,
            'clients' => $clients,
            'services' => $services,
            'staffMembers' => $staffMembers,
        ])->layout('layouts.app', ['title' => 'Appointments | ' . $salon->name, 'header' => 'Appointments Matrix']);
    }
}
