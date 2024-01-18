<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }
    // end function

    public function AddSlider()
    {
        return view('backend.slider.add_slider');
    }
    // end function


    public function StoreSlider(Request $request){

        $image = $request->file('slider_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/slider/'.$imageName);
        $save_url = 'upload/slider/'.$imageName;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

        $notification = array(
            'message' => "Slider Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }
    // end function

    public function EditSlider($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }
    // end function

    public function UpdateSlider(Request $request, $id)
    {
        $slider_id = $id;
        $old_image = $request->old_image;

        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('upload/slider/' . $imageName);
            $save_url = 'upload/slider/' . $imageName;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);

            $notification = array(
                'message' => "Slider Updated Successfully",
                'alert-type' => 'success'
            );

            return redirect()->route('all.slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);

            $notification = array(
                'message' => "Slider Updated Successfully Without Image",
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        }
    }
    // end function

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => "Slider Deleted Successfully",
            'alert-type' => "info"
        );
        return redirect()->back()->with($notification);
    }
    // end function


}
