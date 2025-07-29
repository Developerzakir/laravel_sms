<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
        public function index()
    {
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('admin.fee_amount.index',$data);
    }

    public function create()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('admin.fee_amount.create',$data);
    }

    public function store(Request $request)
    {
        $countClass = count($request->class_id);
    	if ($countClass !=NULL) {
    		for ($i=0; $i <$countClass ; $i++) { 
    			$fee_amount = new FeeCategoryAmount();
    			$fee_amount->fee_category_id = $request->fee_category_id;
    			$fee_amount->class_id = $request->class_id[$i];
    			$fee_amount->amount = $request->amount[$i];
    			$fee_amount->save();

    		} // End For Loop
    	}// End If Condition

    	$notification = array(
    		'message' => 'Fee Amount Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('fee.amount.view')->with($notification);
    }

    public function edit($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
    	// dd($data['editData']->toArray());
    	$data['fee_categories'] = FeeCategory::all();
    	$data['classes'] = StudentClass::all();
        return view('admin.fee_amount.edit',$data);

    }

    public function update(Request $request,$fee_category_id)
    {

       if ($request->class_id == NULL) {
       
        $notification = array(
    		'message' => 'Sorry You do not select any class amount',
    		'alert-type' => 'error'
    	);

    	return redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);
    		 
    	}else{
    		 
         $countClass = count($request->class_id);
	     FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete(); 
    		for ($i=0; $i <$countClass ; $i++) { 
    			$fee_amount = new FeeCategoryAmount();
    			$fee_amount->fee_category_id = $request->fee_category_id;
    			$fee_amount->class_id = $request->class_id[$i];
    			$fee_amount->amount = $request->amount[$i];
    			$fee_amount->save();

    		} // End For Loop	 

    	}// end Else

       $notification = array(
    		'message' => 'Data Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('fee.amount.view')->with($notification);
    }


    public function DetailsFeeAmount($id)
    {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
        return view('admin.fee_amount.details_fee_amount',$data);
 	}


    public function destroy($id)
    {
        $data  = FeeCategoryAmount::find($id);
        $data->delete();

         $notification = array(
            'message'=> 'Student fee category deleted!',
            'alert-type'=>'info'
        );

        return redirect()->route('fee.amount.view')->with($notification);
    }
}
