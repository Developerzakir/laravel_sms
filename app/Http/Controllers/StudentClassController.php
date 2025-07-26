<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function classView()
    {
        $data['allData'] = StudentClass::all();
        return view('admin.student_class.index',$data);
    }

    public function classAdd()
    {
        return view('admin.student_class.create');
    }

    public function classStore(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|unique:student_classes,name'
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student class inserted successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function classEdit($id)
    {
        $editData = StudentClass::find($id);
        return view('admin.student_class.edit',compact('editData'));

    }

    public function classUpdate(Request $request, $id)
    {

        $data =  StudentClass::find($id);

        $validatedData = $request->validate([
            'name'=>'required|unique:student_classes,name,'.$data->id
        ]);

        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student class updated successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function classDestroy($id)
    {
        $data  = StudentClass::find($id);
        $data->delete();

         $notification = array(
            'message'=> 'Student class deleted!',
            'alert-type'=>'info'
        );

        return redirect()->route('student.class.view')->with($notification);
    }
}
