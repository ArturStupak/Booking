<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;

class CommentsController extends Controller
{
    public function store(Request $request)
    {


        if($request->post('name') == null || $request->post('comment') == null){

            return back()->withErrors([
                'name' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }else{
            $adComment = new Comments();
            $adComment->name = $request->post('name');
            $adComment->comment = $request->post('comment');
            $adComment->place_id = $request->post('place_id');
            $adComment->save();
            return back();
        }

    }

    public function deleteComment($commentId)
    {

        Comments::where('id', $commentId)->delete();
        return back();
    }
}
