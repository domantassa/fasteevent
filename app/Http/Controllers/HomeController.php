<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function visiVartotojai()
    {

        $users = \App\User::all();
        return view('vartotojai')->with([
            'users' => $users,
        ]);
        
    }

    public function destroy($id)
    {
        $user = \App\User::find($id);
        $user->delete();
        return redirect('vartotojai');
    }
    
    
}
