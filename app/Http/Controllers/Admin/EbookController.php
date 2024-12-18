<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EbookCategory;
use App\Models\Ebook;
use App\Models\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class EbookController extends Controller
{
    public function index(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = Ebook::query();

        // search filter
        if ($search) {
            $query = $query->join('users', 'ebooks.user_id', '=', 'users.id') // Join with the users table
                ->join('ebook_categories', 'ebooks.category', '=', 'ebook_categories.id') // Join with categories table
                ->select('ebooks.*', 'users.name as user_name', 'users.email as user_email', 'ebook_categories.title as categories_title'); // Select relevant fields

            // Add a where clause to filter by user name, category title, or ebook title
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('ebook_categories.title', 'LIKE', "%$search%")
                    ->orWhere('users.name', 'LIKE', "%$search%")
                    ->orWhere('users.email', 'LIKE', "%$search%")
                    ->orWhere('ebooks.title', 'LIKE', "%$search%"); // Ensure 'ebooks.title' matches the column name in the table
            });
        }
        $show_data['ebooks'] = $query->orderBy('id', 'DESC')->paginate($perPage)->appends(request()->query());
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.ebook.data_container', $show_data)->render();
        }

        return view('admin::ebook.index', $show_data);
    }

    public function create()
    {
        return view('admin::ebook.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required|numeric|min:1',
            'price_type' => Rule::in(['0', '1']),
            'price' => 'required_if:is_paid,1|min:1|nullable|numeric',
            'discount_flag' => Rule::in(['', '1']),
            'discounted_price' => 'required_if:discount_flag,1|min:1|nullable|numeric',
            'preview' => 'required',
            'main' => 'required',
            'edition' => 'required',
            'publication' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',

        ]);
        if (Ebook::where('slug', slugify($request->title))->count() > 0) {
            return redirect(route('admin.ebook'))->with('error', 'There cannot be more than one ebook with the same name. Please change your ebook name');
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['description'] = $request->description;
        $data['user_id'] = Auth::user()->id;
        $data['category'] = $request->category;
        $data['publication_name'] = $request->publication;
        $data['edition'] = $request->edition;
        $data['status'] = 1;
        $data['is_paid'] = $request->price_type;
        if ($request->price_type != 0) {
            $data['price'] = $request->price;
            $data['is_discount'] = $request->discount_flag;
            if ($request->discount_flag == 1) {
                $data['discount_price'] = $request->discounted_price;
            }
        }

        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/ebook/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
        }
        if (isset($request->main)) {
            $data['main_file'] = "uploads/ebook/main_file/" . nice_file_name($request->title, $request->main->extension());
            FileUploader::upload($request->main, $data['main_file']);
        }
        if (isset($request->preview)) {
            $data['preview_file'] = "uploads/ebook/preview_file/" . nice_file_name($request->title, $request->preview->extension());
            FileUploader::upload($request->preview, $data['preview_file']);
        }

        Ebook::insert($data);
        return redirect(route('admin.ebook'))->with('success', translate('Added successfully'));
    }

    public function edit($id)
    {
        $show_data['ebook'] = Ebook::where('id', $id)->first();
        return view('admin::ebook.edit', $show_data);
    }

    public function update(Request $request)
    {
        $query = Ebook::where('id', $request->id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required|numeric|min:1',
            'price_type' => Rule::in(['0', '1']),
            'price' => 'required_if:is_paid,1|min:1|nullable|numeric',
            'discount_flag' => Rule::in(['', '1']),
            'discounted_price' => 'required_if:discount_flag,1|min:1|nullable|numeric',
            'edition' => 'required',
            'publication' => 'required'

        ]);
        if (Ebook::where('slug', slugify($request->title))->where('id', '!=', $request->id)->count() > 0) {
            return redirect(route('admin.ebook'))->with('error', 'There cannot be more than one ebook with the same name. Please change your ebook name');
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['description'] = $request->description;
        $data['category'] = $request->category;
        $data['publication_name'] = $request->publication;
        $data['edition'] = $request->edition;
        $data['is_paid'] = $request->price_type;
        $data['price'] = $request->price;
        $data['is_discount'] = $request->discount_flag;
        $data['discount_price'] = $request->discounted_price;



        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/ebook/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
            remove_file($query->first()->thumbnail);
        }
        if (isset($request->main)) {
            $data['main_file'] = "uploads/ebook/main_file/" . nice_file_name($request->title, $request->main->extension());
            FileUploader::upload($request->main, $data['main_file']);
            remove_file($query->first()->main_file);
        }
        if (isset($request->preview)) {
            $data['preview_file'] = "uploads/ebook/preview_file/" . nice_file_name($request->title, $request->preview->extension());
            FileUploader::upload($request->preview, $data['preview_file']);
            remove_file($query->first()->preview_file);
        }

        $query->update($data);
        return redirect(route('admin.ebook'))->with('success', translate('Updated successfully'));
    }

    public function status($id)
    {
        $query = Ebook::where('id', $id);
        if ($query->first()->status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $query->update($data);
        return redirect(route('admin.ebook'))->with('success', translate('Updated successfully'));
    }
    public function delete($id)
    {
        $query = Ebook::where('id', $id);
        remove_file($query->first()->thumbnail);
        remove_file($query->first()->main_file);
        remove_file($query->first()->preview_file);
        $query->delete();
        return redirect(route('admin.ebook'))->with('success', translate('Deleted successfully'));
    }




    public function ebook_category()
    {
        $show_data['categories'] = EbookCategory::orderBy('id', 'DESC')->get();
        return view('admin::ebook.category', $show_data);
    }
    public function ebook_category_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255'
        ]);

        if (EbookCategory::where('slug', slugify($request->title))->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one category with the same title. Please change your category title');
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);
        $data['user_id'] = Auth::user()->id;

        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/ebook_category/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
        }
        EbookCategory::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }

    public function ebook_category_update(Request $request)
    {
        $query = EbookCategory::where('id', $request->id);
        $validated = $request->validate([
            'title' => 'required|max:255'
        ]);

        if (EbookCategory::where('slug', slugify($request->title))->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one category with the same title. Please change your category title');
        }

        $data['title'] = $request->title;
        $data['slug'] = slugify($request->title);

        if (isset($request->thumbnail)) {
            $data['thumbnail'] = "uploads/ebook_category/thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 470, 360, 200, 360);
            remove_file($query->first()->thumbnail);
        }
        $query->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function ebook_category_delete($id)
    {
        $query = EbookCategory::where('id', $id);
        remove_file($query->first()->thumbnail);
        foreach ($query->first()->ebook as $ebooks) {
            $this->delete($ebooks->id);
        }
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }
}
