<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function index()
    {
        $data['allData'] = FeeCategory::all();
        return view('admin.fee_category.index',$data);
    }

    public function create()
    {
        return view('admin.fee_category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|unique:fee_categories,name'
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student shift inserted successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    public function edit($id)
    {
        $editData = FeeCategory::find($id);
        return view('admin.fee_category.edit',compact('editData'));

    }

    public function update(Request $request, $id)
    {

        $data =  FeeCategory::find($id);

        $validatedData = $request->validate([
            'name'=>'required|unique:fee_categories,name,'.$data->id
        ]);

        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student fee category updated successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    public function destroy($id)
    {
        $data  = FeeCategory::find($id);
        $data->delete();

         $notification = array(
            'message'=> 'Student fee category deleted!',
            'alert-type'=>'info'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }
}
