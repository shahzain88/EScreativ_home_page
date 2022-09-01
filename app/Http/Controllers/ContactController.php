<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['title'] = "Contact Us";
        $data['contacts'] = Contact::latest()->get();
        $data['menu'] = "Message";
        $data['submenu'] = "Contact";
        return view('backend.pages.message.contact', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['title'] = "Contact Us";
        $data['menu'] = "Contact";
        $data['about'] = About::first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.contact', $data);
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
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->status = $request->status ? $request->status : false;

            if ($contact->save()) {
                $data['status'] = true;
                $data['message'] = "Message sent successfully.";
                $data['contact'] = $contact;
                // $data['mail'] = \Mail::to("kawserahmed47@gmail.com")->send(new \App\Mail\EsMail($details, $subject));
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "Message send failed! Please try again...";
                $data['contact'] = $contact;
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
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        if ($contact) {
            $contact->status = true;
            $contact->save();
            $data = array();
            $data['title'] = "Contact Us";
            $data['contact'] = $contact;
            $data['menu'] = "Message";
            $data['submenu'] = "Contact";
            return view('backend.pages.message.contact_show', $data);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $contact = Contact::find($id);
            if ($contact) {
                if ($contact->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Contact deleted successfully!";
                    $data['contact'] = $contact;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Contact delete failed! Please try again...";
                    $data['contact'] = $contact;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Contact not found!";
                $data['contact'] = $contact;
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
