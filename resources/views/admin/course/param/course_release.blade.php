<input type="hidden" name="type" value="course">
<input type="hidden" name="course_id" value="{{ $courses->id }}">
<div class="row mb-2">
    <div class="col-md-6 mb-3">
        <label for="tagsinput-id-3" class="form-label ad-form-label">{{ translate('Course Release Time') }}</label>
        <input type="datetime-local" id="release_date" name="release_date" class="form-control ad-form-control"
            value="{{ $courses->release_date }}">
    </div>
</div>
