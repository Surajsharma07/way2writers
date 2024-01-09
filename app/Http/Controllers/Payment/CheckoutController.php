<?php

namespace App\Http\Controllers\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Http\Request;
use App\Models\Frontend\{Product,ProductMeta};
use App\Models\{Order,OrderProduct};
use Cart,Redirect, Session,Str,Storage,Auth;
use LaravelDaily\Invoices\Invoice;
use App\Models\DeliveryOptions;
use LaravelDaily\Invoices\Classes\{Buyer,InvoiceItem};
class CheckoutController extends Controller
{
    /**
     * Checkout index page
     */
    public function index(Request $request)
    {
        if (auth()->check()) {

        if (Cart::instance('default')->count() > 0) {  //if the cart has items
            $subtotal = Cart::instance('default')->subtotal() ?? 0;
            $discount = session('coupon')['discount'] ?? 0;
            $newSubtotal = $subtotal - $discount > 0 ? $subtotal - $discount : 0;
            $tax = 0;
            $total = $tax + $newSubtotal;
            $deliveryOption = $request->input('deliveryOption');
            $includeCoverLetter = $request->input('includeCoverLetter');
            $deliveryOptionDetails = DeliveryOptions::find($deliveryOption);
            $totalPrice = $request->input('totalPrice');
            $title = $request->input('name');
            return view('frontend.checkout.index')->with([
                'total_product'=>Cart::instance('default')->count(),
                'subtotal' => $subtotal,
                'delivery_option' => $deliveryOptionDetails->name ?? '',
                'discount' => $discount,
                'newSubtotal' => $newSubtotal,
                'total' => $total,
                'tax' => $tax,
                'discount_code'=> session('coupon')['code'] ?? "",
                'deliveryOption' => $deliveryOption,
        'includeCoverLetter' => $includeCoverLetter,
        'totalPrice' => $totalPrice,
            ]);
        }
        return redirect()->route('frontend.cart.index')->withError('You have nothing in your cart, please add some products first');
    } else {
        return view('checkout.guest_checkout');
    }
    
    }
    public function guest_checkout()
    {
  
        if (Cart::instance('default')->count() > 0) {  //if the cart has items
            $subtotal = Cart::instance('default')->subtotal() ?? 0;
            $discount = session('coupon')['discount'] ?? 0;
            $newSubtotal = $subtotal - $discount > 0 ? $subtotal - $discount : 0;
            $tax = 0;
            $total = $tax + $newSubtotal;
        return view('frontend.checkout.guest_checkout')->with([
                'total_product'=>Cart::instance('default')->count(),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'newSubtotal' => $newSubtotal,
                'total' => $total,
                'tax' => $tax,
                'discount_code'=> session('coupon')['code'] ?? "",
            ]);
        }
        return redirect()->route('frontend.cart.index')->withError('You have nothing in your cart, please add some products first');
    } 


    /**
     * common function for managing payment 
     */
    public function store(Request $request)
    {
        $contents = Cart::instance('default')->content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();

        try {
            $subtotal = Cart::instance('default')->subtotal() ?? 0;
            $discount = session('coupon')['discount'] ?? 0;
            $newSubtotal = $subtotal - $discount > 0 ? $subtotal - $discount : 0;

            $data['total_amount'] = $newSubtotal;
            $data['contents'] = $contents;
            $data['email'] = Auth::user()->email;

            if($request->gateway != "free"){
                session()->put('gateway',$request->gateway);  //stored payment gateway into session
            }
            
            switch ($request->gateway){
                case "paypal":
                   return (new PayPalPaymentController())->handlePayment($data);
                break;
                case "stripe":
                    return (new StripePaymentController())->stripe($data);
                break;
                case "razorpay":
                    return (new RazorpayController())->razorpay($data);
                break;
                case "free":
                    if($subtotal > 0){
                        session()->flash("error", trans('frontend_msg.something_went_wrong'));
                        return Redirect::back();
                    }
                    return $this->paymentSuccess($data);
                break;
                default:
				session()->flash("error", trans('frontend_msg.payment_type_not_found'));
				return Redirect::back();
		    }
            return Redirect::back();
        } catch (Exception $e) {
            return back()->withError('Error ' . $e->getMessage());
        }
    }
        
    public function gueststore(Request $request)
    {
        try {
            // Check if the user is already logged in
            if (Auth::check()) {
                return redirect()->route('frontend.checkout');
            }
    
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|string|max:15',
                'gateway' => 'required|in:paypal,stripe,razorpay,free',
            ]);
    
            // Create a new user for the guest
            $user = User::create([
                'full_name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'role' => ('1'),
                'role_type' => ('USER'),
                'password' => Hash::make(Str::random(12)), // Generate a random password for the guest
            ]);
    
            // Log in the created user
            Auth::login($user);
    
            // Continue with the payment process
            $contents = Cart::instance('default')->content()->map(function ($item) {
                return $item->model->slug . ', ' . $item->qty;
            })->values()->toJson();
    
            $subtotal = Cart::instance('default')->subtotal() ?? 0;
            $discount = session('coupon')['discount'] ?? 0;
            $newSubtotal = $subtotal - $discount > 0 ? $subtotal - $discount : 0;
    
            $data['total_amount'] = $newSubtotal;
            $data['contents'] = $contents;
            $data['email'] = $user->email;
    
            if ($request->gateway != "free") {
                session()->put('gateway', $request->gateway);  //stored payment gateway into session
            }
    
            switch ($request->gateway) {
                case "paypal":
                    return (new PayPalPaymentController())->handlePayment($data);
                    break;
                case "stripe":
                    return (new StripePaymentController())->stripe($data);
                    break;
                case "razorpay":
                    return (new RazorpayController())->razorpay($data);
                    break;
                case "free":
                    if ($subtotal > 0) {
                        session()->flash("error", trans('frontend_msg.something_went_wrong'));
                        return redirect()->route('frontend.cart.index');
                    }
                    return $this->paymentSuccess($data);
                    break;
                default:
                    session()->flash("error", trans('frontend_msg.payment_type_not_found'));
                    return redirect()->route('frontend.cart.index');
            }
        } catch (Exception $e) {
            return back()->withError('Error ' . $e->getMessage());
        }
    }
    

    // getting cart contents
private function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['code'] ?? null;
    
    $subtotal = Cart::instance('default')->subtotal();
    $newSubtotal = $subtotal - $discount;
    
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    
    $newTax = $newSubtotal * $tax;
    $totalProductsAmount = 0;
    
    foreach (Cart::instance('default')->content() as $item) {
        $itemAmount = $item->price * $item->qty - $item->options->cover_letter_price - $item->options->delivery_option_price ?? 0;
        $coverLetterAmount = $item->options->cover_letter_price * $item->qty ?? 0;
        $deliveryOptionAmount = $item->options->delivery_option_price ?? 0;
        $totalProductsAmount += $itemAmount + $coverLetterAmount + $deliveryOptionAmount;
    }
    
    $newTotal = $totalProductsAmount + $newTax;
    
    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal
    ]);
}

// Store record into order table
private function insertIntoOrdersTable($request, $error)
{
    $numbers = $this->getNumbers(); // Retrieve numbers from the getNumbers function

    $order = Order::create([
        'user_id' => auth()->user() ? auth()->user()->id : null,
        'tnx_id' => 'TNX' . strtoupper(Str::uuid()),
        'payment_id' => @$request['payment_id'],
        'payer_id' => @$request['payer_id'],
        'status' => @$request['status'] ?? 1,
        'billing_email' => @$request['email'],
        'billing_phone' => @$request['phone'],
        'payment_method' => @$request['payment_method'],
         'payment_gateway' => session()->get('gateway') ?? null,
        'billing_discount' => $numbers->get('discount'),
        'billing_discount_code' => $numbers->get('code'),
        'billing_subtotal' => $numbers->get('newSubtotal'),
        'billing_tax' => $numbers->get('newTax'),
        'billing_total' => $numbers->get('newTotal'),
        'json_response' => serialize($request['json_response']),
        'error' => $error,
    ]);

    /**
     * Storing order product on behalf of order ID
     */
    foreach (Cart::instance('default')->content() as $item) {
        OrderProduct::create([
            'product_id' => $item->model->id,
            'price' => $item->model->price,
            'order_id' => $order->id,
            'quantity' => $item->qty,
            'variants' => (is_array($item->options->variants) && @$item->options->variants[0]) ? serialize(@$item->options->variants) : null,
            'include_cover_letter' => $item->options->get('include_cover_letter'),  // Use get method
            'cover_letter_price' => $item->options->get('cover_letter_price'),      // Use get method
            'delivery_option_name' => $item->options->get('delivery_option'),      // Use get method
            'delivery_option_price' => $item->options->get('delivery_option_price'),  // Use get method
        ]);
       
    
    }

    return $order;
}


    //Increse Product sale count
    private function increaseDownloadCounts()
    {
        foreach (Cart::instance('default')->content() as $item) {
            $product = Product::find($item->model->id);
            $product->update(['sale_count' => $product->sale_count + 1]);
        }
    }

    /**
    * after payment success cart items are stored in the database
   */
    public function paymentSuccess($request){ 

        $data['payment_id'] = $request->token ?? '';
        $data['payer_id'] = $request->PayerID ?? '';
        $data['payment_method'] = @$request->payment_method ?? '';
        $data['email'] = @$request->email ?? '';
        $data['phone'] =  @$request->phone ?? '';
        $data['json_response'] = @$request->json_response;

        $order = $this->insertIntoOrdersTable($data, null);
        $this->increaseDownloadCounts();
        Cart::instance('default')->destroy();
        session()->forget('coupon');
        session()->forget('gateway');
        $tnxId = @$order->tnx_id ?? '';
        return redirect()->route('frontend.success.transaction', ['tnxId' => $tnxId]);
    }

    
  /**
    * after stored in the database redirect to the transaction success page with the download file
   */
    public function transactionSuccess(Request $request)
    {
        $Order = Order::where(['user_id'=>auth()->id(),'tnx_id'=>$request->tnxId])->firstOrFail();
        $OrderProduct = OrderProduct::where('order_id',$Order->id)->get();
        $newFileArr=[];
        foreach ($OrderProduct as $key => $v1) {
            $ProductMeta = (object) ProductMeta::where('product_id',$v1->product_id)->pluck('value','key')->toArray();
            $fileArr = unserialize(@$ProductMeta->multi_file);
            if(!empty($v1->variants)){
                $variants = unserialize($v1->variants);
            
                foreach ($variants as $key => $v2) {
                    foreach ($fileArr as $key => $v3) {

                        if($v3['file_price'] == $v2['price_id']  || $v3['file_price'] == "ALL"){
                            $v3['product_id'] = base64url_encode($v1->product_id);
                            unset($v3['file_external_url']);
                            unset($v3['file_url']);
                            $newFileArr[] = $v3;
                        } 
                    }
                }
            }else{
                foreach ($fileArr as $key => $v3) {
                    $v3['product_id'] = base64url_encode($v1->product_id);
                    unset($v3['file_external_url']);
                    unset($v3['file_url']);
                    $newFileArr[] = $v3;
                }
            }
        }
        $data['tnxId'] = $request->tnxId;
        $data['fileArr'] = $newFileArr;
        $data['order'] = $Order;
        return view('frontend.checkout.payment-success',$data);
    }

    //Download product 
    public function downlaod_invoice(Request $request)
    {
        $order = Order::where(['user_id' => auth()->id(), 'tnx_id' => $request->tnx_id])->firstOrFail();
        $setting = getSetting();
        $user = Auth::user();
        $client = new Buyer([
            'name' => $setting->site_name,
        ]);
        $customer = new Buyer([
            'name' => $user->full_name,
            'custom_fields' => [
                'email' => $user->email,
            ],
        ]);
    
        $items = [];
    
        foreach ($order->getOrderProduct as $orderProduct) {
            $product = $orderProduct->getProduct;
    
            // Check if $product is a collection or a single model instance
            if ($product instanceof \Illuminate\Database\Eloquent\Collection) {
                // If $product is a collection, use $product->first() to get the first item
                $product = $product->first();
            }
    
            if (!empty($orderProduct->variants)) {
                $variants = unserialize($orderProduct->variants);
                foreach ($variants as $variant) {
                    $title = $product->name . ' ' . $variant['option_name'];
                    $items[] = (new InvoiceItem())->title($title)->pricePerUnit($variant['price']);
                }
            } else {
                $pricePerUnit = $product->is_free == '1' ? 0 : ($product->is_offer != '0' ? $product->offer_price : $product->price);
                $items[] = (new InvoiceItem())->title($product->name)->pricePerUnit($pricePerUnit);
            }
    
            // Add cover letter details to the invoice
            if ($orderProduct->include_cover_letter) {
                $items[] = (new InvoiceItem())->title(__('Cover Letter'))->pricePerUnit($orderProduct->cover_letter_price);
            }
    
            // Add delivery option details to the invoice
            $items[] = (new InvoiceItem())->title('Delivery -' .$orderProduct->delivery_option_name)->pricePerUnit($orderProduct->delivery_option_price);
        }
    
        $logo = Storage::url($setting->my_logo);
        $invoice = Invoice::make();
        $invoice->seller($client);
        if (!empty($order->billing_discount)) {
            $invoice->totalDiscount($order->billing_discount);
        }
        $invoice->buyer($customer)
            ->date($order->created_at)
            ->dateFormat('d M Y')
            ->currencySymbol($setting->default_symbol)
            ->currencyCode($setting->default_currency)
            ->addItems($items)
            ->totalAmount($order->billing_total + @$order->billing_discount ?? 0);
    
        return $invoice->stream();
    }
    public function downlaodfile(request $request)
    {
        $Order = Order::where(['user_id'=>auth()->id(),'tnx_id'=>$request->tnx_id])->firstOrFail();
        $ProductMeta = (object) ProductMeta::where('product_id',base64_decode($request->pid))->pluck('value','key')->toArray();
        $fileArr = unserialize(@$ProductMeta->multi_file);
        foreach($fileArr as $key => $file){
         
            if($file['file_id'] == $request->file_id){
                $newfilename = (!empty($file['file_name']) ? $file['file_name'] : '').'.'.substr($file['file_url'], strrpos($file['file_url'], '.') + 1);
              
                if(isset($file['file_url']) && !empty($file['file_url'])){
                    if(Storage::exists($file['file_url'])){
                        return Storage::download($file['file_url'],$newfilename);
                    }
                    return;
                }
                if(isset($file['file_external_url']) && !empty($file['file_external_url'])){
                    return Redirect::to($file['file_external_url'],$newfilename);
                }
            }
        }

        return back();
    }     
}