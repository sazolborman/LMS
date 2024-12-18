<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FileUploader;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $CourseController;

    public function __construct(CourseController $CourseController)
    {
        $this->CourseController = $CourseController;
    }

    public function index()
    {
        $show_data['categories'] = Category::where('parent_id', 0)->orderBy('sort', 'asc')->get();
        return view('admin::course_category.index', $show_data);
    }
    public function category_store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'parent_id' => 'required|numeric|min:0',
            'icon' => 'required',
            'keywords' => 'max:400',
            'description' => 'max:500',
        ]);

        if (Category::where('slug', slugify($request->title))->count() > 0) {
            return redirect(route('admin.category'))->with('error', 'There cannot be more than one category with the same name. Please change your category name');
        }

        $data['parent_id'] = $request->parent_id;
        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['icon'] = $request->icon;
        $data['sort'] = 0;
        $data['keywords'] = $request->keyword;
        $data['description'] = $request->description;

        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/category-thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
        }

        Category::insert($data);

        return redirect(route('admin.category'))->with('success', translate('Added successfully'));
    }

    public function update(Request $request, $id)
    {

        $query = Category::where('id', $id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'parent_id' => 'required|numeric|min:0',
            'icon' => 'required',
            'keywords' => 'max:400',
            'description' => 'max:500',
        ]);

        if (Category::where('slug', slugify($request->title))->where('id', '!=', $id)->count() > 0) {
            return redirect(route('admin.category'))->with('error', translate('There cannot be more than one category with the same name. Please change your category name'));
        }

        $data['parent_id'] = $request->parent_id;
        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['icon'] = $request->icon;
        $data['keywords'] = $request->keyword;
        $data['description'] = $request->description;

        if (isset($request->thumbnail) && $request->thumbnail != '') {
            $data['thumbnail'] = "uploads/category-thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 400, null, 200, 200);
            remove_file($query->first()->thumbnail);
        }

        $query->update($data);

        return redirect(route('admin.category'))->with('success', translate('Updated successfully'));
    }

    public function delete($id)
    {
        $query = Category::where('id', $id);

        if ($query->first()->parent_id > 0) {
            foreach ($query->first()->course as $course) {
                $this->CourseController->course_delete($course->id);
            }
            remove_file($query->first()->thumbnail);
            $query->delete();
        } else {
            foreach ($query->first()->course as $course) {
                $this->CourseController->course_delete($course->id);
            }
            foreach ($query->first()->childs as $sub_category) {
                $sub_query = Category::where('id', $sub_category->id);
                remove_file($sub_query->first()->thumbnail);
                $sub_query->delete();
            }

            remove_file($query->first()->thumbnail);
            $query->delete();
        }

        return redirect(route('admin.category'))->with('success', translate('Category deleted successfully'));
    }
}
