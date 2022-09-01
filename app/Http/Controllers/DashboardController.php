<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['menu'] = "Dashboard";
        $data['submenu'] = "";
        $data['users'] = User::count();
        $data['orders'] = Order::count();
        $data['contacts'] = Contact::count();
        $data['quotations'] = Quotation::count();
        return view('backend.pages.dashboard', $data);
    }
}
