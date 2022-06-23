<?php

namespace App\Http\Controllers;

use App\Models\Atributes;
use App\Models\Booking;
use App\Models\City;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function landingpage()
    {
        $data['places'] = Place::orderBy('views', 'desc')->limit('3')->get();
        $data['cities'] = City::all();
        $max_peoples = [];
        $peoples = Place::all();
        foreach ($peoples as $people){
            $max_peoples[] = $people->max_number_of_people;
        }
        $data['maxPeoples'] = $max_peoples;
        $data['atributes'] = Atributes::all();
        return view('landingpage', $data);
    }

    public function access(){
        return view('access');
    }


}
