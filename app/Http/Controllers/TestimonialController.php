<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['testimonials'] = Testimonial::latest()->get();
        $data['menu'] = "Testimonial";
        $data['submenu'] = "View-Testimonial";
        return view('backend.pages.testimonial.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Testimonial";
        $data['submenu'] = "Create-Testimonial";
        return view('backend.pages.testimonial.create', $data);
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
                'name' => 'required|max:190|unique:testimonials',
                'comment' => 'required|max:250',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $testimonial = new Testimonial();
            $testimonial->name = $request->name;
            $testimonial->comment = $request->comment;
            $testimonial->created_by = Auth::id();
            $testimonial->status = $request->status ? $request->status : false;


            $image = $request->file('image');

            if ($image) {
                $image_name = Str::slug($request->name, '-');
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/testimonials/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $testimonial->image = $image_url;
                }
            }


            if ($testimonial->save()) {
                $data['status'] = true;
                $data['message'] = "Testimonial saved successfully.";
                $data['testimonial'] = $testimonial;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Testimonial save failed! Please try again...";
                $data['testimonial'] = $testimonial;
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
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['testimonial'] = Testimonial::find($id);
        $data['menu'] = "Testimonial";
        $data['submenu'] = "View-Testimonial";
        return view('backend.pages.testimonial.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['testimonial'] = Testimonial::find($id);
        $data['menu'] = "Testimonial";
        $data['submenu'] = "View-Testimonial";
        return view('backend.pages.testimonial.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:190|unique:testimonials,name,' . $id,
                'comment' => 'required|max:250',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $testimonial = Testimonial::find($id);

            if ($testimonial) {
                $testimonial->name = $request->name;
                $testimonial->comment = $request->comment;
                $testimonial->updated_by = Auth::id();
                $testimonial->status = $request->status ? $request->status : false;

                $image = $request->file('image');
                if ($image) {
                    if ($testimonial->image) {
                        unlink($testimonial->image);
                    }
                    $image_name = Str::slug($request->name, '-');
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/testimonials/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $testimonial->image = $image_url;
                    }
                }

                if ($testimonial->save()) {
                    $data['status'] = true;
                    $data['message'] = "Testimonial updated successfully.";
                    $data['testimonial'] = $testimonial;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Testimonial update failed! Please try again...";
                    $data['testimonial'] = $testimonial;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Testimonial not found! Please try again...";
                $data['testimonial'] = $testimonial;
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
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::find($id);
            if ($testimonial) {
                if ($testimonial->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Testimonial deleted successfully!";
                    $data['testimonial'] = $testimonial;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Testimonial delete failed! Please try again...";
                    $data['testimonial'] = $testimonial;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Testimonial not found!";
                $data['testimonial'] = $testimonial;
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
