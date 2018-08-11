<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use App\Comment;
use App\Item;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){

        $id = Auth::user()->id;
        $user= User::find($id);
        $myItems = Item::where('member_id', '=', $id)->orderBy('id', 'DESC')->get();
        $myComments = Comment::where('user_id', '=', $id)->orderBy('id', 'DESC')->get();

        return view('front-end.content.profile', compact('user', 'myItems','myComments'));
    }
}
