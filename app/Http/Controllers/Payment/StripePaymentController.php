<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Cart;
use App\Models\Frontend\Product;
class StripePaymentController extends Controller
{
   /**
    * stripe form page
   */
    public function stripe($request): View
    {
        $setting = getSetting();
        if (Cart::instance('default')->count() ==  0) {
            redirect()->route('frontend.cart.index',app()->getLocale());
        }
        if($setting->is_checked_stripe == 0){  //setting stripe is not checked
            redirect()->route('frontend.cart.index',app()->getLocale());
        }
        $data['stripe_key'] = $setting->stripe_key;
        $symbol = $setting->default_symbol ?? '$';
        $data['total_amount'] = @$symbol.$request['total_amount'];
        return view('frontend.gateways.stripe',$data);
    }
      
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function handlePayment(request $request): RedirectResponse
    {
        try {
            $setting = getSetting();
            if($setting->is_checked_stripe == 1){
                Stripe\Stripe::setApiKey($setting->stripe_secret_key);
                $contents = Cart::instance('default')->content()->map(function ($item) {
                    return $item->model->name . ', ' . $item->qty;
                })->values()->toJson();

                $subtotal = Cart::instance('default')->subtotal() ?? 0;
                $discount = session('coupon')['discount'] ?? 0;
                $newSubtotal = $subtotal - $discount > 0 ? $subtotal - $discount : 0;
                $email = auth()->user()->email;

                //Create payment 
                $charge = Stripe\Charge::create([
                    'amount' => $newSubtotal * 100,
                    'currency' => $setting->default_currency ?? 'USD',
                    'source' => $request->stripeToken,
                    'description' => 'Order',
                    'receipt_email' => $email,
                    'metadata' => [
                        'contents' => $contents,
                        'quantity' => Cart::instance('default')->count(),
                        'discount' => session()->has('coupon') ? json_encode(session('coupon')) : null,
                    ],
                ]);

                if (!empty($charge) && $charge['status'] == 'succeeded') { //if success
                    $data = (object)[]; 
                    $data->token = $charge->id;
                    $data->receipt_url = $charge->receipt_url;
                    $data->json_response = $charge;
                    return (new CheckoutController())->paymentSuccess($data); //redirect to payment success 
                } else {
                    return response()->route('frontend.cancel.payment',app()->getLocale());
                }
            }
        }catch (\Exception $e) {
            return redirect()->route('frontend.cancel.payment',app()->getLocale())->withError('Error ' . $e->getMessage());
        }
         return redirect()->route('frontend.cart.index',app()->getLocale());
    }
}