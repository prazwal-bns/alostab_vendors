<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function AllBanner()
    {
        $banners = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('banners'));
    }
    // end function

    public function AddBanner()
    {
        return view('backend.banner.add_banner');
    }
    // end function

    public function StoreBanner(Request $request){

        $image = $request->file('banner_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$imageName);
        $save_url = 'upload/banner/'.$imageName;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);

        $notification = array(
            'message' => "Banner Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);
    }
    // end function

    public function EditBanner($id)
    {
        $banners = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', compact('banners'));
    }
    // end function

    public function UpdateBanner(Request $request, $id)
    {
        $banner_id = $id;
        $old_image = $request->old_image;

        if ($request->file('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('upload/banner/' . $imageName);
            $save_url = 'upload/banner/' . $imageName;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
            ]);

            $notification = array(
                'message' => "Slider Updated Successfully",
                'alert-type' => 'success'
            );

            return redirect()->route('all.banner')->with($notification);
        } else {
            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
            ]);

            $notification = array(
                'message' => "Banner Updated Successfully Without Image",
                'alert-type' => 'success'
            );
            return redirect()->route('all.banner')->with($notification);
        }
    }
    // end function

    public function DeleteBanner($id)
    {
        $banners = Banner::findOrFail($id);
        $img = $banners->banner_image;
        unlink($img);

        Banner::findOrFail($id)->delete();
        $notification = array(
            'message' => "Banner Deleted Successfully",
            'alert-type' => "info"
        );
        return redirect()->back()->with($notification);
    }
    // end function
}
