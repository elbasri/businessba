<?php

namespace App\Orbscope\Controllers;
use Illuminate\Http\Request;
use App\Orbscope\Models\Setting;
use Illuminate\Support\Facades\Schema;

class SettingsController extends Controller
{
    // Get Website Settings
    public static function GetSetting()
    {
        $orbscopeSetting = (object)
        [
            'name'                   => '{"en":"orbscope","ar":"اورب سكوب"}'  ,
            'email'                  => 'admin@orbscope.com',
            'phone'                  => '0227258161',
            'mobile'                 => '01007772426',
            'color'                  => '#3498db',
            'login_color'            => '#3498db',
            'logo'                   => '',
            'icon'                   => '',
            'keywords'               => '',
            'description'            => '',
            'address'                => '',
            'admin_path'             => 'admin',
            'admin_theme'            => 'layout1',
            'website_theme'          => '',
            'language'               => 'en',
            'enable_watermark'       => 'yes',
            'watermark_image'        => '',
            'watermark_position'     =>'left',
            'watermark_offset'       => '',
            'multi_lang'             =>'yes',
            'website_status'         =>'open',
            'close_message'          => '',
            'allow_register'         => 'yes',
            'allow_admin_theme'      => 'yes',
            'allow_website_theme'    => 'no',
            'session_timeout'        => '1800',
            'contact_image'          => '',
            'homepageImage'          => '',
            'homepageTitle'          => '{"en":"Welcome To Egadvance","ar":"مرحبا في ايجي ادفانس"}',
            'about_image'            => '',
            'about_title'            => ' {"en":"About","ar":"من نحن"} ',
            'contact_title'          => ' {"en":"Contact","ar":"تواصل معنا"} ',
            'footer_desc'          => ' {"en":"Footer Small Desc","ar":"هذا نص تجريبي"} ',
            'address_lang'           => 30.0444196,
            'address_lat'            => 31.23571160000006,
            'zoom'                   => 6,
            'facebook'               => 'https://www.facebook.com',
            'twitter'                => 'https://www.twitter.com',
            'googleplus'             => 'https://www.googleplus.com',
            'linkedin'                => 'https://www.linkedin.com',
        ];

        if(Schema::hasTable('settings'))
        {
            $settings = Setting::orderBy('id','desc')->first();
            if(!empty($settings))
            {
                return $settings;
            }
            else
            {
                $settings = new Setting;
                $settings->name                  = $orbscopeSetting->name;
                $settings->email                 = $orbscopeSetting->email;
                $settings->phone                 = $orbscopeSetting->phone;
                $settings->mobile                = $orbscopeSetting->mobile;
                $settings->color                 = $orbscopeSetting->color;
                $settings->login_color           = $orbscopeSetting->login_color;
                $settings->logo                  = $orbscopeSetting->logo;
                $settings->icon                  = $orbscopeSetting->icon;
                $settings->keywords              = $orbscopeSetting->keywords;
                $settings->description           = $orbscopeSetting->description;
                $settings->address               = $orbscopeSetting->address;
                $settings->admin_path            = $orbscopeSetting->admin_path;
                $settings->admin_theme           = $orbscopeSetting->admin_theme;
                $settings->website_theme         = $orbscopeSetting->website_theme;
                $settings->language              = $orbscopeSetting->language;
                $settings->enable_watermark      = $orbscopeSetting->enable_watermark;
                $settings->watermark_image       = $orbscopeSetting->watermark_image;
                $settings->watermark_position    = $orbscopeSetting->watermark_position;
                $settings->watermark_offset      = $orbscopeSetting->watermark_offset;
                $settings->multi_lang            = $orbscopeSetting->multi_lang;
                $settings->website_status        = $orbscopeSetting->website_status;
                $settings->close_message         = $orbscopeSetting->close_message;
                $settings->allow_register        = $orbscopeSetting->allow_register;
                $settings->allow_admin_theme     = $orbscopeSetting->allow_admin_theme;
                $settings->allow_website_theme   = $orbscopeSetting->allow_website_theme;
                $settings->session_timeout       = $orbscopeSetting->session_timeout;
                $settings->contact_image         = $orbscopeSetting->contact_image;
                $settings->about_image           = $orbscopeSetting->about_image;
                $settings->about_title           = $orbscopeSetting->about_title;
                $settings->contact_title         = $orbscopeSetting->contact_title;
                $settings->address_lat           = $orbscopeSetting->address_lat;
                $settings->address_lang          = $orbscopeSetting->address_lang;
                $settings->zoom                  = $orbscopeSetting->zoom;
                $settings->homepageImage         = $orbscopeSetting->homepageImage;
                $settings->homepageTitle         = $orbscopeSetting->homepageTitle;
                $settings->facebook              = $orbscopeSetting->facebook;
                $settings->twitter               = $orbscopeSetting->twitter;
                $settings->googleplus            = $orbscopeSetting->googleplus;
                $settings->linkedin              = $orbscopeSetting->linkedin;
                $settings->footer_desc           = $orbscopeSetting->footer_desc;

                $settings->save();
                return $settings;
            }
        }
        else
        {
            return $orbscopeSetting;
        }

    }

    // Update Website Information
    public function SaveSettings(Request $request)
    {

    }

    // Save Value Of Language
    public static function SaveLanguage($lang)
    {
        if(auth()->user())
        {

            $user = auth()->user();
            $user->lang = $lang;
            $user->save();

        }elseif(session()->has('lang'))
        {
            session()->forget('lang');
            session()->put('lang',$lang);
        }else{
            session()->put('lang',$lang);
        }
        return $lang;
    }

    // Get Current Language
    public static function GetLanguage()
    {
        if(auth()->user())
        {
            if(!empty(auth()->user()->lang))
            {
                return auth()->user()->lang;
            }else{
                return self::GetSetting()->language;
            }
        }elseif(session()->has('lang'))
        {
            return session()->get('lang');
        }else{
            return self::GetSetting()->language;
        }
    }

    // Change Language
    public function ChangeLanguage($lang=null)
    {

        if(!empty($lang))
        {
            self::SaveLanguage($lang);
        }else{
            self::SaveLanguage(self::GetSetting()->language);
        }
        return back();
    }

}
