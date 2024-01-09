<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\{Product,ProductMeta,Wishlist};
use Cart,Auth;
use App\Models\DeliveryOptions;
class CartController extends Controller
{
     /**
     * Display a listing of the cart items.
     */
    public function index() {
        $product_items = Product::mightAlsoLike()->get();
        return view('frontend.cart.index')->with('product_items', $product_items);
    }

     /**
     * Store a product in a cart
     */
    public function store(Request $request)
    {
        $url = (@$request->buy_now == 1) ? route('frontend.checkout') : route('frontend.cart.index');
    
        $product = Product::where('slug', $request->slug)->first();
        //\Log::debug('Product:', ['product' => $product, 'request' => $request->all()]);
    
        if (empty($product)) {
            return response()->json(['status' => false, 'msg' => trans('frontend_msg.prod_not_found')], 400);
        }
    
        session()->forget('coupon');
    
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id == $product->id;
        });
    
        if ($duplicates->isNotEmpty()) {
            return response()->json(['status' => true, 'msg' => trans('frontend_msg.item_in_your_cart'), 'url' => $url], 200);
        }
    
        $productName = $product->name;
        $variants = [];
    
        // Set the base product price
        $productPrice = ($product->is_free == 1) ? 0 : $product->price;
        $downloadFileArr = [];

        $ProductMeta = (object) ProductMeta::where('product_id', $product->id)->pluck('value', 'key')->toArray();
        
        $fileArr = unserialize(@$ProductMeta->multi_file);
        
        $variants = [];
        // If there are price variants, calculate the sum and adjust the product name
        if (isset($request->price_id) && !empty($request->price_id)) {
            $sum = 0;
            $str = ":-";
    
            foreach ($request->price_id as $key => $price_id) {
                $priceArr = unserialize(@$ProductMeta->multi_price); // Add this line
                foreach ($request->price_id as $key => $price_id) {
    // Extract $priceArr for the current product
    $priceArr = unserialize(@$ProductMeta->multi_price);

    foreach ($request->price_id as $key => $price_id) {
        // Extract $priceArr for the current product
        $priceArr = unserialize(@$ProductMeta->multi_price);
    
        foreach ($priceArr as $k => $row2) {
            if ($price_id == $row2['price_id']) {
                $p = (float)(($product->is_offer != 0) ? $row2['offer_price'] : $row2['price']);
                $sum += $p;
                $str .= (($key == 0) ? ' ' : ' ,') . $row2['option_name'];
    
                $variantArr['price_id'] = $row2['price_id'];
                $variantArr['option_name'] = $row2['option_name'];
                $variantArr['price'] = $p;
                $variants[] = $variantArr;
            }
        }
    }
}}
            Log::info('Price Arr:', ['priceArr' => $priceArr]);

    
            // Update the product price and name
            $productPrice = $sum;
            $productName .= ' ' . $str;
        } elseif ($product->is_offer && $product->is_free != 1) {
            // If there are no price variants, but the product has an offer, use the offer price
            $productPrice = ($product->is_offer == 1 || ($product->is_offer == 2 && $product->start_offer < now() && $product->end_offer > now()))
                ? $product->offer_price
                : $product->price;
        }
       

    
        // Handle delivery option and cover letter
        $deliveryOption = $request->delivery_option ?? null;
        $includeCoverLetter = $request->include_cover_letter ?? 0;
        $deliveryOptionDetails = DeliveryOptions::find($deliveryOption);
        $coverLetterPrice = 350;
        $totalPrice = $productPrice + $deliveryOptionDetails->amount + ($includeCoverLetter ? $coverLetterPrice : 0);
    
        // Add item to cart
        Cart::instance('default')
            ->add($product->id, $productName, 1, $totalPrice, [
                'variants' => $variants,
                'delivery_option' => $deliveryOptionDetails->name ?? '',
                'include_cover_letter' => $includeCoverLetter,
                'delivery_option_price' => $deliveryOptionDetails->amount ?? 0,
                'cover_letter_price' => $includeCoverLetter ? $coverLetterPrice : 0,
               'product_price' => $productPrice,
                ])
            ->associate('App\Models\Frontend\Product');
    
        return response()->json(['status' => true, 'msg' => trans('frontend_msg.prod_added_to_cart'), 'url' => $url], 200);
    }
    
    

    /**
     * Remove the specified resource from cart.
     */
    public function destroy($id, $cart) {
        if($cart == 'default')
        Cart::instance('default')->remove($id);
        session()->flash('success', 'item has been removed');
        return back();
    }
    
    /**
     * Store a newly created and update resource in storage.
     */
    public function addToWishlist(request $request) {
        $product = Product::where('slug',$request->slug)->first();
        if(empty($product)){
            return response()->json(['status' => false, 'msg' => trans('frontend_msg.prod_not_found')], 400); 
        }
        $userId = Auth::id();
        $isExist = Wishlist::where(['user_id'=>$userId,'product_id'=>$product->id])->first();
        if($isExist) //if product already exists ,delete the wishlist
        {
            $isExist->delete();
            return response()->json(['status' => true, 'msg' => trans('frontend_msg.item_remove_form_wishlist')], 200);
        }
        $obj = Wishlist::firstOrNew(['user_id'=>$userId,'product_id'=>$product->id]);
        $obj->user_id = $userId;
        $obj->product_id = $product->id;
        $obj->save();
        return response()->json(['status' => true, 'msg' => trans('frontend_msg.prod_added_to_wishlist')], 200);
    }

     /**
     * Remove the specified resource from wishlist.
     */
    public function removefromWishlist(request $request) {
        $data = Wishlist::find($request->id);
        if(!empty($data))
           $data->delete();
        return back();
    }
}
