<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function userView()
    {
    
    //    $data['allData'] = User::all();
       $data['allData'] = User::where('usertype','Admin')->get();
       return view("admin.user.index",  $data);
    }

    public function userAdd()
    {
        return view('admin.user.add');
    }

    public function userStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users'
        ]);

        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'Admin';
        $data->role     = $request->role;
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message'    =>'User created',
            'alert-type' =>'success',
        );

        return redirect()->route('user.view')->with($notification);
    }

    
    public function UserEdit($id)
    {
    	$editData = User::find($id);
    	return view('admin.user.edit',compact('editData'));
    }



    public function UserUpdate(Request $request, $id)
    {
    	$data = User::find($id);
    	$data->name = $request->name;
    	$data->email = $request->email;
        $data->role = $request->role;
    	$data->save();

    	$notification = array(
    		'message' => 'User Updated Successfully',
    		'alert-type' => 'info'
    	);

    	return redirect()->route('user.view')->with($notification);

    }



    public function UserDelete($id)
    {
    	$user = User::find($id);
    	$user->delete();

    	$notification = array(
    		'message' => 'User Deleted Successfully',
    		'alert-type' => 'info'
    	);

    	return redirect()->route('user.view')->with($notification);

    }
}
