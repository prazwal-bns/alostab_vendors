<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function AllSubCategory(){
        $subcategory = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all',compact('subcategory'));
    }
    // end function
    public function AddSubCategory(){
        $categories = Category::orderBy('category_name','ASC')->get();
        return view('backend.subcategory.add_subcategory',compact('categories'));
    }
    // end function
    public function StoreSubCategory(Request $request){
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => "Sub Category Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }
    // end function

    public function EditSubCategory($id){
        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('categories','subcategory'));
    }
    //end function
    public function UpdateSubCategory(Request $request,$id){
        $subcategory_id = $id;
        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => "Sub Category Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }
    //end function

    public function DeleteSubCategory($id){
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => "Sub Category Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end function


    // for subcategory filtration in add_product page
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);
    }

    // end function
}
