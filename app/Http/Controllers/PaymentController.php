<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\OrderedProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('webhook');
    }


    public function shipping(){
        $user=Auth::user();
        if(count(Auth::user()->cartitems)>0){
            return view('order.shipping',compact('user'));
        }
        else{
            return view('product.cart-summary');
        }
    }




    public function checkout(Request $request){
        $user=Auth::user();
        $total=0;
        if(count($user->cartitems)>0){
            $lineItems = [];
            Stripe::setApiKey(config('stripe.sk'));

            
            foreach ($user->cartitems as $cartitem) {


            $product_name=$cartitem->product->title;
            $product_image=$cartitem->product->images->first()->url;
            $price=$cartitem->product->price;
            $quantity=$cartitem->quantity;
            $image_url='thedreamhouseinteriors.com'. Storage::url($product_image);
            $total+=$cartitem->product->price;

            $lineItems[]= [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                        'images' => [$image_url],
                    ],
                    'currency' => 'eur',
                    'unit_amount' => $price *100,
                ],
                'quantity' => $quantity,

            ];
            }

            $stripe = new \Stripe\StripeClient('sk_test_51Ng5glFmUvlHusW192qiad03Zfy1H7wRVi8B6vyfyCXtIMJoI8e1ODL4pWQJjeQQ16x0ENHTkBTmRqpeIjQsq9FA00vz60OfMg');

            
            switch($request->state){

            

            case 'IT':

                if($total<70){
                    $session = \Stripe\Checkout\Session::create([
                    'line_items' => [$lineItems],
                    'mode' => 'payment',
                    'customer_email'=>$user->email,
                    'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                    'cancel_url' => route('checkout.canceled', [], true),
                    'customer_creation'=>'always',
                    'shipping_address_collection' => ['allowed_countries' => ['IT']],
                    'shipping_options' => [
                        [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => [
                            'amount' => 800,
                            'currency' => 'eur',
                            ],
                            'display_name' => 'Spedizione Standard',
                            'delivery_estimate' => [
                            'minimum' => [
                                'unit' => 'business_day',
                                'value' => 2,
                            ],
                            'maximum' => [
                                'unit' => 'business_day',
                                'value' => 4,
                            ],
                            ],
                        ],
                        ],
                    ],
                ]);
                break;
                }
                else{
                    $session = \Stripe\Checkout\Session::create([
                        'line_items' => [$lineItems],
                        'mode' => 'payment',
                        'customer_email'=>$user->email,
                        'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                        'cancel_url' => route('checkout.canceled', [], true),
                        'customer_creation'=>'always',
                        'shipping_address_collection' => ['allowed_countries' => ['IT']],
                        'shipping_options' => [
                            [
                            'shipping_rate_data' => [
                                'type' => 'fixed_amount',
                                'fixed_amount' => [
                                'amount' => 0,
                                'currency' => 'eur',
                                ],
                                'display_name' => 'Spedizione Gratuita per ordini superiori ai 70 euro',
                                'delivery_estimate' => [
                                'minimum' => [
                                    'unit' => 'business_day',
                                    'value' => 2,
                                ],
                                'maximum' => [
                                    'unit' => 'business_day',
                                    'value' => 4,
                                ],
                                ],
                            ],
                            ],
                        ],
                    ]);
                    break;
                }

                case 'FR':

                    $session = \Stripe\Checkout\Session::create([
                        'line_items' => [$lineItems],
                        'mode' => 'payment',
                        'customer_email'=>$user->email,
                        'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                        'cancel_url' => route('checkout.canceled', [], true),
                        'customer_creation'=>'always',
                        'shipping_address_collection' => ['allowed_countries' => ['FR']],
                        'shipping_options' => [
                            [
                            'shipping_rate_data' => [
                                'type' => 'fixed_amount',
                                'fixed_amount' => [
                                'amount' => 1600,
                                'currency' => 'eur',
                                ],
                                'display_name' => 'Spedizione Europea',
                                'delivery_estimate' => [
                                'minimum' => [
                                    'unit' => 'business_day',
                                    'value' => 2,
                                ],
                                'maximum' => [
                                    'unit' => 'business_day',
                                    'value' => 7,
                                ],
                                ],
                            ],
                            ],
                        ],
                    ]);
                    break;

                    case 'ES':

                        $session = \Stripe\Checkout\Session::create([
                            'line_items' => [$lineItems],
                            'mode' => 'payment',
                            'customer_email'=>$user->email,
                            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                            'cancel_url' => route('checkout.canceled', [], true),
                            'customer_creation'=>'always',
                            'shipping_address_collection' => ['allowed_countries' => ['ES']],
                            'shipping_options' => [
                                [
                                'shipping_rate_data' => [
                                    'type' => 'fixed_amount',
                                    'fixed_amount' => [
                                    'amount' => 1600,
                                    'currency' => 'eur',
                                    ],
                                    'display_name' => 'Spedizione Europea',
                                    'delivery_estimate' => [
                                    'minimum' => [
                                        'unit' => 'business_day',
                                        'value' => 2,
                                    ],
                                    'maximum' => [
                                        'unit' => 'business_day',
                                        'value' => 7,
                                    ],
                                    ],
                                ],
                                ],
                            ],
                        ]);
                        break;

                        
        }

        // if($session->url==route('order_success'))
            $order = new Order();
            $order->status = 'unpaid';
            foreach ($user->cartitems as $cartitem) {
                $total += $cartitem->price * $cartitem->quantity;
            }

            $order->total_price=$total;
            $order->session_id=$session->id;
            $order->user_id=$user->id;
            $order->save();
            foreach ($user->cartitems as $cartitem) {
                OrderedProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$cartitem->product->id,
                    'quantity'=>$cartitem->quantity,
                ]);
            }

            

            // $order->users()->attach(Auth::id());

            $shipping= new Shipping();
            $shipping->order_id=$order->id;
            $shipping->address=$request->address;
            $shipping->street_number=$request->street_number;
            $shipping->city=$request->city;
            $shipping->country=$request->country;
            $shipping->zip_code=$request->zip_code;
            $shipping->state=$request->state;
            $shipping->save();

            

            return redirect()->intended($session->url);
        }
    }




    public function success(Request $request)
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $sessionId = $request->get('session_id');



        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            

            if (!$session) {
                throw new NotFoundHttpException;
            }



            $order = Order::where('session_id', $session->id)->first();

            
            if (!$order) {
                throw new NotFoundHttpException();
            }

           
            

           
            return view('order.success',compact('order'));


        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }

    public function canceled(Request $request )
    {


           
            return view('order.canceled');
            

            
    }

    public function webhook(){
        
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

    // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order->status  === 'unpaid') {
                        $order->status = 'paid';
                        $order->save();
                        foreach($order->orderedproducts as $orderedproduct){
                            $ordered_quantity=$orderedproduct->quantity;
                            $product_quantity=$orderedproduct->product->quantity;
                            $product_id=$orderedproduct->product->id;
                            $product=Product::where('id', $product_id);
                            $product->update([
                                'quantity'=> $product_quantity - $ordered_quantity,
                            ]);
                        }
                    }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}

