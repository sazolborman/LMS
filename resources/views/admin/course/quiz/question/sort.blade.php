@php
    $questions = App\Models\Question::where('quiz_id', $id)->orderBy('sort')->get();
@endphp

<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="title-section">
        <h4 class="mt-0"> {{ translate('List of Questions') }}</h4>
    </div>
    <div class="update-btn d-flex gap-2">
        <button type="submit"
            class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1"
            id="questionBackBtn"
            onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.index', 'lesson_id' => $id]) }}', '{{ translate('Manage Questions') }}', 'modal-lg')"
            name="button">
            <i class="fi-rr-angle-small-left"></i>
            {{ translate('Back') }}
        </button>
        <button type="submit"
            class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1"
            id="section-sort-btn" onclick="sort({{ $id }})" name="button">
            <i class="fi-rr-apps-sort"></i>
            {{ translate('Update sorting') }}
        </button>

    </div>
</div>
<div id="section-list">
    @foreach ($questions as $key => $question)
        <div id="sort-element">
            <div class="draggable-item" id="{{ $question->id }}">
                <div class="w-100 mb-3">
                    <div class="ad-alert light-primary-alert p-3">
                        <div class="alert-content d-flex  border-1">
                            <h4>{!! $question->title !!}</h4>
                            <span class="ms-auto">
                                <i
                                    class="fi-rr-apps-sort text-muted ps-2 border-start me-2 mt-1 hover-show cursor-move"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>





<script>
    'use strict';

    $(function() {
        $("#section-list").sortable({
            axis: "y"
        });
    });

    function sort(id) {
        var containerArray = ['section-list'];
        var itemArray = [];
        var itemJSON;
        let course_id = id;


        for (var i = 0; i < containerArray.length; i++) {
            $('#' + containerArray[i]).each(function() {
                $(this).find('.draggable-item').each(function() {
                    itemArray.push(this.id);
                });
            });
        }

        itemJSON = JSON.stringify(itemArray);
        $.ajax({
            url: "{{ route('admin.question.sort') }}",
            type: 'get',
            data: {
                itemJSON: itemJSON,
                course_id: course_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toaster_message('success', 'border-left-success', 'fi-sr-badge-check text-info',
                        'Success !', 'Questions has been sorted.');
                    document.querySelector('#questionBackBtn').click();
                }
            }
        });
    }
</script>
