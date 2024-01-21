<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function ProductDetails($id, $slug){
        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        $multiImage = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();

        return view('frontend.product.product_details',compact('product','product_color','product_size','multiImage','relatedProduct'));
    }
    // end func

    public function Index(){
        $skip_category_zero = Category::skip(0)->first();
        $skip_product_zero = Product::where('status',1)->where('category_id',$skip_category_zero->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category_one = Category::skip(1)->first();
        $skip_product_one = Product::where('status', 1)->where('category_id', $skip_category_one->id)->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_three = Category::skip(3)->first();
        $skip_product_three = Product::where('status', 1)->where('category_id', $skip_category_three->id)->orderBy('id', 'DESC')->limit(5)->get();
        
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();


        $special_offer = Product::where('special_offer',1)->orderBy('id')->limit(3)->get();

        $recent_products = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        
        return view ('frontend.index',compact('skip_category_zero','skip_product_zero', 'skip_category_one', 'skip_product_one', 'skip_category_three', 'skip_product_three','hot_deals','special_offer','recent_products','special_deals'));
    }
    // end func
}
