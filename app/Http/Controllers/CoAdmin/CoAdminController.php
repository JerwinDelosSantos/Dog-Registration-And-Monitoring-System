<?php

namespace App\Http\Controllers\CoAdmin;
use App\Http\Controllers\Controller;
use App\Models\Dogs;
use Illuminate\Http\Request;

class CoAdminController extends Controller
{
    public function dashboard(){
        return view('co-admin.co_admin_dashboard');
    }
    public function manageDogs(){
        return view('co-admin.co_admin_manage_dogs');
    }

    public function dogsCreate(){
        return view('admin.create_dogs');
    }
    public function show(Dogs $dog){
        return view('co-admin.co_admin_dog_edit', compact('dog'));
    }
    public function coAdminUserProfile(){
        return view('co-admin.co_admin_user_profile');
    }


}
