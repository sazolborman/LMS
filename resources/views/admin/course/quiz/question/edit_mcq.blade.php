<div class="fpb7 mb-3">
    <label class="form-label ad-form-label" for="options">
        {{ translate('Options') }}
        <span class="text-danger ms-1">*</span>
    </label>
    <input class="form-control ad-form-control tagify" type="text" data-role="tagsinput" id="options" name="options"
        value="{{ $question->options }}" placeholder="{{ translate('Your questions here') }}">
    <small>{{ translate('You can keep multiple options. Just put an option and hit enter.') }}</small>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label ad-form-label">
                {{ translate('Answer') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ad-form-control ad-select2" name="answer[]" data-toggle="select2"
                id="answer-select2" multiple>
                <option value="">{{ translate('Select an option') }}</option>
                @if (isset($question->options))
                    @foreach (json_decode($question->options, true) as $option)
                        <option value="{{ $option }}" @if (in_array($option, json_decode($question->answer, true))) selected @endif>
                            {{ $option }}</option>
                    @endforeach
                @else
                    <option value="">{{ translate('Select an option') }}</option>
                @endif
            </select>
            <small>{{ translate('You can select multiple answers.') }}</small>
        </div>
    </div>
</div>

@include('admin.inited')

<script>
    var inputElm = document.querySelector('#options');
    inputElm.addEventListener('change', onChange)

    function onChange(e) {
        let values = e.target.value
        let varArr = JSON.parse(values)
        let answerSelect2 = document.querySelector('#answer-select2')

        answerSelect2.innerHTML = ''
        varArr.forEach(item => {
            let option = document.createElement('option')
            option.text = item.value
            option.value = item.value
            answerSelect2.add(option)
        });
    }
</script>
