<form action="{{ route('admin.quiz.store') }}" method="post">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course_id }}">
    <div class="fpb7 mb-3">
        <label class="form-label ad-form-label" for="title">
            {{ translate('Title') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <input class="form-control ad-form-control" type="text" id="title" name="title" required>
    </div>

    <div class="row mb-3">
        <div class="col-sm-12 ">
            <label class="form-label ad-form-label">
                {{ translate('Section') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ad-form-control ol-select2" data-toggle="select2" name="section">
                <option value="">{{ translate('Select an option') }}</option>
                @foreach (App\Models\Section::where('course_id', $course_id)->get() as $section)
                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label ad-form-label" for="duration">
            {{ translate('Duration') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <div class="row">
            <div class="col-4">
                <input class="form-control ad-form-control" type="number" min="0" max="23" name="hour"
                    placeholder="00 hour">
            </div>
            <div class="col-4">
                <input class="form-control ad-form-control" type="number" min="0" max="59" name="minute"
                    placeholder="00 minute">
            </div>
            <div class="col-4">
                <input class="form-control ad-form-control" type="number" min="0" max="59" name="second"
                    placeholder="00 second">
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-4">
            <label class="form-label ad-form-label" for="total_mark">
                {{ translate('Total Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ad-form-control" type="number" min="1" id="total_mark" name="total_mark"
                required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ad-form-label" for="pass_mark">
                {{ translate('Pass Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ad-form-control" type="number" min="1" id="pass_mark" name="pass_mark"
                required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ad-form-label" for="retake">
                {{ translate('Retake') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ad-form-control" type="number" min="1" id="retake" name="retake"
                value="1" required>
        </div>
    </div>

    <div class=" mb-3">
        <label for="description" class="form-label ad-form-label col-form-label">{{ translate('Description') }}</label>
        <textarea name="description" rows="5" class="form-control ad-form-control text_editor"></textarea>
    </div>

    <div class="">
        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
    </div>
</form>

@include('admin.inited')
