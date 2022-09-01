<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = "Home";
        $data['menu'] = "Home";
        $data['about'] = About::first();
        $data['sliders'] = Slider::where('status', 1)->latest()->get();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)
                            ->inRandomOrder()->limit(12)->get();
        $data['recommend_categories'] = Category::where('status', 1)->where('parent_id', '!=', 0)
                            ->inRandomOrder()->limit(6)->get();
        $data['popular_categories'] = Category::where('status', 1)->where('parent_id', '!=', 0)
                            ->inRandomOrder()->limit(6)->get();
        $data['services'] = Service::with('category')->where('status', 1)->latest()->limit(3)->get();
        $data['projects'] = Project::with('category')->where('status', 1)->inRandomOrder()->limit(6)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['blogs'] = Blog::where('status', 1)->inRandomOrder()->limit(6)->get();
        $data['galleries'] = Gallery::where('status', 1)->inRandomOrder()->limit(4)->get();
        return view('frontend.pages.index', $data);
    }

    public function about()
    {
        $data = array();
        $data['title'] = "About Us";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        return view('frontend.pages.about', $data);
    }

    public function ceoMessage()
    {
        $data = array();
        $data['title'] = "CEO Message";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.ceoMessage', $data);
    }

    public function contact()
    {
        $data = array();
        $data['title'] = "Contact Us";
        $data['menu'] = "Contact";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.contact', $data);
    }

    public function categories()
    {
        $data = array();
        $data['title'] = "Categories";
        $data['menu'] = "Category";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.categories', $data);
    }

    public function services()
    {
        $data = array();
        $data['title'] = "Services";
        $data['menu'] = "Service";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->latest()->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['categories'] = Category::with('children')->where('status', 1)->where('parent_id', 0)->get();
        $data['services'] = Service::with('category')->where('status', 1)->latest()->limit(10)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.services', $data);
    }

    public function serviceDetails()
    {
        $data = array();
        $data['title'] = "Service Details";
        $data['menu'] = "Service";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.serviceDetails', $data);
    }

    public function quotation()
    {
        $data = array();
        $data['title'] = "Quotation";
        $data['menu'] = "";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.quotation', $data);
    }

    public function faq()
    {
        $data = array();
        $data['title'] = "FAQ";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['faqs'] = Faq::where('status', 1)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.faq', $data);
    }

    public function products()
    {
        $data = array();
        $data['title'] = "Products";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.products', $data);
    }

    public function productDetails()
    {
        $data = array();
        $data['title'] = "Products Details";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();


        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.productDetails', $data);
    }

    public function news()
    {
        $data = array();
        $data['title'] = "Blog";
        $data['menu'] = "Blog";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.news', $data);
    }

    public function newsDetails()
    {
        $data = array();
        $data['title'] = "Blog Details";
        $data['menu'] = "Blog";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        return view('frontend.pages.newsDetails', $data);
    }

    public function gallery()
    {
        $data = array();
        $data['title'] = "Gallery";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries1'] = Gallery::where('status', 1)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.gallery', $data);
    }

    public function team()
    {
        $data = array();
        $data['title'] = "Team";
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();
        return view('frontend.pages.team', $data);
    }

    public function profile()
    {
        $data = array();
        $data['title'] = "Profile";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.profile', $data);
    }

    public function mission()
    {
        $data = array();
        $data['title'] = "Mission";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.mission', $data);
    }

    public function vision()
    {
        $data = array();
        $data['title'] = "Vision";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.vision', $data);
    }

    public function history()
    {
        $data = array();
        $data['title'] = "History";
        $data['menu'] = "About";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.history', $data);
    }

    public function projects()
    {
        $data = array();
        $data['title'] = "Projects";
        $data['menu'] = "Project";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.projects', $data);
    }

    public function projectDetails()
    {
        $data = array();
        $data['title'] = "Project Details";
        $data['menu'] = "Project";
        $data['about'] = About::first();
        $data['active_slider'] = Slider::where('status', 2)->first();
        $data['sliders'] = Slider::where('status', 1)->get();
        $data['services'] = Service::where('status', 1)->get();
        $data['projects'] = Project::where('status', 1)->get();
        $data['testimonial'] = Testimonial::where('status', 1)->get();
        $data['news'] = Blog::where('status', 1)->limit(3)->get();
        $data['galleries'] = Gallery::where('status', 1)->limit(4)->get();

        return view('frontend.pages.projectDetails', $data);
    }
}
