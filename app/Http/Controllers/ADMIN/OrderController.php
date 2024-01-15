<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,OrderProduct,User};
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Order = new Order();
        $data['data'] =  $Order->filter()->orderBy('id','DESC')->paginate(10);

        $data['today_revenue'] = $Order->whereDate('created_at', today())->sum('billing_total');
        $data['weekly_revenue'] = $Order->whereBetween('created_at', [today()->startOfWeek(), today()->endOfWeek()])->sum('billing_total');
        $data['monthly_revenue'] = $Order->whereBetween('created_at', [today()->startOfMonth(), today()->endOfMonth()])->sum('billing_total');
        $data['total_revenue'] = $Order->sum('billing_total');
            
        $data['searchable'] =  Order::$searchable;
        return view('admin.order.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.order.create_or_edit');
    }

    /**
     * Store a newly created and update resource in storage.
     */
    public function store(Request $request)
    {
        $rules['name'] = 'required';
        $rules['slug'] = ['required',Rule::unique('product_categories')->where(function($query) use($request){
            $query->where('id', '!=', @$request->category_id);
        })];
        
        $msg['name.required'] = "Category Name is required.";
        $msg['slug.required'] = "Category Name Url is required.";
        $validator = Validator::make($request->all(), $rules,$msg);
        if ($validator->fails())
            return response()->json(['status' => false, 'msg' => $validator->messages()->first()], 400);
        
        $obj = Order::firstOrNew(['id'=>$request->category_id]);
        $obj->name = $request->name;
        $obj->slug = \Str::slug($request->slug);
        $obj->is_featured = $request->is_featured ?? 0;
        $obj->ishave_product = $request->ishave_product ?? 0;
        $obj->save();

        $msg = (isset($request->category_id) && !empty($request->category_id))? trans('msg.category_upd') : trans('msg.category_add');
        return response()->json(['status' => true,'msg' =>$msg,'url'=>route('admin.pro_category.index')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Order::find($id);
        if(empty($data)){
            return redirect()->route('admin.order.index');
        }
        return view('admin.order.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Order::find($id);
        if(empty($data)){
          return redirect()->route('admin.pro_category.index');
        }
        return view('admin.order.edit',compact('data'));
    }

    /**
     * Update the status specified resource in storage.
     */
 

    // ... Other controller imports ...
    public function update(Request $request, string $id)
{
    $obj = Order::with('user')->find($id);

    // Check if the order was found
    if (!$obj) {
        return response()->json(['status' => false, 'msg' => 'Order not found'], 404);
    }

    // Check if all order product statuses are "completed"
    $allCompleted = $obj->getOrderProduct->every(function ($orderProduct) use ($request) {
        return $request->input('status')[$orderProduct->id] == 'completed';
    });

    // If all order product statuses are "completed," update the order status
    if ($allCompleted) {
        $obj->status = '4';
        $obj->save();
    }
    // Iterate through order products for file uploads
    foreach ($obj->getOrderProduct as $orderProduct) {
        // Update order product resumeStatus
        $orderProduct->resumeStatus = $request->input('status')[$orderProduct->id];
        $orderProduct->save();

        // Handle main product file upload
        if ($request->hasFile('main_product_file')) {
            $mainProductFile = $request->file('main_product_file')[$orderProduct->id];

            // Get customer's name using the relationship
            $customerName = optional($obj->user)->full_name;

            // Check if the customer's name is available
            if (!$customerName) {
                return response()->json(['status' => false, 'msg' => 'Customer name not available'], 400);
            }

            // Build the desired path
            $desiredPath = "resumes/" . strtolower(date("F Y")) . "/$customerName";

            // Generate a unique filename
            $fileName = pathinfo($mainProductFile->getClientOriginalName(), PATHINFO_FILENAME)
                        . time() . '.' . $mainProductFile->getClientOriginalExtension();

            // Build the complete file path
            $mainProductFilePath = $desiredPath . '/' . $fileName;

            // Move the uploaded file to the desired location
            $mainProductFile->move(public_path($desiredPath), $fileName);

            $orderProduct->file_upload_path = $mainProductFilePath;
        }

        // Handle cover letter file upload
        if ($orderProduct->include_cover_letter && $request->hasFile('cover_letter_file')) {
            $coverLetterFile = $request->file('cover_letter_file')[$orderProduct->id];

            // Get customer's name using the relationship
            $customerName = optional($obj->user)->full_name;

            // Check if the customer's name is available
            if (!$customerName) {
                return response()->json(['status' => false, 'msg' => 'Customer name not available'], 400);
            }

            // Build the desired path
            $desiredPath = "cover_letters/" . strtolower(date("F Y")) . "/$customerName";

            // Generate a unique filename
            $fileName = pathinfo($coverLetterFile->getClientOriginalName(), PATHINFO_FILENAME)
                        . time() . '.' . $coverLetterFile->getClientOriginalExtension();

            // Build the complete file path
            $coverLetterFilePath = $desiredPath . '/' . $fileName;

            // Move the uploaded file to the desired location
            $coverLetterFile->move(public_path($desiredPath), $fileName);

            $orderProduct->cover_letter_path = $coverLetterFilePath;
        }

        // Update cover letter status
        $orderProduct->cover_letter_status = $request->input('cover_letter_status')[$orderProduct->id] ?? null;
        $orderProduct->save();
    }
   // return response()->json(['status' => true,'msg' =>trans('updated Successfully')], 200);       
   return redirect()->route('admin.order.index');

}

    public function folderPath()
    {
        return "resumes/" . strtolower(date("FY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Order::find($id);
        $data->delete();
        return response()->json(['status' => true,'msg' =>trans('msg.category_del')], 200);       
    }
}
