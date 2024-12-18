<form action="{{ route('admin.language.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Language Name') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="name"
            placeholder="{{ translate('Enter Language Name title') }}">
    </div>

    <div class="mb-3">
        <label for="flag" class="form-label ad-form-label">{{ translate('Country Flag') }}</label>
        <input class="form-control form-control-file" type="file" id="flag" name="country_flag">
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
