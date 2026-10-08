<?php

namespace App\Livewire\Settings;

use App\Traits\WithActiveSalon;
use Livewire\Component;

class TenantSettings extends Component
{
    use WithActiveSalon;

    public $name;
    public $tagline;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $currency;
    public $taxPercentage;
    public $openingTime;
    public $closingTime;
    public $subscriptionPlan;

    public function mount()
    {
        $salon = $this->getActiveSalon();

        $this->name = $salon->name;
        $this->tagline = $salon->tagline;
        $this->phone = $salon->phone;
        $this->email = $salon->email;
        $this->address = $salon->address;
        $this->city = $salon->city;
        $this->currency = $salon->currency;
        $this->taxPercentage = $salon->tax_percentage;
        $this->openingTime = $salon->opening_time;
        $this->closingTime = $salon->closing_time;
        $this->subscriptionPlan = $salon->subscription_plan;
    }

    public function saveSettings()
    {
        $salon = $this->getActiveSalon();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'currency' => 'required|string|max:10',
            'taxPercentage' => 'required|numeric|min:0|max:50',
        ]);

        $salon->update([
            'name' => $this->name,
            'tagline' => $this->tagline,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'currency' => $this->currency,
            'tax_percentage' => $this->taxPercentage,
            'opening_time' => $this->openingTime,
            'closing_time' => $this->closingTime,
        ]);

        session()->flash('success', 'Salon profile and business configuration saved.');
    }

    public function upgradePlan($newPlan)
    {
        $salon = $this->getActiveSalon();
        $salon->subscription_plan = $newPlan;
        $salon->save();

        $this->subscriptionPlan = $newPlan;
        session()->flash('success', "SaaS plan updated to " . ucfirst($newPlan) . "!");
    }

    public function render()
    {
        $salon = $this->getActiveSalon();

        return view('livewire.settings.tenant-settings', [
            'salon' => $salon,
        ])->layout('layouts.app', ['title' => 'Salon Settings & SaaS | ' . $salon->name, 'header' => 'Salon Profile & SaaS Tier']);
    }
}
