<input type="hidden" name="course_id" value="{{ $courses->id }}">
<input type="hidden" name="tab" value="price">
<div class="ad-card-body mb-20px p-20px">
    <div class="w-100">
        <div class="mb-3">
            <label class="form-label ad-form-label">{{ translate('Pricing type') }}</label>
            <div class="ad-radio-wrap d-flex flex-wrap">
                <div class="form-check form-check-radio">
                    <input class="form-check-input form-check-input-radio" type="radio" name="price_type"
                        id="price_type1" value="1" onchange="$('#paid-section').slideDown(200)"
                        @if ($courses->is_paid == '1') checked @endif>
                    <label class="form-check-label form-check-label-radio" for="price_type1">
                        {{ translate('Paid') }}
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <input class="form-check-input form-check-input-radio" type="radio" name="price_type"
                        id="price_type2" value="0" onchange="$('#paid-section').slideUp(200)"
                        @if ($courses->is_paid == '0') checked @endif>
                    <label class="form-check-label form-check-label-radio" for="price_type2">
                        {{ translate('Free') }}
                    </label>
                </div>
            </div>
        </div>
        <div id="paid-section">
            <div class="mb-3">
                <label for="shipping-info2"
                    class="form-label ad-form-label">{{ translate('Course Price') }}({{ currency() }})</label>
                <input type="number" value="{{ $courses->price }}" name="price" class="form-control ad-form-control"
                    id="shipping-info2" placeholder="{{ translate('Enter Your Course Price') }}">
            </div>
            <div class="form-check form-check-checkbox mb-3">
                <input class="form-check-input form-check-input-checkbox" name="discount_flag" type="checkbox"
                    value="1" id="discounted" @if ($courses->discount_flag == '1') checked @endif>
                <label class="form-check-label form-check-label-checkbox" for="flexCheckDefault">
                    {{ translate('Check if this course has discount') }}
                </label>
            </div>
            <div id="discounted-section">
                <div class="mb-3">
                    <label for="shipping-info2"
                        class="form-label ad-form-label">{{ translate('Discounted Price') }}({{ currency() }})</label>
                    <input type="number" class="form-control ad-form-control" id="shipping-info2"
                        name="discounted_price" value="{{ $courses->discounted_price }}"
                        placeholder="{{ translate('Enter Your Discounted Price') }}">
                </div>
            </div>
        </div>
    </div>
</div>
