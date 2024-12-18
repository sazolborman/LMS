@extends(ADMIN)
@push('title', translate('Language Setting'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Language Setting') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Setting / Language Setting') }}</p>
                            </div>
                            <div>
                                <a href="javascript:void(0)"
                                    onclick="clickModal('{{ route('modal', ['admin.setting.language.create']) }}', '{{ translate('Create Language') }}')"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1">{{ translate('Add Language') }}</a>
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
                                                                <button class="nav-link active" id="pills-Language-list-tab"
                                                                    data-bs-toggle="pill"
                                                                    data-bs-target="#Language-list-tab" type="button"
                                                                    role="tab">{{ translate('Language List') }}</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-input-language-tab"
                                                                    data-bs-toggle="pill"
                                                                    data-bs-target="#input-language-tab" type="button"
                                                                    role="tab">{{ translate('Import Language') }}</button>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                    <div class="tab-content mt-3">
                                                        <div class="tab-pane fade show active" id="Language-list-tab">
                                                            @include('admin.setting.language.language_list')
                                                        </div>
                                                        <div class="tab-pane fade" id="input-language-tab">
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
    <script type="text/javascript">
        "use strict";



        function update_language_dir(language_id, dir) {
            $.ajax({
                type: 'post',
                url: '{{ route('admin.language.direction.update') }}',
                data: {
                    language_id: language_id,
                    direction: dir
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    success('{{ translate('Direction has been updated') }}');
                }
            });
        }
    </script>
@endpush
