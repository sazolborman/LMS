@extends(ADMIN)
@push('title', translate('System Setting'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('System Setting') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Setting / System Setting') }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-body-content">
                            <div class="container-fluid">
                                <div class="ad-body-content-inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ad-card mb-20px">
                                                <div class="ad-card-body p-3 ad-tab-body">
                                                    <div class="custom-tab-button">
                                                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active"
                                                                    id="pills-frontend-setting-tab" data-bs-toggle="pill"
                                                                    data-bs-target="#frontend-setting-tab" type="button"
                                                                    role="tab">{{ translate('System Setting') }}</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-home-page-layout-tab"
                                                                    data-bs-toggle="pill"
                                                                    data-bs-target="#home-page-layout-tab" type="button"
                                                                    role="tab">{{ translate('Upload Product') }}</button>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                    <div class="tab-content mt-3">
                                                        <div class="tab-pane fade show active" id="frontend-setting-tab">
                                                            @include('admin.setting.system_setting.system_setting')
                                                        </div>
                                                        <div class="tab-pane fade" id="home-page-layout-tab">
                                                            @include('admin.setting.system_setting.upload_product')
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
