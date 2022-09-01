<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['quotations'] = Quotation::latest()->get();
        $data['menu'] = "Message";
        $data['submenu'] = "Quotation";
        return view('backend.pages.message.quotation', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['title'] = "Quotation";
        $data['menu'] = "";
        $data['about'] = About::first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.quotation', $data);
    }

    public function serviceReservation($slug, $id)
    {

        $data = array();
        $data['title'] = "Quotation";
        $data['menu'] = "";
        $data['about'] = About::first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['service'] = Service::find($id);
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.reservation', $data);
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
                'name' => 'required|max:190',
                'email' => 'required|max:190',
                'subject' => 'required|max:150',
                'message' => 'required|max:250',
                'mobile' => 'required'
            ]);
            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $quotation = new Quotation();
            $quotation->name = $request->name;
            $quotation->email = $request->email;
            $quotation->mobile = $request->mobile;
            $quotation->subject = $request->subject;
            $quotation->message = $request->message;
            $quotation->service_id = $request->service_id ? $request->service_id : false;
            $quotation->quotation = $request->quotation ? $request->quotation : false;
            $quotation->visit = $request->visit ? $request->quotation : false;
            $quotation->diagnosis = $request->diagnosis ? $request->diagnosis : false;
            $quotation->consultation = $request->consultation ? $request->consultation : false;
            $quotation->status = $request->status ? $request->status : false;

            if ($quotation->save()) {
                // \Mail::to("kawserahmed47@gmail.com")->send(new \App\Mail\EsMail($details, $subject));
                $data['status'] = true;
                $data['message'] = "Quotation sent successfully.";
                $data['quotation'] = $quotation;
                return response(json_encode($data, JSON_PRETTY_PRINT), 201)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = true;
                $data['message'] = "Quotation send failed.";
                $data['quotation'] = $quotation;
                return response(json_encode($data, JSON_PRETTY_PRINT), 201)->header('Content-Type', 'application/json');
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
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation = Quotation::with('service')->where('id', $id)->first();

        if ($quotation) {
            $quotation->status = true;
            $quotation->save();
            $data = array();
            $data['title'] = "Quotation Us";
            $data['quotation'] = $quotation;
            $data['menu'] = "Message";
            $data['submenu'] = "Quotation";
            return view('backend.pages.message.quotation_show', $data);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $quotation = Quotation::find($id);
            if ($quotation) {
                if ($quotation->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Quotation deleted successfully!";
                    $data['quotation'] = $quotation;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Quotation delete failed! Please try again...";
                    $data['quotation'] = $quotation;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Quotation not found!";
                $data['quotation'] = $quotation;
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
