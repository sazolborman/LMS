<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileUploader;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;
use App\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_admins(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = User::where('role', 'admin');

        // search filter
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        }
        $show_data['admins'] = $query->paginate($perPage);

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.users.admin.data_container', $show_data)->render();
        }

        return view('admin::users.admin.index', $show_data);
    }
    public function admin_create()
    {
        return view('admin::users.admin.create');
    }
    public function admin_store(Request $request)
    {
        $data['role'] = 'admin';

        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'biography' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
            'facebook' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
            ],
            'twitter' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9_]{1,15}$/',
            ],
            'linkedin' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?linkedin.com\/(in|company)\/[a-zA-Z0-9_\-]+\/?$/',
            ],
            'instagram' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9_\.]{1,30}\/?$/',
            ],
        ]);
        if (User::where('email', $request->email)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one admin with the same email. Please change your admin email');
        }
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['about'] = $request->biography;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkedin'] = $request->linkedin;

        if (isset($request->image) && $request->image != '') {
            $data['photo'] = "uploads/users/admins/" . nice_file_name($request->name, $request->image->extension());
            FileUploader::upload($request->image, $data['photo']);
        }

        $done = User::insert($data);

        if ($done) {
            $admin_id = User::latest('id')->first();
            Permission::insert(['admin_id' => $admin_id->id]);
        }
        return redirect()->route('admin.admins')->with('success', translate('Added successfully'));
    }

    public function admin_edit($id)
    {
        $show_data['admin'] = User::where('role', 'admin')->where('id', $id)->first();
        return view('admin::users.admin.edit', $show_data);
    }

    public function admin_update(Request $request)
    {
        $query =  User::where('id', $request->id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'biography' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'email' => 'required|email',
            'facebook' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
            ],
            'twitter' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9_]{1,15}$/',
            ],
            'linkedin' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?linkedin.com\/(in|company)\/[a-zA-Z0-9_\-]+\/?$/',
            ],
            'instagram' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9_\.]{1,30}\/?$/',
            ],
        ]);
        if (User::where('email', $request->email)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one admin with the same email. Please change your admin email');
        }
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['about'] = $request->biography;
        $data['email'] = $request->email;
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkedin'] = $request->linkedin;

        if (isset($request->image) && $request->image != '') {
            $data['photo'] = "uploads/users/admins/" . nice_file_name($request->name, $request->image->extension());
            FileUploader::upload($request->image, $data['photo']);
            remove_file($query->first()->photo);
        }

        $query->update($data);
        return redirect()->route('admin.admins')->with('success', translate('Update successfully'));
    }

    public function admin_delete($id)
    {
        $query = User::where('id', $id);
        remove_file($query->first()->photo);
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }

    public function permission($id)
    {
        $show_data['admin'] = User::where('role', 'admin')->where('id', $id)->first();
        return view('admin::users.admin.permission', $show_data);
    }

    public function permission_store(Request $request)
    {
        $user_id = $request->user_id;

        $query = Permission::where('admin_id', $user_id);

        if ($query->exists()) {
            $permission = $query->first();
            if ($permission->permissions == '') {
                $set_per = json_encode([$request->permission]);
                Permission::where('admin_id', $user_id)->update(['permissions' => $set_per]);
            } else {
                $set_permission = (array) json_decode($permission->permissions);

                if (in_array($request->permission, $set_permission)) {
                    $pos = array_search($request->permission, $set_permission);
                    array_splice($set_permission, $pos, 1);
                } else {
                    array_push($set_permission, $request->permission);
                }
                Permission::where('admin_id', $user_id)->update(['permissions' => $set_permission]);
                return response()->json([
                    'status'       => true,
                    'success'      => translate('Update successfully'),
                ]);
            }
        }
    }

    // instructor for controller
    public function instructor(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = User::where('role', 'instructor');

        // search filter
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        }
        $show_data['instructors'] = $query->paginate($perPage);
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.users.instructor.data_container', $show_data)->render();
        }

        return view('admin::users.instructor.index', $show_data);
    }
    public function instructor_create()
    {
        return view('admin::users.instructor.create');
    }
    public function instructor_store(Request $request)
    {
        $data['role'] = 'instructor';

        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'biography' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
            'facebook' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
            ],
            'twitter' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9_]{1,15}$/',
            ],
            'linkedin' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?linkedin.com\/(in|company)\/[a-zA-Z0-9_\-]+\/?$/',
            ],
            'instagram' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9_\.]{1,30}\/?$/',
            ],
        ]);
        if (User::where('email', $request->email)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one admin with the same email. Please change your admin email');
        }
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['about'] = $request->biography;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkedin'] = $request->linkedin;

        if (isset($request->image) && $request->image != '') {
            $data['photo'] = "uploads/users/instructors/" . nice_file_name($request->name, $request->image->extension());
            FileUploader::upload($request->image, $data['photo']);
        }

        User::insert($data);

        return redirect()->route('admin.instructor')->with('success', translate('Added successfully'));
    }

    public function instructor_edit($id)
    {
        $show_data['instructor'] = User::where('role', 'instructor')->where('id', $id)->first();
        return view('admin::users.instructor.edit', $show_data);
    }

    public function instructor_update(Request $request)
    {
        $query =  User::where('id', $request->id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'biography' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'email' => 'required|email',
            'facebook' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
            ],
            'twitter' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9_]{1,15}$/',
            ],
            'linkedin' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?linkedin.com\/(in|company)\/[a-zA-Z0-9_\-]+\/?$/',
            ],
            'instagram' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9_\.]{1,30}\/?$/',
            ],
        ]);
        if (User::where('email', $request->email)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one admin with the same email. Please change your admin email');
        }
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['about'] = $request->biography;
        $data['email'] = $request->email;
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkedin'] = $request->linkedin;

        if (isset($request->image) && $request->image != '') {
            $data['photo'] = "uploads/users/instructors/" . nice_file_name($request->name, $request->image->extension());
            FileUploader::upload($request->image, $data['photo']);
            remove_file($query->first()->photo);
        }

        $query->update($data);
        return redirect()->route('admin.instructor')->with('success', translate('Update successfully'));
    }

    public function instructor_setting()
    {
        $show_data['allow_instructor'] = Setting::where('type', 'allow_instructor')->first();
        $show_data['application_note'] = Setting::where('type', 'instructor_application_note')->first();
        $show_data['instructor_revenue'] = Setting::where('type', 'instructor_revenue')->first();
        return view('admin::users.instructor.setting', $show_data);
    }

    public function instructor_setting_store(Request $request)
    {
        if ($request->part == 'allow') {

            $key_found = Setting::where('type', 'instructor_application_note')->exists();
            if ($key_found) {
                $data['description'] = $request->instructor_application_note;

                Setting::where('type', 'instructor_application_note')->update($data);
            } else {
                $data['type'] = 'instructor_application_note';
                $data['description'] = $request->instructor_application_note;

                Setting::insert($data);
            }



            $key_founds = Setting::where('type', 'allow_instructor')->exists();
            if ($key_founds) {
                $data['description'] = $request->allow_instructor;

                Setting::where('type', 'allow_instructor')->update($data);
            } else {

                $data['type'] = 'allow_instructor';
                $data['description'] = $request->allow_instructor;

                Setting::insert($data);
            }
        }
        if ($request->part == 'revenue') {

            $key_found = Setting::where('type', 'instructor_revenue')->exists();
            if ($key_found) {
                $data['description'] = $request->instructor_revenue;

                Setting::where('type', 'instructor_revenue')->update($data);
            } else {
                $data['type'] = 'instructor_revenue';
                $data['description'] = $request->instructor_revenue;

                Setting::insert($data);
            }
        }
        return redirect()->back()->with('success', translate('Update successfully'));
    }

    public function instructor_delete($id)
    {
        $query = User::where('id', $id);
        remove_file($query->first()->photo);
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }


    //student controller by route
    public function student(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = User::where('role', 'student');

        // search filter
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        }
        $show_data['students'] = $query->paginate($perPage);
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.users.student.data_container', $show_data)->render();
        }

        return view('admin::users.student.index', $show_data);
    }
    public function student_create()
    {
        return view('admin::users.student.create');
    }
    public function student_edit($id)
    {
        $show_data['student'] = User::where('role', 'student')->where('id', $id)->first();
        return view('admin::users.student.edit', $show_data);
    }

    public function student_store(Request $request)
    {
        $data['role'] = 'student';

        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'biography' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
            'facebook' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
            ],
            'twitter' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9_]{1,15}$/',
            ],
            'linkedin' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?linkedin.com\/(in|company)\/[a-zA-Z0-9_\-]+\/?$/',
            ],
            'instagram' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9_\.]{1,30}\/?$/',
            ],
        ]);
        if (User::where('email', $request->email)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one admin with the same email. Please change your admin email');
        }
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['about'] = $request->biography;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkedin'] = $request->linkedin;

        if (isset($request->image) && $request->image != '') {
            $data['photo'] = "uploads/users/students/" . nice_file_name($request->name, $request->image->extension());
            FileUploader::upload($request->image, $data['photo']);
        }

        User::insert($data);

        return redirect()->route('admin.student')->with('success', translate('Added successfully'));
    }

    public function student_update(Request $request)
    {
        $query =  User::where('id', $request->id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'biography' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'email' => 'required|email',
            'facebook' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
            ],
            'twitter' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9_]{1,15}$/',
            ],
            'linkedin' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?linkedin.com\/(in|company)\/[a-zA-Z0-9_\-]+\/?$/',
            ],
            'instagram' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9_\.]{1,30}\/?$/',
            ],
        ]);
        if (User::where('email', $request->email)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one admin with the same email. Please change your admin email');
        }
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['about'] = $request->biography;
        $data['email'] = $request->email;
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkedin'] = $request->linkedin;

        if (isset($request->image) && $request->image != '') {
            $data['photo'] = "uploads/users/students/" . nice_file_name($request->name, $request->image->extension());
            FileUploader::upload($request->image, $data['photo']);
            remove_file($query->first()->photo);
        }

        $query->update($data);
        return redirect()->route('admin.student')->with('success', translate('Update successfully'));
    }

    public function student_delete($id)
    {
        $query = User::where('id', $id);
        remove_file($query->first()->photo);
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }
}
