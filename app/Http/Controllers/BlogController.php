<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title, '-');
        $i = 0;
        while (Blog::where('slug', $slug)->exists()) {
            $i++;
            $slug = $slug . '-' . $i;
        }
        return $slug;
    }

    public function blogs()
    {
        $data = array();
        $data['title'] = "Blogs";
        $data['menu'] = "Blogs";
        $data['about'] = About::first();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['blogs'] = Blog::where('status', 1)->latest()->paginate(10);
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.blogs', $data);
    }

    public function blogDetails($slug, $id)
    {
        $data = array();
        $data['title'] = "Blogs";
        $data['menu'] = "Blogs";
        $data['about'] = About::first();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['blog'] = Blog::with('category')->where('status', 1)->where('id', $id)->first();
        $data['galleries'] = Gallery::where('status', 1)->inRandomOrder()->limit(4)->get();
        return view('frontend.pages.blogDetails', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blogs'] = Blog::with('category')->latest()->get();
        $data['menu'] = "Blog";
        $data['submenu'] = "View-Blog";
        return view('backend.pages.blog.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Blog";
        $data['submenu'] = "Create-Blog";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.blog.create', $data);
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
                'title' => 'required',
                'description' => 'nullable',
                'category_id' => 'nullable',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueSlug($request->title);
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->slug = $slug;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->created_by = Auth::id();
            $blog->status = $request->status ? $request->status : false;
            $image = $request->file('image');

            if ($image) {
                $image_name = $slug;
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/blogs/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $blog->image = $image_url;
                }
            }

            if ($blog->save()) {
                $data['status'] = true;
                $data['message'] = "Blog saved successfully.";
                $data['blog'] = $blog;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Blog save failed! Please try again...";
                $data['blog'] = $blog;
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['blog'] = Blog::find($id);
        $data['menu'] = "Blog";
        $data['submenu'] = "View-Blog";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.blog.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['blog'] = Blog::find($id);
        $data['menu'] = "Blog";
        $data['submenu'] = "View-Blog";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'nullable',
                'category_id' => 'nullable',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $project = Blog::find($id);

            if ($project) {
                if ($request->title != $project->title) {
                    $slug = $this->generateUniqueSlug($request->title);
                } else {
                    $slug = $project->title;
                }

                $project->title = $request->title;
                $project->slug = $slug;
                $project->description = $request->description;
                $project->category_id = $request->category_id;
                $project->updated_by = Auth::id();
                $project->status = $request->status ? $request->status : false;
                $image = $request->file('image');

                if ($image) {
                    if ($project->image) {
                        unlink($project->image);
                    }
                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/blogs/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $project->image = $image_url;
                    }
                }

                if ($project->save()) {
                    $data['status'] = true;
                    $data['message'] = "Blog updated successfully.";
                    $data['project'] = $project;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Blog update failed! Please try again...";
                    $data['project'] = $project;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Blog not found! Please try again...";
                $data['project'] = $project;
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::find($id);
            if ($blog) {
                if ($blog->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Blog deleted successfully!";
                    $data['blog'] = $blog;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                        ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Blog delete failed! Please try again...";
                    $data['blog'] = $blog;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                        ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Blog not found!";
                $data['blog'] = $blog;
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
