<?php

namespace App\Http\Livewire\CoAdmin;

use App\Exports\DogExport;
use App\Models\Dogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CoAdminManageDogs extends Component
{
    public $allDogs;
    public $count;
    public $readyToLoad = false;
    public $listeners  = ['delete'];


    public function mount(){
        $this->allDogs = Dogs::with('barangay')
            ->where('barangay_id', Auth::user()->barangay_id)
            ->get();

        $this->count = $this->allDogs->count();
    }

    public function dogs(){
        $this->readyToLoad = true;
    }

    public function render(){
        return view('livewire.co-admin.co-admin-manage-dogs');
    }

    public function confirmDelete($id){
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function delete($id)
    {
        $dog = Dogs::find($id)->first();

        $path = "/storage/";
        if ($dog->dog_image != null) {
            $filename = $dog->dog_image;
            if (\File::exists(public_path($path . $filename))) {
                \File::delete(public_path($path . $filename));
            }
            $dog->delete();
        }

        $dog->delete();

        $this->dispatchBrowserEvent('toastr:info', [
            'type' => 'info',
            'message' => 'Dog deleted successfully',
        ]);

        $this->mount();

    }

    public function getAllDogs(){
        $id = $this->allDogs->pluck('barangay_id');
        return $id->all();
    }

    public function export(){
        try {
            if($this->allDogs->isNotEmpty()) {
                return Excel::download(new DogExport($this->getAllDogs()), 'All-Dogs.xlsx');
            }
        }catch (\Exception $e){
            Log::info($e);
        }
    }

}
