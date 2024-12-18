@extends(ADMIN)
@push('title', translate('Instructor Setting'))
@push('meta')
@endpush
@push('css')
@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="mb-3 flex-wrap">
                                <h4 class="title fs-18px mb-2">{{ translate('Instructor Setting') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Dashboard / Users / Instructor / Instructor Setting') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="dashboard-table-wrap text-center mb-3">
                            <h5>{{ translate('Public instructor settings & Instructor commission settings') }} </h5>
                            <strong>{{ translate('Note: ') }}</strong><small>{{ translate('You can toggle the switch for enabling or disabling a feature to access.') }}</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('admin.instructor.setting.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="part" value="allow">
                                    <div class="dashboard-table-wrap w-100">
                                        <div class="mb-3">
                                            <label for="status"
                                                class="form-label ad-form-label">{{ translate('Allow public instructor') }}</label>
                                            <select class="ad-select2" name="allow_instructor">
                                                <option @if ($allow_instructor->description == 1) selected @endif value="1">
                                                    {{ translate('Yess') }}</option>
                                                <option @if ($allow_instructor->description == 0) selected @endif value="0">
                                                    {{ translate('No') }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="instructor_application_note"
                                                class="form-label ad-form-label">{{ translate('Instructor application note') }}</label>
                                            <textarea class="form-control ad-form-textarea" id="instructor_application_note" name="instructor_application_note"
                                                placeholder="{{ translate('Hare ...') }}" rows="8" cols="80">{{ $application_note->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('admin.instructor.setting.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="part" value="revenue">
                                    <div class="dashboard-table-wrap w-100">
                                        <div class="mb-3">
                                            <label for="instructor_revenue"
                                                class="form-label ad-form-label">{{ translate('Instructor revenue percentage') }}
                                                (%)</label>

                                            <input type="text" class="form-control ad-form-control"
                                                onkeyup="AdminRevenue(this.value)" min="0" max="100"
                                                id="instructor_revenue" name="instructor_revenue"
                                                value="{{ $instructor_revenue->description }}"
                                                placeholder="{{ translate('Instructor revenue') }}">

                                        </div>
                                        <div class="mb-3">
                                            <label for="admin_revenue"
                                                class="form-label ad-form-label">{{ translate('Admin revenue percentage') }}
                                                (%)</label>
                                            <input type="text" class="form-control ad-form-control" id="admin_revenue"
                                                name="admin_revenue" placeholder="{{ translate('Admin revenue') }}">
                                        </div>
                                        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        "use strict";
        $(document).ready(function() {
            var instructor_revenue = $('#instructor_revenue').val();
            AdminRevenue(instructor_revenue);
        });

        function AdminRevenue(instructor_revenue) {
            if (instructor_revenue <= 100) {
                var admin_revenue = 100 - instructor_revenue;
                $('#admin_revenue').val(admin_revenue);
            } else {
                $('#admin_revenue').val(0);
            }
        }
    </script>
@endpush
