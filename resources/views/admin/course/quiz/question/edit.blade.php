@php
    $question = App\Models\Question::where('id', $id)->first();
@endphp
<style>
    .select2-selection.select2-selection--multiple {
        cursor: pointer !important;
    }
</style>

<form class="ajaxForm" action="{{ route('admin.question.update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="quiz_id" value="{{ $question->quiz_id }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label ad-form-label">
                    {{ translate('Question Type') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <select class="form-control ad-form-control ol-select2" data-toggle="select2" name="type"
                    onchange="getOptionType(this)">
                    <option value="">{{ translate('Select an option') }}</option>
                    <option @if ($question->type == 'mcq') selected @endif value="mcq">
                        {{ translate('Multiple Choice') }}</option>
                    <option @if ($question->type == 'fill_blanks') selected @endif value="fill_blanks">
                        {{ translate('Fill in the blanks') }}</option>
                    <option @if ($question->type == 'true_false') selected @endif value="true_false">
                        {{ translate('True or False') }}</option>
                </select>
            </div>
        </div>
    </div>


    <div class="fpb-7 mb-3">
        <label for="title" class="form-label ad-form-label">
            {{ translate('Write question') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <textarea name="title" rows="5" class="form-control ad-form-control text_editor">{!! $question->title !!}</textarea>
    </div>

    <div class="load-question-type"></div>

    <div class="d-flex gap-3">
        <a href="javascript:void(0)" class="btn ad-btn-primary d-flex" id="questionBackBtn"
            onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.index', 'lesson_id' => $question->quiz_id]) }}', '{{ translate('Manage Questions') }}', 'modal-lg')">
            <i class="fi-rr-angle-small-left"></i> {{ translate('Back') }}
        </a>

        <div class="fpb7">
            <button type="submit" class="btn ad-btn-primary">{{ translate('Update Question') }}</button>
        </div>
    </div>
</form>

@include('admin.inited')
<script>
    setupQuestion("{{ $question->type }}");

    function getOptionType(elem) {
        let type = elem.value;
        setupQuestion(type);
    }

    function setupQuestion(type) {
        if (type) {
            $.ajax({
                type: "get",
                url: "{{ route('admin.question.type') }}",
                data: {
                    id: "{{ $question->id }}",
                    type: type,
                },
                success: function(response) {
                    $('.load-question-type').empty().append(response)
                }
            });
        }
    }

    // after response this function will call
    function responseBack() {
        document.querySelector('#questionBackBtn').click();
    }
</script>
