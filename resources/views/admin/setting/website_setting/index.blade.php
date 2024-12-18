@extends(ADMIN)
@push('title', translate('Website Setting'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Website Setting') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Setting / Website Setting') }}
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
                                <div class="custom-tab-button">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-frontend-setting-tab"
                                                data-bs-toggle="pill" data-bs-target="#frontend-setting-tab" type="button"
                                                role="tab">Frontend Settings</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-home-page-layout-tab" data-bs-toggle="pill"
                                                data-bs-target="#home-page-layout-tab" type="button" role="tab">Home
                                                page layout</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-motivational-speech-tab"
                                                data-bs-toggle="pill" data-bs-target="#motivational-speech-tab"
                                                type="button" role="tab">Motivational Speech</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-website-faqs-tab" data-bs-toggle="pill"
                                                data-bs-target="#website-faqs-tab" type="button" role="tab">Website
                                                FAQS</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-logo-images-tab" data-bs-toggle="pill"
                                                data-bs-target="#logo-images-tab" type="button" role="tab">Logo &
                                                Images</button>
                                        </li>
                                    </ul>
                                </div>


                                <div class="tab-content mt-3">
                                    <div class="tab-pane fade show active" id="frontend-setting-tab">
                                        @include('admin.setting.website_setting.frontend_setting')
                                    </div>
                                    <div class="tab-pane fade" id="home-page-layout-tab">
                                        <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="web-title" class="form-label ad-form-label">Website
                                                        title</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="web-title" placeholder="Title">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="tagsinput-id-3" class="form-label ad-form-label">Website
                                                        keywords</label>
                                                    <input type="text" class="form-control ad-form-control ad-tagsinput"
                                                        id="tagsinput-id-3" name="tags" value="test"
                                                        placeholder="Keywords">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="web-des" class="form-label ad-form-label">Example
                                                        textarea</label>
                                                    <textarea class="form-control ad-form-textarea" id="web-des" placeholder="Type here"></textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="selling-tax" class="form-label ad-form-label">Course
                                                        selling tax</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="selling-tax" placeholder="0" aria-describedby="sellingTax">
                                                    <div id="sellingTax" class="form-text ad-form-text">
                                                        enter 0 if you want to disable the tax option
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone-number" class="form-label ad-form-label">Phone</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="phone-number" placeholder="Phone">
                                                </div>


                                                <!-- File Input  -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="formFile" class="form-label ad-form-label">File</label>
                                                    <input class="form-control form-control-file" type="file"
                                                        id="formFile">
                                                </div>

                                            </div>

                                            <button type="reset" value="reset"
                                                class="btn ad-btn-light">Cancel</button>
                                            <button type="submit" class="btn ad-btn-primary">Save</button>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="motivational-speech-tab">
                                        <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="web-title" class="form-label ad-form-label">Website
                                                        title</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="web-title" placeholder="Title">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="tagsinput-id-5" class="form-label ad-form-label">Website
                                                        keywords</label>
                                                    <input type="text"
                                                        class="form-control ad-form-control ad-tagsinput"
                                                        id="tagsinput-id-5" name="tags" value="test"
                                                        placeholder="Keywords">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="web-des" class="form-label ad-form-label">Example
                                                        textarea</label>
                                                    <textarea class="form-control ad-form-textarea" id="web-des" placeholder="Type here"></textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="selling-tax" class="form-label ad-form-label">Course
                                                        selling tax</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="selling-tax" placeholder="0" aria-describedby="sellingTax">
                                                    <div id="sellingTax" class="form-text ad-form-text">
                                                        enter 0 if you want to disable the tax option
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone-number"
                                                        class="form-label ad-form-label">Phone</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="phone-number" placeholder="Phone">
                                                </div>


                                                <!-- File Input  -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="formFile" class="form-label ad-form-label">File</label>
                                                    <input class="form-control form-control-file" type="file"
                                                        id="formFile">
                                                </div>

                                            </div>

                                            <button type="reset" value="reset"
                                                class="btn ad-btn-light">Cancel</button>
                                            <button type="submit" class="btn ad-btn-primary">Save</button>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="website-faqs-tab">
                                        <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="web-title" class="form-label ad-form-label">Website
                                                        title</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="web-title" placeholder="Title">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="tagsinput-id-4" class="form-label ad-form-label">Website
                                                        keywords</label>
                                                    <input type="text"
                                                        class="form-control ad-form-control ad-tagsinput"
                                                        id="tagsinput-id-4" name="tags" value="test"
                                                        placeholder="Keywords">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="web-des" class="form-label ad-form-label">Example
                                                        textarea</label>
                                                    <textarea class="form-control ad-form-textarea" id="web-des" placeholder="Type here"></textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="selling-tax" class="form-label ad-form-label">Course
                                                        selling tax</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="selling-tax" placeholder="0" aria-describedby="sellingTax">
                                                    <div id="sellingTax" class="form-text ad-form-text">
                                                        enter 0 if you want to disable the tax option
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone-number"
                                                        class="form-label ad-form-label">Phone</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="phone-number" placeholder="Phone">
                                                </div>


                                                <!-- File Input  -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="formFile" class="form-label ad-form-label">File</label>
                                                    <input class="form-control form-control-file" type="file"
                                                        id="formFile">
                                                </div>
                                            </div>

                                            <button type="reset" value="reset"
                                                class="btn ad-btn-light">Cancel</button>
                                            <button type="submit" class="btn ad-btn-primary">Save</button>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="logo-images-tab">
                                        <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="web-title" class="form-label ad-form-label">Website
                                                        title</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="web-title" placeholder="Title">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="tagsinput-id-6" class="form-label ad-form-label">Website
                                                        keywords</label>
                                                    <input type="text"
                                                        class="form-control ad-form-control ad-tagsinput"
                                                        id="tagsinput-id-6" name="tags" value="test"
                                                        placeholder="Keywords">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="web-des" class="form-label ad-form-label">Example
                                                        textarea</label>
                                                    <textarea class="form-control ad-form-textarea" id="web-des" placeholder="Type here"></textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="selling-tax" class="form-label ad-form-label">Course
                                                        selling tax</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="selling-tax" placeholder="0" aria-describedby="sellingTax">
                                                    <div id="sellingTax" class="form-text ad-form-text">
                                                        enter 0 if you want to disable the tax option
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone-number"
                                                        class="form-label ad-form-label">Phone</label>
                                                    <input type="number" class="form-control ad-form-control"
                                                        id="phone-number" placeholder="Phone">
                                                </div>


                                                <!-- File Input  -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="formFile" class="form-label ad-form-label">File</label>
                                                    <input class="form-control form-control-file" type="file"
                                                        id="formFile">
                                                </div>


                                            </div>

                                            <button type="reset" value="reset"
                                                class="btn ad-btn-light">Cancel</button>
                                            <button type="submit" class="btn ad-btn-primary">Save</button>

                                        </form>
                                    </div>
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
@endpush
