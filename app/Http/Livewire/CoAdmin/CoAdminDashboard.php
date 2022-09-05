<?php

namespace App\Http\Livewire\CoAdmin;

use App\Models\Dogs;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CoAdminDashboard extends Component
{
    public $dogCount, $recentlyAdded;
    public $readyToLoad = false;
    public function loadDogs(){
        $this->readyToLoad = true;
    }

    public function mount(){
        $this->dogCount = Dogs::where('barangay_id', Auth::user()->barangay_id)->count();

        $this->recentlyAdded = Dogs::with('barangay')
            ->where('barangay_id', Auth::user()->barangay_id)
            ->latest()
            ->limit(3)
            ->get();
    }


    public function render()
    {
        return view('livewire.co-admin.co-admin-dashboard');
    }
}
