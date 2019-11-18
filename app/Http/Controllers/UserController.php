<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return  view('usersView.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = Role::pluck('name','name')->all();
        return view('usersView.create',compact('rules'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        dd($request->all());
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required'],
        ]);

       $user =  User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => \Hash::make($request->get('password')),

        ]);

       if ($user){
           $user->assignRole($request->get('roles'));
       }
       if ($request->hasFile('avatar')){
           $user->addMedia($request->file('avatar'))->toMediaCollection();
       }

        return redirect(action($this->index()));
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profile()
    {
        if (\Auth::user()) {
            $user = \Auth::user();
            return view('usersView.profile', compact('user'));
        }
        return redirect()->route('login');
    }

    public function profileUpdate(Request $request,$id){

      //  dd($request->all(), $id);

        $user = User::where('id',Auth::user()->id)->firstOrFail();
        $this->validate($request,[
            'name' => 'required', 'string', 'max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id.',id'


        ]);

        if($request->filled('password')){
            $this->validate($request,[
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }


        $user->name == $request->name ?: $user->name = $request->name   ;
        $user->email == $request->email ?: $user->email = $request->email   ;
        if($request->filled('password')){
            $user->password = \Hash::make($request->password);
        }
        $user->save();


         dd($request->all(), $id);
    }
}
