<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use App\Traits\WithActiveSalon;
use Livewire\Component;

class ClientManager extends Component
{
    use WithActiveSalon;

    public $search = '';
    public $vipFilter = 'all';

    // Modal state for Add/Edit
    public $showClientModal = false;
    public $editingClientId = null;
    public $name = '';
    public $phone = '';
    public $email = '';
    public $gender = 'female';
    public $birthDate = '';
    public $notes = '';
    public $loyaltyPoints = 50;
    public $vipStatus = false;

    // View history modal
    public $selectedClient = null;
    public $showHistoryModal = false;

    public function openNewClientModal()
    {
        $this->resetValidation();
        $this->reset(['editingClientId', 'name', 'phone', 'email', 'birthDate', 'notes']);
        $this->gender = 'female';
        $this->loyaltyPoints = 50;
        $this->vipStatus = false;
        $this->showClientModal = true;
    }

    public function editClient($id)
    {
        $salon = $this->getActiveSalon();
        $client = Client::where('salon_id', $salon->id)->findOrFail($id);

        $this->editingClientId = $client->id;
        $this->name = $client->name;
        $this->phone = $client->phone;
        $this->email = $client->email;
        $this->gender = $client->gender ?: 'female';
        $this->birthDate = $client->birth_date ? $client->birth_date->format('Y-m-d') : '';
        $this->notes = $client->notes;
        $this->loyaltyPoints = $client->loyalty_points;
        $this->vipStatus = (bool) $client->vip_status;

        $this->showClientModal = true;
    }

    public function viewHistory($id)
    {
        $salon = $this->getActiveSalon();
        $this->selectedClient = Client::with(['appointments.service', 'appointments.staffMember', 'invoices'])
            ->where('salon_id', $salon->id)
            ->findOrFail($id);

        $this->showHistoryModal = true;
    }

    public function saveClient()
    {
        $salon = $this->getActiveSalon();

        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        if ($this->editingClientId) {
            $client = Client::where('salon_id', $salon->id)->findOrFail($this->editingClientId);
            $client->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'gender' => $this->gender,
                'birth_date' => $this->birthDate ?: null,
                'notes' => $this->notes,
                'loyalty_points' => $this->loyaltyPoints,
                'vip_status' => $this->vipStatus,
            ]);
            session()->flash('success', 'Client profile updated.');
        } else {
            Client::create([
                'salon_id' => $salon->id,
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'gender' => $this->gender,
                'birth_date' => $this->birthDate ?: null,
                'notes' => $this->notes,
                'loyalty_points' => $this->loyaltyPoints,
                'vip_status' => $this->vipStatus,
            ]);
            session()->flash('success', 'New client registered.');
        }

        $this->showClientModal = false;
    }

    public function toggleVip($id)
    {
        $salon = $this->getActiveSalon();
        $client = Client::where('salon_id', $salon->id)->find($id);
        if ($client) {
            $client->vip_status = !$client->vip_status;
            $client->save();
        }
    }

    public function deleteClient($id)
    {
        $salon = $this->getActiveSalon();
        $client = Client::where('salon_id', $salon->id)->find($id);
        if ($client) {
            $client->delete();
            session()->flash('success', 'Client removed.');
        }
    }

    public function render()
    {
        $salon = $this->getActiveSalon();

        $query = Client::where('salon_id', $salon->id)->withCount('appointments');

        if ($this->vipFilter === 'vip') {
            $query->where('vip_status', true);
        }

        if ($this->search) {
            $s = '%' . $this->search . '%';
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', $s)
                  ->orWhere('phone', 'like', $s)
                  ->orWhere('email', 'like', $s);
            });
        }

        $clients = $query->orderByDesc('vip_status')->orderBy('name')->get();

        return view('livewire.clients.client-manager', [
            'salon' => $salon,
            'clients' => $clients,
        ])->layout('layouts.app', ['title' => 'Clients CRM | ' . $salon->name, 'header' => 'Client Relationship Management (CRM)']);
    }
}
