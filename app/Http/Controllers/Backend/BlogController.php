<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    
    // ------------------------------> START BLOG CATEGORY <--------------------------------------
    public function AllBlogCategory(){
        $blogCategories = BlogCategory::latest()->get();
        return view('backend.blog.category.all_blogcategory',compact('blogCategories'));
    }
    // END FUNCTION

    public function AddBlogCategory(){
        return view('backend.blog.category.add_blogcategory');
    }
    // END FUNCTION


    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
            'created_at' => Carbon::now()
        ]);
        $notification = array([
            'messge' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->route('all.blog.category')->with($notification);
    }
    // END FUNCTION
    
    public function EditBlogCategory($id){
        $blogCategories = BlogCategory::findOrFail($id);
        return view('backend.blog.category.edit_blogcategory',compact('blogCategories'));
    }
    // END FUNCTION

    public function UpdateBlogCategory(Request $request){
        $blog_id = $request->id;
        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
            'updated_at' => Carbon::now()
        ]);
        $notification = array([
            'messge' => 'Blog Category Updated Successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->route('all.blog.category')->with($notification);
    }
    // END FUNCTION

    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();
        $notification = array([
            'messge' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }
    // END FUNCTION

    // ------------------------------> END BLOG CATEGORY <--------------------------------------


    // ------------------------------> START BLOG POSTS <--------------------------------------
    public function AllBlogPosts(){
        $blogPosts = BlogPost::latest()->get();
        return view('backend.blog.posts.all_blogposts', compact('blogPosts'));
    }

    public function AddBlogPost()
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('backend.blog.posts.add_blogpost',compact('blogCategories'));
    }
    // END FUNCTION


    public function StoreBlogPost(Request $request)
    {
        $save_url = null; // Default value for the brand image

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image'); // Fix the field name here
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1103, 906)->save('upload/blog/' . $imageName);
            $save_url = 'upload/blog/' . $imageName;
        }

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Blog Post Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.posts')->with($notification);
    }
    // END FUNCTION

    public function EditBlogPost($id)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);
        return view('backend.blog.posts.edit_blogpost', compact('blogCategories', 'blogPost'));
    }
    // END FUNCTION
    
    public function UpdateBlogPost(Request $request)
    {
        $post_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1103, 906)->save('upload/blog/' . $imageName);
            $save_url = 'upload/blog/' . $imageName;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            BlogPost::findOrFail($post_id)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'post_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Blog Post Updated Successfully.",
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog.posts')->with($notification);
        } else {
            BlogPost::findOrFail($post_id)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Blog Post Updated Successfully Without Image",
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.posts')->with($notification);
        }
    }
    // END FUNCTION

    public function DeleteBlogPost($id){
        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' => "Blog Post Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // END FUNCTION



    // ------------------------------> END BLOG CATEGORY <--------------------------------------


    // ------------------------------> START FRONTEND BLOG <--------------------------------------
    public function AllBlog(){
        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::latest()->get();
        return view('frontend.blog.home_blog',compact('blogCategories', 'blogPost'));
    }
    // END FUNCTION

    public function BlogDetails($id, $slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogDetails = BlogPost::findOrFail($id);
        $breadCat = BlogCategory::where('id', $blogDetails->category_id)->get(); // Retrieve the category associated with the blog post
        return view('frontend.blog.blog_details', compact('blogCategories', 'blogDetails', 'breadCat'));
    }

    // END FUNCTION

    public function PostCategory($id, $slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::where('category_id',$id)->get();
        $breadCat = BlogCategory::where('id', $id)->get(); 
        return view('frontend.blog.category_post', compact('blogCategories', 'blogPost', 'breadCat'));
    }

    // END FUNCTION
    // ------------------------------> END FRONTEND BLOG <--------------------------------------

}
