<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ADMIN\EmailIntegrationsController;
use Illuminate\Http\Request;
use App\Models\{User};
use App\Models\Frontend\{Contactus,HomeContent,SubscriberEmail};
use Validator,Redirect,DB;
use Carbon\Carbon;
class HomeController extends Controller
{

	/**
     * Store a new contact us request .
     */
	public function postContactuss(Request $request)
{
    $rules = [
        'name'    => 'required|min:3|max:100',
        'email'   => 'required|email|max:150',
        'message' => 'required|max:2000',
        'file'    => 'nullable|mimes:pdf,doc,docx|max:2048',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return json_response(['status' => false, 'msg' => $validator->messages()->first()], 400);
    }

    $request->type = 'Contactus';

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $originalFileName = $file->getClientOriginalName();

        // Generate a unique filename
        $fileName = time() . '_' . pathinfo($originalFileName, PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension();

        // Build the complete file path
        $filePath = 'contact_files/' . $fileName;

        // Move the uploaded file to the public disk
        $file->move(public_path('contact_files'), $fileName);

        try {
            // Log the file path before storing
            \Log::info('File Path: ' . $filePath);

            // File upload logic here
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
        }
    }

    $contactusData = [
        'name'     => $request->input('name'),
        'email'    => $request->input('email'),
        'message'  => $request->input('message'),
        'type'     => 'Contactus',
        'filepath' => $filePath,
    ];

    // Use the standard create method
    Contactus::create($contactusData);

    // create subscribe contact
    (new EmailIntegrationsController())->create_subscribe_user($request);

    return response()->json(['status' => true, 'msg' => trans('frontend_msg.contactus_succ')], 200);
}

	
public function postContactus(Request $request)
{
    $rules = [
        'name'    => 'required|min:3|max:100',
        'email'   => 'required|email|max:150',
        'message' => 'required|max:2000',
        'file'    => 'nullable|mimes:pdf,doc,docx|max:2048',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'msg' => $validator->messages()->first()], 400);
    }
    $obj = Contactus::firstOrNew(['id' => $request->id]);
    $obj->name = $request->name;
    $obj->email = $request->email;
    $obj->message = $request->message;
	$obj->type= 'Contactus';
    // Handle file upload
    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $obj->filepath = $request->file('file')->store($obj->folderPath());
    }
    $obj->save();
// create subscribe contact
(new EmailIntegrationsController())->create_subscribe_user($request);
    return response()->json(['status' => true, 'msg' => trans('frontend_msg.contactus_succ')], 200);
}
	/**
     * Store a new news letter request .
     */
	public function postNewsletter(Request $request){
		$rules = [
			'email'    => 'required|email|max:150',
		];
		$msg['email.required'] = trans('frontend_msg.req_email');
		$msg['email.email'] = trans('frontend_msg.wrong_email_format');
		$validator = Validator::make($request->all(), $rules,$msg);
		if ($validator->fails())
			return json_response(['status' => false, 'msg' => $validator->messages()->first()], 400);

		$is_exist = SubscriberEmail::where(['email'=>$request->email])->first();
		if($is_exist){
			return response()->json(['status' => false, 'msg' => trans('frontend_msg.already_have_news_letter_email')], 200);
		}
		/**
		 * create subcribe contact  
		 */
		(new EmailIntegrationsController())->create_subscribe_user($request);

		return response()->json(['status' => true, 'msg' => trans('frontend_msg.newsletter_succ')], 200);
	}

	/**
     * after registration verify email
     */
	public function emailVerify(Request $request)
	{
		$rules['token'] = 'required|exists:password_reset_tokens,token';
		$msg['token.required'] = trans('frontend_msg.req_token');
		$msg['token.exists'] = trans('frontend_msg.invalid_token');

		$validator = Validator::make($request->all(), $rules,$msg);
		if ($validator->fails()){
		    $data = ['success'=>false,'message'=>$validator->messages()->first()];
		    return view('email_success_error_page',$data);
		}
		$tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->first();
		if(empty($tokenData)){
		    $data = ['success'=>false,'message'=>trans('frontend_msg.invalid_token')];
		    return view('email_success_error_page',$data);
		}
		//update status 
		User::where('email',$tokenData->email)->update(["is_email_verified" => 1,'email_verified_at'=>Carbon::now()]);

		//destroyed email
		DB::table('password_reset_tokens')->where(['email'=>$tokenData->email])->delete();
		$data = ['success'=>true,'message'=>trans('frontend_msg.succ_email_verified')];

		return view('email_success_error_page', $data);
	}

	/**
     * get advertising for specific pages.
     */
	public function get_advertize(Request $request) {
		$data = HomeContent::where(['is_active'=>1,'type'=>'Advertisement','page_name'=>$request->page_name])->first();
		$html = '<a target="_blank" rel="nofollow noreferrer noopener" href="'.$data->link.'"><img src="'. $data->image.'" alt="'.$data->header.'"  />
		</a>';
		return response()->json(['status' => true, 'msg' => trans('frontend_msg.contactus_succ'),'html'=>$html], 200);
	}
	public function folderPath()
    {
        return "contact_us/" . strtolower(date("FY"));
    }

}