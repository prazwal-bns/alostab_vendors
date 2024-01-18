<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class VendorProductController extends Controller
{
    public function VendorAllProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }
    // end function

    public function VendorAddProduct()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();

        return view('vendor.backend.product.vendor_add_product', compact('brands', 'categories'));
    }
    // end function


    // for subcategory filtration in add_product page
    public function VendorGetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }
    // end function


    public function VendorStoreProduct(Request $request)
    {
        $image = $request->file('product_thumbnail');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $imageName);
        $save_url = 'upload/products/thumbnail/' . $imageName;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'vendor_id' => Auth::user()->id,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'product_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        // For Uploading Multiple Image Code ----->
        $images = $request->file('multi_img');
        foreach ($images as $key => $img) {
            $multiimageName = time() . '_' . $key . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $multiimageName);

            $uploadPath = 'upload/products/multi-image/' . $multiimageName;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_image' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }
        // end for each

        $notification = array(
            'message' => "Product Has Been Successfully Inserted",
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);
    }
    // end function

    public function VendorEditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);

        return view('vendor.backend.product.vendor_edit_product', compact('products', 'brands', 'categories', 'subcategory', 'multiImgs'));
    }
    // end func


    public function VendorUpdateProduct(Request $request, $id)
    {
        $product_id = $id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,

            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => "Vendor Product Updated Successfully Without Image",
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);
    }
    // end func

    public function UpdateVendorProductThumbnail(Request $request, $id)
    {
        $product_id = $id;
        $oldImg = $request->old_img;

        if ($request->hasFile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $imageName);
            $save_url = 'upload/products/thumbnail/' . $imageName;

            if (file_exists($oldImg)) {
                unlink($oldImg);
            }

            Product::findOrFail($product_id)->update([
                'product_thumbnail' => $save_url,
                'updated_at' => now(),
            ]);
        }
        $notification = [
            'message' => "Vendor Product Thumbnail Image Updated Successfully.",
            'alert-type' => 'success'
        ];
        return redirect()->route('vendor.all.product')->with($notification);
    }
    // end func

    // vendor multi image

    public function VendorUpdateProductMultiimage(Request $request, $id)
    {
        $imgs = $request->multi_img;

        // Check if $imgs is not null before looping over it
        if ($imgs) {
            foreach ($imgs as $id => $img) {
                $imgDel = MultiImg::findOrFail($id);

                // Check if the file exists before attempting to delete
                if (file_exists($imgDel->photo_image)) {
                    unlink($imgDel->photo_image);
                }

                $multiimageName = time() . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $multiimageName);

                $uploadPath = 'upload/products/multi-image/' . $multiimageName;

                MultiImg::where('id', $id)->update([
                    'photo_image' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // end foreach

        $notification = [
            'message' => "Vendor's Product Multi Image Updated Successfully.",
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    // // end func   
    
    
     // delete Multi image
     public function VendorMultiImgDelete($id)
     {
         $oldImg = MultiImg::findOrFail($id);
         if (file_exists($oldImg->photo_image)) {
             unlink($oldImg->photo_image);
         }
 
         MultiImg::findOrFail($id)->delete();
         $notification = [
             'message' => "Vendor's Product Multi Image Deleted Successfully.",
             'alert-type' => 'info'
         ];
         return redirect()->back()->with($notification);
     }
     // end func    


      // Inactive product
    public function VendorInactiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = [
            'message' => "Vendor Product Deactivated Successfully.",
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }
    // end func

    // active product
    public function VendorActiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = [
            'message' => "Vendor Product Activated Successfully.",
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    // end func

    public function VendorDeleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Unlink the main product thumbnail
        if (file_exists($product->product_thumbnail)) {
            unlink($product->product_thumbnail);
        }

        // Delete the main product record
        Product::findOrFail($id)->delete();

        // Retrieve and loop through multi images
        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            // Unlink each multi image file if it exists
            if (file_exists($img->photo_image)) {
                unlink($img->photo_image);
            }

            // Delete each multi image record
            $img->delete();
        }

        $notification = [
            'message' => "Vendor's Product Deleted Successfully.",
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }
    // end func
}
