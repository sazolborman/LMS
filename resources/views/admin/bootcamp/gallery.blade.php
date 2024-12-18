<input type="hidden" name="id" value="{{ $bootcamp->id }}">
<input type="hidden" name="tab" value="gallery">
<div class="ad-card-body mb-20px p-20px">
    <div class="w-100">
        <div class="mb-3">
            <label for="formFile" class="form-label ad-form-label">{{ translate('Thumbnail') }}
                <small>({{ translate('PNG, JPEG, JPG') }})</small></label>
            <input class="form-control form-control-file" type="file" name="thumbnail" id="formFile">
        </div>
    </div>
</div>
