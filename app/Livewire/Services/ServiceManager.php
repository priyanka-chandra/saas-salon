<?php

namespace App\Livewire\Services;

use App\Models\Category;
use App\Models\Service;
use App\Traits\WithActiveSalon;
use Illuminate\Support\Str;
use Livewire\Component;

class ServiceManager extends Component
{
    use WithActiveSalon;

    public $activeCategoryId = 'all';
    public $search = '';

    // Modal state for Service
    public $showServiceModal = false;
    public $editingServiceId = null;
    public $name = '';
    public $categoryId = '';
    public $price = '';
    public $durationMinutes = 45;
    public $bufferTimeMinutes = 5;
    public $description = '';
    public $isPopular = false;
    public $isActive = true;

    // Category modal
    public $showCategoryModal = false;
    public $newCategoryName = '';
    public $newCategoryDescription = '';

    public function openNewServiceModal()
    {
        $this->resetValidation();
        $this->reset(['editingServiceId', 'name', 'price', 'description', 'isPopular', 'isActive']);
        $this->durationMinutes = 45;
        $this->bufferTimeMinutes = 5;
        $this->isActive = true;

        $salon = $this->getActiveSalon();
        $firstCat = Category::where('salon_id', $salon->id)->first();
        if ($firstCat) {
            $this->categoryId = $firstCat->id;
        }

        $this->showServiceModal = true;
    }

    public function editService($id)
    {
        $salon = $this->getActiveSalon();
        $service = Service::where('salon_id', $salon->id)->findOrFail($id);

        $this->editingServiceId = $service->id;
        $this->name = $service->name;
        $this->categoryId = $service->category_id;
        $this->price = $service->price;
        $this->durationMinutes = $service->duration_minutes;
        $this->bufferTimeMinutes = $service->buffer_time_minutes;
        $this->description = $service->description;
        $this->isPopular = (bool) $service->is_popular;
        $this->isActive = (bool) $service->is_active;

        $this->showServiceModal = true;
    }

    public function saveService()
    {
        $salon = $this->getActiveSalon();

        $this->validate([
            'name' => 'required|string|max:255',
            'categoryId' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'durationMinutes' => 'required|integer|min:5',
        ]);

        if ($this->editingServiceId) {
            $service = Service::where('salon_id', $salon->id)->findOrFail($this->editingServiceId);
            $service->update([
                'name' => $this->name,
                'category_id' => $this->categoryId,
                'price' => $this->price,
                'duration_minutes' => $this->durationMinutes,
                'buffer_time_minutes' => $this->bufferTimeMinutes,
                'description' => $this->description,
                'is_popular' => $this->isPopular,
                'is_active' => $this->isActive,
            ]);
            session()->flash('success', 'Service updated successfully.');
        } else {
            Service::create([
                'salon_id' => $salon->id,
                'category_id' => $this->categoryId,
                'name' => $this->name,
                'price' => $this->price,
                'duration_minutes' => $this->durationMinutes,
                'buffer_time_minutes' => $this->bufferTimeMinutes,
                'description' => $this->description,
                'is_popular' => $this->isPopular,
                'is_active' => $this->isActive,
            ]);
            session()->flash('success', 'New service added to catalog.');
        }

        $this->showServiceModal = false;
    }

    public function toggleActive($id)
    {
        $salon = $this->getActiveSalon();
        $service = Service::where('salon_id', $salon->id)->find($id);
        if ($service) {
            $service->is_active = !$service->is_active;
            $service->save();
        }
    }

    public function togglePopular($id)
    {
        $salon = $this->getActiveSalon();
        $service = Service::where('salon_id', $salon->id)->find($id);
        if ($service) {
            $service->is_popular = !$service->is_popular;
            $service->save();
        }
    }

    public function deleteService($id)
    {
        $salon = $this->getActiveSalon();
        $service = Service::where('salon_id', $salon->id)->find($id);
        if ($service) {
            $service->delete();
            session()->flash('success', 'Service removed from catalog.');
        }
    }

    public function saveCategory()
    {
        $salon = $this->getActiveSalon();

        $this->validate([
            'newCategoryName' => 'required|string|max:255',
        ]);

        Category::create([
            'salon_id' => $salon->id,
            'name' => $this->newCategoryName,
            'slug' => Str::slug($this->newCategoryName) . '-' . uniqid(),
            'description' => $this->newCategoryDescription,
            'color' => '#D48166',
        ]);

        $this->showCategoryModal = false;
        $this->reset(['newCategoryName', 'newCategoryDescription']);
        session()->flash('success', 'Service category created.');
    }

    public function render()
    {
        $salon = $this->getActiveSalon();

        $categories = Category::where('salon_id', $salon->id)->withCount('services')->get();

        $query = Service::where('salon_id', $salon->id)->with('category');

        if ($this->activeCategoryId !== 'all') {
            $query->where('category_id', $this->activeCategoryId);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $services = $query->orderBy('name')->get();

        return view('livewire.services.service-manager', [
            'salon' => $salon,
            'categories' => $categories,
            'services' => $services,
        ])->layout('layouts.app', ['title' => 'Services Catalog | ' . $salon->name, 'header' => 'Services & Treatments Catalog']);
    }
}
