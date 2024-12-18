<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\LanguagePhrase;
use App\Models\FileUploader;
use App\Models\Setting;

class LanguageController extends Controller
{
    public function language()
    {
        return view('admin.setting.language.index');
    }

    public function language_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'country_flag' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if (Language::where('name', $request->name)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one Language with the same name. Please change your Language name');
        }

        $data['name'] = $request->name;
        $data['direction'] = 'ltr';
        $data['created_at'] = date('Y-m-d H:i:s');

        if (isset($request->country_flag)) {
            $data['country_flag'] = "uploads/country_flag/" . nice_file_name($request->name, $request->country_flag->extension());
            FileUploader::upload($request->country_flag, $data['country_flag']);
        }

        $new_lan_id = Language::insertGetId($data);
        $english_lan_id = Language::where('name', 'like', 'English')->first()->id;
        foreach (LanguagePhrase::where('language_id', $english_lan_id)->get() as $en_lan_phrase) {
            LanguagePhrase::insert(['language_id' => $new_lan_id, 'phrase' => $en_lan_phrase->phrase, 'translated' => $en_lan_phrase->translated, 'created_at' => date('Y-m-d H:i:s')]);
        }
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function language_update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'country_flag' => 'image|mimes:jpeg,png,jpg'
        ]);

        if (Language::where('name', $request->name)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one Language with the same name. Please change your Language name');
        }

        $query = Language::where('id',  $request->id);

        $data['name'] = $request->name;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (isset($request->country_flag)) {
            $data['country_flag'] = "uploads/country_flag/" . nice_file_name($request->name, $request->country_flag->extension());
            FileUploader::upload($request->country_flag, $data['country_flag']);
            remove_file($query->first()->country_flag);
        }

        $query->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function language_delete($id)
    {
        $query = Language::where('id',  $id);
        remove_file($query->first()->country_flag);
        $query->delete();
        return redirect()->back()->with('success', translate('Deleted successfully'));
    }
    public function language_select($param)
    {

        Setting::where('type', 'language')->update(['description' => $param]);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }

    public function direction_update(Request $request)
    {
        Language::where('id', $request->language_id)->update(['direction' => $request->direction]);
        return true;
    }
    public function language_phrase($id)
    {
        $show_data['phrases'] = LanguagePhrase::where('language_id', $id)->get();
        $show_data['language'] = Language::where('id', $id)->first();
        return view('admin.setting.language.edit_phrase', $show_data);
    }
    public function language_phrase_update(Request $request, $phrase_id)
    {
        $data['translated'] = $request->translated_phrase;
        $data['updated_at'] = date('Y-m-d H:i:s');
        LanguagePhrase::where('id', $phrase_id)->update($data);
    }
}
