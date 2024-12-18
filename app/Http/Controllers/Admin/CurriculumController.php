<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\FileUploader;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function section_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        if (Section::where('title', $request->title)->where('course_id', $request->course_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one section with the same name. Please change your section name');
        }
        $data['title'] = $request->title;
        $data['release_date'] = $request->release_date;
        $data['user_id'] = Auth::user()->id;
        $data['course_id'] = $request->course_id;
        Section::insert($data);

        return redirect()->back()->with('success', translate('Added successfully'));
    }
    public function section_sort(Request $request)
    {
        $sections = json_decode($request->itemJSON);
        foreach ($sections as $key => $value) {
            $updater = $key + 1;
            Section::where('id', $value)->update(['sort' => $updater]);
        }
        Session::flash('success', translate('Section has been sorted.'));
    }
    public function section_update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        if (Section::where('title', $request->title)->where('course_id', $request->course_id)->where('id', '!=', $request->id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one section with the same name. Please change your section name');
        }
        $data['release_date'] = $request->release_date;
        $data['title'] = $request->title;
        Section::where('id', $request->id)->update($data);

        return redirect()->back()->with('success', translate('Update successfully'));
    }
    public function section_delete($id)
    {
        $query = Section::where('id', $id);
        foreach ($query->first()->lesson as $lesson) {
            $this->lesson_delete($lesson->id);
        }
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }

    public function lesson_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        if (Lesson::where('title', $request->title)->where('section_id', $request->section_id)->where('course_id', $request->course_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one lesson with the same name. Please change your lesson name');
        }
        $data['title'] = $request->title;
        $data['user_id'] = Auth::user()->id;
        $data['course_id'] = $request->course_id;
        $data['section_id'] = $request->section_id;
        $data['release_date'] = $request->release_date;
        $data['is_free'] = $request->makeAsFree;
        $data['lesson_type'] = $request->lesson_type;
        $data['summary'] = $request->description;
        if ($request->lesson_type == 'text') {
            $validated = $request->validate([
                'text_description' => 'required',
            ]);
            $data['attachment'] = $request->text_description;
            $data['attachment_type'] = $request->lesson_provider;
        } elseif ($request->lesson_type == 'youtube' || $request->lesson_type == 'vimo' || $request->lesson_type == 'video_url' || $request->lesson_type == 'google_drive') {
            $validated = $request->validate([
                'lesson_src' => 'required|url',
            ]);
            $data['video_type'] = $request->lesson_provider;
            $data['lesson_src'] = $request->lesson_src;
        } elseif ($request->lesson_type == 'document_file') {
            if ($request->attachment_type == 'text-file') {
                $validated = $request->validate([
                    'attachment' => 'required|file|mimes:txt',
                ]);
            } elseif ($request->attachment_type == 'pdf-file') {
                $validated = $request->validate([
                    'attachment' => 'required|file|mimes:pdf',
                ]);
            } elseif ($request->attachment_type == 'doc-file') {
                $validated = $request->validate([
                    'attachment' => 'required|file|mimes:doc,docx,',
                ]);
            }
            $data['attachment'] = "uploads/lesson_file/attachment/" . nice_file_name($request->title, $request->attachment->extension());
            FileUploader::upload($request->attachment, $data['attachment']);
            $data['attachment_type'] = $request->attachment_type;
        } elseif ($request->lesson_type == 'image_file') {
            $validated = $request->validate([
                'attachment' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
            $data['attachment'] = "uploads/lesson_file/attachment/" . nice_file_name($request->title, $request->attachment->extension());
            FileUploader::upload($request->attachment, $data['attachment']);

            $item = $request->file('attachment');
            $data['attachment_type'] = $item->getClientOriginalExtension();
        } elseif ($request->lesson_type == 'video_file') {
            $validated = $request->validate([
                'system_video_file' => 'required|file|mimes:mp4,avi,mov,wmv,mkv',
            ]);

            $data['lesson_src'] = "uploads/lesson_file/videos/" . nice_file_name($request->title, $request->system_video_file->extension());
            FileUploader::upload($request->system_video_file, $data['lesson_src']);

            $data['video_type'] = $request->lesson_provider;
        } elseif ($request->lesson_type == 'audio_file') {
            $validated = $request->validate([
                'audio_file' => 'required',
            ]);
            $data['lesson_src'] = "uploads/lesson_file/audios/" . nice_file_name($request->title, $request->audio_file->extension());
            FileUploader::upload($request->audio_file, $data['lesson_src']);
        }

        Lesson::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }

    public function lesson_sort(Request $request)
    {
        $lessons = json_decode($request->itemJSON);
        foreach ($lessons as $key => $value) {
            $updater = $key + 1;
            Lesson::where('id', $value)->update(['sort' => $updater]);
        }
        Session::flash('success', translate('Lesson has been sorted.'));
    }

    public function lesson_update(Request $request)
    {
        $query = Lesson::where('id', $request->lesson_id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        if (Lesson::where('title', $request->title)->where('section_id', $request->section_id)->where('course_id', $request->course_id)->where('id', '!=', $request->lesson_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one lesson with the same name. Please change your lesson name');
        }
        $data['title'] = $request->title;
        $data['section_id'] = $request->section_id;
        $data['release_date'] = $request->release_date;
        $data['is_free'] = $request->makeAsFree;
        $data['summary'] = $request->description;
        if ($request->lesson_type == 'text') {
            $validated = $request->validate([
                'text_description' => 'required',
            ]);
            $data['attachment'] = $request->text_description;
        } elseif ($request->lesson_type == 'youtube' || $request->lesson_type == 'vimo' || $request->lesson_type == 'video_url' || $request->lesson_type == 'google_drive') {
            $validated = $request->validate([
                'lesson_src' => 'required|url',
            ]);

            $data['lesson_src'] = $request->lesson_src;
        } elseif ($request->lesson_type == 'document_file') {
            if ($request->attachment_type == 'text-file') {
                $validated = $request->validate([
                    'attachment' => 'required|file|mimes:txt',
                ]);
            } elseif ($request->attachment_type == 'pdf-file') {
                $validated = $request->validate([
                    'attachment' => 'required|file|mimes:pdf',
                ]);
            } elseif ($request->attachment_type == 'doc-file') {
                $validated = $request->validate([
                    'attachment' => 'required|file|mimes:doc,docx,',
                ]);
            }
            $data['attachment'] = "uploads/lesson_file/attachment/" . nice_file_name($request->title, $request->attachment->extension());
            FileUploader::upload($request->attachment, $data['attachment']);
            remove_file($query->first()->attachment);

            $data['attachment_type'] = $request->attachment_type;
        } elseif ($request->lesson_type == 'image_file') {
            $validated = $request->validate([
                'attachment' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
            $data['attachment'] = "uploads/lesson_file/attachment/" . nice_file_name($request->title, $request->attachment->extension());
            FileUploader::upload($request->attachment, $data['attachment']);
            remove_file($query->first()->attachment);

            $data['attachment_type'] = $request->attachment->extension();
        } elseif ($request->lesson_type == 'video_file') {
            $validated = $request->validate([
                'system_video_file' => 'required|file|mimes:mp4,avi,mov,wmv,mkv',
            ]);

            $data['lesson_src'] = "uploads/lesson_file/videos/" . nice_file_name($request->title, $request->system_video_file->extension());
            FileUploader::upload($request->system_video_file, $data['lesson_src']);
            remove_file($query->first()->lesson_src);
        } elseif ($request->lesson_type == 'audio_file') {
            $validated = $request->validate([
                'audio_file' => 'required',
            ]);
            $data['lesson_src'] = "uploads/lesson_file/audios/" . nice_file_name($request->title, $request->audio_file->extension());
            FileUploader::upload($request->audio_file, $data['lesson_src']);
            remove_file($query->first()->lesson_src);
        }

        $query->update($data);
        return redirect()->back()->with('success', translate('Update successfully'));
    }
    public function lesson_delete($id)
    {
        $query = Lesson::where('id', $id);
        if ($query->first()->lesson_type == 'document_file') {
            remove_file($query->first()->attachment);
        } elseif ($query->first()->lesson_type == 'image_file') {
            remove_file($query->first()->attachment);
        } elseif ($query->first()->lesson_type == 'video_file') {
            remove_file($query->first()->lesson_src);
        } elseif ($query->first()->lesson_type == 'audio_file') {
            remove_file($query->first()->lesson_src);
        } elseif ($query->first()->lesson_type == 'assignment') {
            remove_file($query->first()->assignment_question_file);
        }
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }

    public function quiz_store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required',
            'section'    => 'required|numeric',
            'second'     => 'max:59',
            'minute'     => 'max:59',
            'hour'       => 'max:23',
            'total_mark' => 'required|numeric',
            'pass_mark'  => 'required|numeric',
            'retake'     => 'required|numeric|min:1',
        ]);

        if (Lesson::where('title', $request->title)->where('section_id', $request->section_id)->where('course_id', $request->course_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one lesson with the same name. Please change your lesson name');
        }

        $hour   = $request->hour;
        $minute = $request->minute;
        $second = $request->second;

        if ($hour == 0 && $minute == 0 && $second == 0) {
            return redirect()->back()->with('error', 'If hour and minute are 0, second must be greater than 0.');
        } elseif ($hour == 0 && $minute == 0 && $second < 1) {
            return redirect()->back()->with('error', 'If hour is 0, minute must be greater than 0.');
        } elseif ($minute == 0 && $second == 0 && $hour < 1) {
            return redirect()->back()->with('error', 'If minute and second are 0, hour must be greater than 0.');
        }

        if ($request->pass_mark > $request->total_mark) {
            return redirect()->back()->with('error', 'The pass mark must be less than the total mark.');
        }
        $data['title']       = $request->title;
        $data['section_id']  = $request->section;
        $data['total_mark']  = $request->total_mark;
        $data['pass_mark']   = $request->pass_mark;
        $data['retake']      = $request->retake;
        $data['description'] = $request->description;
        $data['course_id'] = $request->course_id;
        $data['lesson_type'] = 'quiz';
        $data['status']      = 1;
        $data['user_id']     = Auth::user()->id;

        $hour             = $request->hour ?? 0;
        $minute           = $request->minute ?? 0;
        $second           = $request->second ?? 0;
        $data['duration'] = $hour . ':' . $minute . ':' . $second;

        Lesson::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }
    public function quiz_update(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required',
            'section'    => 'required|numeric',
            'second'     => 'max:59',
            'minute'     => 'max:59',
            'hour'       => 'max:23',
            'total_mark' => 'required|numeric',
            'pass_mark'  => 'required|numeric',
            'retake'     => 'required|numeric|min:1',
        ]);

        if (Lesson::where('title', $request->title)->where('section_id', $request->section_id)->where('course_id', $request->course_id)->where('id', '!=', $request->lesson_id)->count() > 0) {
            return redirect()->back()->with('error', 'There cannot be more than one lesson with the same name. Please change your lesson name');
        }

        $hour   = $request->hour;
        $minute = $request->minute;
        $second = $request->second;

        if ($hour == 0 && $minute == 0 && $second == 0) {
            return redirect()->back()->with('error', 'If hour and minute are 0, second must be greater than 0.');
        } elseif ($hour == 0 && $minute == 0 && $second < 1) {
            return redirect()->back()->with('error', 'If hour is 0, minute must be greater than 0.');
        } elseif ($minute == 0 && $second == 0 && $hour < 1) {
            return redirect()->back()->with('error', 'If minute and second are 0, hour must be greater than 0.');
        }

        if ($request->pass_mark > $request->total_mark) {
            return redirect()->back()->with('error', 'The pass mark must be less than the total mark.');
        }
        $data['title']       = $request->title;
        $data['section_id']  = $request->section;
        $data['total_mark']  = $request->total_mark;
        $data['pass_mark']   = $request->pass_mark;
        $data['retake']      = $request->retake;
        $data['description'] = $request->description;
        $data['course_id'] = $request->course_id;

        $hour             = $request->hour ?? 0;
        $minute           = $request->minute ?? 0;
        $second           = $request->second ?? 0;
        $data['duration'] = $hour . ':' . $minute . ':' . $second;

        Lesson::where('id', $request->lesson_id)->update($data);
        return redirect()->back()->with('success', translate('Update successfully'));
    }



    public function question_store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required',
            'type'    => 'required',
            'answer'  => 'required',
            'options' => 'required_if:type,mcq',
        ]);

        $answer = null;
        if ($request->type == 'mcq') {
            $answer          = json_encode($request->answer);
            $data['options'] = json_encode(array_column(json_decode($request->options, true), 'value'));
        } elseif ($request->type == 'fill_blanks') {
            $answers = json_decode($request->answer);
            $answer  = json_encode(array_column($answers, 'value'));
        } elseif ($request->type == 'true_false') {
            $answer = $request->answer;
        }

        $data['quiz_id'] = $request->quiz_id;
        $data['title']   = $request->title;
        $data['type']    = $request->type;
        $data['answer']  = $answer;

        Question::insert($data);

        return response()->json([
            'status'       => true,
            'success'      => translate('Question has been added.'),
            'functionCall' => 'responseBack()',
        ]);
    }
    public function question_type(Request $request)
    {
        $show_data = [];
        $types     = [
            'mcq'         => 'mcq',
            'fill_blanks' => 'fill_blanks',
            'true_false'  => 'true_false',
        ];

        if (isset($types[$request->type])) {
            $action = $request->id ? 'edit' : 'create';
            $path   = "admin.course.quiz.question.{$action}_{$types[$request->type]}";

            if ($request->id) {
                $show_data['question'] = Question::where('id', $request->id)->first();
            }
        }

        return view($path, $show_data);
    }

    public function question_update(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required',
            'type'    => 'required',
            'answer'  => 'required',
            'options' => 'required_if:type,mcq',
        ]);

        $answer = $data['options'] = null;
        if ($request->type == 'mcq') {
            $answer          = json_encode($request->answer);
            $data['options'] = json_encode(array_column(json_decode($request->options, true), 'value'));
        } elseif ($request->type == 'fill_blanks') {
            $answers = json_decode($request->answer);
            $answer  = json_encode(array_column($answers, 'value'));
        } elseif ($request->type == 'true_false') {
            $answer = $request->answer;
        }

        $data['quiz_id'] = $request->quiz_id;
        $data['title']   = $request->title;
        $data['type']    = $request->type;
        $data['answer']  = $answer;

        Question::where('id', $request->id)->update($data);

        return response()->json([
            'status'       => true,
            'success'      => translate('Question has been updated.'),
            'functionCall' => 'responseBack()',
        ]);
    }

    public function question_delete($id)
    {
        $question = Question::where('id', $id)->first();
        if (! $question) {
            return redirect()->back()->with('success', translate('Data not found'));
        }

        $question->delete();
        return response()->json(['success' => true, 'id' => $id]);
    }

    public function question_sort(Request $request)
    {
        $question = json_decode($request->itemJSON);
        foreach ($question as $key => $value) {
            $updater = $key + 1;
            Question::where('id', $value)->update(['sort' => $updater]);
        }
        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }


    //assignment store
    public function assignment_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'question' => 'required',
            'deadline_time' => 'required',
            'deadline_date' => 'required|date',
            'total_marks' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        $date_time = $request->deadline_date . ' ' . $request->deadline_time;
        $start_time = strtotime($date_time);

        $data['title'] = $request->title;
        $data['section_id'] = $request->section_id;
        $data['course_id'] = $request->course_id;
        $data['assignment_question'] = $request->question;
        $data['assignment_deadline'] = $start_time;
        $data['total_mark'] = $request->total_marks;
        $data['status'] = $request->status;
        $data['assignment_note'] = $request->note;
        $data['lesson_type'] = $request->lesson_type;
        $data['user_id'] = Auth::user()->id;


        if (isset($request->question_file)) {
            $data['assignment_question_file'] = "uploads/assignment/question_file/" . nice_file_name($request->title, $request->question_file->extension());
            FileUploader::upload($request->question_file, $data['assignment_question_file']);
        }

        Lesson::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }

    public function assignment_update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'question' => 'required',
            'deadline_time' => 'required',
            'deadline_date' => 'required|date',
            'total_marks' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        $query = Lesson::where('id', $request->id);
        $date_time = $request->deadline_date . ' ' . $request->deadline_time;
        $start_time = strtotime($date_time);

        $data['title'] = $request->title;
        $data['section_id'] = $request->section_id;
        $data['assignment_question'] = $request->question;
        $data['assignment_deadline'] = $start_time;
        $data['total_mark'] = $request->total_marks;
        $data['status'] = $request->status;
        $data['assignment_note'] = $request->note;


        if (isset($request->question_file)) {
            $data['assignment_question_file'] = "uploads/assignment/question_file/" . nice_file_name($request->title, $request->question_file->extension());
            FileUploader::upload($request->question_file, $data['assignment_question_file']);
            remove_file($query->first()->assignment_question_file);
        }

        $query->update($data);
        return redirect()->back()->with('success', translate('Updated successfully'));
    }
}
