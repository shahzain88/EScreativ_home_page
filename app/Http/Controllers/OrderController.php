<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function generateUniqueUsername($name)
    {
        $username = Str::slug($name, '-');
        $i = 0;
        while (User::where('username', $username)->exists()) {
            $i++;
            $username = $username . '-' . $i;
        }
        return $username;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['menu'] = "Order";
        $data['submenu'] = "View-Order";
        $data['orders'] = Order::with('user')->latest()->get();
        return view('backend.pages.order.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->product_ids)) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $user = new User();
                $user->name = $request->name;
                $user->username = $this->generateUniqueUsername($request->name);
                $user->email = $request->email;
                $user->role_id = 6;
                $user->password = Hash::make("12345678");
                $user->save();

                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->customer_id = date('Ymd') . '-' . $user->id;
                $customer->first_name = $request->name;
                $customer->address = $request->address;
                $customer->mobile = $request->mobile;
                $customer->email = $request->email;
                $customer->save();
            }

            $cost = 0;
            foreach ($request->product_ids as $key => $product_id) {
                $price = Product::find($product_id);
                $cost = $cost + ($request->quantity[$product_id][0] * $price->product_price);
            }

            $order = new Order();
            $order->user_id = $user->id;
            $order->cost = $cost;
            $order->expenses = $request->expenses;
            $order->discount = $request->discount;
            $order->construction_details = $request->construction_details;
            $order->validity = $request->validity;
            $order->save();


            foreach ($request->product_ids as $index => $product_id) {
                $cart = new Cart();
                $price = Product::find($product_id);
                $cart->product_id = $product_id;
                $cart->price = $price->product_price;
                $cart->quantity = $request->quantity[$product_id][0];
                $cart->user_id = $user->id;
                $cart->order_id = $order->id;
                $cart->save();
            }

            Session::flash('message', "Successful");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $customer = Customer::where('user_id', $order->user_id)->first();
        $cart = Cart::where('order_id', $id)->get();
        $data = array();
        $data['customer'] = $customer;
        $data['carts'] = $cart;
        $data['order'] = $order;
        return view('frontend.pages.shop.invoice', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                if ($order->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Order deleted successfully!";
                    $data['order'] = $order;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Order delete failed! Please try again...";
                    $data['order'] = $order;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Order not found!";
                $data['order'] = $order;
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }
}
