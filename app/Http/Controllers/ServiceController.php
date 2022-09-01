<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title, '-');
        $i = 0;
        while (Service::where('slug', $slug)->exists()) {
            $i++;
            $slug = $slug . '-' . $i;
        }
        return $slug;
    }

    public function services()
    {
        $data = array();
        $data['title'] = "Services";
        $data['menu'] = "Service";
        $data['about'] = About::first();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)
                            ->inRandomOrder()->limit(6)->get();
        $data['services'] = Service::with('category')->where('status', 1)->latest()->paginate(10);
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.services', $data);
    }

    public function serviceDetails($slug, $id)
    {
        $data = array();
        $data['title'] = "Services";
        $data['menu'] = "Service";
        $data['about'] = About::first();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)
                            ->inRandomOrder()->limit(6)->get();
        $data['service'] = Service::with('category', 'images')->where('status', 1)->where('id', $id)->first();
        $data['galleries'] = Gallery::where('status', 1)->inRandomOrder()->limit(4)->get();
        return view('frontend.pages.serviceDetails', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['services'] = Service::with('category')->latest()->get();
        $data['menu'] = "Service";
        $data['submenu'] = "View-Service";
        return view('backend.pages.service.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Service";
        $data['submenu'] = "Create-Service";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.service.create', $data);
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
                'title' => 'required|max:190|unique:services',
                'category_id' => 'required',
                'unit_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'info' => 'nullable|max:250',
                'description' => 'nullable',
                'details_content' => 'nullable',
                'sales_point' => 'nullable',
                'price_list' => 'nullable',
                'work_content' => 'nullable',
                'flow_to_work' => 'nullable',
                'before_booking' => 'nullable',
                'cancellation_policy' => 'nullable',
                'about_the_store' => 'nullable',
                'feature_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueSlug($request->title);

            $service = new Service();
            $service->title = $request->title;
            $service->category_id = $request->category_id;
            $service->info = $request->info;
            $service->slug = $slug;
            $service->unit_price = $request->unit_price;
            $service->description = $request->description;
            $service->details_content = $request->details_content;
            $service->sales_point = $request->sales_point;
            $service->price_list = $request->price_list;
            $service->work_content = $request->work_content;
            $service->flow_to_work = $request->flow_to_work;
            $service->before_booking = $request->before_booking;
            $service->cancellation_policy = $request->cancellation_policy;
            $service->about_the_store = $request->about_the_store;

            $service->created_by = Auth::id();
            $service->status = $request->status ? $request->status : false;

            $image = $request->file('feature_image');
            $image_name = 'service-' . rand(100, 999) . '-' . date("Ymd");
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $upload_path = 'uploads/services/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $service->feature_image = $image_url;
            }
            if ($service->save()) {
                $moreImages = $request->file('images');
                if ($moreImages) {
                    foreach ($moreImages as $image) {
                        $image_name = 'service-' . rand(100, 999) . '-' . date("Ymd");
                        $ext = strtolower($image->getClientOriginalExtension());
                        $image_full_name = $image_name . "." . $ext;
                        $upload_path = 'uploads/services/';
                        $image_url = $upload_path . $image_full_name;
                        $success = $image->move($upload_path, $image_full_name);
                        if ($success) {
                            $serviceImg = new ServiceImage();
                            $serviceImg->image = $image_url;
                            $serviceImg->service_id = $service->id;
                            $serviceImg->save();
                        }
                    }
                }

                $data['status'] = true;
                $data['message'] = "Service saved successfully.";
                $data['service'] = $service;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Service save failed! Please try again...";
                $data['service'] = $service;
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['menu'] = "Service";
        $data['submenu'] = "View-Service";
        $data['service'] = Service::with('category', 'images')->find($id);
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.service.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['menu'] = "Service";
        $data['submenu'] = "View-Service";
        $data['service'] = Service::with('category', 'images')->find($id);
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.service.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:190|unique:services,title,' . $id,
                'category_id' => 'required',
                'unit_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'info' => 'nullable|max:250',
                'description' => 'nullable',
                'details_content' => 'nullable',
                'sales_point' => 'nullable',
                'price_list' => 'nullable',
                'work_content' => 'nullable',
                'flow_to_work' => 'nullable',
                'before_booking' => 'nullable',
                'cancellation_policy' => 'nullable',
                'about_the_store' => 'nullable',
                'feature_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueSlug($request->title);

            $service = Service::find($id);

            if ($service) {
                $service->title = $request->title;
                $service->category_id = $request->category_id;
                $service->info = $request->info;
                $service->slug = $slug;
                $service->unit_price = $request->unit_price;
                $service->description = $request->description;
                $service->details_content = $request->details_content;
                $service->sales_point = $request->sales_point;
                $service->price_list = $request->price_list;
                $service->work_content = $request->work_content;
                $service->flow_to_work = $request->flow_to_work;
                $service->before_booking = $request->before_booking;
                $service->cancellation_policy = $request->cancellation_policy;
                $service->about_the_store = $request->about_the_store;
                $service->created_by = Auth::id();
                $service->status = $request->status ? $request->status : false;
                $image = $request->file('feature_image');
                if ($image) {
                    if ($service->feature_image) {
                        unlink($service->feature_image);
                    }

                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/services/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $service->feature_image = $image_url;
                    }
                }

                if ($service->save()) {
                    $moreImages = $request->file('images');
                    if ($moreImages) {
                        foreach ($moreImages as $image) {
                            $image_name = 'service-' . rand(100, 999) . '-' . date("Ymd");
                            $ext = strtolower($image->getClientOriginalExtension());
                            $image_full_name = $image_name . "." . $ext;
                            $upload_path = 'uploads/services/';
                            $image_url = $upload_path . $image_full_name;
                            $success = $image->move($upload_path, $image_full_name);
                            if ($success) {
                                $serviceImg = new ServiceImage();
                                $serviceImg->image = $image_url;
                                $serviceImg->service_id = $service->id;
                                $serviceImg->save();
                            }
                        }
                    }

                    $data['status'] = true;
                    $data['message'] = "Service updated successfully.";
                    $data['service'] = $service;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Service update failed! Please try again...";
                    $data['service'] = $service;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Service not found! Please try again...";
                $data['service'] = $service;
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $service = Service::find($id);
            if ($service) {
                if ($service->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Service deleted successfully!";
                    $data['service'] = $service;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Service delete failed! Please try again...";
                    $data['service'] = $service;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Service not found!";
                $data['service'] = $service;
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
