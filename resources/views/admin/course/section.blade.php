<form action="{{ route('admin.section.store') }}" method="post">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course_id }}">
    <div class="w-100">
        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Section Title') }}</label>
            <input type="text" class="form-control ad-form-control" id="title" name="title"
                placeholder="{{ translate('Enter your section title') }}">
        </div>
        <div class="mb-3">
            <label for="tagsinput-id-3" class="form-label ad-form-label">{{ translate('Section Release Time') }}</label>
            <input type="datetime-local" id="release_date" name="release_date" class="form-control ad-form-control">
        </div>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
