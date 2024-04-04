<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $product_id){
        if(Auth::check()){
            $exits = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if(!$exits){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Product Successfully Added To your Wishlist.']);
            }
            else{
                return response()->json(['error' => 'This Product has already been added to your wishlist.']);
            }
        }
        else{
            return response()->json(['error' => 'Please Login to Your Account Before adding products to Wishlist.']);
        }
    }
    // end function

    // For Wishlist Page
    public function AllWishlist(){
        return view('frontend.wishlist.view_wishlist');
    }
    // end function

    // Display Products in wishlist Page
    public function GetWishListProduct()
    {
        // $wishlist = Wishlist::with('product')->where('user_id', Auth::user()->id)->latest()->get();
        // $wishQty = Wishlist::count();

        // return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
        $userId = Auth::id(); // Get the user ID of the authenticated user

        $wishlist = Wishlist::where('user_id', $userId)->with('product')->latest()->get();
        $wishQty = Wishlist::where('user_id', $userId)->count(); // Count the wishlist items for the authenticated user

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }

    // end function

    // REMOVE WISHLIST
    public function WishlistRemove($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Product Removed Successfully From Your Wishlist.']);
    }
    // end function

    public function GetProductReviews($product_id)
    {
        // Retrieve reviews for the specified product_id
        $reviews = Review::where('product_id', $product_id)->where('status', 1)->get();

        return response()->json($reviews);
    }
    // // end function
}
