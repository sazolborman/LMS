<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="title-section">
        <h4 class="mt-0"> {{ translate('List of live class') }}</h4>
    </div>
    <div class="update-btn">
        <button type="submit"
            class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1"
            id="section-sort-btn" onclick="sort({{ $module_id }})" name="button">
            <i class="fi-rr-apps-sort"></i>
            {{ translate('Update sorting') }}
        </button>
    </div>
</div>
<div id="class_list">
    @foreach (App\Models\BootcampLiveClass::where('bootcamp_id', $bootcamp_id)->where('module_id', $module_id)->orderBy('sort')->get() as $class)
        <div id="sort-element">
            <div class="draggable-item" id="{{ $class->id }}">
                <div class="w-100 mb-3">
                    <div class="ad-alert light-primary-alert p-3">
                        <div class="alert-content d-flex  border-1">
                            <h4>{{ $class->title }}</h4>
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
        $("#class_list").sortable();
    });
</script>
<script type="text/javascript">
    function sort(id) {
        var containerArray = ['class_list'];
        var itemArray = [];
        var itemJSON;
        let class_id = id;
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
            url: "{{ route('admin.class.sort') }}",
            type: 'POST',
            data: {
                itemJSON: itemJSON,
                class_id: class_id,
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
