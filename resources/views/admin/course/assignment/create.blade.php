<div class="mt-3">
    <form action="{{ route('admin.assignment.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course_id }}">
        <input type="hidden" name="lesson_type" value="{{ $lesson_type }}">
        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Assignment Title') }}</label>
            <input type="text" class="form-control ad-form-control" id="title" name="title"
                placeholder="{{ translate('Enter assignment title') }}" required>
        </div>
        <div class="mb-3">
            <label for="question" class="form-label ad-form-label">{{ translate('Questions') }}</label>
            <textarea class="text_editor" placeholder="{{ translate('Hare ...') }}" id="summernote" name="question" required></textarea>
        </div>
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="w-100">
                <label for="question_file" class="form-label ad-form-label">{{ translate('Question file') }}</label>
                <input class="form-control form-control-file" type="file" name="question_file" id="question_file">
            </div>
            <div class="w-100">
                <label for="status" class="form-label ad-form-label">{{ translate('Submission status') }}</label>
                <select class="ad-select2" name="status">
                    <option value="">{{ translate('Select an option') }}
                    </option>
                    <option value="0">{{ translate('Draft') }}</option>
                    <option value="1">{{ translate('Active') }}</option>
                </select>
            </div>
            <div class="w-100">
                <label for="level" class="form-label ad-form-label">{{ translate('Course Section') }}</label>
                <select class="ad-select2" name="section_id">
                    <option value="">{{ translate('Select an option') }}
                        @foreach (App\Models\Section::where('course_id', $course_id)->orderBy('sort')->get() as $section)
                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="w-100">
                <label for="total_marks" class="form-label ad-form-label">{{ translate('Total marks') }}</label>
                <input type="number" class="form-control ad-form-control" id="total_marks" name="total_marks" required>
            </div>
            <div class="w-100">
                <label for="deadline_date"
                    class="form-label ad-form-label">{{ translate('Deadline (deadline)') }}</label>
                <input type="date" class="form-control ad-form-control" id="deadline_date" name="deadline_date"
                    required>
            </div>
            <div class="w-100">
                <label for="deadline_time" class="form-label ad-form-label">{{ translate('Deadline (Time)') }}</label>
                <input type="time" class="form-control ad-form-control" id="deadline_time" name="deadline_time"
                    required>
            </div>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label ad-form-label">{{ translate('Note') }}</label>
            <textarea class="form-control ad-form-textarea" id="note" name="note"
                placeholder="{{ translate('Hare ...') }}"></textarea>
        </div>

        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
    </form>
</div>
