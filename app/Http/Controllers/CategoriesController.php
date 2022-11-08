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
use Illuminate\Support\Str;

class CategoriesController extends Controller
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
        return Category::all();
    }

    public function manageCategory()
    {
        $categories = Category::all();
        $isAdmin = Controller::isAdmin();
        return view('manage-categories', compact('categories', 'isAdmin'));
    }


    public function addCategory(Request $request){
        $title = $request->new_category_name;
        $description = $request->new_category_description;
        if(isset($title) && trim($title) != ""){
            $title_found = Category::where('name',$title)->first();
            if (empty($title_found->id)){
                $save = new Category();
                $save->id=Str::uuid();
                $save->name=$title;
                $save->description=$description;
                $save->created_by=Auth::user()->getAuthIdentifierName();
                $save->save();

                return redirect()->route('categories.manage')->with('message', 'Category has been successfully added');
            }else{
                return redirect()->route('categories.manage')->with('Error', 'Category name is already available');
            }

        }
        return redirect()->route('categories.manage')->with('Error', 'Category name cannot be empty');
    }
}
