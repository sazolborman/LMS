<form action="{{ route('admin.bootcamp.category.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            placeholder="{{ translate('Enter bootcamp category title') }}">
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
