@php
    $course = App\Models\Course::where('id', $course_id)->first();

    $selected_lesson_type = 'youtube';
    if (isset($param3) && !empty($param3)) {
        $selected_lesson_type = $param3;
    }
    $type = 'youtube';
    $selected_lesson_type = $selected_lesson_type ?? '';
@endphp

<div class="ad-modal-form">
    <h6 class="title fs-16px mb-3">{{ translate('Select lesson type') }}</h6>
    <div class="mb-2">
        <div class="d-flex align-items-center gap-3">
            <div class="w-100">
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-youtube3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-play-alt"></span>
                        <p class="title">{{ translate('YouTube Video') }}</p>
                    </div>
                    <input class="form-check-input" value="{{ $type }}" type="radio" name="leasonType"
                        id="radio-youtube3" @if ($selected_lesson_type == 'youtube') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-vimeo3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-caret-circle-right"></span>
                        <p class="title">{{ translate('Vimeo Video') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-vimeo3" value="vimo"
                        @if ($selected_lesson_type == 'vimo') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-videofile3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-video-camera-alt"></span>
                        <p class="title">{{ translate('Video File') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-videofile3"
                        value="video_file" @if ($selected_lesson_type == 'video_file') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-audiofile3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-volume"></span>
                        <p class="title">{{ translate('Audio File') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-audiofile3"
                        value="audio_file" @if ($selected_lesson_type == 'audio_file') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-url3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-link"></span>
                        <p class="title">{{ translate('Video url [ .mp4 ]') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-url3" value="video_url"
                        @if ($selected_lesson_type == 'video_url') checked @endif>
                    <div class="check"></div>
                </label>
            </div>
            <div class="w-100">
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-document3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-document"></span>
                        <p class="title">{{ translate('Document file') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-document3"
                        value="document_file" @if ($selected_lesson_type == 'document_file') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-text3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-text"></span>
                        <p class="title">{{ translate('Text') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-text3" value="text"
                        @if ($selected_lesson_type == 'text') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-image3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-broken-image"></span>
                        <p class="title">{{ translate('Image File') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-image3"
                        value="image_file" @if ($selected_lesson_type == 'image_file') checked @endif>
                    <div class="check"></div>
                </label>
                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-drive3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fi-rr-triangle"></span>
                        <p class="title">{{ translate('Google Drive Video') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-drive3"
                        value="google_drive" @if ($selected_lesson_type == 'google_drive') checked @endif>
                    <div class="check"></div>
                </label>


                <label class="ad-radiobox-1 d-flex align-items-center justify-content-between flex-wrap"
                    for="radio-assignment3">
                    <div class="title-icon d-flex align-items-center">
                        <span class="fa-solid fa-file-invoice"></span>
                        <p class="title">{{ translate('Assignment') }}</p>
                    </div>
                    <input class="form-check-input" type="radio" name="leasonType" id="radio-assignment3"
                        value="assignment" @if ($selected_lesson_type == 'assignment') checked @endif>
                    <div class="check"></div>
                </label>
            </div>
        </div>



    </div>
    <div class="alert alert-primary ad-alert-primary ad-alert-sm mb-3" role="alert">
        <p class="title2 fs-14px">{{ translate('Course: ') }}<span class="title">{{ $course->title }}</span></p>
    </div>
    <button type="submit" onclick="showLessonAddModal()"
        class="btn ad-btn-primary">{{ translate('Next') }}</button>
</div>

<script type="text/javascript">
    function showLessonAddModal() {
        $url = $("input[name=leasonType]:checked").val();
        clickModal('{{ route('modal', ['admin.course.lesson_add', 'course_id' => $course_id]) }}&lesson_type=' + $url,
            '{{ translate('Add new lesson') }}', 'modal-lg')

    }
</script>
