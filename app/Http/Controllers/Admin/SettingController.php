<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Hash;


class SettingController extends Controller
{
    public $services;
    public function __construct(Services $services) {
        $this->services = $services;
    }

    public function profile_setting(Request $request){

        $user = User::first();
        if($request->isMethod('post')){
            if ($request->hasFile('profile_image')){
                $folder = 'admin/assets/images/profile/';
                $width = 170; $height = 170;
                $this->services->imageDestroy($user->profile_image,'admin/assets/images/profile/');
                $data['profile_image'] = $this->services->imageUpload($request->file('profile_image'), $folder,$width,$height);
            }
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            if($request->password) $data['password'] = Hash::make($request->password);
            $user->update($data);
            return redirect()->route('profileSetting')->with('message','Profile Updated');
        }
        return view('admin.pages.profile.profile',compact('user'));
    }

    public function website_setting(Request $request){
        $setting = WebsiteSetting::first();
        if($request->isMethod('post')){
            if ($request->hasFile('favicon_image')){
                $width = 32; $height = 32;
                $folder = 'admin/assets/images/logo/';
                $this->services->imageDestroy($setting->favicon_image,'admin/assets/images/logo/');
                $data['favicon_image'] = $this->services->imageUpload($request->file('favicon_image'), $folder,$width,$height);
            }
            if ($request->hasFile('logo_image')){
                $folder = 'admin/assets/images/logo/';
                $width = 150; $height = 85;
                $this->services->imageDestroy($setting->logo_image,'admin/assets/images/logo/');
                $data['logo_image'] = $this->services->imageUpload($request->file('logo_image'), $folder,$width,$height);
            }
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['facebook_link'] = $request->facebook_link;
            $data['linkedin_link'] = $request->linkedin_link;
            $data['twitter_link'] = $request->twitter_link;
            $setting->update($data);
            return redirect()->route('websiteSetting')->with('message','Website Setting Updated');
        }

        return view('admin.pages.profile.website_profile',compact('setting'));
    }


}
