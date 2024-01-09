<?php

namespace App\Http\Controllers\ADMIN;
use App\Models\Blogcategory;
use App\Models\Blogs;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        //$data['data']= Blogs::filter()->orderBy('id','DESC')->paginate(10);
        $data['all_category'] = Blogcategory::where('status',1)->get();
        //$data['sub_category'] = BlogController::where('is_active',1)->get();
        $data = Blogs::all();
        return view('admin.blog.index',compact('data'));
    }
    public function create()
    {
        //$data['data']= Blogs::filter()->orderBy('id','DESC')->paginate(10);
        $data['all_category'] = Blogcategory::where('status',1)->get();
        //$data['sub_category'] = BlogController::where('is_active',1)->get();
        
        return view('admin.blog.create',$data);
    }
    public function store(Request $request)
{
    $rules = [
        'name' => 'required',
        'description' => 'required',
        'meta_title' => 'required',
        'meta_keyword' => 'required',
        'category_id' => 'required',
        'meta_description' => 'required',
        'image' => 'required',
    ];

    $msg = [
        'name.required' => trans('msg.name'),
        'description.required' => trans('msg.description'),
        'meta_title.required' => trans('msg.meta_title'),
        'meta_keywords.required' => trans('msg.meta_keywords'),
        'meta_description.required' => trans('msg.meta_description'),
        'image.required' => trans('msg.image_required'),
        'image.image' => trans('msg.image_invalid_format'),
        'image.max' => trans('msg.image_max_size'),
    ];

    $validator = Validator::make($request->all(), $rules, $msg);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'msg' => $validator->messages()->first()], 400);
    }

    $obj = Blogs::firstOrNew(['id' => $request->id]);
    $obj->name = $request->name;
    $obj->slug = $request->slug;
    $obj->description = $request->description;
    $obj->meta_title = $request->meta_title;
    $obj->meta_keyword = $request->meta_keyword;
    $obj->meta_description = $request->meta_description;
    $obj->category_id = $request->category_id;
    $obj->created_by = Auth::user()->id;

    // Handle image upload
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $obj->image = $request->file('image')->store($obj->folderPath());
    }
    $obj->save();

    $msg = (isset($request->id) && !empty($request->id)) ? trans('msg.page_upd') : trans('msg.page_add');

    return redirect()->route('admin.blog.index')->with('success', $msg);
}

    public function edit(string $id)
{
    $data = Blogs::find($id);

    if (empty($data)) {
        return redirect()->route('admin.blog.index');
    }

    $all_category = Blogcategory::where('status', 1)->get();

    return view('admin.blog.create', compact('data', 'all_category'));
}

    public function destroy(string $id)
    {
       
        $data = Blogs::find($id);
        $data->delete();
        return response()->json(['status' => true,'msg' =>trans('msg.category_del')], 200);       
    }
    public function folderPath()
    {
        return "blogs/" . strtolower(date("FY"));
    }
    public function show()
    {
        //$data['data']= Blogs::filter()->orderBy('id','DESC')->paginate(10);
        $data['all_category'] = Blogcategory::where('status',1)->get();
        //$data['sub_category'] = BlogController::where('is_active',1)->get();
        $data = Blogs::all();
        return view('admin.blog.index',compact('data'));
    }
}

