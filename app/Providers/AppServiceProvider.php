<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            $id = Auth::id();
            if (Auth::check()) {
                $places = Place::where('user_id', $id)->get();
                $userId = [];
                foreach($places as $place){
                    $userId[]= $place->id;
                }
                $count = 0;
                foreach($userId as $user){
                    $notAcepted = Booking::where('place_id',$user)->where('seen', 1)->count();
                    $count += $notAcepted;
                }

                $notAcepted = $count > 0 ? ' ('.$count.')' : '';
                view()->share('notAcepted', $notAcepted);
            }

        });
    }
    public function countBookings()
    {
        $id = Auth::id();
        $places = Place::where('user_id', $id)->get();
        $userId = [];
        foreach($places as $place){
            $userId[]= $place->id;
        }
        $data['bookings'] = Booking::where('place_id', $userId)->where('seen', 1)->get();
        return view('layouts.app', $data);
    }

}
