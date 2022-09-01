<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categories()
    {
        $data = array();
        $data['title'] = "Categories";
        $data['menu'] = "Category";
        $data['about'] = About::first();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.categories', $data);
    }

    public function categoryServices($slug, $id)
    {
        $data = array();
        $data['title'] = "Category - Services";
        $data['menu'] = "Category";
        $data['about'] = About::first();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['category'] = Category::with('parent', 'services')->where('status', 1)->where('id', $id)->first();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.categoryServices', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['categories'] = Category::with('parent')->latest()->get();
        $data['menu'] = "Category";
        $data['submenu'] = "View-Category";
        return view('backend.pages.category.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Category";
        $data['submenu'] = "Create-Category";
        $data['parent_categories'] = Category::where('status', true)->where('parent_id', false)->get();
        return view('backend.pages.category.create', $data);
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
                'name' => 'required|max:190|unique:categories',
                'description' => 'nullable|max:190',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = Str::slug($request->name, '-');
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $slug;
            $category->description = $request->description;
            $category->created_by = Auth::id();
            $category->parent_id = $request->parent_id ? $request->parent_id : 0;
            $category->status = $request->status ? $request->status : false;


            $image = $request->file('image');

            if ($image) {
                $image_name = $slug;
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/categories/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $category->image = $image_url;
                }
            }


            if ($category->save()) {
                $data['status'] = true;
                $data['message'] = "Category saved successfully.";
                $data['category'] = $category;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Category save failed! Please try again...";
                $data['category'] = $category;
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['category'] = Category::find($id);
        $data['menu'] = "Category";
        $data['submenu'] = "View-Category";
        return view('backend.pages.category.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['category'] = Category::find($id);
        $data['parent_categories'] = Category::where('status', true)->where('parent_id', false)->get();
        $data['menu'] = "Category";
        $data['submenu'] = "View-Category";
        return view('backend.pages.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:190|unique:categories,name,' . $id,
                'description' => 'nullable|max:190',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $category = Category::find($id);

            if ($category) {
                $slug = Str::slug($request->name, '-');
                $category->name = $request->name;
                $category->slug = $slug;
                $category->description = $request->description;
                $category->updated_by = Auth::id();
                $category->parent_id = $request->parent_id ? $request->parent_id : 0;
                $category->status = $request->status ? $request->status : false;

                $image = $request->file('image');
                if ($image) {
                    if ($category->image) {
                        unlink($category->image);
                    }
                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/categories/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $category->image = $image_url;
                    }
                }

                if ($category->save()) {
                    $data['status'] = true;
                    $data['message'] = "Category updated successfully.";
                    $data['category'] = $category;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Category update failed! Please try again...";
                    $data['category'] = $category;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Category not found! Please try again...";
                $data['category'] = $category;
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                if ($category->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Category deleted successfully!";
                    $data['category'] = $category;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Category delete failed! Please try again...";
                    $data['category'] = $category;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Category not found!";
                $data['category'] = $category;
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
