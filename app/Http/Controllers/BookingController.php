<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Check;
use App\Models\Place;
use App\Models\Wishes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function rezervation($placesId)
    {
        $data['places'] = Place::find($placesId);
        $data['checks'] = Check::where('places_id', $placesId)->get();
        $dates = Booking::where('place_id', $placesId)->get();
        $allDates = [];
        foreach($dates as $date){
            $arrival = strtotime($date->arrival);
            $departure = strtotime($date->departure);
            for($currentDate = $arrival; $currentDate <= $departure; $currentDate += (86400)){
                $daterange = date('Y-m-d', $currentDate);
                $allDates[] = $daterange;
            }
        }
        $data['dates'] = json_encode($allDates);
        return view('place.rezervation', $data);
    }

    public function store(Request $request){

        $max = Place::find($request->post('place_id'));
        $booking = new Booking();
        $booking->name = $request->post('name');
        $booking->email = $request->post('email');
        $booking->arrival = Carbon::createFromFormat('m/d/Y', $request->post('arrival'))->format('Y-m-d');
        $booking->departure = Carbon::createFromFormat('m/d/Y', $request->post('departure'))->format('Y-m-d');
        $booking->place_id = $request->post('place_id');

        if($request->post('number_of_people') <= $max->max_number_of_people){
            $booking->number_of_people = $request->post('number_of_people');
            $booking->seen = 1;
            $booking->save();
        }else{
            return back();
        }

        $last = DB::table('bookings')->latest('id')->first();
        $atributes=$request->post('atributes');
        foreach($atributes as $atribute)
        {
            $wishes = new Wishes();
            $wishes->booking_id = $last->id;
            $wishes->atributes_id = $atribute;
            $wishes->save();
        }

    return redirect(route('home'));
    }

    public function seen()
    {
        $id = Auth::id();
        $places = Place::where('user_id', $id)->get();
        $userId = [];
        foreach($places as $place){
            $userId[]= $place->id;
        }
        $data['bookings'] = [];
        foreach ($userId as $user) {
            $data['bookings'][] = Booking::where('place_id', $user)->where('seen', 1)->get();
        }
        return view('bookings.bookings',$data);
    }

    public function accept($bookingId){

        $bookingId = Booking::find($bookingId);
        $bookingId->seen = 0;
        $bookingId->save();
        return back();

    }

    public function deleteBooking($id)
    {
        Booking::where('id', $id)->delete();
        return back();
    }
}
