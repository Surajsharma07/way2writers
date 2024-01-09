<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Validation\Rule; 
use App\Models\Blogcategory;
use Illuminate\Http\Request;

class BlogCategoriesController extends Controller
{
    public function index()
    {
         $data['data']= Blogcategory::orderBy('id','DESC')->paginate(10);
         return view('admin.blog.category.index',$data);
         
 }
 public function create()
 {
 return view('admin.blog.category.create');
 }

 public function store(Request $request){
   
   /* $this->validate($request, [
        'name'=> 'required|string', unique_key(''),
        
        'slug'=> 'required',
        ]);

    $Blogcategory = new Blogcategory;
    $Blogcategory->name = $request->name;
    $Blogcategory->slug = $request->slug;
    $obj = Blogcategory::firstOrNew(['id'=>$request->id]);
        $obj->name = $request->name;
        $obj->slug = \Str::slug($request->slug);
        $obj->is_featured = $request->status ?? 0;
    $Blogcategory->save();
    return redirect('admin/blog-category/index')->with('success','done');
}*/

$rules = [
    'name' => 'required',
    'slug' => [
        'required',
        Rule::unique('blogcategories')->ignore($request->id),
    ],
];

$msg = [
    'name.required' => trans('msg.category_name'),
    'slug.required' => trans('msg.category_url'),
];

$validator = Validator::make($request->all(), $rules, $msg);

if ($validator->fails()) {
    return response()->json(['status' => false, 'msg' => $validator->messages()->first()], 400);
}

$obj = Blogcategory::find($request->id);

if (!$obj) {
    // If $obj is not found, create a new instance
    $obj = new Blogcategory;
}

$obj->name = $request->name;
$obj->slug = \Str::slug($request->slug);
$obj->status = $request->status ?? 0;
$obj->save();

$msg = $obj->wasRecentlyCreated ? trans('msg.category_add') : trans('msg.category_upd');

// Flash the success message to be retrieved in the next request
return redirect()->route('admin.blog-category.index')->with('success', $msg);
 }
 public function show(string $id)
{
    //
}
public function edit(string $id)
{
    $data = Blogcategory::find($id);

    if (empty($data)) {
        return redirect()->route('admin.blog-category.index');
    }
    
    return view('admin.blog.category.create', compact('data'));
}
public function update(Request $request, string $id)
    {
         
        $obj = Blogcategory::find($id);
        if($obj->status == 1){
            $obj->status = 0;
            $msg = trans('msg.de_active');
        }
        else{
            $obj->status = 1;
            $msg = trans('msg.active');
        }
        $obj->save();
        return response()->json(['status' => true,'msg' =>$msg], 200);
    }
    public function destroy(string $id)
    {
       
        $data = Blogcategory::find($id);
        $data->delete();
        return response()->json(['status' => true,'msg' =>trans('msg.category_del')], 200);       
    }

}

