<div class="mb-3">
    <label for="level" class="form-label ad-form-label">{{ translate('Document Type') }}</label>
    <select class="form-control ad-form-control" name="attachment_type">
        <option value="text-file">{{ translate('Text File') }}</option>
        <option value="pdf-file">{{ translate('PDF File') }}</option>
        <option value="doc-file">{{ translate('Document File') }}</option>
    </select>
</div>
<div class="mb-3">
    <label for="formFile" class="form-label ad-form-label">{{ translate('Attachment') }}</label>
    <input class="form-control form-control-file" type="file" name="attachment" id="formFile"
        placeholder="{{ translate('Attachment') }}">
</div>
