<form action="{{ route('admin.class.store') }}" method="post">
    @csrf
    <input type="hidden" name="bootcamp_id" value="{{ $bootcamp_id }}">
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            placeholder="{{ translate('Enter class title') }}" required>
    </div>
    <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
        <div class="w-100">
            <label for="title" class="form-label ad-form-label">{{ translate('Date') }}</label>
            <input type="date" class="form-control ad-form-control" id="date" name="date" required>
        </div>
        <div class="w-100">
            <label for="title" class="form-label ad-form-label">{{ translate('Start Time') }}</label>
            <input type="time" class="form-control ad-form-control" id="start_time" name="start_time" required>
        </div>
        <div class="w-100">
            <label for="title" class="form-label ad-form-label">{{ translate('End Time') }}</label>
            <input type="time" class="form-control ad-form-control" id="end_time" name="end_time" required>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
        <div class="w-100">
            <label for="module_id" class="form-label ad-form-label">{{ translate('Module') }}</label>
            <select class="ad-select2" name="module_id">
                <option value="">{{ translate('Select an option') }}
                </option>
                @foreach (App\Models\BootcampModule::orderBy('id', 'DESC')->get() as $module)
                    <option value="{{ $module->id }}">{{ $module->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-100">
            <label for="status" class="form-label ad-form-label">{{ translate('Status') }}</label>
            <select class="ad-select2" name="status">
                <option value="">{{ translate('Select an option') }}
                </option>
                <option value="0">{{ translate('Upcoming') }}</option>
                <option value="1">{{ translate('Live') }}</option>
                <option value="2">{{ translate('Completed') }}</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label ad-form-label">{{ translate('Summary') }}</label>
        <textarea class="text_editor" placeholder="{{ translate('Hare ...') }}" name="summary"></textarea>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
@include('admin.inited');
