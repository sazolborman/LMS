<form action="{{ route('admin.module.store') }}" method="post">
    @csrf
    <input type="hidden" name="bootcamp_id" value="{{ $bootcamp_id }}">
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            placeholder="{{ translate('Enter module title') }}">
    </div>
    <div class="mb-5">
        <label for="title" class="form-label ad-form-label">{{ translate('Study Plan') }}</label>
        <input type="text" class="form-control ad-form-control daterangepicker daterangepicker1 input-pointer"
            name="study_plan" id="basic">
    </div>
    <div class="mb-3">
        <label class="form-label ad-form-label">{{ translate('Restriction of study plan:') }}</label>
        <div class="ad-radio-wrap">
            <div class="form-check form-check-radio mb-2">
                <input class="form-check-input form-check-input-radio" type="radio" name="status" id="status1"
                    value="0">
                <label class="form-check-label form-check-label-radio" for="status1">
                    {{ translate('No restriction') }}
                </label>
            </div>
            <div class="form-check form-check-radio mb-2">
                <input class="form-check-input form-check-input-radio" type="radio" name="status" id="status2"
                    checked="" value="1">
                <label class="form-check-label form-check-label-radio" for="status2">
                    {{ translate('Until the start date, keep this section locked') }}
                </label>
            </div>
            <div class="form-check form-check-radio mb-2">
                <input class="form-check-input form-check-input-radio" type="radio" name="status" id="status3"
                    checked="" value="2">
                <label class="form-check-label form-check-label-radio" for="status2">
                    {{ translate('Keep this section open only within the selected date range') }}
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>

@include('admin.inited')
<script>
    // Function to format a date as MM/DD/YYYY
    function formatDate(date) {
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let day = date.getDate().toString().padStart(2, '0');
        let year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    // Get the current date
    const currentDate = new Date();

    // Set start date as the current date
    const startDate = formatDate(currentDate);

    // Set end date to 20 days after the current date
    const endDate = formatDate(new Date(currentDate.getTime() + 20 * 24 * 60 * 60 * 1000));

    // Set the value of the input field
    document.getElementById('basic').value = `${startDate} - ${endDate}`;
</script>
