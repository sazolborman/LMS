<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\FileUploader;
use App\Models\FrontendSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function blog(Request $request)

    {
        if ($request->tab == 'active' || $request->tab == '') {
            // Get the number of items per page (default to 10 if not provided)
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $query = Blog::where('status', 1);

            // search filter
            if ($search) {
                $query = $query->join('users', 'blogs.user_id', '=', 'users.id') // Join with the users table
                    ->join('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                    ->select('blogs.*', 'users.name as user_name', 'users.email as user_email', 'blog_categories.title as category_title');


                // Apply the condition to search for either the course title or the user name
                $query->where(function ($query) use ($search) {
                    $query->where('users.email', 'LIKE', "%$search%")
                        ->orWhere('users.name', 'LIKE', "%$search%")
                        ->orWhere('blogs.title', 'LIKE', "%$search%")
                        ->orWhere('blog_categories.title', 'LIKE', "%$search%");
                });
            }

            $active_data['blogs'] = $query->orderBy('id', 'DESC')->paginate($perPage);

            if ($request->ajax()) {
                return view('admin.blog.active_blog', $active_data)->render();
            }
            return view('admin.blog.index', $active_data);
        }
        if ($request->tab == 'pending') {
            // Get the number of items per page (default to 10 if not provided)
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $query = Blog::where('status', 0);

            // search filter
            if ($search) {
                $query = $query->join('users', 'blogs.user_id', '=', 'users.id') // Join with the users table
                    ->join('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                    ->select('blogs.*', 'users.name as user_name', 'users.email as user_email', 'blog_categories.title as category_title');


                // Apply the condition to search for either the course title or the user name
                $query->where(function ($query) use ($search) {
                    $query->where('users.email', 'LIKE', "%$search%")
                        ->orWhere('users.name', 'LIKE', "%$search%")
                        ->orWhere('blogs.title', 'LIKE', "%$search%")
                        ->orWhere('blog_categories.title', 'LIKE', "%$search%");
                });
            }

            $active_data['blogs'] = $query->orderBy('id', 'DESC')->paginate($perPage);

            if ($request->ajax()) {
                return view('admin.blog.pending_blog', $active_data)->render();
            }
            return view('admin.blog.index', $active_data);
        }
    }
    public function blog_create()
    {
        return view('admin::blog.create');
    }
    public function blog_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'keywords' => 'max:400',
            'thumbnail' => 'image|mimes:jpeg,png,jpg',
            'banner' => 'image|mimes:jpeg,png,jpg',
        ]);
        if (Blog::where('slug', slugify($request->title))->count() > 0) {
            return redirect()->back()->with('error', translate('There cannot be more than one blog with the same title. Please change your blog title'));
        }
        $data['category_id'] = $request->category;
        $data['user_id'] = Auth::user()->id;
        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['keywords'] = $request->keywords;
        $data['description'] = $request->description;
        if (isset($request->thumbnail) && $request->thumbnail != '') {
            $data['thumbnail'] = "uploads/blog/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 400, null, 200, 200);
        }
        if (isset($request->banner) && $request->banner != '') {
            $data['banner'] = "uploads/blog/banner/" . nice_file_name($request->title, $request->banner->extension());
            FileUploader::upload($request->banner, $data['banner'], 400, null, 200, 200);
        }
        $data['status'] = 1;
        Blog::insert($data);
        return redirect(route('admin.blog'))->with('success', translate('Added successfully'));
    }

    public function blog_edit($id)
    {
        $show_data['blog'] = Blog::where('id', $id)->first();
        return view('admin::blog.edit', $show_data);
    }
    public function blog_update(Request $request)
    {
        $query = Blog::where('id', $request->id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'keywords' => 'max:400',
            'thumbnail' => 'image|mimes:jpeg,png,jpg',
            'banner' => 'image|mimes:jpeg,png,jpg',
        ]);
        if (Blog::where('slug', slugify($request->title))->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', translate('There cannot be more than one blog with the same title. Please change your blog title'));
        }
        $data['category_id'] = $request->category;
        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['keywords'] = $request->keywords;
        $data['description'] = $request->description;
        if (isset($request->thumbnail) && $request->thumbnail != '') {
            $data['thumbnail'] = "uploads/blog/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 400, null, 200, 200);
            remove_file($query->first()->thumbnail);
        }
        if (isset($request->banner) && $request->banner != '') {
            $data['banner'] = "uploads/blog/banner/" . nice_file_name($request->title, $request->banner->extension());
            FileUploader::upload($request->banner, $data['banner'], 400, null, 200, 200);
            remove_file($query->first()->banner);
        }
        $query->update($data);
        return redirect(route('admin.blog'))->with('success', translate('Update successfully'));
    }

    public function blog_status($id)
    {
        $query = Blog::where('id', $id);
        if ($query->first()->status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $query->update($data);
        return redirect(route('admin.blog'))->with('success', translate('Update successfully'));
    }

    public function blog_delete($id)
    {
        $query = Blog::where('id', $id);
        remove_file($query->first()->thumbnail);
        remove_file($query->first()->banner);
        $query->delete();
        return redirect(route('admin.blog'))->with('success', translate('Delete successfully'));
    }
    public function blog_category()
    {
        $show_data['categories'] = BlogCategory::get();
        return view('admin::blog.category', $show_data);
    }

    public function blog_category_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required|max:255',
        ]);
        if (BlogCategory::where('slug', slugify($request->title))->count() > 0) {
            return redirect()->back()->with('error', translate('There cannot be more than one blog category with the same name. Please change your blog category name'));
        }
        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['short_description'] = $request->short_description;
        BlogCategory::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }
    public function blog_category_update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required|max:255',
        ]);
        if (BlogCategory::where('slug', slugify($request->title))->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', translate('There cannot be more than one blog category with the same name. Please change your blog category name'));
        }
        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['short_description'] = $request->short_description;
        BlogCategory::where('id', $request->id)->update($data);
        return redirect()->back()->with('success', translate('Update successfully'));
    }

    public function blog_category_delete($id)
    {
        $query = BlogCategory::where('id', $id);
        foreach ($query->first()->blog as $blog) {
            $this->blog_delete($blog->id);
        }
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }

    public function blog_setting()
    {
        return view('admin::blog.setting');
    }

    public function blog_setting_update(Request $request)
    {
        $data['value'] = $request->instructors_permission;
        FrontendSetting::where('key', 'instructors_blog_permission')->update($data);

        $data['value'] = $request->visibility_on_the_homepage;
        FrontendSetting::where('key', 'blog_visibility_on_the_home_page')->update($data);

        return response()->json([
            'status'       => true,
            'success'      => translate('Blog Setting Update successfully.')
        ]);
    }
}
