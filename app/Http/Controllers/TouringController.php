<?php

namespace App\Http\Controllers;

use App\Models\Booking_travel;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Validation\Rule;
use App\Models\Rating;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TouringController extends Controller
{



    public function search_OnTravel(Request $request)
    {
        $title = $request->input('departing_place');
        $tourism_name_site = $request->input('tourism_name_site');
        $price = $request->input('price');

        $trips = Travel::where('departing_place', 'like', '%' . $title . '%')->
                         where('tourism_name_site', 'like', '%' . $tourism_name_site . '%')->
                         where('price', 'like', '%' . $price . '%')->get();
        return response()->json($trips);
    }

    public function account_delete_me()
    {

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->delete();
        return response()->json([
            'message'=>'success account deleted'
        ]);

    }


    public function add_profile(Request $request)
    {

        $validate=$request->validate([
            'name' => 'required',
            'balance'=>'required',
            'gender'=>['required', Rule::in(['male','female'])  ],

        ]);

        $image = $request->file('image');
        if($request->hasFile('image')){

            $fileName = date('dmY').time().'.'.$image->getClientOriginalExtension();
              $image->move(public_path("/pictures"), $fileName);
              $data['image'] = $fileName;

         }
         $user_id=auth()->user()->id;
         $profile=Profile::create([
            'name' => $validate['name'],
            'balance'=>$validate['balance'],
            'gender'=>$validate['gender'],
            'user_id'=>$user_id,
            'image'=>$fileName,
         ]);

         return response()->json($profile);


    }


    public function show_profile( $id)
    {
    $user=User::find($id);
    $profile=$user->profile;
    return response()->json($profile);
    }

    public function update_profile($id ,Request $request)
    {
        $user_id=auth()->user()->id;
        $profile = Profile::find($id);

        if($user_id === $profile->user_id ){
            $profile->update($request->all());
            return response()->json(['message' => 'تم تحديث الملف الشخصي بنجاح'], 200);
        }
        return response()->json(['message' => 'عذرا ..ليس لديك صلاحية التعديل'], 200);
    }


    public function add_rating(Request $request , $travel_touring_id)
    {
        $validation=$request->validate([
            'rating'=>'required|min:1|max:5',
        ]);
        $user_id=auth()->user()->id;

        $rating=Rating::create([
            'user_id'=>$user_id,
            'travel_touring_id'=>$travel_touring_id,
            'rating'=>$validation['rating'],
        ]);
        return response()->json($rating);

    }

    public function add_comment(Request $request , $travel_touring_id)
    {
        $validation=$request->validate([
            'comment'=>'required',
        ]);
        $user_id=auth()->user()->id;

        $comment=Comment::create([
            'user_id'=>$user_id,
            'travel_touring_id'=>$travel_touring_id,
            'comment'=>$validation['comment'],
        ]);
        return response()->json([
            'message'=> 'success',
            $comment]);

    }

    public function booking_travel(Request $request , $travel_id)
    {
        $validation=$request->validate([
            'payment_method'=>'required'
        ]);
        $user_id=auth()->user()->id;

        $booking=Booking_travel::create([
            'user_id'=>$user_id,
            'travel_touring_id'=>$travel_id,
            'payment_method'=>$validation['payment_method'],
        ]);

        return response()->json([
            'Message'=>'Successful Booking Completed ',
            'details'=>$booking
        ]);
    }

    public function booking_cancel(Request $request, $id)
    {
        $booking = Booking_travel::find($id);
        $user_id=auth()->user()->id;
        if($booking->user_id != $user_id) {
            return response()->json(['message' => 'عذرا .. ليس لديك صلاحية الإلغاء'], 404);
        }
        $booking->delete();
        return response()->json(['message' => 'تم إلغاء الحجز بنجاح'], 200);
    }

    public function booking_update(Request $request, $id)
    {
        $user_id=auth()->user()->id;
        $booking = Booking_travel::find($id);
        if($booking->user_id != $user_id) {
            return response()->json(['message' => 'عذرا .. ليس لديك صلاحية التعديل'], 404);
        }
        $booking->update($request->all());
        return response()->json(['message' => 'تم تعديل الحجز بنجاح'], 200);
    }


}
