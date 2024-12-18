@php
    $seo = App\Models\Seo::where('name_route', 'course.details')
        ->where('course_id', $courses->id)
        ->first();
@endphp


<input type="hidden" name="course_id" value="{{ $courses->id }}">
<input type="hidden" name="tab" value="seo">
<div class="ad-card-body mb-20px p-20px">
    <div class="w-100">
        <div class="mb-3">
            <label for="meta_title" class="form-label ad-form-label">{{ translate('Meta Title') }}</label>
            <input type="text" value="{{ isset($seo) ? $seo->meta_title : '' }}" class="form-control ad-form-control"
                id="meta_title" name="meta_title" placeholder="{{ translate('Enter your meta title') }}">
        </div>
        <div class="mb-3">
            <label for="tagsinput-id-1" class="form-label ad-form-label">{{ translate('Meta keywords') }}</label>
            <input type="text" class="form-control ad-form-control tagify " id="tagsinput-id-1" name="meta_keywords"
                value="{{ isset($seo) ? $seo->meta_keywords : '' }}" placeholder="{{ translate('Meta Keywords') }}">
        </div>
        <div class="mb-3">
            <label for="short_description" class="form-label ad-form-label">{{ translate('Meta Description') }}</label>
            <textarea class="form-control ad-form-textarea" id="meta_description" name="meta_description"
                placeholder="{{ translate('Hare ...') }}">{{ isset($seo) ? $seo->meta_description : '' }}</textarea>
        </div>
        <div class="mb-3">
            <label for="meta_robot" class="form-label ad-form-label">{{ translate('Meta Robot') }}</label>
            <input type="text" value="{{ isset($seo) ? $seo->meta_robot : '' }}"
                class="form-control ad-form-control" id="meta_robot" name="meta_robot"
                placeholder="{{ translate('Enter your meta robot') }}">
        </div>
        <div class="mb-3">
            <label for="canonical_url" class="form-label ad-form-label">{{ translate('Canonical Url') }}</label>
            <input type="url" value="{{ isset($seo) ? $seo->canonical_url : '' }}"
                class="form-control ad-form-control" id="canonical_url" name="canonical_url"
                placeholder="{{ translate('Enter your Canonical Url') }}">
        </div>
        <div class="mb-3">
            <label for="custom_url" class="form-label ad-form-label">{{ translate('Custom Url') }}</label>
            <input type="url" value="{{ isset($seo) ? $seo->custom_url : '' }}"
                class="form-control ad-form-control" id="custom_url" name="custom_url"
                placeholder="{{ translate('Enter your Custom Url') }}">
        </div>
        <div class="mb-3">
            <label for="og_title" class="form-label ad-form-label">{{ translate('Og Title') }}</label>
            <input type="text" value="{{ isset($seo) ? $seo->og_title : '' }}" class="form-control ad-form-control"
                id="og_title" name="og_title" placeholder="{{ translate('Enter your Og Title') }}">
        </div>
        <div class="mb-3">
            <label for="og_description" class="form-label ad-form-label">{{ translate('Og Description') }}</label>
            <textarea class="form-control ad-form-textarea" id="og_description" name="og_description"
                placeholder="{{ translate('Hare ...') }}">{{ isset($seo) ? $seo->og_description : '' }}</textarea>
        </div>
        <div class="mb-3">
            <label for="og_image" class="form-label ad-form-label">{{ translate('Og Image') }}
                <small>({{ translate('PNG, JPEG, JPG') }})</small></label>
            <div class="single-card-item mb-2 w-50">
                <div class="single-card-img custom-single-card-img">
                    @if (isset($seo->og_image))
                        <img src="{{ asset($seo->og_image) }}" alt="img">
                    @else
                        <img src="{{ asset('assets/backend/images/img/card-img.png') }}" alt="img">
                    @endif
                </div>
            </div>
            <input class="form-control form-control-file" type="file" name="og_image" id="og_image">
        </div>
        <div class="mb-3">
            <label for="json_id" class="form-label ad-form-label">{{ translate('Json Id') }}</label>
            <textarea class="form-control ad-form-textarea" id="json_id" name="json_id"
                placeholder="{{ translate('Hare ...') }}">{{ isset($seo) ? $seo->json_ld : '' }}</textarea>
        </div>
    </div>

</div>
