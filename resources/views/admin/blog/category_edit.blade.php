@php
    $category = App\Models\BlogCategory::where('id', $id)->first();
@endphp
<form action="{{ route('admin.blog.category.update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            placeholder="{{ translate('Enter title') }}" value="{{ $category->title }}">
    </div>
    <div class="mb-3">
        <label for="short_description" class="form-label ad-form-label">{{ translate('Short Description') }}</label>
        <textarea class="form-control ad-form-textarea" id="short_description" name="short_description"
            placeholder="{{ translate('Hare ...') }}" rows="5" cols="50">{{ $category->short_description }}</textarea>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>
