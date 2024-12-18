<form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Category Name') }}</label>
        <input type="text" class="form-control ad-form-control" name="title" id="title"
            placeholder="{{ translate('Name') }}">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Pick Your Icon') }}</label>
        <input type="text" name="icon" class="form-control ad-form-control icon-picker" id="icon-picker"
            placeholder="{{ translate('Choose your icon') }}">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Keyword') }}
            <small>({{ translate('optional') }})</small></label>
        <input type="text" name="keyword" class="form-control ad-form-control" id="keywords"
            placeholder="{{ translate('Write Keyword') }}">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Category Description') }}
            <small>({{ translate('optional') }})</small></label>
        <textarea name="description" class="form-control ad-form-textarea" id="description"
            placeholder="{{ translate('hare ...') }}"></textarea>
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('') }}Thumbnail
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
