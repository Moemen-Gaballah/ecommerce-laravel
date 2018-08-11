<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.content.user.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.user.create');
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
            'username' => 'required|string',
            'password' => 'required|min:6|string',
            'email' => 'email|unique:users',
            'full' => 'required|string',
            'avater' => 'required|mimes:jpeg,jpg,png|max:2048',
        ));

        // Store in the database
        $user = new User;

        $user->name = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->fullname = $request->full;

        if($request->hasfile('avater')) {
            $image = $request->file('avater');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('/image/user');
            $user->image = $filename;
            $image->move($location, $filename);
        }
        $user->save();

        Session::flash('success', 'the user was successfully Save!');
        return redirect('/admin/member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.content.user.edit', compact('user'));
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
        $user = User::find($id);
//        echo $user->password;
//        dd($request->all());

        if($request->email == $user->email) {
            if(empty($request->newpassword)) {
                $this->validate($request, array(
                    'username' => 'required|string',
                    'full' => 'required|string',
                ));

                    $user->name = $request->username;
                    $user->fullname = $request->full;
                    $user->save();
            } else {
                    $this->validate($request, array(
                        'username' => 'required|string',
                        'newpassword' => 'required|string|min:6',
                        'full' => 'required|string',
                    ));
                        $user->name = $request->username;
                        $user->password = bcrypt($request->newpassword);
                        $user->fullname = $request->full;
                        $user->save();
            }
        }else{
            if(empty($request->password)) {
                $this->validate($request, array(
                    'username' => 'required|string',
                    'email' => 'email|unique:users',
                    'full' => 'required|string',
                ));

                    $user->name = $request->username;
                    $user->email = $request->email;
                    $user->fullname = $request->full;
                    $user->save();
            } else {
                    $this->validate($request, array(
                        'username' => 'required|string',
                        'newpassword' => 'required|string|min:6',
                        'email' => 'email|unique:users',
                        'full' => 'required|string',
                    ));

                        $user->name = $request->username;
                        $user->password = bcrypt($request->newpassword);
                        $user->fullname = $request->full;
                        $user->save();
            }
        }

        Session::flash('success', 'the user was successfully Save!');
        return redirect('/admin/member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('success', 'The User was successfuly deleted.');
        return redirect('/admin/member');
    }
}
