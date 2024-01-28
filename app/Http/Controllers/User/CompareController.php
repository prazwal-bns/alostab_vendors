<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exits = Compare::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exits) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Product Successfully Added To your Comparison list.']);
            } else {
                return response()->json(['error' => 'This Product has already been added to your comparision list.']);
            }
        } else {
            return response()->json(['error' => 'Please Login to Your Account Before adding products to your compare list.']);
        }
    }
    // end function

    public function AllCompare()
    {
        return view('frontend.compare.view_compare');
    }
    // end function

    public function GetCompareProduct()
    {
        $userId = Auth::id(); // Get the user ID of the authenticated user

        $comparelist = Compare::where('user_id', $userId)->with('product')->latest()->get();
        $compareQty = Compare::where('user_id', $userId)->count(); // Count the wishlist items for the authenticated user

        return response()->json(['comparelist' => $comparelist, 'compareQty' => $compareQty]);
    }
    // end function


    // REMOVE WISHLIST
    public function CompareRemove($id)
    {
        Compare::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Product Removed Successfully From Your Compare List.']);
    }
    // end function

}
