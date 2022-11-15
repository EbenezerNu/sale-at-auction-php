<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\Review;
use App\Models\Product;
use App\Models\Auction;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class AuctionsController extends Controller
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
        return Auction::all();
    }

    public function manageAuctions()
    {
        $auctions = Auction::all();
        $categories = Category::all();
        $isAdmin = Controller::isAdmin();
        return view('manage-auctions', compact('categories','auctions', 'isAdmin'));
    }

    public function getAuction($id)
    {
        $auction = Auction::where('id', $id)->first();
        $categories = Category::all();
        $reviews = Review::where('auction_id', $id)->get();
        $isAdmin = Controller::isAdmin();
        return view('edit-auction', compact('categories', 'auction', 'reviews', 'isAdmin'));
    }

    public function deleteAuction($id)
    {
        Auction::destroy($id);
        if(Auction::find($id)>0)
            return redirect()->back()->with('error', 'Auction could not be deleted');
        return redirect()->back()->with('message', 'Auction has been deleted successfully');
    }


    public function addAuction(Request $request){
        $name = $request->new_auction_title;
        $description = $request->new_auction_description;
        $category = $request->new_auction_category;
        $bid = $request->new_auction_starting_bid;
        $end_date = $request->new_auction_end_date;
        if(isset($title) && trim($name) != ""){
            $name_found = Auction::where('name', $name)->first();
            if (empty($name_found->id)){
                $save = new Auction();
                $save->id=Str::uuid();
                $save->name=$name;
                if(!isset($description) || trim($description) != ""){
                    $description = "Auction on ".$name;
                }
                $save->description=$description;
                $category_found = Category::where('id',$category)->first();
                if (empty($category_found)) {
                    return redirect()->route('auction.manage')->with('Error', 'Category does not exist');
                }
                $save->category_id=$category;
                if ($end_date < Date::today()) {
                    return redirect()->route('auction.manage')->with('Error', 'End Date cannot be earlier than today');
                }
                $save->start_date=Date::today();
                if (!isset($bid) || doubleval($bid) <= 0){
                    return redirect()->back()->with('Error', 'Auction starting price must be a number greater than 0');
                }
                $save->price=$bid;
                $save->end_date=$end_date;

                $save->created_by=Controller::getUsername();
                $save->save();

                return redirect()->route('auction.manage')->with('message', 'Auction has been successfully added');
            }else{
                return redirect()->route('auction.manage')->with('Error', 'Auction title is already available');
            }

        }
        return redirect()->route('auction.manage')->with('Error', 'Auction title cannot be empty');
    }

    public function editAuctionForm($id){
        $auction = Auction::where('id', $id)->first();
        if (empty($auction)){
            return redirect()->back()->with('Error', 'Auction does not exist');
        }
        $categories = Category::all();
        $isAdmin = $this->isAdmin();
        return view('auctions-form', compact('categories','auction', 'isAdmin'));
    }

    public function editAuction(Request $request, $id){
        $title = $request->new_auction_name;
        $description = $request->new_auction_description;
        $selectedCategory = $request->new_auction_category;
        $end_date = $request->new_auction_end_date;
        $bid = $request->new_auction_starting_bid;
        if(isset($title) && trim($title) != "" && trim($description) != "" ){
            $auction = Category::where('id', $id)->first();
            if (!empty($auction)){
                $auction->name=$title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }
                $auction->description=$description;
                $category_found = Category::where('id',$selectedCategory)->first();
                if (empty($category_found)) {
                    return redirect()->route('auction.manage')->with('Error', 'Category does not exist');
                }
                $auction->category_id=$selectedCategory;
                if ($end_date < Date::today()) {
                    return redirect()->route('auction.manage')->with('Error', 'End Date cannot be earlier than today');
                }
                $auction->start_date=Date::today();
                if (!isset($bid) || doubleval($bid) <= 0) {
                    return redirect()->route('auction.manage')->with('Error', 'Starting should be greater than 0');
                }
                $auction->price=$bid;
                $auction->end_date=$end_date;
                $auction->save();

                return redirect()->route('auction.manage')->with('message', 'Auction has been successfully added');
            }else{
                return redirect()->back()->with('Error', 'Auction title is already available');
            }

        }
        return redirect()->back()->with('Error', 'Auction title cannot be empty');
    }
}
