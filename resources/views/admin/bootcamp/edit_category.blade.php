@php
    $category = App\Models\BootcampCategory::where('id', $id)->first();
@endphp
<form action="{{ route('admin.bootcamp.category.update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            value="{{ $category->title }}" placeholder="{{ translate('Enter bootcamp category title') }}">
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
