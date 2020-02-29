<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Gate;
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
    public function index(User $user)
    {

        if(Gate::denies('edit-users')){
            return view('user.index',compact('user'));
        }
        $user = User::orderBy('id','DESC')->paginate(10);
        return view('admin.users.index',compact('user'));
    }
}
