@php
    $title = App\Models\Section::where('id', $id)->first();
@endphp
<form action="{{ route('admin.section.update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="course_id" value="{{ $title->course_id }}">
    <div class="w-100">
        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Section Title') }}</label>
            <input type="text" value="{{ $title->title }}" class="form-control ad-form-control" id="title"
                name="title" placeholder="{{ translate('Enter your section title') }}">
        </div>
        <div class="mb-3">
            <label for="tagsinput-id-3" class="form-label ad-form-label">{{ translate('Section Release Time') }}</label>
            <input type="datetime-local" id="release_date" name="release_date" class="form-control ad-form-control"
                value="{{ $title->release_date }}">
        </div>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
