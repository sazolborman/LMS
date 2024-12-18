@extends(ADMIN)
@push('title', translate('Course Create'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Course Create') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Courses / Create Course') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <form action="{{ route('admin.course.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="ad-card-body mb-20px p-20px">
                                    <h4 class="title fs-16px mb-3">{{ translate('Course Create') }}</h4>

                                    <div class="d-flex gap-3">
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="title"
                                                    class="form-label ad-form-label">{{ translate('Course Title') }}</label>
                                                <input type="text" class="form-control ad-form-control" id="title"
                                                    name="title" placeholder="{{ translate('Enter your course title') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="short_description"
                                                    class="form-label ad-form-label">{{ translate('Short Description') }}</label>
                                                <textarea class="form-control ad-form-textarea" id="short_description" name="short_description"
                                                    placeholder="{{ translate('Hare ...') }}"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description"
                                                    class="form-label ad-form-label">{{ translate('Description') }}</label>
                                                <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="description"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status"
                                                    class="form-label ad-form-label">{{ translate('Course Status') }}</label>
                                                <select class="ad-select2" name="status">
                                                    <option value="">{{ translate('Select your course status') }}
                                                    </option>
                                                    <option value="Active">{{ translate('Active') }}</option>
                                                    <option value="Private">{{ translate('Private') }}</option>
                                                    <option value="Upcoming">{{ translate('Upcoming') }}</option>
                                                    <option value="Pending">{{ translate('Pending') }}</option>
                                                    <option value="Draft">{{ translate('Draft') }}</option>
                                                    <option value="Inactive">{{ translate('Inactive') }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="banner"
                                                    class="form-label ad-form-label">{{ translate('Banner') }}</label>
                                                <input class="form-control form-control-file" type="file" id="banner"
                                                    name="banner">
                                            </div>

                                        </div>
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="category"
                                                    class="form-label ad-form-label">{{ translate('Course Category') }}</label>
                                                <select class="ad-select2" name="category">
                                                    <option value="">{{ translate('Select a category') }}</option>
                                                    @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'desc')->get() as $category)
                                                        <optgroup label="{{ $category->title }}">
                                                            @foreach ($category->childs as $sub_category)
                                                                <option value="{{ $sub_category->id }}">&nbsp
                                                                    {{ $sub_category->title }}
                                                                </option>
                                                            @endforeach
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="level"
                                                    class="form-label ad-form-label">{{ translate('Course Level') }}</label>
                                                <select class="ad-select2" name="level">
                                                    <option value="">{{ translate('Select your course level') }}
                                                    </option>
                                                    <option value="beginner">{{ translate('Beginner') }}</option>
                                                    <option value="intermediate">{{ translate('Intermediate') }}</option>
                                                    <option value="advanced">{{ translate('Advanced') }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="language"
                                                    class="form-label ad-form-label">{{ translate('Course Language') }}</label>
                                                <select class="ad-select2" name="language">
                                                    <option value="">{{ translate('Select your course language') }}
                                                    </option>
                                                    <option value="1">{{ translate('English') }}</option>
                                                    <option value="2">{{ translate('Bangla') }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    class="form-label ad-form-label">{{ translate('Pricing type') }}</label>
                                                <div class="ad-radio-wrap d-flex flex-wrap">
                                                    <div class="form-check form-check-radio">
                                                        <input class="form-check-input form-check-input-radio"
                                                            type="radio" name="price_type" id="price_type1" value="1"
                                                            onchange="$('#paid-section').slideDown(200)" checked>
                                                        <label class="form-check-label form-check-label-radio"
                                                            for="price_type1">
                                                            {{ translate('Paid') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-radio">
                                                        <input class="form-check-input form-check-input-radio"
                                                            type="radio" name="price_type" id="price_type2"
                                                            value="0" onchange="$('#paid-section').slideUp(200)">
                                                        <label class="form-check-label form-check-label-radio"
                                                            for="price_type2">
                                                            {{ translate('Free') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="paid-section">
                                                <div class="mb-3">
                                                    <label for="shipping-info2"
                                                        class="form-label ad-form-label">{{ translate('Course Price') }}({{ currency() }})</label>
                                                    <input type="number" name="price"
                                                        class="form-control ad-form-control" id="shipping-info2"
                                                        placeholder="{{ translate('Enter Your Course Price') }}">
                                                </div>
                                                <div class="form-check form-check-checkbox mb-3">
                                                    <input class="form-check-input form-check-input-checkbox"
                                                        name="discount_flag" type="checkbox" value="1"
                                                        id="discounted">
                                                    <label class="form-check-label form-check-label-checkbox"
                                                        for="flexCheckDefault">
                                                        {{ translate('Check if this course has discount') }}
                                                    </label>
                                                </div>
                                                <div id="discounted-section">
                                                    <div class="mb-3">
                                                        <label for="shipping-info2"
                                                            class="form-label ad-form-label">{{ translate('Discounted Price') }}({{ currency() }})</label>
                                                        <input type="number" class="form-control ad-form-control"
                                                            id="shipping-info2" name="discounted_price"
                                                            placeholder="{{ translate('Enter Your Discounted Price') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="formFile"
                                                    class="form-label ad-form-label">{{ translate('Thumbnail') }}</label>
                                                <input class="form-control form-control-file" type="file"
                                                    name="thumbnail" id="formFile">
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
@endpush
