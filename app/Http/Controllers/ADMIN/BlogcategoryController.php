<?php

namespace App\Http\Controllers\ADMIN;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; 

class BlogcategoryController extends Controller
{
   public function index()
   {
        return view('admin.blog.category.index');
}
public function create()
{
return view('admin.blog.category.create');
}
public function store(Request $request)
{
    dump (request());
    /*
    $id = Auth::user()->id;
    $data = Auth::find($id);
    $data->name = $request->name;
    $data->slug = $request->slug;
   $data->description = $request->description;
    if ($request->file('image')) {
        $file= $request->file('image');
        $filename =time(). '.' . $file->getClientOriginalName();
        $file ->move('uploads/blogs/', $filename);
        $data->image= $filename;
    $data->image = $request->image;
    $data->meta_title = $request->meta_title;
    $data->meta_description = $request->meta_description;
    $data->meta_keywords = $request->meta_keywords;
    $data->navbar_status = $request->navbar_status;
    $data->created_by = Auth::user()->id;
    $data->featured = $request->featured;
    $data->status = $request->status;
    $data->save();
    */

    $rules['name'] = 'required';
        $rules['slug'] = ['required',Rule::unique('blogcats')->where(function($query) use($request){
            $query->where('id', '!=', @$request->category_id);
        })];
    $msg = (isset($request->category_id) && !empty($request->category_id))? trans('msg.category_upd') : trans('msg.category_add');

    return response()->json(['status' => true,'msg' =>$msg,'url'=>route('admin.blog-category.index')], 200);
}}