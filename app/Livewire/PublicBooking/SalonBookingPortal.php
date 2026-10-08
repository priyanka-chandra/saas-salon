<?php

namespace App\Livewire\PublicBooking;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Salon;
use App\Models\Service;
use App\Models\StaffMember;
use Carbon\Carbon;
use Livewire\Component;

class SalonBookingPortal extends Component
{
    public Salon $salon;
    public $slug;

    // Multi-step booking state
    public $step = 1; // 1: Select Service, 2: Select Stylist, 3: Select Date & Time, 4: Client Info, 5: Confirmed

    public $selectedCategoryId = 'all';
    public $selectedServiceId = null;
    public $selectedStaffId = null;
    public $selectedDate = '';
    public $selectedTime = '';

    public $clientName = '';
    public $clientPhone = '';
    public $clientEmail = '';
    public $clientNotes = '';

    public $confirmedAppointment = null;

    public function mount($slug)
    {
        $this->salon = Salon::where('slug', $slug)->firstOrFail();
        $this->selectedDate = Carbon::tomorrow()->format('Y-m-d');
    }

    public function selectService($serviceId)
    {
        $this->selectedServiceId = $serviceId;
        $this->step = 2;
    }

    public function selectStaff($staffId)
    {
        $this->selectedStaffId = $staffId;
        $this->step = 3;
    }

    public function selectDateTime($time)
    {
        $this->selectedTime = $time;
        $this->step = 4;
    }

    public function submitBooking()
    {
        $this->validate([
            'clientName' => 'required|string|min:2',
            'clientPhone' => 'required|string|min:7',
            'clientEmail' => 'nullable|email',
            'selectedServiceId' => 'required|exists:services,id',
            'selectedDate' => 'required|date',
            'selectedTime' => 'required',
        ]);

        // Find or create client
        $client = Client::firstOrCreate(
            ['salon_id' => $this->salon->id, 'phone' => $this->clientPhone],
            ['name' => $this->clientName, 'email' => $this->clientEmail, 'notes' => $this->clientNotes]
        );

        $service = Service::findOrFail($this->selectedServiceId);

        // Calculate end time
        $startCarbon = Carbon::createFromFormat('H:i', $this->selectedTime);
        $endCarbon = (clone $startCarbon)->addMinutes($service->duration_minutes);
        $endTime = $endCarbon->format('H:i');

        // Resolve staff member if "any" was selected
        $staffId = $this->selectedStaffId;
        if (!$staffId || $staffId === 'any') {
            $staff = StaffMember::where('salon_id', $this->salon->id)->where('is_active', true)->first();
            $staffId = $staff ? $staff->id : 1;
        }

        $appointment = Appointment::create([
            'salon_id' => $this->salon->id,
            'client_id' => $client->id,
            'staff_member_id' => $staffId,
            'service_id' => $service->id,
            'appointment_date' => $this->selectedDate,
            'start_time' => $this->selectedTime,
            'end_time' => $endTime,
            'status' => 'confirmed',
            'price' => $service->price,
            'discount' => 0.00,
            'final_price' => $service->price,
            'payment_status' => 'unpaid',
            'notes' => $this->clientNotes,
            'booking_source' => 'portal',
        ]);

        $this->confirmedAppointment = $appointment->load(['service', 'staffMember', 'client']);
        $this->step = 5;
    }

    public function resetBooking()
    {
        $this->step = 1;
        $this->selectedServiceId = null;
        $this->selectedStaffId = null;
        $this->selectedTime = '';
        $this->clientName = '';
        $this->clientPhone = '';
        $this->clientEmail = '';
        $this->clientNotes = '';
        $this->confirmedAppointment = null;
    }

    public function render()
    {
        $categories = Category::where('salon_id', $this->salon->id)->get();

        $query = Service::where('salon_id', $this->salon->id)->where('is_active', true);
        if ($this->selectedCategoryId !== 'all') {
            $query->where('category_id', $this->selectedCategoryId);
        }
        $services = $query->orderBy('name')->get();

        $staffMembers = StaffMember::where('salon_id', $this->salon->id)->where('is_active', true)->get();

        $selectedService = $this->selectedServiceId ? Service::find($this->selectedServiceId) : null;
        $selectedStaff = ($this->selectedStaffId && $this->selectedStaffId !== 'any') ? StaffMember::find($this->selectedStaffId) : null;

        // Sample time slots
        $timeSlots = [
            '10:00', '11:00', '12:00', '13:30', '14:30', '15:30', '16:30', '17:30', '18:30'
        ];

        return view('livewire.public-booking.salon-booking-portal', [
            'categories' => $categories,
            'services' => $services,
            'staffMembers' => $staffMembers,
            'selectedService' => $selectedService,
            'selectedStaff' => $selectedStaff,
            'timeSlots' => $timeSlots,
        ])->layout('layouts.public', ['title' => 'Book Appointment | ' . $this->salon->name]);
    }
}
