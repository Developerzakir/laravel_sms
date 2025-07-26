<?php

namespace App\Http\Controllers;

use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function shiftView()
    {
        $data['allData'] = StudentShift::all();
        return view('admin.student_shift.index',$data);
    }

    public function shiftAdd()
    {
        return view('admin.student_shift.create');
    }

    public function shiftStore(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|unique:student_shifts,name'
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student shift inserted successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function shiftEdit($id)
    {
        $editData = StudentShift::find($id);
        return view('admin.student_shift.edit',compact('editData'));

    }

    public function shiftUpdate(Request $request, $id)
    {

        $data =  StudentShift::find($id);

        $validatedData = $request->validate([
            'name'=>'required|unique:student_shifts,name,'.$data->id
        ]);

        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student shift updated successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function shiftDestroy($id)
    {
        $data  = StudentShift::find($id);
        $data->delete();

         $notification = array(
            'message'=> 'Student shift deleted!',
            'alert-type'=>'info'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }
}
