<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id){
       $category = Category::find($id);
       $items = Item::where('category_id', '=', $id)->where('status', '=', 1)->get();

        return view('front-end.content.category', compact('category', 'items'));
    }
}
