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
    public function index(Request $request)
    {
        $categories = Category::all();
        $keyword = '';
        $products = Product::all();
        if(!empty($request) && isset($request->search) && trim($request->search) != ""){
            $keyword = trim($request->search);
            $products = $products->where('name', 'LIKE','%'.trim($request->search).'%');
//            $products = $this->filter($products, $keyword);
        }
        $isAdmin = Controller::isAdmin();
        return view('index', compact('categories', 'products', 'keyword', 'isAdmin'));
    }

    public function getUser(){
        $user= User::where('email', json_decode(Auth::token(), true)['email'])->first();
        $id=$user->id;
        $role = Role::where('id', $user->role_id)->first();
        $role_name = $role->name;
        $email =$user->email;

        return compact('email','id','role_name');
    }

    public function filter($products, $keyword){
        $products = $products->where(function ($qx) use ($keyword) {
            $qx->orwhere('name', 'ILIKE', '%' . $keyword . '%');
            $qx->orWhere('description', 'ILIKE', '%' . $keyword . '%');
        });
        return $products;
    }
}
