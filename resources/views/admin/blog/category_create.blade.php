<form action="{{ route('admin.blog.category.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            placeholder="{{ translate('Enter blog category title') }}">
    </div>
    <div class="mb-3">
        <label for="short_description" class="form-label ad-form-label">{{ translate('Short Description') }}</label>
        <textarea class="form-control ad-form-textarea" id="short_description" name="short_description"
            placeholder="{{ translate('Hare ...') }}" rows="5" cols="50"></textarea>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
