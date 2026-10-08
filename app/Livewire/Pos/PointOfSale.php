<?php

namespace App\Livewire\Pos;

use App\Models\Category;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Service;
use App\Models\StaffMember;
use App\Traits\WithActiveSalon;
use Livewire\Component;

class PointOfSale extends Component
{
    use WithActiveSalon;

    public $selectedCategoryId = 'all';
    public $searchService = '';

    // Cart items: [ [ 'id' => 1, 'name' => 'Blowout', 'price' => 95.0, 'quantity' => 1 ] ]
    public $cart = [];

    public $clientId = '';
    public $staffMemberId = '';
    public $discountAmount = 0.00;
    public $paymentMethod = 'card';
    public $notes = '';

    // Completed receipt modal
    public $showReceiptModal = false;
    public $completedInvoice = null;

    public function addToCart($serviceId)
    {
        $salon = $this->getActiveSalon();
        $service = Service::where('salon_id', $salon->id)->findOrFail($serviceId);

        foreach ($this->cart as $key => $item) {
            if ($item['service_id'] === $service->id) {
                $this->cart[$key]['quantity'] += 1;
                $this->cart[$key]['total'] = $this->cart[$key]['quantity'] * $this->cart[$key]['price'];
                return;
            }
        }

        $this->cart[] = [
            'service_id' => $service->id,
            'name' => $service->name,
            'price' => (float) $service->price,
            'quantity' => 1,
            'total' => (float) $service->price,
        ];
    }

    public function updateQuantity($index, $change)
    {
        if (isset($this->cart[$index])) {
            $newQty = $this->cart[$index]['quantity'] + $change;
            if ($newQty <= 0) {
                unset($this->cart[$index]);
                $this->cart = array_values($this->cart);
            } else {
                $this->cart[$index]['quantity'] = $newQty;
                $this->cart[$index]['total'] = $newQty * $this->cart[$index]['price'];
            }
        }
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
    }

    public function clearCart()
    {
        $this->cart = [];
        $this->discountAmount = 0.00;
        $this->notes = '';
    }

    public function getSubtotalProperty()
    {
        return array_sum(array_column($this->cart, 'total'));
    }

    public function getTaxAmountProperty()
    {
        $salon = $this->getActiveSalon();
        $taxable = max(0, $this->subtotal - floatval($this->discountAmount));
        return round($taxable * ($salon->tax_percentage / 100), 2);
    }

    public function getTotalAmountProperty()
    {
        $taxable = max(0, $this->subtotal - floatval($this->discountAmount));
        return round($taxable + $this->taxAmount, 2);
    }

    public function processCheckout()
    {
        $salon = $this->getActiveSalon();

        if (empty($this->cart)) {
            session()->flash('error', 'Please add at least one treatment or service to the ticket.');
            return;
        }

        $invoiceNumber = 'INV-' . strtoupper(substr($salon->slug, 0, 3)) . '-' . date('Ymd') . '-' . rand(100, 999);

        $invoice = Invoice::create([
            'salon_id' => $salon->id,
            'invoice_number' => $invoiceNumber,
            'client_id' => $this->clientId ?: null,
            'appointment_id' => null,
            'subtotal' => $this->subtotal,
            'tax_amount' => $this->taxAmount,
            'discount_amount' => floatval($this->discountAmount),
            'total_amount' => $this->totalAmount,
            'payment_method' => $this->paymentMethod,
            'status' => 'paid',
            'notes' => $this->notes,
        ]);

        foreach ($this->cart as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'service_id' => $item['service_id'],
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'total_price' => $item['total'],
            ]);
        }

        // Update client spent & visits if client attached
        if ($this->clientId) {
            $client = Client::find($this->clientId);
            if ($client) {
                $client->total_spent += $this->totalAmount;
                $client->visits_count += 1;
                $client->loyalty_points += floor($this->totalAmount / 10);
                $client->last_visit_at = now();
                $client->save();
            }
        }

        $this->completedInvoice = $invoice->load(['items', 'client']);
        $this->showReceiptModal = true;
        $this->clearCart();
    }

    public function render()
    {
        $salon = $this->getActiveSalon();

        $categories = Category::where('salon_id', $salon->id)->get();
        $clients = Client::where('salon_id', $salon->id)->orderBy('name')->get();
        $staffMembers = StaffMember::where('salon_id', $salon->id)->where('is_active', true)->orderBy('name')->get();

        $query = Service::where('salon_id', $salon->id)->where('is_active', true);

        if ($this->selectedCategoryId !== 'all') {
            $query->where('category_id', $this->selectedCategoryId);
        }

        if ($this->searchService) {
            $query->where('name', 'like', '%' . $this->searchService . '%');
        }

        $services = $query->orderBy('name')->get();

        return view('livewire.pos.point-of-sale', [
            'salon' => $salon,
            'categories' => $categories,
            'clients' => $clients,
            'staffMembers' => $staffMembers,
            'services' => $services,
        ])->layout('layouts.app', ['title' => 'POS Register | ' . $salon->name, 'header' => 'Point of Sale (POS) Checkout']);
    }
}
