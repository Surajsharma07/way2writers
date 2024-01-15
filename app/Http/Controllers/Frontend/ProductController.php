<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\{Product,ProductMeta,ProductCategory,ProductSubCategory};
use App\Models\ProductAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Response;
class ProductController extends Controller
{
    /**
     * get single proudct details
     */
    public function single_details(Request $request,$slug)
    {
        $product = Product::where(['slug'=>$slug,'is_active'=> 1])->firstOrFail();
        $data['product'] = $product;
        $data['product_meta']= (object) ProductMeta::where('product_id',$product->id)->pluck('value','key')->toArray();
        
        //store product view
        $obj = ProductAnalysis::firstOrNew(['ip_adress'=> request_ip()]);
        $obj->product_id = $product->id;
        $obj->browser = get_user_agent($request->header('User-Agent'));
        $obj->device = (isMobileDev($request->header('User-Agent'))) ? 'Mobile' : 'Desktop';
        $obj->ip_adress = request_ip();
        $obj->page_name = 'SingleProduct';
        $obj->save();
        return  response(view('frontend.product.single_details',$data));
    }

     /**
     * search prouduct page
     */
    public function search()
    {
        $product = new Product();
        $data['total_prod']= $product->where('is_active',1)->count();
        $data['total_sale_prod']= $product->where('is_offer',2)->count();
        return view('frontend.product.search',$data);
    }
    /**
     * search prouduct with filter by ajax 
     */
    public function ajax_search_product(Request $request){
        $query = Product::query();
        $query->where('is_active',1);
        if(@$request->search_text){
            $query->where(function($q) use ($request){
                $q->where('name','like','%'.$request->search_text.'%');
            });
        }

        if(@$request->category_id[0])
        $query->whereIn('category_id',$request->category_id);
    
        if(isset($request->start_price) && isset($request->end_price))
        $query->whereBetween('price',[$request->start_price,$request->end_price]);

        if(isset($request->is_sale))
        $query->where('is_offer',2);

        if(isset($request->rating))
        $query->whereIn('rating',$request->rating);

        if(@$request->sort_by == 'price-desc')
            $query->orderBy('price','DESC');
        else
            $query->orderBy('price','ASC');

        $data = $query->paginate(9);
        $html= view('frontend.search.product_search', ['data' =>$data,'p_view'=>@$request->p_view])->render();
        return response()->json(['status' => true, 'html_response' =>$html,'last_page'=>$data->lastPage(),'current_page'=>$data->currentPage()], 200);
    }

}
