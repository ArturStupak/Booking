<?php

namespace App\Http\Controllers;

use App\Models\Atributes;
use App\Models\City;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $data['users'] = User::where('role', 2)->orwhere('role', 3)->get();
        return view('admin.users', $data);
    }

    public function show($userId)
    {
        $data['user'] = User::find($userId);
        return view('admin.userupdate',$data);
    }

    public function update(Request $request)
    {
        $id = $request->post('user_id');
        $user = User::find($id);
        $user->name = $request->post('name');
        $user->last_name = $request->post('last_name');
        $user->email = $request->post('email');
        $user->role = $request->post('role');
        $user->active = $request->post('active');
        $user->save();
        return back();
    }

    public function userPlaces($userId)
    {
        $data['places'] = Place::where('user_id', $userId)->get();
        return view('admin.userPlaces', $data);
    }




}
