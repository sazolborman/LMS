@extends(ADMIN)
@push('title', translate('Ai management'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Ai Setting') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Setting / Ai Setting') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <form action="{{ route('admin.ai.settings.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="ad-card-body mb-20px p-20px">
                                    <div class="w-50">
                                        <div class="mb-3">
                                            <label for="category"
                                                class="form-label ad-form-label">{{ translate('Select Ai status') }}</label>
                                            <select class="ad-select2" name="ai_status">
                                                <option @selected(get_settings('ai_status') == 'active') value="active">
                                                    {{ translate('Active') }}</option>
                                                <option @selected(get_settings('ai_status') == 'inactive') value="inactive">
                                                    {{ translate('Inactive') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w-50">
                                        <div class="mb-3">
                                            <label for="category"
                                                class="form-label ad-form-label">{{ translate('Select Ai model') }}</label>
                                            <select class="ad-select2" name="open_ai_model">
                                                <option @selected(get_settings('open_ai_model') == 'gpt-3.5-turbo-0125') value="gpt-3.5-turbo-0125">
                                                    gpt-3.5-turbo-0125</option>
                                                <option @selected(get_settings('open_ai_model') == 'gpt-4-0125-preview') value="gpt-4-0125-preview">
                                                    gpt-4-0125-preview ({{ translate('Required premium account') }})
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="w-50">
                                        <div class="mb-3">
                                            <label for="open_ai_max_token"
                                                class="form-label ad-form-label">{{ translate('Max tokens') }}</label>
                                            <input type="number" class="form-control ad-form-control"
                                                id="open_ai_max_token" value="{{ get_settings('open_ai_max_token') }}"
                                                name="open_ai_max_token" min="20" max="2048" required>
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <div class="mb-3">
                                            <label for="open_ai_max_token"
                                                class="form-label ad-form-label">{{ translate('Secret key') }}</label>
                                            <input type="text" class="form-control ad-form-control"
                                                id="open_ai_secret_key" value="{{ get_settings('open_ai_secret_key') }}"
                                                name="open_ai_secret_key" required>
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
@endpush
