<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Salon;
use App\Models\Service;
use App\Models\StaffMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin
        $superAdmin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@glowsuite.io',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'phone' => '+1 (555) 019-2831',
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
        ]);

        // 2. Create Tenant Salon 1: Luxe & Co.
        $luxeSalon = Salon::create([
            'name' => 'Luxe & Co. Hair & Beauty Lounge',
            'slug' => 'luxe-and-co',
            'tagline' => 'Haute Coiffure & Luxury Aesthetic Lounge',
            'email' => 'contact@luxesalon.com',
            'phone' => '+1 (310) 849-2041',
            'address' => '450 N Rodeo Drive, Suite 200',
            'city' => 'Beverly Hills, CA',
            'currency' => '$',
            'tax_percentage' => 8.50,
            'subscription_plan' => 'enterprise',
            'subscription_status' => 'active',
            'trial_ends_at' => null,
            'primary_color' => '#D48166',
            'accent_color' => '#1E293B',
            'opening_time' => '09:00',
            'closing_time' => '20:00',
        ]);

        // Owner of Salon 1
        $luxeOwner = User::create([
            'salon_id' => $luxeSalon->id,
            'name' => 'Genevieve Laurent',
            'email' => 'owner@luxe.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '+1 (310) 849-2040',
            'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&auto=format&fit=crop&q=80',
        ]);

        // 3. Create Tenant Salon 2: Velvet Aura Spa & Wellness
        $velvetSalon = Salon::create([
            'name' => 'Velvet Aura Spa & Wellness',
            'slug' => 'velvet-aura',
            'tagline' => 'Holistic Rituals, Skin Radiance & Medi-Spa',
            'email' => 'hello@velvetaura.com',
            'phone' => '+1 (212) 555-0188',
            'address' => '740 Madison Ave, 4th Floor',
            'city' => 'New York, NY',
            'currency' => '$',
            'tax_percentage' => 8.875,
            'subscription_plan' => 'growth',
            'subscription_status' => 'active',
            'trial_ends_at' => null,
            'primary_color' => '#059669',
            'accent_color' => '#0F172A',
            'opening_time' => '10:00',
            'closing_time' => '21:00',
        ]);

        User::create([
            'salon_id' => $velvetSalon->id,
            'name' => 'Elena Rostova',
            'email' => 'owner@velvet.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '+1 (212) 555-0189',
            'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
        ]);

        // Seed Luxe Salon categories & services
        $this->seedSalonData($luxeSalon);
        $this->seedSalonData($velvetSalon);
    }

    private function seedSalonData(Salon $salon): void
    {
        // Categories
        $catHair = Category::create([
            'salon_id' => $salon->id,
            'name' => 'Hair Styling & Cuts',
            'slug' => 'hair-styling-' . $salon->id,
            'description' => 'Precision haircuts, blowouts, and runway styling',
            'icon' => 'scissors',
            'color' => '#D48166',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $catColor = Category::create([
            'salon_id' => $salon->id,
            'name' => 'Color & Balayage',
            'slug' => 'color-balayage-' . $salon->id,
            'description' => 'Master color melting, foil balayage, and gloss',
            'icon' => 'palette',
            'color' => '#C4704F',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $catSkin = Category::create([
            'salon_id' => $salon->id,
            'name' => 'Facials & Skin Radiance',
            'slug' => 'facials-skin-' . $salon->id,
            'description' => 'Hydra-dermabrasion, lymphatic drainage, and lifting',
            'icon' => 'sparkles',
            'color' => '#E0A96D',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $catNails = Category::create([
            'salon_id' => $salon->id,
            'name' => 'Nail Couture',
            'slug' => 'nail-couture-' . $salon->id,
            'description' => 'Russian manicure, gel extensions, and organic spa pedicure',
            'icon' => 'heart',
            'color' => '#F472B6',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Services
        $s1 = Service::create([
            'salon_id' => $salon->id,
            'category_id' => $catHair->id,
            'name' => 'Signature Haute Blowout & Gloss',
            'description' => 'Scalp detox wash, nourishing caviar mask, and signature voluminous blowout.',
            'price' => 95.00,
            'duration_minutes' => 45,
            'buffer_time_minutes' => 10,
            'is_popular' => true,
            'is_active' => true,
        ]);

        $s2 = Service::create([
            'salon_id' => $salon->id,
            'category_id' => $catHair->id,
            'name' => 'Couture Precision Haircut',
            'description' => 'Bespoke consult, tailored precision architectural cut, styling finish.',
            'price' => 140.00,
            'duration_minutes' => 60,
            'buffer_time_minutes' => 15,
            'is_popular' => true,
            'is_active' => true,
        ]);

        $s3 = Service::create([
            'salon_id' => $salon->id,
            'category_id' => $catColor->id,
            'name' => 'French Dimensional Balayage',
            'description' => 'Hand-painted sun-kissed gradients, bond protector, and custom tonal gloss.',
            'price' => 280.00,
            'duration_minutes' => 150,
            'buffer_time_minutes' => 20,
            'is_popular' => true,
            'is_active' => true,
        ]);

        $s4 = Service::create([
            'salon_id' => $salon->id,
            'category_id' => $catColor->id,
            'name' => 'Full Platinum Blonding & Toner',
            'description' => 'Double-process root to tip illumination with moisture repair infusion.',
            'price' => 320.00,
            'duration_minutes' => 180,
            'buffer_time_minutes' => 20,
            'is_popular' => false,
            'is_active' => true,
        ]);

        $s5 = Service::create([
            'salon_id' => $salon->id,
            'category_id' => $catSkin->id,
            'name' => '24K Gold Cellular Renewal Facial',
            'description' => 'Pure gold leaf infusion, microcurrent contouring, and cold cryo therapy.',
            'price' => 210.00,
            'duration_minutes' => 75,
            'buffer_time_minutes' => 15,
            'is_popular' => true,
            'is_active' => true,
        ]);

        $s6 = Service::create([
            'salon_id' => $salon->id,
            'category_id' => $catNails->id,
            'name' => 'Diamond Gel Manicure & Hand Spa',
            'description' => 'Exfoliating botanical scrub, precision cuticle care, and chip-free gel finish.',
            'price' => 85.00,
            'duration_minutes' => 50,
            'buffer_time_minutes' => 10,
            'is_popular' => false,
            'is_active' => true,
        ]);

        // Stylists
        $staff1 = StaffMember::create([
            'salon_id' => $salon->id,
            'name' => 'Camille Dubois',
            'title' => 'Artistic Creative Director & Master Stylist',
            'email' => 'camille@' . $salon->slug . '.com',
            'phone' => '+1 (310) 555-0121',
            'bio' => 'Paris Fashion Week veteran with 12 years expertise in architectural cutting and effortless French texture.',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80',
            'commission_rate' => 20.00,
            'rating' => 4.98,
            'working_days' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            'is_active' => true,
        ]);

        $staff2 = StaffMember::create([
            'salon_id' => $salon->id,
            'name' => 'Julian Vance',
            'title' => 'Master Colorist & Blonde Specialist',
            'email' => 'julian@' . $salon->slug . '.com',
            'phone' => '+1 (310) 555-0122',
            'bio' => 'Award-winning color innovator recognized for multi-dimensional honey balayage and corrective blonding.',
            'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80',
            'commission_rate' => 18.00,
            'rating' => 4.95,
            'working_days' => ['Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            'is_active' => true,
        ]);

        $staff3 = StaffMember::create([
            'salon_id' => $salon->id,
            'name' => 'Aria Thorne',
            'title' => 'Lead Esthetician & Skin Alchemist',
            'email' => 'aria@' . $salon->slug . '.com',
            'phone' => '+1 (310) 555-0123',
            'bio' => 'Certified holistic medical esthetician blending European facial massage with modern dermal technology.',
            'avatar_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=200&auto=format&fit=crop&q=80',
            'commission_rate' => 15.00,
            'rating' => 4.99,
            'working_days' => ['Mon', 'Wed', 'Thu', 'Fri', 'Sun'],
            'is_active' => true,
        ]);

        // CRM Clients
        $client1 = Client::create([
            'salon_id' => $salon->id,
            'name' => 'Victoria Sterling',
            'email' => 'victoria.sterling@gmail.com',
            'phone' => '+1 (310) 777-9812',
            'gender' => 'female',
            'birth_date' => '1992-06-14',
            'notes' => 'Prefers chilled sparkling water with lime. Sensitive scalp, uses sulfate-free shampoo only.',
            'loyalty_points' => 380,
            'vip_status' => true,
            'total_spent' => 2450.00,
            'visits_count' => 12,
            'last_visit_at' => Carbon::now()->subDays(12),
        ]);

        $client2 = Client::create([
            'salon_id' => $salon->id,
            'name' => 'Sophia Montgomery',
            'email' => 'sophia.m@outlook.com',
            'phone' => '+1 (310) 888-4321',
            'gender' => 'female',
            'birth_date' => '1995-11-03',
            'notes' => 'Loves warm espresso tones for autumn balayage. Very punctual.',
            'loyalty_points' => 150,
            'vip_status' => false,
            'total_spent' => 840.00,
            'visits_count' => 4,
            'last_visit_at' => Carbon::now()->subDays(20),
        ]);

        $client3 = Client::create([
            'salon_id' => $salon->id,
            'name' => 'Marcus Holloway',
            'email' => 'm.holloway@techcorp.io',
            'phone' => '+1 (310) 999-1122',
            'gender' => 'male',
            'birth_date' => '1988-03-22',
            'notes' => 'Regular executive haircut every 3 weeks. Prefers mint scalp tonic.',
            'loyalty_points' => 90,
            'vip_status' => false,
            'total_spent' => 420.00,
            'visits_count' => 3,
            'last_visit_at' => Carbon::now()->subDays(18),
        ]);

        $client4 = Client::create([
            'salon_id' => $salon->id,
            'name' => 'Isabella De Luca',
            'email' => 'isabella.deluca@fashionhub.com',
            'phone' => '+1 (310) 654-7890',
            'gender' => 'female',
            'birth_date' => '1990-08-19',
            'notes' => 'VIP client. Model and influencer, requests high-gloss finish for photoshoot events.',
            'loyalty_points' => 520,
            'vip_status' => true,
            'total_spent' => 3890.00,
            'visits_count' => 18,
            'last_visit_at' => Carbon::now()->subDays(5),
        ]);

        // Appointments Today and Upcoming
        $today = Carbon::today()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $appt1 = Appointment::create([
            'salon_id' => $salon->id,
            'client_id' => $client1->id,
            'staff_member_id' => $staff1->id,
            'service_id' => $s2->id,
            'appointment_date' => $today,
            'start_time' => '10:00',
            'end_time' => '11:00',
            'status' => 'confirmed',
            'price' => $s2->price,
            'discount' => 0.00,
            'final_price' => $s2->price,
            'payment_status' => 'paid',
            'notes' => 'Texture trim and botanical hair bath',
            'booking_source' => 'portal',
        ]);

        $appt2 = Appointment::create([
            'salon_id' => $salon->id,
            'client_id' => $client2->id,
            'staff_member_id' => $staff2->id,
            'service_id' => $s3->id,
            'appointment_date' => $today,
            'start_time' => '11:30',
            'end_time' => '14:00',
            'status' => 'in_progress',
            'price' => $s3->price,
            'discount' => 20.00,
            'final_price' => $s3->price - 20.00,
            'payment_status' => 'unpaid',
            'notes' => 'Autumn dimensional hand-paint balayage',
            'booking_source' => 'internal',
        ]);

        $appt3 = Appointment::create([
            'salon_id' => $salon->id,
            'client_id' => $client4->id,
            'staff_member_id' => $staff3->id,
            'service_id' => $s5->id,
            'appointment_date' => $today,
            'start_time' => '15:00',
            'end_time' => '16:15',
            'status' => 'confirmed',
            'price' => $s5->price,
            'discount' => 0.00,
            'final_price' => $s5->price,
            'payment_status' => 'unpaid',
            'notes' => 'Pre-gala 24K gold facial ritual',
            'booking_source' => 'portal',
        ]);

        $appt4 = Appointment::create([
            'salon_id' => $salon->id,
            'client_id' => $client3->id,
            'staff_member_id' => $staff1->id,
            'service_id' => $s1->id,
            'appointment_date' => $tomorrow,
            'start_time' => '14:00',
            'end_time' => '14:45',
            'status' => 'confirmed',
            'price' => $s1->price,
            'discount' => 0.00,
            'final_price' => $s1->price,
            'payment_status' => 'unpaid',
            'notes' => 'Executive wash and styling',
            'booking_source' => 'phone',
        ]);

        // Invoice for Appt 1
        $tax = round($s2->price * ($salon->tax_percentage / 100), 2);
        $total = $s2->price + $tax;

        $invoice = Invoice::create([
            'salon_id' => $salon->id,
            'invoice_number' => 'INV-' . strtoupper(substr($salon->slug, 0, 3)) . '-' . date('Y') . '-001',
            'client_id' => $client1->id,
            'appointment_id' => $appt1->id,
            'subtotal' => $s2->price,
            'tax_amount' => $tax,
            'discount_amount' => 0.00,
            'total_amount' => $total,
            'payment_method' => 'card',
            'status' => 'paid',
            'notes' => 'Paid via Apple Pay terminal #1',
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice->id,
            'service_id' => $s2->id,
            'item_name' => $s2->name,
            'quantity' => 1,
            'unit_price' => $s2->price,
            'total_price' => $s2->price,
        ]);
    }
}
