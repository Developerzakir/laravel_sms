<?php

namespace App\Http\Controllers;

use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function groupView()
    {
        $data['allData'] = StudentGroup::all();
        return view('admin.student_group.index',$data);
    }

    public function groupAdd()
    {
        return view('admin.student_group.create');
    }

    public function groupStore(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|unique:student_groups,name'
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student group inserted successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function groupEdit($id)
    {
        $editData = StudentGroup::find($id);
        return view('admin.student_group.edit',compact('editData'));

    }

    public function groupUpdate(Request $request, $id)
    {

        $data =  StudentGroup::find($id);

        $validatedData = $request->validate([
            'name'=>'required|unique:student_groups,name,'.$data->id
        ]);

        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message'=> 'Student group updated successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function groupDestroy($id)
    {
        $data  = StudentGroup::find($id);
        $data->delete();

         $notification = array(
            'message'=> 'Student group deleted!',
            'alert-type'=>'info'
        );

        return redirect()->route('student.group.view')->with($notification);
    }
}
