<?php

namespace App\Traits;

use App\Models\Salon;
use Illuminate\Support\Facades\Auth;

trait WithActiveSalon
{
    public function getActiveSalon(): Salon
    {
        $salonId = session('active_salon_id');

        if ($salonId) {
            $salon = Salon::find($salonId);
            if ($salon) {
                return $salon;
            }
        }

        if (Auth::check() && Auth::user()->salon_id) {
            $salon = Salon::find(Auth::user()->salon_id);
            if ($salon) {
                session(['active_salon_id' => $salon->id]);
                return $salon;
            }
        }

        $defaultSalon = Salon::first();
        if (!$defaultSalon) {
            $defaultSalon = Salon::create([
                'name' => 'Demo Salon',
                'slug' => 'demo-salon',
                'currency' => '$',
            ]);
        }

        session(['active_salon_id' => $defaultSalon->id]);
        return $defaultSalon;
    }
}
