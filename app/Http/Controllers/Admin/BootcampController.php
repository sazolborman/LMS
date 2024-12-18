<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ZoomMeetController;
use App\Models\Bootcamp;
use App\Models\BootcampCategory;
use App\Models\BootcampLiveClass;
use App\Models\BootcampModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FileUploader;
use App\Models\Seo;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class BootcampController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('showing', 10);
        $category   = 'all';
        $status     = 'all';
        $instructor = 'all';
        $price      = 'all';

        $query  = Bootcamp::query();

        // selected category
        if (isset($request->category) && $request->category != '' && $request->category != 'all') {
            $category_info = BootcampCategory::where('slug', $request->category)->first();
            $show_data['category'] = $request->category;
            $query                  = $query->where('category_id', $category_info->id);
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
            $query = $query->join('users', 'bootcamps.user_id', '=', 'users.id') // Join with the users table
                ->join('bootcamp_categories', 'bootcamps.category_id', '=', 'bootcamp_categories.id')
                ->select('bootcamps.*', 'users.name as user_name', 'bootcamp_categories.title as category_title');

            // Apply the condition to search for either the course title or the user name
            $query->where(function ($query) use ($search) {
                $query->where('bootcamps.title', 'LIKE', "%$search%")
                    ->orWhere('users.name', 'LIKE', "%$search%")
                    ->orWhere('bootcamp_categories.title', 'LIKE', "%$search%");
            });
        }

        $show_data['instructor']       = $instructor;
        $show_data['status']           = $status;
        $show_data['price']            = $price;
        $show_data['bootcamps'] = $query->orderBy('id', 'DESC')->paginate($perPage)->appends(request()->query());

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.bootcamp.data_container', $show_data)->render();
        }

        return view('admin::bootcamp.index', $show_data);
    }
    public function bootcamp_create()
    {
        return view('admin.bootcamp.create');
    }

    public function bootcamp_store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required',
            'description' => 'required',
            'category' => 'required|numeric|min:1',
            'price_type' => Rule::in(['0', '1']),
            'price' => 'required_if:is_paid,1|min:1|nullable|numeric',
            'discount_flag' => Rule::in(['', '1']),
            'discounted_price' => 'required_if:discount_flag,1|min:1|nullable|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',

        ]);


        if (Bootcamp::where('slug', slugify($request->title))->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one bootcamp with the same name. Please change your bootcamp name');
        }


        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['short_description'] = $request->short_description;
        $data['description'] = $request->description;
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;
        $data['publish_date'] = strtotime($request->publish_date);
        if ($request->price_type != 0) {
            $data['is_paid'] = $request->price_type;
            $data['price'] = $request->price;
            $data['discount_flag'] = $request->discount_flag;
            if ($request->discount_flag == 1) {
                $data['discounted_price'] = $request->discounted_price;
            }
        } else {
            $data['is_paid'] = $request->price_type;
        }

        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/bootcamp/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
        }


        Bootcamp::insert($data);

        return redirect(route("admin.bootcamp"))->with('success', translate('Added successfully'));
    }

    public function bootcamp_edit($id)
    {
        $show_data['bootcamp'] = Bootcamp::where('id', $id)->first();
        return view('admin::bootcamp.edit', $show_data);
    }

    public function bootcamp_update(Request $request)
    {
        $query = Bootcamp::where('id', $request->id);
        if ($request->tab == 'basic') {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'short_description' => 'required',
                'description' => 'required',
                'category' => 'required|numeric|min:1',
            ]);

            if (Bootcamp::where('slug', slugify($request->title))->where('id', '!=', $request->id)->count() > 0) {
                return redirect(route('admin.course'))->with('error', 'There cannot be more than one bootcamp with the same name. Please change your bootcamp name');
            }
            $basic_data['title'] = $request->title;
            $basic_data['slug'] = slugify($request->title);
            $basic_data['short_description'] = $request->short_description;
            $basic_data['description'] = $request->description;
            $basic_data['user_id'] = Auth::user()->id;
            $basic_data['category_id'] = $request->category;
            $basic_data['publish_date'] = strtotime($request->publish_date);
            $query->update($basic_data);
        } elseif ($request->tab == 'info') {


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
            $validated = $request->validate([
                'price_type' => Rule::in(['0', '1']),
                'price' => 'required_if:is_paid,1|min:1|nullable|numeric',
            ]);
            $price_data['is_paid'] = $request->price_type;
            $price_data['price'] = $request->price;
            $price_data['discount_flag'] = $request->discount_flag;
            $price_data['discounted_price'] = $request->discounted_price;
            $query->update($price_data);
        } elseif ($request->tab == 'gallery') {
            if (isset($request->thumbnail)) {
                $gallery_data['thumbnail'] = "uploads/bootcamp/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
                FileUploader::upload($request->thumbnail, $gallery_data['thumbnail'], 470, 360, 200, 360);
                remove_file($query->first()->thumbnail);
            }
            $query->update($gallery_data);
        } elseif ($request->tab == 'seo') {

            $seo = Seo::where('name_route', 'bootcamp.details')->where('bootcamp_id', $request->id)->first();
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
            $seo_data['bootcamp_id'] = $request->id;
            $seo_data['route'] = 'Bootcamp Details';
            $seo_data['name_route'] = 'bootcamp.details';
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

                Seo::where('name_route', 'bootcamp.details')->where('bootcamp_id', $request->id)->update($seo_data);
            } else {
                Seo::insert($seo_data);
            }
        }

        return response()->json([
            'status'       => true,
            'success'      => translate('Update successfully'),
        ]);
    }

    //delete bootcamp
    public function bootcamp_delete($id)
    {
        $query = Bootcamp::where('id', $id);
        foreach ($query->first()->module as $module) {
            $this->module_delete($module->id);
        }
        remove_file($query->first()->thumbnail);
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }

    //bootcamp category
    public function bootcamp_category()
    {
        $show_data['bootcamp_categories'] = BootcampCategory::orderBy('id', 'DESC')->get();
        return view('admin.bootcamp.category', $show_data);
    }
    public function bootcamp_category_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255'
        ]);
        if (BootcampCategory::where('slug', slugify($request->title))->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one category with the same. Please change your category title');
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        BootcampCategory::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }

    public function bootcamp_category_update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255'
        ]);
        if (BootcampCategory::where('slug', slugify($request->title))->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one category with the same. Please change your category title');
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        BootcampCategory::where('id', $request->id)->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function bootcamp_category_delete($id)
    {
        $query = BootcampCategory::where('id', $id);
        foreach ($query->first()->bootcamp as $bootcamp) {
            $this->bootcamp_delete($bootcamp->id);
        }
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }


    public function module_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        if (BootcampModule::where('title', $request->title)->where('bootcamp_id', $request->bootcamp_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one module with the same name. Please change your module name');
        }
        $data['title'] = $request->title;
        $data['bootcamp_id'] = $request->bootcamp_id;
        $data['user_id'] = Auth::user()->id;
        $data['status'] = $request->status;
        $study_plan                 = explode('-', $request->study_plan);
        $data['publish_date'] = strtotime($study_plan[0]);
        $data['expiry_date']  = strtotime($study_plan[1]);

        BootcampModule::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }
    public function module_update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        if (BootcampModule::where('title', $request->title)->where('bootcamp_id', $request->bootcamp_id)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one module with the same name. Please change your module name');
        }
        $data['title'] = $request->title;
        $data['status'] = $request->status;
        $study_plan                 = explode('-', $request->study_plan);
        $data['publish_date'] = strtotime($study_plan[0]);
        $data['expiry_date']  = strtotime($study_plan[1]);

        BootcampModule::where('id', $request->id)->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function module_sort(Request $request)
    {
        $bootcamps = json_decode($request->itemJSON);
        foreach ($bootcamps as $key => $value) {
            $updater = $key + 1;
            BootcampModule::where('id', $value)->update(['sort' => $updater]);
        }
        Session::flash('success', translate('Module has been sorted.'));
    }

    public function module_delete($id)
    {
        $query = BootcampModule::where('id', $id);
        foreach ($query->first()->live_class as $live_class) {
            $this->class_delete($live_class->id);
        }
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }

    public function class_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'date'        => 'required|date',
            'start_time'  => 'required|string',
            'end_time'    => 'required|string|after:start_time',
            'module_id'   => 'required',
            'summary' => 'required',
            'status' => 'required',
        ]);
        if (BootcampLiveClass::where('title', $request->title)->where('module_id', $request->module_id)->where('bootcamp_id', $request->bootcamp_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one class with the same name. Please change your class name');
        }

        // process class schedule
        $start           = $request->date . ' ' . $request->start_time;
        $start_time = strtotime($start);
        $end             = $request->date . ' ' . $request->end_time;
        $end_time   = strtotime($end);

        // check selected module
        $module = BootcampModule::where('id', $request->module_id)->first();
        if (! $module) {
            return redirect()->with('error', translate('Module does not exist.'));
        }

        // check module and class schedule
        if (isset($module->status)) {
            if ($module->status == 1 && $start_time < $module->publish_date) {
                return redirect()->with('error', translate('Please set class schedule properly.'));
            }
            if ($module->status == 2 && (($start_time < $module->publish_date || $start_time > $module->expiry_date) && ($end_time < $module->publish_date || $end_time > $module->expiry_date))) {
                return redirect()->with('error', translate('Please set class schedule properly.'));
            }
        }

        $data['title']       = $request->title;
        $data['bootcamp_id']       = $request->bootcamp_id;
        $data['summary'] = $request->summary;
        $data['status']      = $request->status;
        $data['module_id']   = $request->module_id;
        $data['start_time']  = $start_time;
        $data['end_time']    = $end_time;

        $joiningData    = ZoomMeetController::createMeeting($request->title, $start_time);
        $joiningInfoArr = json_decode($joiningData, true);

        if (array_key_exists('code', $joiningInfoArr) && $joiningInfoArr) {
            return redirect(route('admin.bootcamp.edit', ['id' => $module->bootcamp_id, 'tab' => 'curriculum']))->with('error', translate($joiningInfoArr['message']));
        }

        $data['provider']     = 'zoom';
        $data['joining_data'] = $joiningData;

        BootcampLiveClass::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));;
    }

    //live class update
    public function class_update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'date'        => 'required|date',
            'start_time'  => 'required|string',
            'end_time'    => 'required|string|after:start_time',
            'module_id'   => 'required',
            'summary' => 'required',
            'status' => 'required',
        ]);
        if (BootcampLiveClass::where('title', $request->title)->where('module_id', $request->module_id)->where('bootcamp_id', $request->bootcamp_id)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one class with the same name. Please change your class name');
        }

        // process class schedule
        $start           = $request->date . ' ' . $request->start_time;
        $start_time = strtotime($start);
        $end             = $request->date . ' ' . $request->end_time;
        $end_time   = strtotime($end);

        // check selected module
        $module = BootcampModule::where('id', $request->module_id)->first();
        if (! $module) {
            return redirect()->with('error', translate('Module does not exist.'));
        }

        // check module and class schedule
        if (isset($module->status)) {
            if ($module->status == 1 && $start_time < $module->publish_date) {
                return redirect()->with('error', translate('Please set class schedule properly.'));
            }
            if ($module->status == 2 && (($start_time < $module->publish_date || $start_time > $module->expiry_date) && ($end_time < $module->publish_date || $end_time > $module->expiry_date))) {
                return redirect()->with('error', translate('Please set class schedule properly.'));
            }
        }

        $data['title']       = $request->title;
        $data['bootcamp_id']       = $request->bootcamp_id;
        $data['summary'] = $request->summary;
        $data['status']      = $request->status;
        $data['module_id']   = $request->module_id;
        $data['start_time']  = $start_time;
        $data['end_time']    = $end_time;

        $joiningData    = ZoomMeetController::createMeeting($request->title, $start_time);
        $joiningInfoArr = json_decode($joiningData, true);

        if (array_key_exists('code', $joiningInfoArr) && $joiningInfoArr) {
            return redirect(route('admin.bootcamp.edit', ['id' => $module->bootcamp_id, 'tab' => 'curriculum']))->with('error', translate($joiningInfoArr['message']));
        }
        $data['joining_data'] = $joiningData;

        BootcampLiveClass::where('id', $request->id)->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    //live class sort
    public function class_sort(Request $request)
    {
        $live_classs = json_decode($request->itemJSON);
        foreach ($live_classs as $key => $value) {
            $updater = $key + 1;
            BootcampLiveClass::where('id', $value)->update(['sort' => $updater]);
        }
        Session::flash('success', translate('Live class has been sorted.'));
    }

    // live class delete
    public function class_delete($id)
    {
        BootcampLiveClass::where('id', $id)->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }
}
