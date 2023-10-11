<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\User;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(count($user->cartitems)>0){
            $lineItems = [];
            Stripe::setApiKey(config('stripe.sk'));


            foreach ($user->cartitems as $cartitem) {


            $product_name=$cartitem->product->title;
            $product_image=$cartitem->product->images->first()->url;
            $total=$cartitem->product->price;
            $quantity=$cartitem->quantity;
            $image_url='127.0.0.1:8000'. Storage::url($product_image);

            $lineItems[]= [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                        'images' => ['https://picsum.photos/200/300'],
                    ],
                    'currency' => 'eur',
                    'unit_amount' => $total *100,
                ],
                'quantity' => $quantity,

            ];
            }




        $session = \Stripe\Checkout\Session::create([
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'customer_email'=>$user->email,
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.canceled', [], true),
        ]);

        // if($session->url==route('order_success'))
            $order = new Order();
            $order->status = 'unpaid';
            foreach ($user->cartitems as $cartitem) {
                $total += $cartitem->price * $cartitem->quantity;
            }

            $order->total_price=$total;
            $order->session_id=$session->id;
            $order->save();
            foreach ($user->cartitems as $cartitem) {
                $order->products()->attach($cartitem->product->id);
            }
            $order->users()->attach(Auth::id());

            $shipping= new Shipping();
            $shipping->order_id=$order->id;
            $shipping->address=$request->address;
            $shipping->street_number=$request->street_number;
            $shipping->city=$request->city;
            $shipping->country=$request->country;
            $shipping->zip_code=$request->zip_code;
            $shipping->state=$request->state;
            $shipping->save();

            foreach($user->cartitems as $cartitem){
                $cartitem->delete();
            }

            return redirect($session->url);
        }
    }




    public function success(Request $request, )
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');


        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if (!$session) {
                throw new NotFoundHttpException;
            }



            $order = Order::where('session_id', $session->id)->first();
            $customer_name=$order->user->name;
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }

            return view('order.success',compact('customer_name'));


        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }

    public function canceled()
    {
        return view('order.canceled');
    }

    public function webhook()
    {

        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
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
            case 'payment_intent.canceled':
                $session = $event->data->object;
                $order = Order::where('session_id', $session->id)->first();
                $order->delete();

            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // Send email to customer
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');

    }

}
