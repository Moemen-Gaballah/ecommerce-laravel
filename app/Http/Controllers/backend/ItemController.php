<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Item;
use App\User;
use App\Category;
use Session;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'DESC')->get();
//        dd($items);
        return view('admin.content.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::where('parent', '=', 0)->get();
        $childcategories = Category::where('parent', '!=', 0)->get();

        return view('admin.content.item.create',compact('users', 'categories', 'childcategories'));
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
            'description' => 'required|string',
            'price' => 'required|string',
            'country' => 'required|string',
            'status' => 'required|int',
            'member' => 'required|int',
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
        $item->member_id = $request->member;
        $item->category_id = $request->category;
        $item->tags = $request->tags;

//        if($request->hasfile('avater')) {
//            $image = $request->file('avater');
//            $filename = time().'.'.$image->getClientOriginalExtension();
//            $location = public_path('/image/user');
//            $user->image = $filename;
//            $image->move($location, $filename);
//        }
        $item->save();

        Session::flash('success', 'the Item was successfully Save!');
        return redirect('/admin/item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $users = User::all();
        $categories = Category::where('parent', '=', 0)->get();
        $childcategories = Category::where('parent', '!=', 0)->get();

        return view('admin.content.item.edit',compact('users', 'categories', 'childcategories','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
//        dd($request->all());
        $this->validate($request, array(
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'country' => 'required|string',
            'status' => 'required|int',
            'member' => 'required|int',
            'category' => 'required|int',
            'tags' => 'nullable|string',
        ));

        // Store in the database

        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->country_made = $request->country;
        $item->status = $request->status;
        $item->member_id = $request->member;
        $item->category_id = $request->category;
        $item->tags = $request->tags;

//        if($request->hasfile('avater')) {
//            $image = $request->file('avater');
//            $filename = time().'.'.$image->getClientOriginalExtension();
//            $location = public_path('/image/user');
//            $user->image = $filename;
//            $image->move($location, $filename);
//        }
        $item->save();

        Session::flash('success', 'the Item was successfully Update!');
        return redirect('/admin/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        $item->delete();

        Session::flash('success', 'The Item was successfully delete.');
        return redirect('/admin/item');
    }
}
