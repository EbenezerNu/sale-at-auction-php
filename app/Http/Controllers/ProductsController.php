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
        $products = Products::all();
        $isAdmin = Controller::isAdmin();
        return view('manage-products', compact('products', 'isAdmin'));
    }

    public function getProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $isAdmin = Controller::isAdmin();
        return view('edit-product', compact('product', 'isAdmin'));
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
        if(Category::find($id)>0)
            return redirect()->back()->with('error', 'Product could not be deleted');
        return redirect()->back()->with('message', 'Product has been deleted successfully');
    }


    public function addProduct(Request $request){
        $title = $request->new_product_name;
        $description = $request->new_product_description;
        if(isset($title) && trim($title) != ""){
            $title_found = Product::where('name',$title)->first();
            if (empty($title_found->id)){
                $save = new Product();
                $save->id=Str::uuid();
                $save->name=$title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }
                $save->description=$description;
                $save->created_by=Auth::user()->getAuthIdentifierName();
                $save->save();

                return redirect()->route('product.manage')->with('message', 'Product has been successfully added');
            }else{
                return redirect()->route('product.manage')->with('Error', 'Product name is already available');
            }

        }
        return redirect()->route('product.manage')->with('Error', 'Product name cannot be empty');
    }

    public function editProductForm($id){
        $product = Product::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with('Error', 'Product does not exist');
        }
        $isAdmin = $this->isAdmin();
        return view('products-form', compact('product', 'isAdmin'));
    }

    public function editProduct(Request $request, $id){
        $title = $request->new_product_name;
        $description = $request->new_product_description;
        if(isset($title) && trim($title) != "" && trim($description) != "" ){
            $product = Category::where('id', $id)->first();
            if (!empty($product)){
                $product->name=$title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }
                $product->description=$description;
                $product->save();

                return redirect()->route('product.manage')->with('message', 'Product has been successfully added');
            }else{
                return redirect()->back()->with('Error', 'Product name is already available');
            }

        }
        return redirect()->back()->with('Error', 'Product name cannot be empty');
    }
}
