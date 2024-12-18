@extends(ADMIN)
@push('title', translate('Ebook Create'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Ebook Create') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Ebook Management / Create Ebook') }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('admin.ebook') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <form action="{{ route('admin.ebook.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="ad-card-body mb-20px p-20px">

                                    <div class="d-flex gap-3">
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="title"
                                                    class="form-label ad-form-label">{{ translate('Ebook Title') }}</label>
                                                <input type="text" class="form-control ad-form-control" id="title"
                                                    name="title" placeholder="{{ translate('Enter your Ebook title') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="publication"
                                                    class="form-label ad-form-label">{{ translate('Publication Name') }}</label>
                                                <input type="text" class="form-control ad-form-control" id="publication"
                                                    name="publication"
                                                    placeholder="{{ translate('Enter Publication Name') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edition"
                                                    class="form-label ad-form-label">{{ translate('Edition') }}</label>
                                                <input type="text" class="form-control ad-form-control" id="edition"
                                                    name="edition" placeholder="{{ translate('Enter Edition') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="description"
                                                    class="form-label ad-form-label">{{ translate('Description') }}</label>
                                                <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="description"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="formFile"
                                                    class="form-label ad-form-label">{{ translate('Thumbnail') }}</label>
                                                <input class="form-control form-control-file" type="file"
                                                    name="thumbnail" id="formFile">
                                            </div>

                                        </div>
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="category"
                                                    class="form-label ad-form-label">{{ translate('Ebook Category') }}</label>
                                                <select class="ad-select2" name="category">
                                                    <option value="">{{ translate('Select a category') }}</option>
                                                    @foreach (App\Models\EbookCategory::orderBy('title', 'desc')->get() as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endforeach

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
                                                            type="radio" name="price_type" id="price_type2" value="0"
                                                            onchange="$('#paid-section').slideUp(200)">
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
                                                        class="form-label ad-form-label">{{ translate('Ebook Price') }}({{ currency() }})</label>
                                                    <input type="number" name="price"
                                                        class="form-control ad-form-control" id="shipping-info2"
                                                        placeholder="{{ translate('Enter Your Ebook Price') }}">
                                                </div>
                                                <div class="form-check form-check-checkbox mb-3">
                                                    <input class="form-check-input form-check-input-checkbox"
                                                        name="discount_flag" type="checkbox" value="1" id="discounted"
                                                        checked>
                                                    <label class="form-check-label form-check-label-checkbox"
                                                        for="flexCheckDefault">
                                                        {{ translate('Check if this ebook has discount') }}
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
                                                <label for="preview"
                                                    class="form-label ad-form-label">{{ translate('Preview File') }}</label>
                                                <input class="form-control form-control-file" type="file"
                                                    id="preview" name="preview">
                                            </div>
                                            <div class="mb-3">
                                                <label for="main"
                                                    class="form-label ad-form-label">{{ translate('Main File') }}</label>
                                                <input class="form-control form-control-file" type="file"
                                                    id="main" name="main">
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
