<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }
    // end function
    public function AddBrand()
    {
        return view('backend.brand.add_brand');
    }
    // end function

    public function StoreBrand(Request $request)
    {
        $save_url = null; // Default value for the brand image
    
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image'); // Fix the field name here
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $imageName);
            $save_url = 'upload/brand/' . $imageName;
        }
    
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);
    
        $notification = array(
            'message' => "Brand Inserted Successfully",
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.brand')->with($notification);
    }
    

    // end function

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }
    // end function

    public function UpdateBrand(Request $request, $id)
    {
        $brand_id = $id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $imageName);
            $save_url = 'upload/brand/' . $imageName;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => "Brand Updated Successfully",
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => "Brand Updated Successfully Without Image",
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }
    }
    // end function

    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => "Brand Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
