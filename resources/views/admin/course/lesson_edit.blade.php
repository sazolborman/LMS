@php
    $lesson = App\Models\Lesson::where('id', $lesson_id)->first();
    $lesson_type = $lesson->lesson_type;
@endphp
<div class="w-100">
    <div class="ad-alert light-success-alert p-3 d-flex align-items-center gap-2">
        <div class="alert-icon">
            <i class="bi bi-columns-gap"></i>
        </div>
        <div class="alert-content">
            <h4 class="fs-16px mb-1">{{ translate('Lesson Type: ') }}
                @if ($lesson_type == 'youtube')
                    <strong>{{ translate('Youtube Video') }}</strong>
                @endif
                @if ($lesson_type == 'vimo')
                    <strong>{{ translate('Vimo Video') }}</strong>
                @endif
                @if ($lesson_type == 'video_file')
                    <strong>{{ translate('Video File') }}</strong>
                @endif
                @if ($lesson_type == 'audio_file')
                    <strong>{{ translate('Audio File') }}</strong>
                @endif
                @if ($lesson_type == 'video_url')
                    <strong>{{ translate('Video Url') }}</strong>
                @endif
                @if ($lesson_type == 'google_drive')
                    <strong>{{ translate('Google Drive Video') }}</strong>
                @endif
                @if ($lesson_type == 'document_file')
                    <strong>{{ translate('Document File') }}</strong>
                @endif
                @if ($lesson_type == 'text')
                    <strong>{{ translate('Text') }}</strong>
                @endif
                @if ($lesson_type == 'image_file')
                    <strong>{{ translate('Image File') }}</strong>
                @endif
            </h4>
        </div>
    </div>
</div>

<div class="w-100 mt-3">
    <form action="{{ route('admin.lesson.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">

        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
            <input type="text" class="form-control ad-form-control" id="title" name="title"
                placeholder="{{ translate('Enter title') }}" value="{{ $lesson->title }}" required>
        </div>
        <div class="mb-3">
            <label for="level" class="form-label ad-form-label">{{ translate('Course Section') }}</label>
            <select class="form-control ad-form-control" name="section_id">
                @foreach (App\Models\Section::where('course_id', $course_id)->orderBy('sort')->get() as $section)
                    <option @if ($lesson->section_id == $section->id) selected @endif value="{{ $section->id }}">
                        {{ $section->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tagsinput-id-3"
                class="form-label ad-form-label">{{ translate('Section Release Time') }}</label>
            <input type="datetime-local" id="release_date" name="release_date" class="form-control ad-form-control"
                value="{{ $lesson->release_date }}">
        </div>
        @if ($lesson_type == 'youtube')
            @include('admin.course.lesson_youtube_edit')
        @elseif($lesson_type == 'vimo')
            @include('admin.course.lesson_vimo_edit')
        @elseif($lesson_type == 'video_file')
            @include('admin.course.lesson_videoFile_edit')
        @elseif($lesson_type == 'audio_file')
            @include('admin.course.lesson_audioFile_edit')
        @elseif($lesson_type == 'video_url')
            @include('admin.course.lesson_videoUrl_edit')
        @elseif($lesson_type == 'document_file')
            @include('admin.course.lesson_document_edit')
        @elseif($lesson_type == 'text')
            @include('admin.course.lesson_text_edit')
        @elseif($lesson_type == 'image_file')
            @include('admin.course.lesson_image_edit')
        @elseif($lesson_type == 'google_drive')
            @include('admin.course.lesson_drive_edit')
        @endif
        <div class="mb-3">
            <label for="description" class="form-label ad-form-label">{{ translate('Description') }}</label>
            <textarea class="text_editor" placeholder="{{ translate('Hare ...') }}" id="summernote" name="description">{{ $lesson->summary }}</textarea>
        </div>
        <h6>{{ translate('Do you want to keep it free as a preview lesson?') }}</h6>
        <div class="form-check form-check-checkbox mb-3">
            <input class="form-check-input form-check-input-checkbox" name="makeAsFree" type="checkbox" value="1"
                @if ($lesson->is_free == 1) checked @endif>
            <label class="form-check-label form-check-label-checkbox" for="flexCheckDefault">
                {{ translate('Mark as free lesson') }}
            </label>
        </div>
        <button type="submit" class="btn ad-btn-primary">{{ translate('Submit') }}</button>
    </form>
</div>
@include('admin.inited')
