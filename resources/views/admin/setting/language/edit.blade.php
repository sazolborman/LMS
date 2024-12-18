@php
    $language = App\Models\Language::where('id', $lan_id)->first();
@endphp
<form action="{{ route('admin.language.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $lan_id }}">
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Language Name') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="name"
            value="{{ $language->name }}" placeholder="{{ translate('Enter Language Name title') }}">
    </div>

    <div class="mb-3">
        <label for="flag" class="form-label ad-form-label">{{ translate('Country Flag') }}</label>
        <input class="form-control form-control-file" type="file" id="flag" name="country_flag">
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
