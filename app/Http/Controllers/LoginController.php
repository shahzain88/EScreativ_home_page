<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginCheck(Request $request)
    {
        try {
            $email = $request->email;
            $password = $request->password;
            $remember = $request->remember ? true : false ;
            $user = User::where('email', $email)->orWhere('username', $email)->where('status', true)->first();
            if ($user) {
                $email = $user->email;
                if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1 ], $remember)) {
                    $data['status'] = true;
                    $data['message'] = "Login Successfully!";
                    $data['user'] = $user;
                    return response()->json($data, 200);
                } else {
                    $data['status'] = false;
                    $data['message'] = "Email or password does not match!";
                    return response()->json($data, 403);
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Email or password does not match!";
                return response()->json($data, 403);
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Email or password does not match!";
            $data['errors'] = $th;
            return response()->json($data, 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
