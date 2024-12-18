<div class="row">
    <label class="form-label ad-form-label">
        {{ translate('Answer') }}
        <span class="text-danger ms-1">*</span>
    </label>
    <div class="col-sm-8 offset-sm-2">
        <div class="btn-group mb-3 w-100" role="group">
            <input type="radio" class="btn-check" id="true" name="answer" value="true" autocomplete="off">
            <label class="btn btn-outline-secondary" for="true">{{ translate('True') }}</label>

            <input type="radio" class="btn-check" id="false" name="answer" value="false" autocomplete="off">
            <label class="btn btn-outline-secondary" for="false">{{ translate('False') }}</label>
        </div>
    </div>
</div>
