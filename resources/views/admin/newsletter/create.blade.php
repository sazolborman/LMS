<form action="{{ route('admin.newsletter.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="subject" class="form-label ad-form-label">{{ translate('Newsletter Subject') }}</label>
        <input type="text" class="form-control ad-form-control" id="subject" name="subject"
            placeholder="{{ translate('Enter newsletter subject') }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label ad-form-label">{{ translate('Newsletter Description') }}</label>
        <textarea class="text_editor" placeholder="{{ translate('Hare ...') }}" id="summernote" name="description"></textarea>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>

</form>

@include('admin.inited')
