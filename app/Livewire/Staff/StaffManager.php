<?php

namespace App\Livewire\Staff;

use App\Models\StaffMember;
use App\Traits\WithActiveSalon;
use Livewire\Component;

class StaffManager extends Component
{
    use WithActiveSalon;

    public $showStaffModal = false;
    public $editingStaffId = null;

    public $name = '';
    public $title = 'Senior Stylist';
    public $email = '';
    public $phone = '';
    public $bio = '';
    public $avatarUrl = '';
    public $commissionRate = 15;
    public $rating = 5.0;
    public $isActive = true;

    public function openNewStaffModal()
    {
        $this->resetValidation();
        $this->reset(['editingStaffId', 'name', 'email', 'phone', 'bio', 'avatarUrl']);
        $this->title = 'Master Stylist';
        $this->commissionRate = 15;
        $this->rating = 5.0;
        $this->isActive = true;
        $this->showStaffModal = true;
    }

    public function editStaff($id)
    {
        $salon = $this->getActiveSalon();
        $staff = StaffMember::where('salon_id', $salon->id)->findOrFail($id);

        $this->editingStaffId = $staff->id;
        $this->name = $staff->name;
        $this->title = $staff->title;
        $this->email = $staff->email;
        $this->phone = $staff->phone;
        $this->bio = $staff->bio;
        $this->avatarUrl = $staff->avatar_url;
        $this->commissionRate = $staff->commission_rate;
        $this->rating = $staff->rating;
        $this->isActive = (bool) $staff->is_active;

        $this->showStaffModal = true;
    }

    public function saveStaff()
    {
        $salon = $this->getActiveSalon();

        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'commissionRate' => 'required|numeric|min:0|max:100',
        ]);

        $defaultAvatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80';

        if ($this->editingStaffId) {
            $staff = StaffMember::where('salon_id', $salon->id)->findOrFail($this->editingStaffId);
            $staff->update([
                'name' => $this->name,
                'title' => $this->title,
                'email' => $this->email,
                'phone' => $this->phone,
                'bio' => $this->bio,
                'avatar_url' => $this->avatarUrl ?: $defaultAvatar,
                'commission_rate' => $this->commissionRate,
                'rating' => $this->rating,
                'is_active' => $this->isActive,
            ]);
            session()->flash('success', 'Stylist details updated.');
        } else {
            StaffMember::create([
                'salon_id' => $salon->id,
                'name' => $this->name,
                'title' => $this->title,
                'email' => $this->email,
                'phone' => $this->phone,
                'bio' => $this->bio,
                'avatar_url' => $this->avatarUrl ?: $defaultAvatar,
                'commission_rate' => $this->commissionRate,
                'rating' => $this->rating,
                'working_days' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                'is_active' => $this->isActive,
            ]);
            session()->flash('success', 'New stylist added to team.');
        }

        $this->showStaffModal = false;
    }

    public function toggleActive($id)
    {
        $salon = $this->getActiveSalon();
        $staff = StaffMember::where('salon_id', $salon->id)->find($id);
        if ($staff) {
            $staff->is_active = !$staff->is_active;
            $staff->save();
        }
    }

    public function deleteStaff($id)
    {
        $salon = $this->getActiveSalon();
        $staff = StaffMember::where('salon_id', $salon->id)->find($id);
        if ($staff) {
            $staff->delete();
            session()->flash('success', 'Stylist removed from salon roster.');
        }
    }

    public function render()
    {
        $salon = $this->getActiveSalon();
        $staffMembers = StaffMember::where('salon_id', $salon->id)
            ->withCount('appointments')
            ->orderBy('name')
            ->get();

        return view('livewire.staff.staff-manager', [
            'salon' => $salon,
            'staffMembers' => $staffMembers,
        ])->layout('layouts.app', ['title' => 'Artistic Staff | ' . $salon->name, 'header' => 'Stylists & Artistic Team']);
    }
}
