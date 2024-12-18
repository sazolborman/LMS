<div class="fpb7 mb-3">
    <label class="form-label ad-form-label" for="answer">
        {{ translate('Answer') }}
        <span class="text-danger ms-1">*</span>
    </label>
    <input class="form-control tagify" type="text" name="answer" data-role="tagsinput" id="answer"
        placeholder="{{ translate('Your answer here') }}">
    <small>{{ translate('You can keep multiple answers. Just put your answer and hit enter.') }}</small>
</div>

@include('admin.inited')
