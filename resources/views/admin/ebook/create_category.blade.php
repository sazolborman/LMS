<form action="{{ route('admin.ebook.category.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="w-100">
        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Ebook Category Title') }}</label>
            <input type="text" class="form-control ad-form-control" id="title" name="title"
                placeholder="{{ translate('Enter Ebook Category Title') }}">
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label ad-form-label">{{ translate('Thumbnail') }}</label>
            <input class="form-control form-control-file" type="file" name="thumbnail" id="formFile">
        </div>


        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
    </div>
</form>
