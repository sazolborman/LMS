<input type="hidden" name="course_id" value="{{ $courses->id }}">
<input type="hidden" name="tab" value="gallery">
<div class="ad-card-body mb-20px p-20px">
    <div class="w-100">
        <div class="mb-3">
            <label for="formFile" class="form-label ad-form-label">{{ translate('Thumbnail') }}
                <small>({{ translate('PNG, JPEG, JPG') }})</small></label>
            <input class="form-control form-control-file" type="file" name="thumbnail" id="formFile">
        </div>
        <div class="mb-3">
            <label for="banner" class="form-label ad-form-label">{{ translate('Banner') }}
                <small>({{ translate('PNG, JPEG, JPG') }})</small></label>
            <input class="form-control form-control-file" type="file" id="banner" name="banner">
        </div>
        <div class="mb-3">
            <label for="banner" class="form-label ad-form-label">{{ translate('Preview') }}
                <small>({{ translate('MP4, WMV, WebM') }})</small></label>
            <input class="form-control form-control-file" type="file" id="preview" name="preview">
        </div>
    </div>
</div>
