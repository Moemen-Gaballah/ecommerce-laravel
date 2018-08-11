<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Category;
use Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()

    {

        $this->middleware('admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!empty($_GET['sort'])){
            $sort = $_GET['sort'];
        }else {
            $sort = 'ASC';
        }
        $categories = Category::where('parent', '=', 0)->orderBy('id', $sort)->get();
        $childcategories = Category::where('parent', '!=', 0)->orderBy('id', $sort)->get();
        return view('admin.content.category.index', compact('categories', 'childcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('parent', '=', 0)->get();
        return view('admin.content.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        ($request->all());
        if(!empty($request->ordering)) {
            $this->validate($request, array(
                'name' => 'required|string|unique:categories|max:255',
                'description' => 'nullable|string',
                'ordering' => 'int',
                'parent' => 'int',
                'visibility' => 'int',
                'commenting' => 'int',
                'ads' => 'int',
            ));
        }else {
            $this->validate($request, array(
                'name' => 'required|string|unique:categories|max:255',
                'description' => 'nullable|string',
                'parent' => 'int',
                'visibility' => 'int',
                'commenting' => 'int',
                'ads' => 'int',
            ));
        }
        // Store in the database
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent = $request->parent;
//        $category->ordering = filter_var($request->ordering,FILTER_SANITIZE_NUMBER_INT);
       if(empty($request->ordering)){
        $category->ordering = 0;
       }else{
        $category->ordering = $request->ordering;
       }
        $category->visibility = $request->visibility;
        $category->allow_comment = $request->commenting;
        $category->allow_ads = $request->ads;
        $category->save();

        Session::flash('success', 'The Category was successfully Save!');
        return redirect('/admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $category = Category::findOrFail($id);
//
//        return view('')
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $allCategories = Category::where('parent', '=', '0')->orderBy('id', 'ASC')->get();

        return view('admin.content.category.edit', compact('category', 'allCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($request->input('name') == $category->name) {
            $this->validate($request, array(
                'description' => 'nullable|string',
                'ordering' => 'int',
                'parent' => 'int',
                'visibility' => 'int',
                'commenting' => 'int',
                'ads' => 'int',
            ));
        } else {
            $this->validate($request, array(
                'name' => 'required|string|unique:categories|max:255',
                'description' => 'nullable|string',
                'ordering' => 'int',
                'parent' => 'int',
                'visibility' => 'int',
                'commenting' => 'int',
                'ads' => 'int',
            ));
        }

        // Store in the database
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent = $request->parent;
        if(empty($request->ordering)){
            $category->ordering = 0;
        }else{
            $category->ordering = $request->ordering;
        }
//        $category->ordering = $request->ordering;
        $category->visibility = $request->visibility;
        $category->allow_comment = $request->commenting;
        $category->allow_ads = $request->ads;
        $category->save();

        Session::flash('success', 'The Category was successfully Save!');
        return redirect('/admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'The Categroy was successfuly deleted.');
        return redirect('/admin/category');
    }
}
