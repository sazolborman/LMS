@php
    $module = App\Models\BootcampModule::where('id', $id)->first();
@endphp
<form action="{{ route('admin.module.update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <div class="mb-3">
        <label for="title" class="form-label ad-form-label">{{ translate('Title') }}</label>
        <input type="text" class="form-control ad-form-control" id="title" name="title"
            value="{{ $module->title }}" placeholder="{{ translate('Enter module title') }}">
    </div>
    <div class="mb-5">
        <label for="title" class="form-label ad-form-label">{{ translate('Study Plan') }}</label>
        <input type="text" class="form-control ad-form-control daterangepicker daterangepicker1 input-pointer"
            name="study_plan"
            value="{{ date('m/d/Y', $module->publish_date) . ' - ' . date('m/d/Y', $module->expiry_date) }}">
    </div>
    <div class="mb-3">
        <label class="form-label ad-form-label">{{ translate('Restriction of study plan:') }}</label>
        <div class="ad-radio-wrap">
            <div class="form-check form-check-radio mb-2">
                <input class="form-check-input form-check-input-radio" type="radio" name="status" id="status1"
                    value="0" @if ($module->status == 0) checked @endif>
                <label class="form-check-label form-check-label-radio" for="status1">
                    {{ translate('No restriction') }}
                </label>
            </div>
            <div class="form-check form-check-radio mb-2">
                <input class="form-check-input form-check-input-radio" type="radio" name="status" id="status2"
                    value="1" @if ($module->status == 1) checked @endif>
                <label class="form-check-label form-check-label-radio" for="status2">
                    {{ translate('Until the start date, keep this section locked') }}
                </label>
            </div>
            <div class="form-check form-check-radio mb-2">
                <input class="form-check-input form-check-input-radio" type="radio" name="status" id="status3"
                    value="2" @if ($module->status == 2) checked @endif>
                <label class="form-check-label form-check-label-radio" for="status2">
                    {{ translate('Keep this section open only within the selected date range') }}
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>

@include('admin.inited')
