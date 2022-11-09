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

class ReviewsController extends Controller
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
        return Review::all();
    }

    public function manageReviews()
    {
        $reviews = Review::all();
        $products = Product::all();
        $isAdmin = Controller::isAdmin();
        return view('manage-reviews', compact('reviews','products', 'isAdmin'));
    }

    public function getReview($id)
    {
        $review = Review::where('id', $id)->first();
        $isAdmin = Controller::isAdmin();
        return view('edit-review', compact('review', 'isAdmin'));
    }

    public function deleteReview($id)
    {
        Review::destroy($id);
        if(Review::find($id)>0)
            return redirect()->back()->with('error', 'Review could not be deleted');
        return redirect()->back()->with('message', 'Review has been deleted successfully');
    }


    public function addReview(Request $request, $id){
        $title = $request->reviewtext;
        $product = Product::where('id', $id)->first();
        if(empty($product)){
            return redirect()->back()->with('Error', 'Selected Review product not found');
        }
        if(isset($title) && trim($title) != ""){
            $save = new Review();
            $save->id=Str::uuid();
            $save->title=$title;
            $save->description=$title;
            $save->product_id = $id;
            $save->created_by = Controller::getUsername();
            $save->save();

            return redirect()->back()->with('message', 'Review has been successfully added');
        }
        return redirect()->back()->with('Error', 'Review text cannot be empty');
    }

    public function editReviewForm($id){
        $review = Review::where('id', $id)->first();
        if (empty($review)){
            return redirect()->back()->with('Error', 'Review does not exist');
        }
        $categories = Category::all();
        $isAdmin = $this->isAdmin();
        return view('reviews-form', compact('categories','review', 'isAdmin'));
    }

    public function editReview(Request $request, $id){
        $title = $request->new_review_name;
        $description = $request->new_review_description;
        $price = $request->new_review_price;
        $category_id = $request->new_review_category;
        if(isset($title) && trim($title) != "" && trim($description) != "" ){
            $review = Review::where('id', $id)->first();
            if (!empty($review)){
                $review->name = $title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }else if (!isset($price) || doubleval($price) <= 0){
                    return redirect()->back()->with('Error', 'Review price must be a number');
                }else if (!isset($category_id)){
                    return redirect()->back()->with('Error', 'Review category cannot be empty');
                }
                $review->description = $description;
                $review->price = $price;
                $selected_category = Category::where('id', $category_id)->first();
                if(empty($selected_category)){
                    return redirect()->back()->with('Error', 'Selected Review category not found');
                }
                $review->category_id = $category_id;
                $review->save();

                return redirect()->route('review.manage')->with('message', 'Review has been successfully added');
            }else{
                return redirect()->back()->with('Error', 'Review name is already available');
            }

        }
        return redirect()->back()->with('Error', 'Review name cannot be empty');
    }
}
