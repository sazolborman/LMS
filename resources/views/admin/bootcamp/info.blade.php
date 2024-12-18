@php
    $faqs = json_decode($bootcamp->faqs);
    $outcomes = json_decode($bootcamp->outcomes, true);
    $requirements = json_decode($bootcamp->requirements, true);
@endphp

<input type="hidden" name="id" value="{{ $bootcamp->id }}">
<input type="hidden" name="tab" value="info">
<div class="ad-card-body mb-20px p-20px">
    <div class="w-100">
        {{-- FAQ area start --}}
        <div id = "faq_area">
            <label for="title" class="form-label ad-form-label">{{ translate('Bootcamp FAQ') }}</label>
            @if (isset($faqs) && count($faqs) > 0)
                @foreach ($faqs as $key => $faq)
                    <div class="d-flex align-item-center gap-3 mb-3">
                        <div class="w-100">
                            <input type="text" value="{{ $faq->title }}" class="form-control ad-form-control"
                                name="faq_title[]" id="faqs" placeholder="{{ translate('FAQ question') }}">
                            <textarea name="faq_description[]" rows="2" class="form-control ad-form-textarea mt-2"
                                placeholder="{{ translate('Answer') }}">{{ $faq->description }}</textarea>
                        </div>
                        <div>
                            @if ($key != 0)
                                <button type="button" class="btn ad-btn-danger mt-0" name="button"
                                    onclick="removeFaq(this)">
                                    <i class="fa fa-minus"></i> </button>
                            @else
                                <button type="button" class="btn ad-btn-success" style="" name="button"
                                    onclick="appendFaq()">
                                    <i class="fa fa-plus"></i> </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex align-item-center gap-3 mb-3">
                    <div class="w-100">
                        <input type="text" class="form-control ad-form-control" name="faq_title[]" id="faqs"
                            placeholder="{{ translate('FAQ question') }}">
                        <textarea name="faq_description[]" rows="2" class="form-control ad-form-textarea mt-2"
                            placeholder="{{ translate('Answer') }}"></textarea>
                    </div>
                    <div class="">
                        <button type="button" class="btn ad-btn-success" style="" name="button"
                            onclick="appendFaq()">
                            <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
            @endif
            <div id = "blank_faq_field">
                <div class="d-flex align-item-center gap-3 mb-3">
                    <div class="w-100">
                        <input type="text" class="form-control ad-form-control" name="faq_title[]" id="faqs"
                            placeholder="{{ translate('FAQ question') }}">
                        <textarea name="faq_description[]" rows="2" class="form-control ad-form-textarea mt-2"
                            placeholder="{{ translate('Answer') }}"></textarea>
                    </div>
                    <div class="">
                        <button type="button" class="btn ad-btn-danger mt-0" name="button" onclick="removeFaq(this)">
                            <i class="fa fa-minus"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- FAQ area end --}}

        {{-- requirement area start --}}
        <div id = "requirement_area">
            <label for="title" class="form-label ad-form-label">{{ translate('Bootcamp Requirements') }}</label>
            @if (isset($requirements) && count($requirements) > 0)
                @foreach ($requirements as $key => $requirement)
                    <div class="d-flex align-item-center gap-3 mb-3">
                        <div class="w-100">
                            <input type="text"value="{{ $requirement }}" class="form-control ad-form-control"
                                id="title" name="requirements[]"
                                placeholder="{{ translate('Provide Requirements') }}">
                        </div>
                        <div>
                            @if ($key != 0)
                                <button type="button" class="btn ad-btn-danger mt-0" name="button"
                                    onclick="removeRequirement(this)">
                                    <i class="fa fa-minus"></i> </button>
                            @else
                                <button type="button" class="btn ad-btn-success" style="" name="button"
                                    onclick="appendRequirement()">
                                    <i class="fa fa-plus"></i> </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex align-item-center gap-3 mb-3">
                    <div class="w-100">
                        <input type="text" class="form-control ad-form-control" id="title" name="requirements[]"
                            placeholder="{{ translate('Provide Requirements') }}">
                    </div>
                    <div>
                        <button type="button" class="btn ad-btn-success" style="" name="button"
                            onclick="appendRequirement()">
                            <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
            @endif
            <div id = "blank_requirement_field">
                <div class="d-flex align-item-center gap-3 mb-3">
                    <div class="w-100">
                        <input type="text" class="form-control ad-form-control" id="title"
                            name="requirements[]" placeholder="{{ translate('Provide Requirements') }}">
                    </div>
                    <div>
                        <button type="button" class="btn ad-btn-danger mt-0" name="button"
                            onclick="removeRequirement(this)">
                            <i class="fa fa-minus"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- requirement area end --}}

        {{-- Outcomes area start --}}
        <div id = "outcomes_area">
            <label for="title" class="form-label ad-form-label">{{ translate('Bootcamp Outcomes') }}</label>
            @if (isset($outcomes) && count($outcomes) > 0)
                @foreach ($outcomes as $key => $outcome)
                    <div class="d-flex align-item-center gap-3 mb-3">
                        <div class="w-100">
                            <input type="text" value="{{ $outcome }}" class="form-control ad-form-control"
                                id="title" name="outcomes[]" placeholder="{{ translate('Provide Outcomes') }}">
                        </div>
                        <div>
                            @if ($key != 0)
                                <button type="button" class="btn ad-btn-danger mt-0" name="button"
                                    onclick="removeOutcome(this)">
                                    <i class="fa fa-minus"></i> </button>
                            @else
                                <button type="button" class="btn ad-btn-success" style="" name="button"
                                    onclick="appendOutcome()">
                                    <i class="fa fa-plus"></i> </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex align-item-center gap-3 mb-3">
                    <div class="w-100">
                        <input type="text" class="form-control ad-form-control" id="title" name="outcomes[]"
                            placeholder="{{ translate('Provide Outcomes') }}">
                    </div>
                    <div>
                        <button type="button" class="btn ad-btn-success" style="" name="button"
                            onclick="appendOutcome()">
                            <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
            @endif
            <div id = "blank_outcome_field">
                <div class="d-flex align-item-center gap-3 mb-3">
                    <div class="w-100">
                        <input type="text" class="form-control ad-form-control" id="title" name="outcomes[]"
                            placeholder="{{ translate('Provide Outcomes') }}">
                    </div>
                    <div>
                        <button type="button" class="btn ad-btn-danger mt-0" name="button"
                            onclick="removeOutcome(this)">
                            <i class="fa fa-minus"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Outcomes area end --}}
    </div>
</div>
