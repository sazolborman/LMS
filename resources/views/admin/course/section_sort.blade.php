<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="title-section">
        <h4 class="mt-0"> {{ translate('List of sections') }}</h4>
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
<div id="section-list">
    @foreach (App\Models\Section::where('course_id', $course_id)->orderBy('sort')->get() as $section)
        <div id="sort-element">
            <div class="draggable-item" id="{{ $section->id }}">
                <div class="w-100 mb-3">
                    <div class="ad-alert light-primary-alert p-3">
                        <div class="alert-content d-flex  border-1">
                            <h4>{{ $section->title }}</h4>
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

<script type="text/javascript">
    $(function() {
        $("#section-list").sortable();
    });
</script>
<script type="text/javascript">
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
        console.log(itemJSON);
        $.ajax({
            url: "{{ route('admin.section.sort') }}",
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
