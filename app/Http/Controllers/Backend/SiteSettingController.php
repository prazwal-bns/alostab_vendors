<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function SiteSetting(){
        $setting = SiteSetting::find(1);
        return view('backend.site_setting.update_setting',compact('setting'));
    }
    // END FUNCTION

    public function SiteSettingUpdate(Request $request){
        $setting_id = $request->id;
        
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(916, 292)->save('upload/logo/' . $imageName);
            $save_url = 'upload/logo/' . $imageName;

            SiteSetting::findOrFail($setting_id)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'copyright' => $request->copyright,
                'logo' => $save_url,
            ]);

            $notification = array(
                'message' => "Site Setting Updated Successfully",
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            SiteSetting::findOrFail($setting_id)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'copyright' => $request->copyright,
            ]);

            $notification = array(
                'message' => "Site Setting Updated Successfully Without Logo",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    // END FUNCTION

    public function SeoSetting(){
        $seo = Seo::find(1);
        return view('backend.site_setting.update_seo', compact('seo'));
    }
    // END FUNCTION

    public function SeoSettingUpdate(Request $request){
        $seo_id = $request->id;

        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);

        $notification = array(
            'message' => "SEO Setting Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } 
}
