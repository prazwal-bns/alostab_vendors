<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function AllCategory()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_all', compact('category'));
    }
    // end function
    public function AddCategory()
    {
        return view('backend.category.add_category');
    }
    // end function
    public function StoreCategory(Request $request){

        $image = $request->file('category_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(400,400)->save('upload/category/'.$imageName);
        $save_url = 'upload/category/'.$imageName;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => "Category Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }
    //end function

   



    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }
    // end function
    public function UpdateCategory(Request $request, $id)
    {
        $category_id = $id;
        $old_image = $request->old_image;

        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/category/' . $imageName);
            $save_url = 'upload/category/' . $imageName;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => "Category Updated Successfully",
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        } else {
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = array(
                'message' => "Category Updated Successfully Without Image",
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        }
    }
    // end function
    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => "Category Deleted Successfully",
            'alert-type' => "info"
        );
        return redirect()->back()->with($notification);
    }
    // end function
}
