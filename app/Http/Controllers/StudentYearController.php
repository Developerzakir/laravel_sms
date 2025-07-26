<?php

namespace App\Http\Controllers;

use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function yearView()
    {
        $data['allData'] = StudentYear::all();
        return view('admin.student_year.index',$data);
    }

    public function yearAdd()
    {
        return view('admin.student_year.create');
    }

    public function yearStore(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|unique:student_years,name'
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student year inserted successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    public function yearEdit($id)
    {
        $editData = StudentYear::find($id);
        return view('admin.student_year.edit',compact('editData'));

    }

    public function yearUpdate(Request $request, $id)
    {

        $data =  StudentYear::find($id);

        $validatedData = $request->validate([
            'name'=>'required|unique:student_years,name,'.$data->id
        ]);

        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student year updated successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    public function yearDestroy($id)
    {
        $data  = StudentYear::find($id);
        $data->delete();

         $notification = array(
            'message'=> 'Student year deleted!',
            'alert-type'=>'info'
        );

        return redirect()->route('student.year.view')->with($notification);
    }
}
