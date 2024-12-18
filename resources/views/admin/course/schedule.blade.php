@extends(ADMIN)
@push('title')
@endpush
@push('meta')
@endpush
@push('css')
@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Course Setting') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Course / Course Setting') }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card mb-20px">
                            <div class="ad-card-body p-3 ad-tab-body">
                                <div class="tab-content mt-3">
                                    <form action="{{ route('admin.schedule.store') }}" method="POST">
                                        @csrf
                                        <h4 class="mb-2">{{ translate('Course Schedule') }}</h4>
                                        <div class="row mb-5">
                                            <div class="col-md-6 mb-3">
                                                <label for="status"
                                                    class="form-label ad-form-label">{{ translate('Courses') }}</label>
                                                <select class="ad-select2" id="course" name="course">
                                                    <option value="">{{ translate('Select your course') }}
                                                    </option>
                                                    @foreach (App\Models\Course::where('status', 'Active')->get() as $course)
                                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tagsinput-id-3" class="form-label ad-form-label">Course Release
                                                    Time</label>
                                                <input type="datetime-local" id="release_date" name="release_date"
                                                    class="form-control ad-form-control">
                                            </div>
                                        </div>

                                        <h4 class="mb-2">{{ translate('Section Schedule') }}</h4>
                                        <div class="row mb-5">
                                            <div class="col-md-6 mb-3">
                                                <label for="status"
                                                    class="form-label ad-form-label">{{ translate('Sections') }}</label>
                                                <select class="ad-select2" name="section" id="section">
                                                    <option value="">{{ translate('Select your section') }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tagsinput-id-3"
                                                    class="form-label ad-form-label">{{ translate('Section Release Time') }}</label>
                                                <input type="datetime-local" id="release_date" name="release_date"
                                                    class="form-control ad-form-control">
                                            </div>
                                        </div>
                                        <h4 class="mb-2">{{ translate('Lesson Schedule') }}</h4>
                                        <div class="row mb-2">
                                            <div class="col-md-6 mb-3">
                                                <label for="status"
                                                    class="form-label ad-form-label">{{ translate('Lessons') }}</label>
                                                <select class="ad-select2" id="lesson" name="lesson">
                                                    <option value="">{{ translate('Select your lesson') }}
                                                    </option>

                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tagsinput-id-3"
                                                    class="form-label ad-form-label">{{ translate('Lesson Release Time') }}</label>
                                                <input type="datetime-local" id="release_date" name="release_date"
                                                    class="form-control ad-form-control">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#discounted').change(function() {
                if ($(this).is(':checked')) {
                    $('#discounted-section').show();
                } else {
                    $('#discounted-section').hide();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#course').change(function(e) {
                e.preventDefault();
                let bid = jQuery(this).val();
                console.log(bid);
                $.ajax({
                    url: "{{ route('admin.show.section') }}",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        bid: bid,

                    },
                    success: function(res) {
                        console.log(res);
                        $('#section').find('option:not(:first)').remove();
                        if (res['model'].length > 0) {
                            $.each(res['model'], function(key, value) {
                                $('#section').append("<option value='" + value['id'] +
                                    "'>" +
                                    value['title'] + "</option>")
                            });
                        }
                    },

                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#section').change(function(e) {
                e.preventDefault();
                let bid = jQuery(this).val();
                console.log(bid);
                $.ajax({
                    url: "{{ route('admin.show.lesson') }}",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        bid: bid,

                    },
                    success: function(res) {
                        console.log(res);
                        $('#lesson').find('option:not(:first)').remove();
                        if (res['model'].length > 0) {
                            $.each(res['model'], function(key, value) {
                                $('#lesson').append("<option value='" + value['id'] +
                                    "'>" +
                                    value['title'] + "</option>")
                            });
                        }
                    },

                });

            });
        });
    </script>
@endpush
