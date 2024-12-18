@php
    $questions = App\Models\Question::where('quiz_id', $lesson_id)->orderBy('sort')->get();
    $lesson = App\Models\Lesson::where('id', $lesson_id)->first();
@endphp

<div class="d-none">
    <button type="submit"
        class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1"
        id="questionBackBtn"
        onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.index', 'lesson_id' => $lesson_id]) }}', '{{ translate('Manage Questions') }}', 'modal-lg')"
        name="button">
        <i class="fi-rr-angle-small-left"></i>
        {{ translate('Back') }}
    </button>
</div>
@if ($questions->count() > 0)
    <div class="d-flax justify-content-between align-items-center">
        <div class="mb-2">
            <h4 class="title">{{ $lesson->title }}</h4>
        </div>
        <div class="d-flex gap-3">
            <a href="javascript:void(0)"
                onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.create', 'lesson_id' => $lesson_id]) }}', '{{ translate('Add Question') }}', 'modal-lg')"
                class="btn ad-btn-light-primary">{{ translate('Add Question') }}
            </a>

            <a href="javascript:void(0)"
                onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.sort', 'id' => $lesson_id]) }}', '{{ translate('Sort Question') }}', 'modal-lg')"
                class="btn ad-btn-light-primary">{{ translate('Sort Questions') }}
            </a>
        </div>

    </div>

    <ul class="list-group-3 mt-3">
        @foreach ($questions as $key => $question)
            <li class="custom-question">
                <div class="single-date-items d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)" class="fs-16px title2 d-flex align-items-center cg-10px" disabled>
                        <span>
                            {{ ++$key }}.
                        </span>
                        {!! $question->title !!}
                    </a>
                    <div class="buttons menu-hover">
                        <a href="javascript:void(0)"
                            onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.edit', 'id' => $question->id]) }}', '{{ translate('Update Question') }}', 'modal-lg')"
                            class="edit-delete" data-toggle="tooltip" data-bs-original-title="{{ translate('Edit') }}">
                            <span class="fi-rr-pencil"></span>
                        </a>


                        <a href="javascript:void(0)" data-bs-toggle="tooltip"
                            onclick="deleteModal('{{ route('admin.question.delete', $question->id) }}'); event.stopPropagation();"
                            class="edit-delete" data-bs-original-title="{{ translate('Delete') }}">
                            <span class="fi-rr-trash"></span>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="question-btn">
        <a href="javascript:void(0)" class="add-question"
            onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.create', 'lesson_id' => $lesson_id]) }}', '{{ translate('Add Question') }}', 'modal-lg')">
            <p><i class="fi-rr-add"></i></p>
            <h3>{{ translate('Add Question') }}</h3>
        </a>
    </div>


@endif



<script>
    function deleteModal(url) {
        deleteUrl = url; // Store the URL for later use in the confirm action
        // Show the confirmation modal
        $('#deleteModal').modal('show');
    }
    let deleteUrl = '';
    console.log(deleteUrl);

    $('#confirmDelete').on('click', function() {
        console.log(deleteUrl);
        // Perform the AJAX request to delete the question
        $.ajax({
            url: deleteUrl, // The URL stored in the global variable
            type: 'DELETE', // Use the DELETE HTTP method
            data: {
                _token: '{{ csrf_token() }}' // Add CSRF token
            },
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#deleteModal').modal('hide');
                    // Optionally, you can remove the deleted item from the DOM or reload the page
                    // For example, remove the question from the DOM:
                    $('#question-' + response.id).remove();
                    toaster_message('success', 'border-left-success', 'fi-sr-badge-check text-info',
                        'Success !', 'Question has been deleted.');
                    document.querySelector('#questionBackBtn').click();

                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                toaster_message('warning', 'border-left-warning', 'fi-sr-exclamation text-danger',
                    'Attention !', 'An error occurred: ');
            }
        });
    });
</script>
