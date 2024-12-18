@php
    $category = App\Models\Category::where('id', $id)->first();
    $parent_categories = App\Models\Category::where('parent_id', 0)->orderBy('title', 'asc')->get();
@endphp

<form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
    @csrf



    @if (isset($title) && $title == 'child')
        <div class="input-group-field mb-3">
            <label for="name" class="form-label ad-form-label">{{ translate('Parent category') }}</label>
            <select class="form-control ad-form-control" name="parent_id">
                @foreach ($parent_categories as $parent_category)
                    <option value="{{ $parent_category->id }}" @if ($category->parent_id == $parent_category->id) selected @endif>
                        {{ $parent_category->title }}</option>
                @endforeach
            </select>
        </div>
    @elseif(isset($title) && $title == 'main')
        <input type="hidden" name="parent_id" value="0">
    @endif


    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Category Name') }}</label>
        <input type="text" class="form-control ad-form-control" value="{{ $category->title }}" name="title"
            id="title" placeholder="{{ translate('Nmae') }}">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Pick Your Icon') }}</label>
        <input type="text" value="{{ $category->icon }}" name="icon"
            class="form-control ad-form-control icon-picker" id="icon-picker"
            placeholder="{{ translate('Choose your icon') }}">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Keyword') }}
            <small>({{ translate('optional') }})</small></label>
        <input type="text" name="keyword" class="form-control ad-form-control" id="keywords"
            value="{{ $category->keywords }}" placeholder="{{ translate('Write Keyword') }}">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Category Description') }}
            <small>({{ translate('optional') }})</small></label>
        <textarea name="description" class="form-control ad-form-textarea" id="description"
            placeholder="{{ translate('here....') }}">{{ $category->description }}</textarea>
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Thumbnail') }}
            <small>({{ translate('optional') }})</small></label>
        <input name="thumbnail" class="form-control form-control-file" type="file" id="thumbnail">
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>


<script type="text/javascript">
    "Use strict";

    $(function() {
        if ($('.icon-picker').length) {
            $('.icon-picker').iconpicker();
        }
    });
</script>
