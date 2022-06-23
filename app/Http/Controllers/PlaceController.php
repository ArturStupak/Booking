<?php

namespace App\Http\Controllers;

use App\Models\Atributes;
use App\Models\Booking;
use App\Models\Check;
use App\Models\City;
use App\Models\Gallery;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Image;

class PlaceController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['cities'] = City::all();
        $data['atributes'] = Atributes::all();
        return view('place.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Place $place)
    {
        $place = new Place();
        $place->user_id = Auth::id();
        $place->name = $request->post('name');
        $place->adress = $request->post('adress');
        $place->city_id = $request->post('city');
        $place->price = $request->post('price');
        $place->max_number_of_people = $request->post('max_number_of_people');
        $place->description = $request->post('description');
        $place->views = 0;
        $place->phonenumber = $request->post('phonenumber');
        $place->save();

        $last = DB::table('places')->latest('id')->first();
//        $atributes = Atributes::all();

        $checks = $request->post('atributes');
        foreach ($checks as $element) {
            $check = new Check();
            $check->places_id = $last->id;
            $check->atributes_id = $element;
            $check->value = $element ? 1 : 0;
            $check->save();
        }


        $images = $request->file('image');
        $position = 0;
        foreach ($images as $image) {
//            $validatedData = $request->validate([
//                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
//            ]);
            $name = $image->getClientOriginalName();
            $path = $image->move('/public/uploads/', $name);
            $save = new Gallery();
            $save->place_id = $last->id;
            $save->image = str_replace('\\', '/', $path);
            $position++;
            $save->position = $position;
            $save->save();

        }

//        $atributes = new Atributes();
//        $atributes->places_id = $last->id;
//        $atributes->pool = $request->post('pool') ? (int) $request->post('pool') : 0;
//        $atributes->pool = $request->post('pool') ? (int) $request->post('pool') : 0;
//        $atributes->bath = $request->post('bath') ? (int) $request->post('bath') : 0;
//        $atributes->food = $request->post('food') ? (int) $request->post('food') : 0;
//        $atributes->drinks = $request->post('drinks') ? (int) $request->post('drinks') : 0;


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        $id = $place->id;
        $data['places'] = Place::find($id);
        $place['views'] += 1;
        $place->save();
        $data['images'] = Gallery::where('place_id', $id)->get();
        $data['checks'] = Check::where('places_id', $id)->get();
        $dates = Booking::where('place_id', $id)->get();
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
        return view('place.about', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($placeId)
    {
        $data['places'] = Place::find($placeId);
        $data['images'] = Gallery::where('place_id', $placeId)->get();
        $data['count'] = Gallery::where('place_id', $placeId)->count();
        $data['cities'] = City::all();
        $checks = Check::where('places_id', $placeId)->get();
        $data['atributes'] = Atributes::all();
        $data['newatributes'] = [];
        $data['checks'] = [];
        foreach ($checks as $checked) {
            $data['checks'][] = $checked->atributes_id;
        }

        return view('place.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        $place->user_id = Auth::id();
        $place->name = $request->post('name');
        $place->adress = $request->post('adress');
        $place->city_id = $request->post('city');
        $place->price = $request->post('price');
        $place->max_number_of_people = $request->post('max_number_of_people');
        $place->description = $request->post('description');
        $place->views += 0;
        $place->phonenumber = $request->post('phonenumber');
        $place->save();
        $checks = $request->post('atributes');
        DB::table('checks')->where('places_id', $place->id)->delete();
        foreach ($checks as $element) {
            $check = new Check();
            $check->places_id = $place->id;
            $check->atributes_id = $element;
            $check->value = $element ? 1 : 0;
            $check->save();
        }

        $images = $request->file('image');
        if ($images !== null) {

            $position = 0;
            foreach ($images as $image) {
//            $validatedData = $request->validate([
//                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
//            ]);
                $name = $image->getClientOriginalName();
                $path = $image->move('/public/uploads/', $name);
                $save = new Gallery();
                $save->place_id = $place->id;
                $save->image = str_replace('\\', '/', $path);
                $position++;
                $save->position = $position;
                $save->save();
            }

        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
     //
    }

    public function myAds()
    {
        $id = Auth::id();
        $data['places'] = Place::where('user_id', $id)->get();
        return view('place.myAds', $data);
    }


    public function deleteImage(Request $request)
    {

        Gallery::where('id', $request->post('image_id'))->delete();
        return back();
    }

    public function deletePlace($placeId)
    {
        Place::where('id', $placeId)->delete();
        return back();
    }



//    public function PopularPlaces(){
//        $data['places'] = Place::orderBy('views', 'desc')->get();
//        return view('landingpage', $data);
//    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $places = Place::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('search', compact('places'));
    }

    public function filter()
    {

    }


}
