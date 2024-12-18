<div class="w-100">
    <div class="ad-alert light-success-alert p-3 d-flex align-items-center gap-2">
        <div class="alert-icon">
            <i class="bi bi-columns-gap"></i>
        </div>
        <div class="alert-content">
            <h4 class="fs-16px mb-1 d-flex align-items-center gap-3">{{ translate('Lesson Type: ') }}
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
                @if ($lesson_type == 'assignment')
                    <strong>{{ translate('Assignment') }}</strong>
                @endif


                <div class="d-flex align-items-center justify-content-end">
                    <button type="button"
                        onclick="clickModal('{{ route('modal', ['admin.course.lesson_type', 'course_id' => $course_id, 'param3' => $lesson_type]) }}', '{{ translate('Select a lesson type') }}')"
                        class="btn ad-btn-light-primary ad-btn-rounded">
                        {{ translate('Change') }}
                    </button>
                </div>
            </h4>
        </div>
    </div>
</div>
@if ($lesson_type == 'assignment')
    @include('admin.course.assignment.create')
@else
    <div class="w-100 mt-3">
        <form action="{{ route('admin.lesson.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course_id }}">
            <input type="hidden" name="lesson_type" value="{{ $lesson_type }}">

            <div class="mb-3">
                <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
                <input type="text" class="form-control ad-form-control" id="title" name="title"
                    placeholder="{{ translate('Enter title') }}" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label ad-form-label">{{ translate('Course Section') }}</label>
                <select class="form-control ad-form-control" name="section_id">
                    @foreach (App\Models\Section::where('course_id', $course_id)->orderBy('sort')->get() as $section)
                        <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tagsinput-id-3"
                    class="form-label ad-form-label">{{ translate('Lesson Release Time') }}</label>
                <input type="datetime-local" id="release_date" name="release_date" class="form-control ad-form-control">
            </div>
            @if ($lesson_type == 'youtube')
                <input type="hidden" name="lesson_provider" value="youtube">
                @include('admin.course.lesson_youtube_add')
            @elseif($lesson_type == 'vimo')
                <input type="hidden" name="lesson_provider" value="vimo">
                @include('admin.course.lesson_vimo_add')
            @elseif($lesson_type == 'video_file')
                @include('admin.course.lesson_videoFile_add')
            @elseif($lesson_type == 'audio_file')
                @include('admin.course.lesson_audioFile_add')
            @elseif($lesson_type == 'video_url')
                <input type="hidden" name="lesson_provider" value="video_url">
                @include('admin.course.lesson_videoUrl_add')
            @elseif($lesson_type == 'document_file')
                @include('admin.course.lesson_document_add')
            @elseif($lesson_type == 'text')
                @include('admin.course.lesson_text_add')
            @elseif($lesson_type == 'image_file')
                @include('admin.course.lesson_image_add')
            @elseif($lesson_type == 'google_drive')
                <input type="hidden" name="lesson_provider" value="google_drive">
                @include('admin.course.lesson_drive_add')
            @endif
            <div class="mb-3">
                <label for="description" class="form-label ad-form-label">{{ translate('Description') }}</label>
                <textarea class="text_editor" placeholder="{{ translate('Hare ...') }}" id="summernote" name="description"></textarea>
            </div>
            <h6>{{ translate('Do you want to keep it free as a preview lesson?') }}</h6>
            <div class="form-check form-check-checkbox mb-3">
                <input class="form-check-input form-check-input-checkbox" name="makeAsFree" type="checkbox"
                    value="1">
                <label class="form-check-label form-check-label-checkbox" for="flexCheckDefault">
                    {{ translate('Mark as free lesson') }}
                </label>
            </div>
            <button type="submit" class="btn ad-btn-primary">{{ translate('Submit') }}</button>
        </form>
    </div>
@endif

@include('admin.inited')
