<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $show_data['newsletters'] = Newsletter::orderBy('id', 'DESC')->get();
        return view('admin::newsletter.index', $show_data);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
            'description' => 'required',
        ]);

        $data['subject'] = $request->subject;
        $data['description'] = $request->description;

        Newsletter::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }
    public function update(Request $request)
    {
        $query =  Newsletter::where('id', $request->id);
        $validated = $request->validate([
            'subject' => 'required',
            'description' => 'required',
        ]);

        $data['subject'] = $request->subject;
        $data['description'] = $request->description;

        $query->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function delete($id)
    {
        Newsletter::where('id', $id)->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }
}
