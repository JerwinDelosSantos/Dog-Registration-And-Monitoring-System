<?php

namespace App\Http\Livewire\CoAdmin;

use Illuminate\Support\Facades\Auth;
use App\Models\Dogs;
use Livewire\Component;
use Livewire\WithFileUploads;

class CoAdminCreateDog extends Component
{
    use WithFileUploads;

    public $barangays;
    public $barangay;
    public $purok;
    public $dog_name;
    public $id_number;
    public $dog_image;
    public $origin;
    public $breed;
    public $color;
    public $age;
    public $sex;
    public $sex_description;
    public $vaccines_taken;
    public $owner_name;
    public $contact_number;

    public $dogs;

    protected $rules = [
        'dog_name' => 'required',
        'dog_image' => 'max:2048',
        'origin' => 'required',
        'breed'  => 'required',
        'color' => 'required',
        'age' => 'required|max:255',
        'sex' => 'required',
        'sex_description' => 'required',
        'vaccines_taken' => 'required',
        'owner_name' => 'required',
        'contact_number' => 'required|min:10|max:11',
        'purok' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create(){

        $this->validate();

        $filename = "";
        if ($this->dog_image) {
            $filename = $this->dog_image->store('dog-images', 'public');
        } else {
            $filename = Null;
        }
        Dogs::create([
            'dog_image' => $filename,
            'dog_name' => $this->dog_name,
            'origin' => $this->origin,
            'breed' => $this->breed,
            'color' => $this->color,
            'age' => $this->age,
            'sex' => $this->sex,
            'sex_description' => $this->sex_description,
            'vaccines_taken' => $this->vaccines_taken,
            'owner_name' => $this->owner_name,
            'contact_number' => $this->contact_number,
            'barangay_id' => Auth::user()->barangay->id,
            'purok' => $this->purok,
            'id_number' => strtoupper(substr($this->dog_name, 0, 3)). '-' .substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6)
        ]);

        session()->flash('message', 'Dog record added successfully!');

        return redirect()->route('coAdminDogs.index');
    }

    public function render()
    {
        return view('livewire.co-admin.co-admin-create-dog');
    }

}
