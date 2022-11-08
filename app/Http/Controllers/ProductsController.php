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

class ProductsController extends Controller
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
        return Products::all();
    }

    public function manageProducts()
    {
        $products = Product::all();
        $categories = Category::all();
        $isAdmin = Controller::isAdmin();
        return view('manage-products', compact('categories','products', 'isAdmin'));
    }

    public function getProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        $isAdmin = Controller::isAdmin();
        return view('edit-product', compact('categories','product', 'isAdmin'));
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
        if(Product::find($id)>0)
            return redirect()->back()->with('error', 'Product could not be deleted');
        return redirect()->back()->with('message', 'Product has been deleted successfully');
    }


    public function addProduct(Request $request){
        $title = $request->new_product_name;
        $description = $request->new_product_description;
        $price = $request->new_product_price;
        $category = $request->new_product_category;
        if(isset($title) && trim($title) != ""){
            $title_found = Product::where('name',$title)->first();
            if (!empty($title_found->id)){
                return redirect()->route('product.manage')->with('Error', 'Product name is already available');
            }else if (!isset($price) || doubleval($price) <= 0){
                return redirect()->route('product.manage')->with('Error', 'Product price must be a number');
            }else if (!isset($category)){
                return redirect()->route('product.manage')->with('Error', 'Product category cannot be empty');
            }else{
                $save = new Product();
                $save->id=Str::uuid();
                $save->name=$title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }
                $save->description = $description;
                $save->price = $price;
                $selected_category = Category::where('id', $category)->first();
                if(empty($selected_category)){
                    return redirect()->route('product.manage')->with('Error', 'Selected Product category not found');
                }
                $save->category_id = $category;
                $save->created_by = Auth::user()->getAuthIdentifierName();
                $save->save();

                return redirect()->route('product.manage')->with('message', 'Product has been successfully added');
            }

        }
        return redirect()->route('product.manage')->with('Error', 'Product name cannot be empty');
    }

    public function editProductForm($id){
        $product = Product::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with('Error', 'Product does not exist');
        }
        $categories = Category::all();
        $isAdmin = $this->isAdmin();
        return view('products-form', compact('categories','product', 'isAdmin'));
    }

    public function editProduct(Request $request, $id){
        $title = $request->new_product_name;
        $description = $request->new_product_description;
        $price = $request->new_product_price;
        $category = $request->new_product_category;
        if(isset($title) && trim($title) != "" && trim($description) != "" ){
            $product = Product::where('id', $id)->first();
            if (!empty($product)){
                $product->name = $title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }else if (!isset($price) || doubleval($price) <= 0){
                    return redirect()->back()->with('Error', 'Product price must be a number');
                }else if (!isset($category)){
                    return redirect()->back()->with('Error', 'Product category cannot be empty');
                }
                $product->description = $description;
                $product->price = $price;
                $selected_category = Category::where('id', $category)->first();
                if(empty($selected_category)){
                    return redirect()->back()->with('Error', 'Selected Product category not found');
                }
                $product->category_id = $category;
                $product->save();

                return redirect()->route('product.manage')->with('message', 'Product has been successfully added');
            }else{
                return redirect()->back()->with('Error', 'Product name is already available');
            }

        }
        return redirect()->back()->with('Error', 'Product name cannot be empty');
    }
}
