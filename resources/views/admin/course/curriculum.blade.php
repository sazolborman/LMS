@php
    $section = App\Models\Section::where('course_id', $courses->id)
        ->orderBy('sort')
        ->get();
@endphp
<div class="mt-3">
    @if ($section->count() > 0)
        <div>
            <div class="ad-curriculum d-flex justify-content-center align-items-center gap-3">
                <a href="javascript:void(0)"
                    onclick="clickModal('{{ route('modal', ['admin.course.section', 'course_id' => $courses->id]) }}', 'Add new section')"
                    class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                    <i class="fi-rr-plus-small"></i>
                    {{ translate('Add Section') }}
                </a>
                <a href="javascript:void(0)"
                    onclick="clickModal('{{ route('modal', ['admin.course.lesson_type', 'course_id' => $courses->id]) }}', '{{ translate('Select a lesson type') }}', 'modal-lg')"
                    class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                    <i class="fi-rr-plus-small"></i>
                    {{ translate('Add Lesson') }}
                </a>
                <a href="javascript:void(0)"
                    onclick="clickModal('{{ route('modal', ['admin.course.quiz.create', 'course_id' => $courses->id]) }}', '{{ translate('Quiz Create') }}', 'modal-lg')"
                    class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                    <i class="fi-rr-plus-small"></i>
                    {{ translate('Add Quiz') }}
                </a>
                <a href="javascript:void(0)"
                    onclick="clickModal('{{ route('modal', ['admin.course.section_sort', 'course_id' => $courses->id]) }}', '{{ translate('Sorting section') }}')"
                    class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                    <i class="fi-rr-apps-sort"></i>
                    {{ translate('Sort Section') }}
                </a>
            </div>
            @foreach (App\Models\Section::where('course_id', $courses->id)->orderBy('sort')->get() as $key => $section)
                <div class="section-box">
                    <div class="section-card">
                        <div class="mb-2">
                            <h5 class="section-title"> <span>{{ translate('Section') }} {{ ++$key }}:
                                    {{ $section->title }}</span>
                                <div class="hover">
                                    <div class="d-flex justify-content-end align-items-center gap-1 section-menu">
                                        <a href="javascript:void(0)"
                                            onclick="clickModal('{{ route('modal', ['admin.course.lesson_sort', 'course_id' => $courses->id, 'section_id' => $section->id]) }}', '{{ translate('Sorting lesson') }}')"
                                            class="btn ad-btn-dark d-flex align-items-center gap-1 ad-btn-rounded custom-add-btn">
                                            <i class="bi bi-sort-down"></i>
                                            <small>{{ translate('Sort Lesson') }}</small>
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="clickModal('{{ route('modal', ['admin.course.section_edit', 'id' => $section->id]) }}', 'Update section')"
                                            class="btn ad-btn-dark d-flex align-items-center gap-1 ad-btn-rounded custom-add-btn">
                                            <i class="fi-rr-attribution-pen"></i>
                                            <small>{{ translate('Edit Section') }}</small>
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="confirmModal('{{ route('admin.section.delete', $section->id) }}')"
                                            class="btn ad-btn-dark d-flex align-items-center gap-1 ad-btn-rounded custom-add-btn">
                                            <i class="fi-rr-trash"></i>
                                            <small>{{ translate('Delete Section') }}</small>
                                        </a>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        @foreach (App\Models\Lesson::where('course_id', $courses->id)->where('section_id', $section->id)->orderBy('sort')->get() as $lesson)
                            <div class="mt-3">
                                <div class="custom-lesson">
                                    <div class="ad-alert light-dark-alert p-3 w-100">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex gap-2">
                                                <div class="alert-icon fs-18px">
                                                    @if ($lesson->lesson_type == 'quiz')
                                                        <i class="bi bi-question-square-fill"></i>
                                                    @elseif($lesson->lesson_type == 'assignment')
                                                        <i class="bi bi-file-text"></i>
                                                    @else
                                                        <i class="bi bi-youtube"></i>
                                                    @endif
                                                </div>
                                                <div class="alert-content">
                                                    <h5>{{ ucfirst($lesson->title) }}</h5>
                                                </div>
                                            </div>
                                            <div class="menu-hover">
                                                <div class="d-flex align-items-center gap-2">
                                                    @if ($lesson->lesson_type == 'quiz')
                                                        <a href="javascript:void(0)" id="placement-btton"
                                                            class="placement-top"
                                                            onclick="clickModal('{{ route('modal', ['admin.course.quiz.question.index', 'lesson_id' => $lesson->id]) }}', '{{ translate('Manage Question') }}', 'modal-lg')"
                                                            data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('Manage Question') }}">
                                                            <i class="bi bi-card-text fs-16px"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" id="placement-btton"
                                                            class="placement-top" onclick="" data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('Quiz Result') }}">
                                                            <i class="bi bi-clipboard-data fs-16px"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" id="placement-btton"
                                                            class="placement-top"
                                                            onclick="clickModal('{{ route('modal', ['admin.course.quiz.edit', 'course_id' => $courses->id, 'lesson_id' => $lesson->id]) }}', '{{ translate('Quiz Update') }}', 'modal-lg')"
                                                            data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('Edit') }}">
                                                            <i class="bi bi-pencil-square fs-16px"></i>
                                                        </a>
                                                    @elseif($lesson->lesson_type == 'assignment')
                                                        <a href="javascript:void(0)" id="placement-top"
                                                            class="placement-top" data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('view Submission') }}">
                                                            <i class="bi bi-eye fs-16px"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" id="placement-btton"
                                                            class="placement-top"
                                                            onclick="clickModal('{{ route('modal', ['admin.course.assignment.edit', 'course_id' => $courses->id, 'lesson_id' => $lesson->id]) }}', '{{ translate('Assignment Update') }}', 'modal-lg')"
                                                            data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('Edit') }}">
                                                            <i class="bi bi-pencil-square fs-16px"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" id="placement-top"
                                                            class="placement-top" data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('Resource File') }}">
                                                            <i class="bi bi-folder2-open fs-16px"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" id="placement-btton"
                                                            class="placement-top"
                                                            onclick="clickModal('{{ route('modal', ['admin.course.lesson_edit', 'course_id' => $courses->id, 'lesson_id' => $lesson->id]) }}', '{{ translate('Lesson Update') }}', 'modal-lg')"
                                                            data-toggle="tooltip"
                                                            data-bs-original-title="{{ translate('Edit') }}">
                                                            <i class="bi bi-pencil-square fs-16px"></i>
                                                        </a>
                                                    @endif
                                                    <a href="javascript:void(0)" id="placement-top"
                                                        class="placement-top"
                                                        onclick="confirmModal('{{ route('admin.lesson.delete', $lesson->id) }}')"
                                                        data-toggle="tooltip"
                                                        data-bs-original-title="{{ translate('Delete') }}">
                                                        <i class="bi bi-trash fs-16px"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="question-btn">
            <a href="javascript:void(0)" class="add-question"
                onclick="clickModal('{{ route('modal', ['admin.course.section', 'course_id' => $courses->id]) }}', '{{ translate('Add new section') }}')">
                <p><i class="fi-rr-add"></i></p>
                <h3>{{ translate('Add Section') }}</h3>
            </a>
        </div>
    @endif
</div>
