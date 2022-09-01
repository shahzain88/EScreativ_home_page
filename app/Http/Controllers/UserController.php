<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function generateUniqueUsername($name)
    {
        $username = Str::slug($name, '-');
        $i = 0;
        while (User::where('username', $username)->exists()) {
            $i++;
            $username = $username . '-' . $i;
        }
        return $username;
    }

    public function index()
    {
        $data = array();
        $data['users'] = User::with('role')->latest()->get();
        $data['menu'] = "Users";
        $data['submenu'] = "View-User";
        return view('backend.pages.user.view', $data);
    }

    public function create()
    {
        $data = array();
        $data['menu'] = "Users";
        $data['submenu'] = "Create-User";
        $data['roles'] = Role::where('status', true)->get();
        return view('backend.pages.user.create', $data);
    }

    public function profile($username)
    {
        $data = array();
        $data['menu'] = "";
        $data['submenu'] = "";
        $data['user'] = User::where('username', $username)->first();
        return view('backend.pages.user.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:190',
                'email' => 'required|max:190',
                'id' => 'required',
                'password' => 'nullable',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $user = User::find($request->id);

            if ($user) {
                if ($user->name != $request->name) {
                    $slug = $this->generateUniqueUsername($request->name);
                } else {
                    $slug = $user->username;
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $slug;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->updated_by = Auth::id();
                $image = $request->file('image');
                if ($image) {
                    if ($user->image) {
                        unlink($user->image);
                    }
                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/users/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $user->image = $image_url;
                    }
                }


                if ($user->save()) {
                    $data['status'] = true;
                    $data['message'] = "Profile updated successfully.";
                    $data['user'] = $user;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Profile update failed! Please try again...";
                    $data['user'] = $user;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Profile not found! Please try again...";
                $data['user'] = $user;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                if ($user->delete()) {
                    $customer = Customer::where('user_id', $id)->first();
                    if ($customer) {
                        $customer->delete();
                    }

                    $data['status'] = true;
                    $data['message'] = "User deleted successfully!";
                    $data['user'] = $user;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)
                            ->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "User delete failed! Please try again...";
                    $data['user'] = $user;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)
                            ->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "User not found!";
                $data['user'] = $user;
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:190',
                'email' => 'required|max:190',
                'role_id' => 'required',
                'password' => 'required',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $slug = $this->generateUniqueUsername($request->name);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $slug;
            $user->password = Hash::make($request->password);
            $user->created_by = Auth::id();
            $user->role_id = $request->role_id ? $request->role_id : 0;
            $user->status = $request->status ? $request->status : false;
            $image = $request->file('image');

            if ($image) {
                $image_name = $slug;
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/users/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $user->image = $image_url;
                }
            }


            if ($user->save()) {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->first_name = $request->name;
                $customer->email = $request->email;
                $customer->customer_id = date('Ymd') . '-' . $user->id;
                $customer->save();

                $data['status'] = true;
                $data['message'] = "User saved successfully.";
                $data['user'] = $user;
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status'] = false;
                $data['message'] = "User save failed! Please try again...";
                $data['user'] = $user;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:190',
                'email' => 'required|max:190',
                'role_id' => 'required',
                'password' => 'nullable',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Validation failed! Please check your inputs...";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            $user = User::find($id);

            if ($user) {
                if ($user->name != $request->name) {
                    $slug = $this->generateUniqueUsername($request->name);
                } else {
                    $slug = $user->username;
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $slug;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->updated_by = Auth::id();
                $user->role_id = $request->role_id ? $request->role_id : 0;
                $user->status = $request->status ? $request->status : false;
                $image = $request->file('image');

                if ($image) {
                    if ($user->image) {
                        unlink($user->image);
                    }
                    $image_name = $slug;
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = 'uploads/users/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $user->image = $image_url;
                    }
                }


                if ($user->save()) {
                    $customer = Customer::where('user_id', $user->id)->first();

                    if ($customer) {
                        $customer->user_id = $user->id;
                        $customer->first_name = $request->name;
                        $customer->email = $request->email;
                        $customer->customer_id = date('Ymd') . '-' . $user->id;
                    } else {
                        $customer = new Customer();
                        $customer->user_id = $user->id;
                        $customer->first_name = $request->name;
                        $customer->email = $request->email;
                        $customer->customer_id = date('Ymd') . '-' . $user->id;
                    }

                    $customer->save();

                    $data['status'] = true;
                    $data['message'] = "User updated successfully.";
                    $data['user'] = $user;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "User update failed! Please try again...";
                    $data['user'] = $user;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "User not found! Please try again...";
                $data['user'] = $user;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function edit($id)
    {
        $data = array();
        $data['user'] = User::find($id);
        $data['roles'] = Role::where('status', true)->get();
        $data['menu'] = "Users";
        $data['submenu'] = "Create-User";
        return view('backend.pages.user.edit', $data);
    }
}
