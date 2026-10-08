<?php

namespace App\Livewire\SaaS;

use App\Models\Salon;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        $salons = Salon::with(['services', 'staffMembers'])->get();

        return view('livewire.saas.landing-page', [
            'salons' => $salons,
        ])->layout('layouts.public', ['title' => 'GlowSuite B2B | Premier Salon & Spa SaaS Platform']);
    }
}
