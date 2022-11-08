<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\Review;
use App\Models\Product;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $categories = Category::all();
        $products = Product::all();
        $data = Auth::user();
        $user_role = Role::where('id', $data->role_id)->first();
        $isAdmin = false;
        if(empty($user_role) && trim($user_role->name) == 'ROLE_ADMIN'){
            $isAdmin = true;
        }
        return view('index', compact('categories', '$products', 'isAdmin'));
    }

    public function getUser(){
        $user= User::where('email', json_decode(Auth::token(), true)['email'])->first();
        $id=$user->id;
        $role = Role::where('id', $user->role_id)->first();
        $role_name = $role->name;
        $email =$user->email;

        return compact('email','id','role_name');
    }
}
