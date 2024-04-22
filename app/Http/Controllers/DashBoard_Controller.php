<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class DashBoard_Controller extends Controller
{

    public function add_Travel(Request $request)
    {

        $validation=$request->validate([
            'tourism_name_site'=>'required',
            'period'=>'required',
            'country_name'=>'required',
            'hotels_name'=>'required',
            'seating_stoppages'=>'required',
            'departing_appointment'=>'required',
            'departing_place'=>'required',
            'degree_valeting'=>'required',
            'activities'=>'required',
            'food_service_schedule'=>'required',
            'price'=>'required',
            'status'=>'required'
        ]);

        $travel=Travel::create([
            'tourism_name_site'=>$validation['tourism_name_site'],
            'period'=>$validation['period'],
            'country_name'=>$validation['country_name'],
            'hotels_name'=>$validation['hotels_name'],
            'seating_stoppages'=>$validation['seating_stoppages'],
            'departing_appointment'=>$validation['departing_appointment'],
            'departing_place'=>$validation['departing_place'],
            'degree_valeting'=>$validation['degree_valeting'],
            'activities'=>$validation['activities'],
            'food_service_schedule'=>$validation['food_service_schedule'],
            'price'=>$validation['price'],
            'status'=>$validation['status']
        ]);
        return response()->json([
            'completed addition successfully',
            'success'=>$travel,
        ]);
    }

    public function delete_Travel($id)
    {
        $travel = Travel::find($id);
        if(!$travel) {
            return response()->json(['message' => 'رحلة غير موجودة'], 404);
        }

        $travel->delete();

        return response()->json(['message' => 'تم حذف الرحلة بنجاح'], 200);
    }

    public function update_Travel(Request $request, $id)
    {
        $travel = Travel::find($id);
        if(!$travel) {
            return response()->json(['message' => 'رحلة غير موجودة'], 404);
        }
        $travel->update($request->all());
        return response()->json(['message' => 'تم تحديث الرحلة بنجاح'], 200);
    }
}
