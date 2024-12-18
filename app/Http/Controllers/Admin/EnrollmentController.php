<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return view('admin::enrollment.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'course_id' => 'required',
        ]);

        for ($i = 0; $i < count($request->user_id); $i++) {
            for ($j = 0; $j < count($request->course_id); $j++) {
                $data['user_id'] = $request->user_id[$i];
                $data['course_id'] = $request->course_id[$j];
                $data['entry_date'] = time();
                $user = Enrollment::where('user_id', $request->user_id[$i])->where('course_id', $request->course_id[$j])->exists();
                if (!$user) {

                    Enrollment::insert($data);
                }
            }
        }
        return redirect(route('admin.enrollment.history'))->with('success', translate('Added successfully'));
    }

    public function enrollment_history(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = Enrollment::query();

        // search filter
        if ($search) {
            $query = $query->join('courses', 'enrollments.course_id', '=', 'courses.id')
                ->join('users', 'enrollments.user_id', '=', 'users.id') // Join with the users table
                ->select('enrollments.*', 'courses.title as course_title', 'users.name as user_name', 'users.email as user_email');


            // Apply the condition to search for either the course title or the user name
            $query->where(function ($query) use ($search) {
                $query->where('courses.title', 'LIKE', "%$search%")
                    ->orWhere('users.name', 'LIKE', "%$search%")
                    ->orWhere('users.email', 'LIKE', "%$search%");
            });
        }
        $show_data['enrolls'] = $query->orderBy('id', 'DESC')->paginate($perPage)->appends(request()->query());
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.enrollment.data_container', $show_data)->render();
        }

        return view('admin::enrollment.enroll_history', $show_data);
    }
    public function enrollment_history_delete($id)
    {
        Enrollment::where('id', $id)->delete();
        return redirect(route('admin.enrollment.history'))->with('success', translate('Deleted successfully'));
    }
}
