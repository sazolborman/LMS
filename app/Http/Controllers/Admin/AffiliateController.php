<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliator;
use App\Models\FileUploader;
use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function affiliator(Request $request)
    {


        if ($request->tab == 'active' || $request->tab == '') {
            // Get the number of items per page (default to 10 if not provided)
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $query = Affiliator::where('status', 1);

            // search filter
            if ($search) {
                $query = $query->join('users', 'affiliators.user_id', '=', 'users.id') // Join with the users table
                    ->select('affiliators.*', 'users.name as user_name', 'users.email as user_email');


                // Apply the condition to search for either the course title or the user name
                $query->where(function ($query) use ($search) {
                    $query->where('users.email', 'LIKE', "%$search%")
                        ->orWhere('users.name', 'LIKE', "%$search%");
                });
            }

            $active_data['active_affiliators'] = $query->orderBy('id', 'DESC')->paginate($perPage);

            if ($request->ajax()) {
                return view('admin.affiliate.active_affiliator', $active_data)->render();
            }
            return view('admin.affiliate.index', $active_data);
        }

        if ($request->tab == 'suspend') {
            // Get the number of items per page (default to 10 if not provided)
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $query = Affiliator::where('status', operator: 2);

            // search filter
            if ($search) {
                $query = $query->join('users', 'affiliators.user_id', '=', 'users.id') // Join with the users table
                    ->select('affiliators.*', 'users.name as user_name', 'users.email as user_email');


                // Apply the condition to search for either the course title or the user name
                $query->where(function ($query) use ($search) {
                    $query->where('users.email', 'LIKE', "%$search%")
                        ->orWhere('users.name', 'LIKE', "%$search%");
                });
            }

            $suspend_data['suspend_affiliators'] = $query->orderBy('id', 'DESC')->paginate($perPage);

            if ($request->ajax()) {
                return view('admin.affiliate.suspend_affiliator', $suspend_data)->render();
            }
            return view('admin.affiliate.index', $suspend_data);
        }
        if ($request->tab == 'pending') {
            // Get the number of items per page (default to 10 if not provided)
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $query = Affiliator::where('status', 0);

            // search filter
            if ($search) {
                $query = $query->join('users', 'affiliators.user_id', '=', 'users.id') // Join with the users table
                    ->select('affiliators.*', 'users.name as user_name', 'users.email as user_email');


                // Apply the condition to search for either the course title or the user name
                $query->where(function ($query) use ($search) {
                    $query->where('users.email', 'LIKE', "%$search%")
                        ->orWhere('users.name', 'LIKE', "%$search%");
                });
            }

            $pending_data['pending_affiliators'] = $query->orderBy('id', 'DESC')->paginate($perPage);

            if ($request->ajax()) {
                return view('admin.affiliate.pending_affiliator', $pending_data)->render();
            }
            return view('admin.affiliate.index', $pending_data);
        }
    }
    public function affiliator_store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|max:255',
            'document' => 'mimes:jpeg,png,jpg,pdf',
        ]);

        if (Affiliator::where('user_id', $request->user_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one user with the same. Please change your user');
        }

        $user_info = User::where('id', $request->user_id)->first();
        $name = slugify($user_info->name);
        $data['user_id'] = $request->user_id;
        $data['message'] = $request->message;
        $data['status'] = 1;

        if (isset($request->document)) {
            $data['document'] = "uploads/affiliator/" . nice_file_name($name, $request->document->extension());
            FileUploader::upload($request->document, $data['document'], null, null, null, null);
        }

        Affiliator::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }

    public function affiliator_status($id)
    {
        $query = Affiliator::where('id', $id);
        if ($query->first()->status == 1) {
            $data['status'] = 2;
        } elseif ($query->first()->status == 0) {
            $data['status'] = 1;
        } elseif ($query->first()->status == 2) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        $query->update($data);
        return redirect()->back()->with('success', translate('Status Change successfully'));
    }
    public function affiliator_delete($id)
    {
        $query = Affiliator::where('id', $id);
        remove_file($query->first()->document);
        $query->delete();
        return redirect()->back()->with('success', translate('Status Change successfully'));
    }
}
