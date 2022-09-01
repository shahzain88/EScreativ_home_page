<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function products()
    {
        $data = array();
        $data['title'] = "Product";
        $data['menu'] = "Product";
        $data['about'] = About::first();
        $data['products'] = Product::where('status', 1)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.productsList', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['products'] = Product::latest()->get();
        $data['menu'] = "Product";
        $data['submenu'] = "View-Product";
        return view('backend.pages.product.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Product";
        $data['submenu'] = "Create-Product";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'product_name' => 'required|max:190|unique:products',
                'product_price' => 'nullable|max:190',
                'category_id' => 'nullable',
                'product_details' => 'nullable',
                'service_name' => 'nullable',
                'service_cost' => 'nullable',
                'service_description' => 'nullable',
                'construction_site' => 'nullable',
                'product_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_price = $request->product_price;
            $product->category_id = $request->category_id;
            $product->product_details = $request->product_details;
            $product->service_name = $request->service_name;
            $product->service_cost = $request->service_cost;
            $product->service_description = $request->service_description;
            $product->construction_site = $request->construction_site;
            $product->created_by = Auth::id();
            $product->status = $request->status ? $request->status : false;

            $image = $request->file('product_image');
            $slug = Str::slug($request->product_name, '-');
            if ($image) {
                $image_name = $slug;
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/products/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $product->product_image = $image_url;
                }
            }

            if ($product->save()) {
                $data['status'] = true;
                $data['message'] = "Product saved successfully.";
                $data['product'] = $product;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Product save failed! Please try again...";
                $data['product'] = $product;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['menu'] = "Product";
        $data['submenu'] = "Create-Product";
        $data['product'] = Product::find($id);
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['menu'] = "Product";
        $data['submenu'] = "Create-Product";
        $data['product'] = Product::find($id);
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'product_name' => 'required|max:190|unique:products,product_name,' . $id,
                'product_price' => 'nullable|max:190',
                'category_id' => 'nullable',
                'product_details' => 'nullable',
                'service_name' => 'nullable',
                'service_cost' => 'nullable',
                'service_description' => 'nullable',
                'construction_site' => 'nullable',
                'product_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $product = Product::find($id);

            if ($product) {
                $product->product_name = $request->product_name;
                $product->product_price = $request->product_price;
                $product->category_id = $request->category_id;
                $product->product_details = $request->product_details;
                $product->service_name = $request->service_name;
                $product->service_cost = $request->service_cost;
                $product->service_description = $request->service_description;
                $product->construction_site = $request->construction_site;
                $product->created_by = Auth::id();
                $product->status = $request->status ? $request->status : false;

                $image = $request->file('product_image');
                $slug = Str::slug($request->product_name, '-');
                if ($image) {
                    if ($product->product_image) {
                        unlink($product->product_image);
                    }
                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/products/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $product->product_image = $image_url;
                    }
                }

                if ($product->save()) {
                    $data['status'] = true;
                    $data['message'] = "Product saved successfully.";
                    $data['product'] = $product;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Product save failed! Please try again...";
                    $data['product'] = $product;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Product not found! Please try again...";
                $data['product'] = $product;
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($product->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Product deleted successfully!";
                    $data['product'] = $product;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Product delete failed! Please try again...";
                    $data['product'] = $product;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Product not found!";
                $data['product'] = $product;
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
