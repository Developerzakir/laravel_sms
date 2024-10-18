<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function userView()
    {
    
       $data['allData'] = User::all();
       return view("admin.user.index",  $data);
    }
}
