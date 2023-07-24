<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // public function profile(){
    //     $id = Auth::user()->id;
    //     $admin = User::find($id);

    //     return view('admin.profile', compact('admin'));
    // }
}
