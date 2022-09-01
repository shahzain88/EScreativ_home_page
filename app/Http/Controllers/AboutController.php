<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['about'] = About::first();
        $data['menu'] = "About";
        $data['submenu'] = "View-About";
        return view('backend.pages.about.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['menu'] = "About";
        $data['submenu'] = "Create-About";
        return view('backend.pages.about.create', $data);
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
                'about_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'message_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'why_choose_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'why_best_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'vision_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'mission_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'history_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }


            $about  = new About();
            $about->email = $request->email;
            $about->mobile = $request->mobile;
            $about->address = $request->address;
            $about->about = $request->about;
            $about->message = $request->message;
            $about->mission = $request->mission;
            $about->vision = $request->vision;
            $about->history = $request->history;
            $about->why_choose = $request->why_choose;
            $about->why_best = $request->why_best;
            $about->created_by = Auth::id();

            $about_img = $request->file('about_img');
            if ($about_img) {
                $image_name = "about-img-" . date("Y-m-d");
                $ext = strtolower($about_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $about_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->about_img = $image_url;
                }
            }

            $logo = $request->file('logo');
            if ($logo) {
                $image_name = "company-logo-" . date("Y-m-d");
                $ext = strtolower($logo->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $logo->move($upload_path, $image_full_name);
                if ($success) {
                    $about->logo = $image_url;
                }
            }


            $message_img = $request->file('message_img');
            if ($message_img) {
                $image_name = "message-img-" . date("Y-m-d");
                $ext = strtolower($message_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $message_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->message_img = $image_url;
                }
            }

            $mission_img = $request->file('mission_img');
            if ($mission_img) {
                $image_name = "mission-img-" . date("Y-m-d");
                $ext = strtolower($mission_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $mission_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->mission_img = $image_url;
                }
            }


            $vision_img = $request->file('vision_img');
            if ($vision_img) {
                $image_name = "vision-img-" . date("Y-m-d");
                $ext = strtolower($vision_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $vision_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->vision_img = $image_url;
                }
            }


            $history_img = $request->file('history_img');
            if ($history_img) {
                $image_name = "history-img-" . date("Y-m-d");
                $ext = strtolower($history_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $history_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->history_img = $image_url;
                }
            }


            $why_choose_img = $request->file('why_choose_img');
            if ($why_choose_img) {
                $image_name = "why-choose-img-" . date("Y-m-d");
                $ext = strtolower($why_choose_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $why_choose_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->why_choose_img = $image_url;
                }
            }


            $why_best_img = $request->file('why_best_img');
            if ($why_best_img) {
                $image_name = "why-best-img-" . date("Y-m-d");
                $ext = strtolower($why_best_img->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/abouts/';
                $image_url = $upload_path . $image_full_name;
                $success = $why_best_img->move($upload_path, $image_full_name);
                if ($success) {
                    $about->why_best_img = $image_url;
                }
            }

            if ($about->save()) {
                $data['status'] = false;
                $data['message'] = "About information saved successfully.";
                $data['about'] = $about;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "About information save failed. Please try again...";
                $data['about'] = $about;
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['about'] = About::find($id);
        $data['menu'] = "About";
        $data['submenu'] = "View-About";
        return view('backend.pages.about.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['about'] = About::find($id);
        $data['menu'] = "About";
        $data['submenu'] = "View-About";
        return view('backend.pages.about.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'about_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'message_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'why_choose_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'why_best_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'vision_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'mission_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'history_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }


            $about  = About::find($id);
            if ($about) {
                $about->email = $request->email;
                $about->mobile = $request->mobile;
                $about->address = $request->address;
                $about->about = $request->about;
                $about->message = $request->message;
                $about->mission = $request->mission;
                $about->vision = $request->vision;
                $about->history = $request->history;
                $about->why_choose = $request->why_choose;
                $about->why_best = $request->why_best;
                $about->updated_by = Auth::id();


                $about_img = $request->file('about_img');
                if ($about_img) {
                    if ($about->about_img) {
                        unlink($about->about_img);
                    }
                    $image_name = "about-img-" . date("Y-m-d");
                    $ext = strtolower($about_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $about_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->about_img = $image_url;
                    }
                }

                $logo = $request->file('logo');
                if ($logo) {
                    if ($about->logo) {
                        unlink($about->logo);
                    }
                    $image_name = "company-logo-" . date("Y-m-d");
                    $ext = strtolower($logo->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $logo->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->logo = $image_url;
                    }
                }


                $message_img = $request->file('message_img');
                if ($message_img) {
                    if ($about->message_img) {
                        unlink($about->message_img);
                    }
                    $image_name = "message-img-" . date("Y-m-d");
                    $ext = strtolower($message_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $message_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->message_img = $image_url;
                    }
                }

                $mission_img = $request->file('mission_img');
                if ($mission_img) {
                    if ($about->mission_img) {
                        unlink($about->mission_img);
                    }
                    $image_name = "mission-img-" . date("Y-m-d");
                    $ext = strtolower($mission_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $mission_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->mission_img = $image_url;
                    }
                }


                $vision_img = $request->file('vision_img');
                if ($vision_img) {
                    if ($about->vision_img) {
                        unlink($about->vision_img);
                    }
                    $image_name = "vision-img-" . date("Y-m-d");
                    $ext = strtolower($vision_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $vision_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->vision_img = $image_url;
                    }
                }


                $history_img = $request->file('history_img');
                if ($history_img) {
                    if ($about->history_img) {
                        unlink($about->history_img);
                    }
                    $image_name = "history-img-" . date("Y-m-d");
                    $ext = strtolower($history_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $history_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->history_img = $image_url;
                    }
                }


                $why_choose_img = $request->file('why_choose_img');
                if ($why_choose_img) {
                    if ($about->why_choose_img) {
                        unlink($about->why_choose_img);
                    }
                    $image_name = "why-choose-img-" . date("Y-m-d");
                    $ext = strtolower($why_choose_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $why_choose_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->why_choose_img = $image_url;
                    }
                }


                $why_best_img = $request->file('why_best_img');
                if ($why_best_img) {
                    if ($about->why_best_img) {
                        unlink($about->why_best_img);
                    }
                    $image_name = "why-best-img-" . date("Y-m-d");
                    $ext = strtolower($why_best_img->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/abouts/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $why_best_img->move($upload_path, $image_full_name);
                    if ($success) {
                        $about->why_best_img = $image_url;
                    }
                }

                if ($about->save()) {
                    $data['status'] = false;
                    $data['message'] = "About information updated successfully.";
                    $data['about'] = $about;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "About information update failed. Please try again...";
                    $data['about'] = $about;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "About information not found. Please try again...";
                $data['about'] = $about;
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
