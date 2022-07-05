<?php

namespace App\Http\Controllers;

use App\Models\Atributes;
use App\Models\Booking;
use App\Models\Check;
use App\Models\City;
use App\Models\Comments;
use App\Models\Gallery;
use App\Models\Place;
use App\Models\Ratings;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ValidatedInput;
use Nette\Utils\Image;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;
use PhpParser\Node\Scalar\MagicConst\File;
use PhpParser\Node\Stmt\Foreach_;
use Ramsey\Uuid\Rfc4122\Validator;

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
    public function index(Request $request)
    {
        $data['cities'] = City::all();
        $max_peoples = [];
        $peoples = Place::all();
        foreach ($peoples as $people){
            $max_peoples[] = $people->max_number_of_people;
        }
        $data['maxPeoples'] = $max_peoples;
        $data['atributes'] = Atributes::all();
        $data['places'] = Place::paginate(3);
        return view('home', $data);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Place $place)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:95',
            'adress' => 'required|string|max:95',
            'phonenumber' => 'required',
            'city' => 'required',
            'price' => 'required',
            'max_number_of_people' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', ' Visi laukeliai turi būti užpildyti, skelbimas nesukurtas.');
        } else {

            $place = new Place();
            $place->user_id = Auth::id();
            $placeName = Place::all();
            foreach ($placeName as $element) {
                if ($request->post('name') == $element->name) {
                    return back()->with('error', 'Sorry, places name exist ');
                } else {
                    $place->name = $request->post('name');
                }
            }
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

            $checks = $request->post('atributes');
            if ($checks !== null) {
                foreach ($checks as $element) {
                    $check = new Check();
                    $check->places_id = $last->id;
                    $check->atributes_id = $element;
                    $check->value = $element ? 1 : 0;
                    $check->save();
                }
            }

            $images = $request->file('image');
            $positions = $request->post('position');
            $i = 0;
            if ($images !== null) {
                foreach ($images as $image) {
                    $rand = rand(100, 1000);
                    $name = $image->getClientOriginalName();
                    $full_image_name = $rand . '.' . $name;
                    $path = $image->move('public/uploads/', $full_image_name);
                    $save = new Gallery();
                    $save->place_id = $last->id;
                    $save->image = str_replace('\\', '/', $path);
                    $save->position = $positions[$i];
                    if($positions[$i] == 0){
                        $save->position = 99;
                    }else{
                        $save->position = $positions[$i];
                    }
                    $i++;
                    $save->save();
                }
            }
        }
        return back()->with('success', 'Post created');
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
            $place->views++;
            $place->save();
            $data['comments'] = Comments::where('place_id', $id)->get();
            $data['images'] = Gallery::where('place_id', $id)->orderBy('position', 'desc')->get();
            $data['checks'] = Check::where('places_id', $id)->get();
            $dates = Booking::where('place_id', $id)->get();
            $allDates = [];
            foreach ($dates as $date) {
                $arrival = strtotime($date->arrival);
                $departure = strtotime($date->departure);
                for ($currentDate = $arrival; $currentDate <= $departure; $currentDate += (86400)) {
                    $daterange = date('Y-m-d', $currentDate);
                    $allDates[] = $daterange;
                }
            }
            $data['dates'] = json_encode($allDates);
            $data['currentUser'] = Auth::id();
            $users = Ratings::find(Auth::id());
            if(!empty($users) || $users == null){
                $count = 0;
                $sum = 0;
                $ratings = Ratings::where('place_id', $id)->get();

                foreach($ratings as $rating){
                    $sum += $rating->rating;
                    $count++;
                }
                if($sum !== 0){
                    $average = $sum / $count;
                    $data['average'] = round($average);
                }else{
                    $data['average'] = null;
                }
            }else{
                $data['average'] = null;
            }
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Place $place)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:95',
            'adress' => 'required|string|max:95',
            'phonenumber' => 'required',
            'city' => 'required',
            'price' => 'required',
            'max_number_of_people' => 'required',
            'description' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'All field must be filled in, post is not created.');
        } else {
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
            if ($checks !== null) {
                foreach ($checks as $element) {
                    $check = new Check();
                    $check->places_id = $place->id;
                    $check->atributes_id = $element;
                    $check->value = $element ? 1 : 0;
                    $check->save();
                }
            }

            $images = $request->file('image');
            $positions = $request->post('position');
            $i = 0;
            if ($images !== null) {
                foreach ($images as $image) {
                    $rand = md5(rand(100, 1000));
                    $name = $image->getClientOriginalName();
                    $full_image_name = $rand . '.' . $name;
                    $path = $image->move('public/uploads/', $full_image_name);
                    $save = new Gallery();
                    $save->place_id = $place->id;
                    $save->image = str_replace('\\', '/', $path);
                    $save->position = $positions[$i];
                    if ($positions[$i] == 0) {
                        $save->position = 99;
                    } else {
                        $save->position = $positions[$i];
                    }
                    $i++;
                    $save->save();
                }
            }
            return back();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function myAds()
    {
        $id = Auth::id();
        $data['places'] = Place::where('user_id', $id)->get();
        return view('place.myAds', $data);

    }

    public function deleteImage(Request $request)
    {
        $image = Gallery::find($request->post('image_id'));
        $imagePath = $image->image;
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }
        Gallery::where('id', $request->post('image_id'))->delete();
        return back();
    }

    public function deletePlace($placeId)
    {
        $id = $placeId;
        Place::where('id', $id)->delete();
        $images = Gallery::where('place_id', $id)->get();
        foreach($images as $image){
            $findImage = Gallery::find($image->id);
            $imagePath = $findImage->image;
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
            Gallery::where('id', $findImage->id)->delete();
        }
        Check::where('places_id', $id)->delete();
        Booking::where('place_id', $id)->delete();
        Comments::where('place_id', $id)->delete();

        return back();
    }

    public function search(Request $request){

        $search = $request->input('search');
        $places = Place::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();
        return view('search', compact('places'));
    }

    public function filter(Request $request)
    {
        $placesId = [];
        $atributes = $request->get('atributes');
        if(!empty($atributes)){
            $checks = Check::whereIn('atributes_id', $atributes)->get();
            foreach ($checks as $check) {
                $placesId[] = $check->places_id;
            }
        }

        $places = Place::where('id', '>' , 1);

        if($request->get('city')){
            $places->where('city_id', $request->get('city'));
        }
        if($request->get('maxPeoples')) {
            $places->where('max_number_of_people', '<=', $request->get('maxPeoples'));
        }
        if(!empty($placesId)){
            $places->whereIn('id', $placesId);
        }
        $data['places'] = $places->paginate(3);
        $data['images'] = Gallery::all();
        $data['cities'] = City::all();
        $max_peoples = [];
        $peoples = Place::all();
        foreach ($peoples as $people) {
            $max_peoples[] = $people->max_number_of_people;
        }
        $data['maxPeoples'] = $max_peoples;
        $data['atributes'] = Atributes::all();

        return view('home', $data);

    }

    public function saveRating(Request $request){

        $id = Auth::id();
        $users = Ratings::where('user_id', $id)->where('place_id', $request->post('place_id'))->get();

        if(!empty($users)){
            $rating = new Ratings();
            $rating->user_id = Auth::id();
            $rating->place_id = $request->post('place_id');
            $rating->rating = $request->post('rating');
            $rating->save();
        }
        return back()->with('success', 'Ačiū už įvertinimą');
     }


}
