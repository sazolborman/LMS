<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

if (!function_exists('translate')) {

    function translate($phrase = '', $value_replace = array())
    {
        $active_lan    = session('language') ?? get_settings('language');
        $active_lan_id = DB::table('languages')->where('name', 'like', $active_lan)->value('id');
        $lan_phrase    = DB::table('language_phrases')->where('language_id', $active_lan_id)->where('phrase', $phrase)->first();

        if ($lan_phrase) {
            $translated = $lan_phrase->translated;
        } else {
            $translated  = $phrase;
            $english_lan = DB::table('languages')->where('name', 'like', 'english')->first();
            if (DB::table('language_phrases')->where('language_id', $english_lan->id)->where('phrase', $phrase)->count() == 0) {
                DB::table('language_phrases')->insert(['language_id' => $english_lan->id, 'phrase' => $phrase, 'translated' => $translated]);
            }
        }

        if (!is_array($value_replace)) {
            $value_replace = array($value_replace);
        }
        foreach ($value_replace as $replace) {
            $translated = preg_replace('/____/', $replace, $translated, 1); // Replace one placeholder at a time
        }

        return $translated;
    }
}
//currency
if (!function_exists('currency')) {
    function currency($price = false)
    {
        if ($price > 0) {
            return '$' . $price;
        } elseif ($price === false) {
            return '$';
        } else {
            return '$0';
        }
    }
}

// user information
if (!function_exists('get_user')) {
    function get_user($user_id = "")
    {
        if ($user_id != '') {
            $user_info = DB::table('users')->where('id', $user_id)->first();
            return $user_info;
        }
    }
}
//section count
if (!function_exists('section_count')) {
    function section_count($course_id = "")
    {
        $total_section = DB::table('sections')->where('course_id', $course_id)->count();
        return $total_section;
    }
}
// student enroll count
if (!function_exists('course_by_enrolled')) {
    function course_by_enrolled($course_id = "")
    {
        $enrolled = DB::table('enrollments')->where('course_id', $course_id)->count();
        return $enrolled;
    }
}
//lesson Count
if (!function_exists('lesson_count')) {
    function lesson_count($course_id = "")
    {
        $total_lesson = DB::table('lessons')->where('course_id', $course_id)->count();
        return $total_lesson;
    }
}
// category information
if (!function_exists('get_category')) {
    function get_category($category_id = "")
    {
        $category_by_id = DB::table('categories')->where('id', $category_id)->first();
        return $category_by_id;
    }
}

// bootcamp category information
if (!function_exists('get_bootcampCategory')) {
    function get_bootcampCategory($category_id = "")
    {
        $category_by_id = DB::table('bootcamp_categories')->where('id', $category_id)->first();
        return $category_by_id;
    }
}

// Global Settings
if (!function_exists('remove_file')) {
    function remove_file($url = null)
    {
        $url = public_path($url);
        $url = str_replace('optimized/', '', $url);
        $url_arr = explode('/', $url);
        $file_name = $url_arr[count($url_arr) - 1];

        if (is_file($url) && file_exists($url) && !empty($file_name)) {
            unlink($url);

            $url = str_replace($file_name, 'optimized/' . $file_name, $url);
            if (is_file($url) && file_exists($url)) {
                unlink($url);
            }
        }
    }
}
// check in root admin
if (!function_exists('is_root_admin')) {
    function is_root_admin($admin_id = '')
    {
        // GET THE LOGGEDIN IN ADMIN ID
        if (empty($admin_id)) {
            $admin_id = Auth::user()->id;
        }

        $get_admin_permissions = DB::table('permissions')->where('admin_id', $admin_id)->get('permissions');
        if ($get_admin_permissions->count() == 0) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('img')) {
    function img($path = null)
    {
        if (empty($path) || !is_string($path)) {
            return asset('global/images/default.png');
        }
        if ($path == 'user') {
            return asset('global/images/avatar.png');
        }
        if (file_exists(public_path($path))) {
            return asset($path);
        }
        return asset('global/images/default.png');
    }
}
if (!function_exists('settings_data')) {
    function settings_data($type = "", $return_type = false)
    {
        $value = DB::table('settings')->where('type', $type);
        if ($value->count() > 0) {
            if ($return_type === true) {
                return json_decode($value->value('description'), true);
            } elseif ($return_type === "object") {
                return json_decode($value->value('description'));
            } else {
                return $value->value('description');
            }
        } else {
            return false;
        }
    }
}
if (!function_exists('nice_file_name')) {
    function nice_file_name($file_title = "", $extension = "")
    {
        return slugify($file_title) . '-' . time() . '.' . $extension;
    }
}
if (!function_exists('slugify')) {
    function slugify($string)
    {
        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        return strtolower($string);
    }
}
// RANDOM NUMBER GENERATOR FOR ELSEWHERE
if (!function_exists('random')) {
    function random($length_of_string, $lowercase = false)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        $randVal = substr(str_shuffle($str_result), 0, $length_of_string);
        if ($lowercase) {
            $randVal = strtolower($randVal);
        }
        return $randVal;
    }
}

//get_course_by_user_id
if (!function_exists('get_course_by_user')) {
    function get_course_by_user($user_id = "")
    {
        $get_course = DB::table('courses')->where('user_id', $user_id)->first();
        return $get_course;
    }
}
//get_course
if (!function_exists('get_course')) {
    function get_course($course_id = "")
    {
        $get_course = DB::table('courses')->where('id', $course_id)->first();
        return $get_course;
    }
}
//get_ebook_category
if (!function_exists('get_ebook_category')) {
    function get_ebook_category($category_id = "")
    {
        $get_ebook_category = DB::table('ebook_categories')->where('id', $category_id)->first();
        return $get_ebook_category;
    }
}

//get frontend setting
if (!function_exists('get_frontend_settings')) {
    function get_frontend_settings($type = "", $return_type = false)
    {
        $value = DB::table('frontend_settings')->where('key', $type);
        if ($value->count() > 0) {
            if ($return_type === true) {
                return json_decode($value->value('value'), true);
            } elseif ($return_type === "object") {
                return json_decode($value->value('value'));
            } else {
                return $value->value('value');
            }
        } else {
            return false;
        }
    }
}

// get setting
if (!function_exists('get_settings')) {
    function get_settings($type = "", $return_type = false)
    {
        $value = App\Models\Setting::where('type', $type);
        if ($value->count() > 0) {
            if ($return_type === true) {
                return json_decode($value->value('description'), true);
            } elseif ($return_type === "object") {
                return json_decode($value->value('description'));
            } else {
                return $value->value('description');
            }
        } else {
            return false;
        }
    }
}
