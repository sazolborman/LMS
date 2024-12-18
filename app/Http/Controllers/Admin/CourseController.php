<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Validation\Rule;
use App\Models\Course;
use App\Models\CourseBundle;
use App\Models\FileUploader;
use App\Models\Section;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{

    protected $CurriculumController;

    public function __construct(CurriculumController $CurriculumController)
    {
        $this->CurriculumController = $CurriculumController;
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('showing', 10);
        $category   = 'all';
        $status     = 'all';
        $instructor = 'all';
        $price      = 'all';

        $query  = Course::query();

        // selected category
        if (isset($request->category) && $request->category != '' && $request->category != 'all') {
            $category_info = Category::where('slug', $request->category)->first();
            $show_data['category'] = $request->category;
            $query                  = $query->where('category_id', $category_info->id);
        }

        // status filter
        if (isset($request->status) && $request->status != '' && $request->status != 'all') {

            if ($request->status == 'Active') {
                $get_status = 'Active';
            } elseif ($request->status == 'Inactive') {
                $get_status = 'Inactive';
            } elseif ($request->status == 'Pending') {
                $get_status = 'Pending';
            } elseif ($request->status == 'Private') {
                $get_status = 'Private';
            } elseif ($request->status == 'Upcoming') {
                $get_status = 'Upcoming';
            } elseif ($request->status == 'Draft') {
                $get_status = 'Draft';
            }
            $query         = $query->where('status', $get_status);
            $status = $request->status;
        }

        // selected instructor
        if (isset($request->instructor) && $request->instructor != '' && $request->instructor != 'all') {
            $query      = $query->where('user_id', $request->instructor);
            $instructor = $request->instructor;
        }

        // selected price
        if (isset($request->price) && $request->price != '' && $request->price != 'all') {

            if ($request->price == 'free') {
                $get_price = 0;
                $query = $query->where('is_paid', $get_price);
            } elseif ($request->price == 'paid') {
                $get_price = 1;
                $query = $query->where('is_paid', $get_price);
            } elseif ($request->price == 'discount') {
                $get_price = 1;
                $query = $query->where('discount_flag', $get_price);
            }
            $price = $request->price;
        }

        // search filter
        if (isset($search) && $search != '') {
            $query = $query->join('users', 'courses.user_id', '=', 'users.id') // Join with the users table
                ->join('categories', 'courses.category_id', '=', 'categories.id')
                ->select('courses.*', 'users.name as user_name', 'categories.title as category_title');

            // Apply the condition to search for either the course title or the user name
            $query->where(function ($query) use ($search) {
                $query->where('courses.title', 'LIKE', "%$search%")
                    ->orWhere('users.name', 'LIKE', "%$search%")
                    ->orWhere('categories.title', 'LIKE', "%$search%");
            });
        }

        $show_data['instructor']       = $instructor;
        $show_data['status']           = $status;
        $show_data['price']            = $price;
        $show_data['courses'] = $query->orderBy('id', 'DESC')->paginate($perPage)->appends(request()->query());

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.course.data_container', $show_data)->render();
        }

        return view('admin::course.index', $show_data);
    }
    public function course_create()
    {
        return view('admin::course.create');
    }
    public function course_store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required',
            'description' => 'required',
            'category' => 'required|numeric|min:1',
            'status' => 'required|in:Active,Pending,Draft,Private,Upcoming,Deactive',
            'level' => 'required|in:everyone,beginner,intermediate,advanced',
            'language' => 'required',
            'price_type' => Rule::in(['0', '1']),
            'price' => 'required_if:is_paid,1|min:1|nullable|numeric',
            'discount_flag' => Rule::in(['', '1']),
            'discounted_price' => 'required_if:discount_flag,1|min:1|nullable|numeric',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',

        ]);

        if (settings_data('repeat_course') == 0) {
            if (Course::where('slug', slugify($request->title))->count() > 0) {
                return redirect(route('admin.course'))->with('error', 'There cannot be more than one course with the same name. Please change your course name');
            }
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['short_description'] = $request->short_description;
        $data['description'] = $request->description;
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;
        $data['status'] = $request->status;
        $data['level'] = $request->level;
        $data['language'] = $request->language;
        $data['is_paid'] = $request->price_type;
        if ($request->price_type != 0) {
            $data['price'] = $request->price;
            $data['discount_flag'] = $request->discount_flag;
            if ($request->discount_flag == 1) {
                $data['discounted_price'] = $request->discounted_price;
            }
        }

        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/course/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
        }
        if (isset($request->banner)) {
            $data['banner'] = "uploads/course/banner/" . nice_file_name($request->title, $request->banner->extension());
            FileUploader::upload($request->banner, $data['banner'], 470, 360, 200, 360);
        }

        Course::insert($data);

        return redirect(route('admin.course'))->with('success', translate('Added successfully'));
    }

    public function course_edit($id)
    {
        $show_data['courses'] = Course::where('id', $id)->first();
        return view('admin::course.edit', $show_data);
    }
    public function course_update(Request $request)
    {
        $query = Course::where('id', $request->course_id);
        if ($request->tab == 'basic') {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'short_description' => 'required',
                'description' => 'required',
                'category' => 'required|numeric|min:1',
                'status' => 'required|in:Active,Pending,Draft,Private,Upcoming,Deactive',
                'level' => 'required|in:everyone,beginner,intermediate,advanced',
                'language' => 'required',
            ]);
            if (settings_data('repeat_course') == 0) {
                if (Course::where('slug', slugify($request->title))->where('id', '!=', $request->course_id)->count() > 0) {
                    return redirect(route('admin.course'))->with('error', 'There cannot be more than one course with the same name. Please change your course name');
                }
            }
            $basic_data['title'] = $request->title;
            $basic_data['slug'] = slugify($request->title);
            $basic_data['short_description'] = $request->short_description;
            $basic_data['description'] = $request->description;
            $basic_data['category_id'] = $request->category;
            $basic_data['status'] = $request->status;
            $basic_data['level'] = $request->level;
            $basic_data['language'] = $request->language;
            $basic_data['multi_instructor'] = json_encode(array_filter($request->instructor, fn($value) => !is_null($value) && $value !== ''));
            $query->update($basic_data);
        } elseif ($request->tab == 'info') {
            $validated = $request->validate([
                'faq_title' => 'required',
                'faq_description' => 'required',
                'requirements' => 'required',
                'outcomes' => 'required',
            ]);

            $info_data['requirements'] = json_encode(array_filter($request->requirements, fn($value) => !is_null($value) && $value !== ''));
            $info_data['outcomes'] = json_encode(array_filter($request->outcomes, fn($value) => !is_null($value) && $value !== ''));

            //Remove empty value by using array filter function
            $info_data['requirements'] = json_encode(array_filter($request->requirements, fn($value) => !is_null($value) && $value !== ''));
            $info_data['outcomes'] = json_encode(array_filter($request->outcomes, fn($value) => !is_null($value) && $value !== ''));

            $faqs = [];
            foreach ($request->faq_title as $key => $title) {
                if ($title != '') {
                    $faqs[] = ['title' => $title, 'description' => $request->faq_description[$key]];
                }
            }
            $info_data['faqs'] = json_encode($faqs);
            $query->update($info_data);
        } elseif ($request->tab == 'price') {

            $price_data['is_paid'] = $request->price_type;
            $price_data['price'] = $request->price;
            $price_data['discount_flag'] = $request->discount_flag;
            $price_data['discounted_price'] = $request->discounted_price;
            $query->update($price_data);
        } elseif ($request->tab == 'gallery') {

            if (isset($request->thumbnail)) {
                $gallery_data['thumbnail'] = "uploads/course/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
                FileUploader::upload($request->thumbnail, $gallery_data['thumbnail'], 470, 360, 200, 360);
                remove_file($query->first()->thumbnail);
            }
            if (isset($request->banner)) {
                $gallery_data['banner'] = "uploads/course/banner/" . nice_file_name($request->title, $request->banner->extension());
                FileUploader::upload($request->banner, $gallery_data['banner'], 470, 360, 200, 360);
                remove_file($query->first()->banner);
            }
            if (isset($request->preview)) {
                $gallery_data['preview'] = "uploads/course/preview/" . nice_file_name($request->title, $request->preview->extension());
                FileUploader::upload($request->preview, $gallery_data['preview']);
                remove_file($query->first()->preview);
            }
            $query->update($gallery_data);
        } elseif ($request->tab == 'seo') {

            $seo = Seo::where('name_route', 'course.details')->where('course_id', $request->course_id)->first();
            $meta_keywords = '';
            $meta_keywords_arr = json_decode($request->meta_keywords, true);
            if (is_array($meta_keywords_arr)) {
                foreach ($meta_keywords_arr as $key => $keyword) {
                    if ($key > 0) {
                        $meta_keywords .= ',' . $keyword['value'];
                    } else {
                        $meta_keywords .= $keyword['value'];
                    }
                }
            }
            $seo_data['meta_keywords'] = $meta_keywords;
            $seo_data['meta_description'] = $request->meta_description;
            $seo_data['course_id'] = $request->course_id;
            $seo_data['route'] = 'Course Details';
            $seo_data['name_route'] = 'course.details';
            $seo_data['meta_title'] = $request->meta_title;
            $seo_data['meta_robot'] = $request->meta_robot;
            $seo_data['canonical_url'] = $request->canonical_url;
            $seo_data['custom_url'] = $request->custom_url;
            $seo_data['json_ld'] = $request->json_id;
            $seo_data['og_title'] = $request->og_title;
            $seo_data['og_description'] = $request->og_description;
            if (isset($request->og_image)) {
                $seo_data['og_image'] = "uploads/seo/og_image/" . nice_file_name($request->og_title, $request->og_image->extension());
                FileUploader::upload($request->og_image, $seo_data['og_image'], null, null, null);
                remove_file($seo->og_image);
            }
            if ($seo) {
                if ($request->og_image) {
                    remove_file($seo->og_image);
                }

                Seo::where('name_route', 'course.details')->where('course_id', $request->course_id)->update($seo_data);
            } else {
                Seo::insert($seo_data);
            }
        }


        return response()->json([
            'status'       => true,
            'success'      => translate('Update successfully'),
        ]);
    }

    public function course_status($id)
    {
        $query = Course::where('id', $id);
        if ($query->first()->status == "Active") {
            $data['status'] = "Inactive";
        } else {
            $data['status'] = "Active";
        }
        $query->update($data);
        return redirect()->back()->with('success', translate('Status Change successfully'));
    }

    public function course_delete($id)
    {
        $query = Course::where('id', $id);
        foreach ($query->first()->section as $section) {
            $this->CurriculumController->section_delete($section->id);
        }
        remove_file($query->first()->thumbnail);
        remove_file($query->first()->banner);
        remove_file($query->first()->preview);
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }

    //course schedule
    public function course_schedule()
    {
        return view('admin::course.schedule');
    }
    public function show_section(Request $request)
    {
        $bid = $request->post('bid');
        $model = Section::where('course_id', $bid)->get();
        return response([
            'status' => 1,
            'model' => $model
        ]);
    }
    public function show_lesson(Request $request)
    {
        $bid = $request->post('bid');
        $model = Lesson::where('section_id', $bid)->get();
        return response([
            'status' => 1,
            'model' => $model
        ]);
    }
    public function schedule_store(Request $request)
    {
        $data['release_date'] = $request->release_date;
        if ($request->type == 'course') {
            Course::where('id', $request->course_id)->update($data);
        } elseif ($request->type == 'section') {
            Section::where('id', $request->section)->update($data);
        } else {
            Lesson::where('id', $request->lesson)->update($data);
        }

        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    // Course bundle function

    public function course_bundle(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = CourseBundle::query();

        // search filter
        if ($search) {
            $query->where('title', 'LIKE', "%$search%");
        }

        $show_data['bundles'] = $query->orderBy('id', 'DESC')->paginate($perPage)->appends(request()->query());;
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.course_bundle.data_container', $show_data)->render();
        }

        return view('admin::course_bundle.index', $show_data);
    }
    public function course_bundle_create()
    {
        return view('admin::course_bundle.create');
    }
    public function course_bundle_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'days' => 'required',
            'course_id' => 'required',
            'price' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',

        ]);

        $data['title'] = $request->title;
        $data['course_id'] = json_encode($request->course_id, true);
        $data['price'] = $request->price;
        $data['subscription_day'] = $request->days;
        $data['description'] = $request->description;
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 1;
        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/course_bundle/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
        }
        CourseBundle::insert($data);
        return redirect(route('admin.bundle'))->with('success', translate('Added successfully'));
    }

    public function course_bundle_edit($id)
    {
        $show_data['bundle'] = CourseBundle::where('id', $id)->first();
        return view('admin::course_bundle.edit', $show_data);
    }
    public function course_bundle_update(Request $request)
    {
        $query = CourseBundle::where('id', $request->id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'days' => 'required',
            'course_id' => 'required',
            'price' => 'required|numeric',
        ]);

        $data['title'] = $request->title;
        $data['course_id'] = json_encode($request->course_id, true);
        $data['price'] = $request->price;
        $data['subscription_day'] = $request->days;
        $data['description'] = $request->description;
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 1;
        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/course_bundle/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
            remove_file($query->first()->thumbnail);
        }
        $query->update($data);
        return redirect(route('admin.bundle'))->with('success', translate('Updated successfully'));
    }

    public function course_bundle_status($id)
    {
        $query = CourseBundle::where('id', $id);
        if ($query->first()->status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $query->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function course_bundle_delete($id)
    {
        $query = CourseBundle::where('id', $id);
        remove_file($query->first()->thumbnail);
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }
}
