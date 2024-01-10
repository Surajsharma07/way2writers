<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Product,ProductMeta,ProductCategory,ProductSubCategory,Comments,Rating};
use Validator;
use Illuminate\Validation\Rule;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data']= Product::filter()->orderBy('id','DESC')->paginate(10);
        $data['all_category'] = ProductCategory::where('is_active',1)->get();
        $data['sub_category'] = ProductSubCategory::where('is_active',1)->get();
        return view('admin.product.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addProductStep1()
    {
        $data['all_category'] = ProductCategory::where('is_active',1)->get();
        $data['sub_category'] = ProductSubCategory::where('is_active',1)->get();
        return view('admin.product.step1',$data);
    }
    public function addProductStep2($id)
    {
        $data = Product::find($id);
        if(empty($data)){
          return redirect()->route('admin.product.index');
        }
        $data['product_id'] = $id;
        return view('admin.product.step2',$data);
    }

    
    /**
     * Product store step one for a newly created and update resource in storage.
     */
    public function storeProductStep1(Request $request)
    {
        $rules['product_type'] = 'required';
        $rules['name'] = 'required';
        $rules['slug'] = ['required',Rule::unique('products')->where(function($query) use($request){
            $query->where('id', '!=', @$request->product_id);
        })];
        $rules['category_id'] = 'required';
        $rules['sub_category_id'] = 'required';
        $rules['description'] = 'required';
        $rules['meta_title'] = 'required';
        $rules['meta_keywords'] = 'required';
        $rules['meta_desc'] = 'required';
        $msg['name.required'] = trans('msg.product_name');
        $msg['slug.required'] =trans('msg.product_url');
        $validator = Validator::make($request->all(), $rules,$msg);
        if ($validator->fails())
            return response()->json(['status' => false, 'msg' => $validator->messages()->first()], 400);
        $pdArr = [];

        $obj = Product::firstOrNew(['id'=>@$request->product_id]);
        $obj->user_id = auth()->id();
        $obj->is_featured = @$request->is_featured ?? 0;
        $obj->fill($request->all());
        $obj->slug = \Str::slug($request->slug);

        //created an array of product update version details
        if(isset($request->product_key[0])){
            foreach ($request->product_key as $key => $value)
            {   
                $arr1['key'] = $value;
                $arr1['value'] = @$request->product_value[$key];
                $pdArr[] = $arr1;
            }
            $obj->product_details = serialize($pdArr);
        }
        $obj->save();

       
        if(isset($request->product_id) && !empty($request->product_id)){ //if proudct id is exist
            $msg = trans('msg.product_upd');
            $url = route('admin.product.edit.step2',['id'=>$obj->id]);
        }
        else{
            $msg = trans('msg.product_add');
            $url = route('admin.product.create.step2',['id'=>$obj->id]);
        }
        //return response()->json(['status' => true,'msg' =>$msg,'url'=>$url], 200);
       // return redirect()->route($url);
       // return redirect()->route('admin.order.index');
       return redirect()->route('admin.product.edit.step2',['id'=>$obj->id]);
    }
    /**
     * Product store step two for a newly created and update resource in storage.
     */
    public function storeProductStep2(Request $request)
    {
        if(empty($request->product_id)){
            $rules['image'] = 'required';
        }
        if(request()->file('image')){
            $rules['image'] = ['mimes:jpeg,jpg,png,gif,svg','max:1000'];
        }
        if(request()->file('preview_imgs')){
            $rules['preview_imgs.*'] = ['mimes:jpeg,jpg,png,gif,svg','max:1000'];
        }

        if($request->is_enable_multi_price == 1){ //if product have multiple price
            $rules['option_name.*'] = 'required';
            $rules['price.*'] = 'required';
        }
        else{
            if($request->is_free == 0){  //if product is free
                $rules['single_price'] = 'required';
            }
        }
        
        if($request->file_type == 0){ //file type 0 is a single file 
            $rules['file_name.*'] = 'required';
            if($request->is_enable_multi_price == 1){
                 $rules['file_price.*'] = 'required';
            }
            $rules['file_external_url.*'] = 'required_without:file.*';
            $rules['file.*'] = 'required_without:file_external_url';
        }
            

        $msg['single_price.required'] = trans('msg.product_price');
        $msg['image.required'] =  trans('msg.product_image');
        $msg['image.mimes'] =  trans('msg.req_product_image_mimes');
        $msg['option_name.*'] =  "Option Name is required.";
        $msg['price.*'] =  "Price is required";
        $msg['file_name.*'] =  "File Name is required.";
        $msg['file_price.*'] =  "File Price is required.";
        $msg['file_external_url.*'] =  "External file url required";
        $msg['file.*'] =  "file is required";
        
        $validator = Validator::make($request->all(), $rules,$msg);
        if ($validator->fails())
            return response()->json(['status' => false, 'msg' => $validator->messages()->first()], 400);
        
        $productObj = new Product();

        /**
        * In step one basic details are stored in the product table some extra fields are remaining so we store them in second time.
        */
        
        $obj = Product::find($request->product_id);
        $obj->price = @$request->single_price ?? 0;
        $obj->is_enable_multi_price = $request->is_enable_multi_price ?? 0;
        $obj->file_type = $request->file_type;
        $obj->is_free = $request->is_free ?? 0;
        $obj->is_offer = $request->is_offer ?? 0;
        if(@$request->single_offer_price)
            $obj->offer_price = @$request->single_offer_price ?? 0;
        if(!empty($request->start_offer))
            $obj->start_offer = $request->start_offer;
        if(!empty($request->end_offer))
            $obj->end_offer = $request->end_offer;
        $obj->save();

        $preview_imgs = $fileArr = $finalArr = $multiPrice = $multifiles = [];

         //if product have multiple price created array
        if(isset($request->is_enable_multi_price) && $request->is_enable_multi_price == 1){
            foreach ($request->price as $key => $value)
            {   
                $arr1['price_id'] = (!empty($request->price_id[$key])) ? $request->price_id[$key] : ($key+1);
                $arr1['option_name'] = @$request->option_name[$key];
                $arr1['price'] =$value;
                $arr1['default_price'] = @$request->default_price[$key + 1];
                $arr1['offer_price'] = @$request->offer_price[$key];
                $multiPrice[] = $arr1;
            }

            $finalArr['multi_price'] = serialize($multiPrice);
        }
    
        if(request()->file('file')){
            foreach(request()->file('file') as $key1 => $uploadedFile){
                if($uploadedFile){
                    $fileArr[$key1] = $uploadedFile->store($productObj->filefolderPath()); //for getting file folder path
                }
            }
        }

        //if product have multiple file created array
        foreach ($request->file_name as $key2 => $value)
        {   
            $arr3['file_id'] = (!empty($request->file_id[$key2])) ? $request->file_id[$key2] : unique_key(); //generate unique file name 
            $arr3['file_name'] = @$request->file_name[$key2];
            $arr3['file_external_url'] = @$request->file_external_url[$key2] ?? '';
        
            if (@$fileArr[$key2]){
                $arr3['file_url'] = @$fileArr[$key2];
            }else{
                $arr3['file_url'] = @$request->file[$key2];
            }
            $arr3['file_price'] = @$request->file_price[$key2];
            $multifiles[] = $arr3;
        }

        //when a product updated preview images are exist
        if(isset($request->preview_imgs_arr) && !empty($request->preview_imgs_arr)){
            $preview_imgs = $request->preview_imgs_arr;
        }

       
        // Upload Preview Images
        if(request()->file('preview_imgs')){
            foreach(request()->file('preview_imgs') as $key3 => $uploadedFile){
                if($uploadedFile){
                    $preview_imgs[] = $uploadedFile->store($productObj->previewfolderPath());
                }
            }
        }

        $finalArr['multi_file'] = serialize($multifiles); //converted all array files into serialized
        $finalArr['enable_multi_option'] = $request->enable_multi_option ?? 0;
        $finalArr['last_modify_by'] = auth()->id();
        $finalArr['file_type'] = $request->file_type;
        $finalArr['preview_imgs'] = serialize($preview_imgs); //converted all array images into serialized

        //Create and update product Meta
        foreach ($finalArr as $key => $value)
        {
            $obj = ProductMeta::firstOrNew(['product_id'=>@$request->product_id,'key' => $key]);
            $obj->key = $key;
            $obj->value = $value;
            $obj->save();
        }
    

        return response()->json(['status' => true,'msg' =>trans('msg.product_upd'),'url'=>route('admin.product.index')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['all_category'] = ProductCategory::where('is_active',1)->get();
        $data['sub_category'] = ProductSubCategory::where('is_active',1)->get();
        $data['data'] = Product::find($id);
        if(empty($data)){
          return redirect()->route('admin.product.index');
        }
        $data['product_id'] = $id;
        return view('admin.product.step1',$data);
    }

    public function editProductStep2(string $id)
    {
        $data['product'] = Product::find($id);
        $res = ProductMeta::where('product_id',$id)->pluck('value','key')->toArray();
        
        if(!empty($res))
        $data['data']= (object)$res;
        $data['product_id'] = $id;
        return view('admin.product.step2',$data);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obj = Product::find($id);
        if($obj->is_active == 1){
            $obj->is_active = 0;
            $msg = trans('msg.de_active');
        }
        else{
            $obj->is_active = 1;
            $msg = trans('msg.active');
        }
        $obj->save();
        return redirect()->route('admin.product.step2');
       // return response()->json(['status' => true,'msg' =>$msg], 200);
    }
    public function update_status_featured(Request $request, string $id)
    {
        $obj = Product::find($id);
        if($obj->is_featured == 1){
            $obj->is_featured = 0;
            $msg = trans('msg.status_update');
        }
        else{
            $obj->is_featured = 1;
            $msg = trans('msg.status_update');
        }
        $obj->save();
        return response()->json(['status' => true,'msg' =>$msg], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Product::find($id);
        $data->delete();
        // ProductMeta::where('product_id',$id)->delete();
        return response()->json(['status' => true,'msg' =>trans('msg.product_del')], 200);       
    }

    //Comment 
    public function comment_view(string $id)
    {
        $data['data'] = Comments::where('product_id',$id)->paginate(20);
        if(empty($data)){
          return redirect()->route('admin.product.index');
        }
        return view('admin.product.comment',$data);
    }

    //Review 
    public function review_view(string $id)
    {
        $data['data'] = Rating::where('product_id',$id)->paginate(20);
        if(empty($data)){
          return redirect()->route('admin.product.index');
        }
        return view('admin.product.review',$data);
    }
}