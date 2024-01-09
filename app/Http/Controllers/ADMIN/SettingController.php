<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Setting};
use App\Models\Admin\Advertisement;
use App\Models\{Languages,Country};
use Validator;
use DB;
class SettingController extends Controller
{
    /**
     * index page of setting 
     */
    public function website_setting_view()
    {
        $data['data'] = (object)Setting::pluck('short_value','key')->toArray();
        $data['langArr'] = Languages::all();
        return view('admin.setting.website',$data);
    }

    /**
     *  Common function for storing setting short values
     */
    public function store(Request $request)
    {
        $request->request->remove('_token');
        $input = $request->all();
        if(count($input) > 0){
            foreach ($request->all() as $key => $value)
            {
                $obj = Setting::firstOrNew(['key' => $key]);
                $obj->key = $key;
                if (request()->hasFile($key) && request()->file($key)->isValid())
                    $obj->short_value = request()->file($key)->store('my_images');
                else
                    $obj->short_value = $value;
                $obj->save();
            }
            return response()->json(['status' => true,'msg' =>trans('msg.setting_upd')], 200);
        }
        return response()->json(['status' => false,'msg' =>trans('msg.something_went_wrong')], 400);
    }

     /**
     *  Common function for storing setting long values
     */
    public function storelongtext(Request $request)
    {
        $request->request->remove('_token');
        $input = $request->all();
        if(count($input) > 0){
            foreach ($request->all() as $key => $value)
            {
                $obj = Setting::firstOrNew(['key' => $key]);
                $obj->key = $key;
                $obj->long_value = $value;
                $obj->save();
            }
            return response()->json(['status' => true,'msg' =>trans('msg.setting_upd')], 200);
        }
        return response()->json(['status' => false,'msg' =>trans('msg.something_went_wrong')], 400);
    }

   /**
     *  Display the social login page 
     */
    public function social_login()
    {      
        $data['data'] = (object)Setting::pluck('short_value','key')->toArray();  
        return view('admin.setting.social_login',$data);
    }

     /**
     *  common function for storing the social login 
     */
   public function updateSettings(Request $request, $platform){
        $request->request->remove('_token'); 
        $input = $request->all();
        foreach ($input as $key => $value) {
            $obj = Setting::firstOrNew(['key' => $key]);
            $obj->short_value = $value;
            putPermanentEnv(strtoupper($key) ,$value);
            $obj->save();
        }   
        $platformName = ucfirst($platform); // Capitalize the platform name
        return response()->json(['status' => true, 'msg' => "$platformName  successfully."], 200);
    }
   
    public function saveSociallogin(Request $request)
    {
        $request->request->remove('_token'); 
        $input = $request->all();
        foreach ($input as $key => $value) {
            $obj = Setting::firstOrNew(['key' => $key]);
            $obj->short_value = str_replace(' ', '', $value);
            putPermanentEnv(strtoupper(str_replace(' ', '', $key)) ,str_replace(' ', '', $value));
            $obj->save();
        }
        return response()->json(['status' => true, 'msg' => "social keys added successfully."], 200);
    }

     /**
     *  Display the menu setting page 
     */
    public function menu(){
        $data['data'] = (object)Setting::pluck('short_value','key')->toArray();
        return view('admin.setting.menu',$data);
    } 

    //show edit details   
    public function email_templates(){
        $data['data'] = (object)Setting::pluck('short_value','key')->toArray();
        return  view('admin.email_integration.email_template',$data);
    }

    //save update value
    public function email_templates_stores(Request $request){
        return $this->updateSettings($request, 'Email Template Update');    
    }

    //Portal Revenue
    public function portal_revenue_view()
    {
        $data['data'] = (object)Setting::pluck('short_value','key')->toArray();
        $obj = new Country();
        $data['currency'] = $obj->whereNotNull('currency_code')->groupBy('currency_code')->get();
        $data['symbol'] = $obj->whereNotNull('symbol')->groupBy('symbol')->get();
        return view('admin.setting.portal_revenue',$data);
    }

     // show specific resources on why_choose_us
     public function payment_setting_view()
     {
        $data['payment_gateways'] = ['PayPal','Stripe','Razorpay'];
        $data['data'] = (object)Setting::pluck('short_value','key')->toArray();
        return view('admin.setting.payment_setting',$data);
     }

}