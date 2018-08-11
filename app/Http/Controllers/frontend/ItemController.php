<?php

namespace App\Http\Controllers\frontend;

use App\Category;
use App\Http\Controllers\Controller;

use App\Item;
use Session;
use App\Comment;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('front-end.content.newad', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, array(
            'name' => 'required|string',
            'description' => 'required|string|min:10',
            'price' => 'required|string|numeric',
            'country' => 'required|string',
            'status' => 'required|int',
            'category' => 'required|int',
            'tags' => 'nullable|string',
        ));

        // Store in the database
        $item = new Item();

        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->country_made = $request->country;
        $item->status = $request->status;
        $item->member_id = \Auth::user()->id;
        $item->category_id = $request->category;
        $item->tags = $request->tags;

        $item->save();

        Session::flash('success', 'the Item was successfully Save!');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $item = Item::find($id)->where('status', '=', 1)->get();
        $item = Item::find($id);
        $comments = Comment::where('item_id','=', $id)->where('status', '=', 1)->get();

        return view('front-end.content.item', compact('item', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
