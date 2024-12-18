@extends(ADMIN)
@push('title', translate('Course Bundle Edit'))
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
                        <div class="mb-3 flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Course Bundle Edit') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Deshboard / Course Bundle / manage Bundle / Course Bundle Edit') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.bundle') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <form action="{{ route('admin.bundle.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $bundle->id }}">
                                <div class="ad-card-body mb-20px p-20px">
                                    <h4 class="title fs-16px mb-3">{{ translate('Course Bundle Edit') }}</h4>

                                    <div class="d-flex gap-3">
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="title"
                                                    class="form-label ad-form-label">{{ translate('Course Bundle Title') }}</label>
                                                <input type="text" class="form-control ad-form-control" id="title"
                                                    value="{{ $bundle->title }}" name="title"
                                                    placeholder="{{ translate('Enter your course title') }}">
                                            </div>
                                            @php
                                                $selectedCourses = json_decode($bundle->course_id);
                                            @endphp
                                            <div class="mb-3">
                                                <label for="course_id"
                                                    class="form-label ad-form-label">{{ translate('Select Courses') }}</label>
                                                <select class="ad-select2" name="course_id[]" multiple="multiple">
                                                    @foreach (App\Models\Course::get() as $course)
                                                        <option value="{{ $course->id }}"
                                                            {{ in_array($course->id, $selectedCourses) ? 'selected' : '' }}>
                                                            {{ $course->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            <div class="mb-3">
                                                <label for="shipping-info2"
                                                    class="form-label ad-form-label">{{ translate('Bundle Price') }}({{ currency() }})</label>
                                                <input type="number" name="price" class="form-control ad-form-control"
                                                    id="shipping-info2" value="{{ $bundle->price }}"
                                                    placeholder="{{ translate('Enter Your Course Bundle Price') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="days"
                                                    class="form-label ad-form-label">{{ translate('Subscription Renew Days') }}</label>
                                                <input type="number" class="form-control ad-form-control" id="days"
                                                    name="days"value="{{ $bundle->subscription_day }}"
                                                    placeholder="{{ translate('Subscription Renew Days') }}">
                                            </div>
                                        </div>
                                        <div class="w-100">

                                            <div class="mb-3">
                                                <label for="formFile"
                                                    class="form-label ad-form-label">{{ translate('Thumbnail') }}</label>
                                                <input class="form-control form-control-file" type="file"
                                                    name="thumbnail" id="formFile">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description"
                                                    class="form-label ad-form-label">{{ translate('Bundle Description') }}</label>
                                                <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="description">{{ $bundle->description }}</textarea>
                                            </div>
                                        </div>
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
            $('.ad-select2').select2({
                placeholder: "Select Courses",
                allowClear: true // Optional: to allow clearing the selection
            });
        });
    </script>
@endpush
