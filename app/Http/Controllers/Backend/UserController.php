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
        $data->usertype = $request->usertype;
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->password = bcrypt($request->password);
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
        $data->usertype = $request->usertype;
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
