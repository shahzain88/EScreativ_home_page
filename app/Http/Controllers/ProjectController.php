<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title, '-');
        $i = 0;
        while (Project::where('slug', $slug)->exists()) {
            $i++;
            $slug = $slug . '-' . $i;
        }
        return $slug;
    }

    public function projects()
    {
        $data = array();
        $data['title'] = "Projects";
        $data['menu'] = "Project";
        $data['about'] = About::first();
        $data['categories'] = Category::where('status', 1)->where('parent_id', 0)->get();
        $data['projects'] = Project::with('category')->where('status', 1)->inRandomOrder()->limit(9)->get();
        $data['galleries'] = Gallery::where('status', 1)->inRandomOrder()->limit(4)->get();
        return view('frontend.pages.projects', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['projects'] = Project::latest()->get();
        $data['menu'] = "Project";
        $data['submenu'] = "View-Project";
        return view('backend.pages.project.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "Project";
        $data['submenu'] = "Create-Project";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.project.create', $data);
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
                'title' => 'required|max:190|unique:projects',
                'description' => 'nullable',
                'category_id' => 'nullable',
                'client_feedback' => 'nullable',
                'client_name' => 'nullable',
                'start_date' => 'nullable',
                'end_date' => 'nullable',
                'budget' => 'nullable',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueSlug($request->title);
            $project = new Project();
            $project->title = $request->title;
            $project->slug = $slug;
            $project->description = $request->description;
            $project->category_id = $request->category_id;
            $project->client_feedback = $request->client_feedback;
            $project->client_name = $request->client_name;
            $project->start_date = $request->start_date;
            $project->end_date = $request->end_date;
            $project->budget = $request->budget;
            $project->created_by = Auth::id();
            $project->status = $request->status ? $request->status : false;
            $image = $request->file('image');

            if ($image) {
                $image_name = $slug;
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/projects/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $project->image = $image_url;
                }
            }


            if ($project->save()) {
                $data['status'] = true;
                $data['message'] = "Project saved successfully.";
                $data['project'] = $project;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Project save failed! Please try again...";
                $data['project'] = $project;
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
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['title'] = "Projects";
        $data['menu'] = "Project";
        $data['about'] = About::first();
        $data['project'] = Project::with('category')->where('id', $id)->first();
        $data['menu'] = "Project";
        $data['submenu'] = "View-Project";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['galleries'] = Gallery::where('status', 1)->inRandomOrder()->limit(4)->get();
        return view('frontend.pages.projectDetails', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['project'] = Project::find($id);
        $data['menu'] = "Project";
        $data['submenu'] = "View-Project";
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        return view('backend.pages.project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:190|unique:projects,title,' . $id,
                'description' => 'nullable',
                'category_id' => 'nullable',
                'client_feedback' => 'nullable',
                'client_name' => 'nullable',
                'start_date' => 'nullable',
                'end_date' => 'nullable',
                'budget' => 'nullable',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $project = Project::find($id);

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
                $project->client_feedback = $request->client_feedback;
                $project->client_name = $request->client_name;
                $project->start_date = $request->start_date;
                $project->end_date = $request->end_date;
                $project->budget = $request->budget;
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
                    $upload_path = 'uploads/projects/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $project->image = $image_url;
                    }
                }

                if ($project->save()) {
                    $data['status'] = true;
                    $data['message'] = "Project updated successfully.";
                    $data['project'] = $project;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Project update failed! Please try again...";
                    $data['project'] = $project;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Project not found! Please try again...";
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
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $project = Project::find($id);
            if ($project) {
                if ($project->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Project deleted successfully!";
                    $data['project'] = $project;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Project delete failed! Please try again...";
                    $data['project'] = $project;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Project not found!";
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
}
