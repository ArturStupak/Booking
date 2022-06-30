<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $adComment = new Comments();
        $adComment->user_id = Auth::id();
        $adComment->comment = $request->post('comment');
        $adComment->place_id = $request->post('place_id');

        $adComment->save();
    }
}
