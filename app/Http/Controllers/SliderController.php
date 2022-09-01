<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title, '-');
        $i = 0;
        while (Slider::where('slug', $slug)->exists()) {
            $i++;
            $slug = $slug . '-' . $i;
        }
        return $slug;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['sliders'] = Slider::all();
        $data['menu'] = "Slider";
        $data['submenu'] = "View-Slider";
        return view('backend.pages.slider.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Slider";
        $data['submenu'] = "Create-Slider";
        return view('backend.pages.slider.create', $data);
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
                'title' => 'required|max:190|unique:sliders',
                'subtitle' => 'nullable|max:190',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueSlug($request->title);

            $slider = new Slider();
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->slug = $slug;
            $slider->created_by = Auth::id();
            $slider->status = $request->status ? $request->status : false;


            $image = $request->file('image');
            $image_name = $slug;
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $upload_path = 'uploads/sliders/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $slider->image = $image_url;
            }
            if ($slider->save()) {
                $data['status'] = true;
                $data['message'] = "Slider saved successfully.";
                $data['slider'] = $slider;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Slider save failed! Please try again...";
                $data['slider'] = $slider;
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
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['slider'] = Slider::find($id);
        $data['menu'] = "Slider";
        $data['submenu'] = "View-Slider";
        return view('backend.pages.slider.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['slider'] = Slider::find($id);
        $data['menu'] = "Slider";
        $data['submenu'] = "View-Slider";
        return view('backend.pages.slider.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:190|unique:sliders,title,' . $id,
                'subtitle' => 'nullable|max:190',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueSlug($request->title);

            $slider = Slider::find($id);

            if ($slider) {
                $slider->title = $request->title;
                $slider->subtitle = $request->subtitle;
                $slider->slug = $slug;
                $slider->updated_by = Auth::id();
                $slider->status = $request->status ? $request->status : false;


                $image = $request->file('image');

                if ($image) {
                    if ($slider->image) {
                        unlink($slider->image);
                    }
                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/sliders/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $slider->image = $image_url;
                    }
                }

                if ($slider->save()) {
                    $data['status'] = true;
                    $data['message'] = "Slider saved successfully.";
                    $data['slider'] = $slider;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Slider save failed! Please try again...";
                    $data['slider'] = $slider;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Slider not found";
                $data['errors'] = $validate->errors();
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
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            if ($slider) {
                if ($slider->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Slider deleted successfully!";
                    $data['slider'] = $slider;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Slider delete failed! Please try again...";
                    $data['slider'] = $slider;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Slider not found!";
                $data['slider'] = $slider;
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
