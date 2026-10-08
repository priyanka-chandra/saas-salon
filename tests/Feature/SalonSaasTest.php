<?php

namespace Tests\Feature;

use App\Models\Salon;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalonSaasTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_landing_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('GlowSuite');
    }

    public function test_login_page_loads_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Sign In');
    }

    public function test_dashboard_loads_for_authenticated_owner(): void
    {
        $owner = User::where('email', 'owner@luxe.com')->first();
        $response = $this->actingAs($owner)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Luxe & Co.');
    }

    public function test_appointments_page_loads(): void
    {
        $owner = User::where('email', 'owner@luxe.com')->first();
        $response = $this->actingAs($owner)->get('/appointments');
        $response->assertStatus(200);
    }

    public function test_services_catalog_page_loads(): void
    {
        $owner = User::where('email', 'owner@luxe.com')->first();
        $response = $this->actingAs($owner)->get('/services');
        $response->assertStatus(200);
    }

    public function test_pos_register_page_loads(): void
    {
        $owner = User::where('email', 'owner@luxe.com')->first();
        $response = $this->actingAs($owner)->get('/pos');
        $response->assertStatus(200);
    }

    public function test_public_booking_portal_loads(): void
    {
        $salon = Salon::where('slug', 'luxe-and-co')->first();
        $response = $this->get('/book/' . $salon->slug);
        $response->assertStatus(200);
        $response->assertSee($salon->name);
    }
}
