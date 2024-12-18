<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="title-section">
        <h4 class="mt-0"> {{ translate('List of lesson') }}</h4>
    </div>
    <div class="update-btn">
        <button type="submit"
            class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1"
            id="section-sort-btn" onclick="sort({{ $course_id }})" name="button">
            <i class="fi-rr-apps-sort"></i>
            {{ translate('Update sorting') }}
        </button>
    </div>
</div>
<div id="lesson-list">
    @foreach (App\Models\Lesson::where('course_id', $course_id)->where('section_id', $section_id)->orderBy('sort')->get() as $lesson)
        <div id="sort-element">
            <div class="draggable-item" id="{{ $lesson->id }}">
                <div class="w-100 mb-3">
                    <div class="ad-alert light-primary-alert p-3 d-flex justify-content-between">
                        <div class="alert-content">
                            <h4>{{ ucfirst($lesson->title) }}</h4>
                        </div>
                        <span class="ms-auto">
                            <i
                                class="fi-rr-apps-sort text-muted ps-2 border-start me-2 mt-1 hover-show cursor-move"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script type="text/javascript">
    $(function() {
        $("#lesson-list").sortable();
    });
</script>
<script type="text/javascript">
    function sort(id) {
        var containerArray = ['lesson-list'];
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
        console.log(itemJSON);
        $.ajax({
            url: "{{ route('admin.lesson.sort') }}",
            type: 'POST',
            data: {
                itemJSON: itemJSON,
                course_id: course_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                location.reload();
            }
        });
    }
</script>
