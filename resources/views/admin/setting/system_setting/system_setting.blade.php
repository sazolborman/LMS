<form action="{{ route('admin.system.settings.update') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="web_name" class="form-label ad-form-label">{{ translate('Website Name') }}</label>
            <input type="text" class="form-control ad-form-control" id="web_name" name="system_name"
                value="{{ settings_data('system_name') }}" placeholder="{{ translate('Enter Website Name') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="web_title" class="form-label ad-form-label">{{ translate('Website title') }}</label>
            <input type="text" class="form-control ad-form-control" id="web_title" name="system_title"
                value="{{ settings_data('system_title') }}" placeholder="{{ translate('Enter Website Title') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Website keywords') }}</label>
            <input type="text" class="form-control ad-form-control tagify" id="tagsinput-id-2"
                value="{{ settings_data('website_keywords') }}" name="website_keywords"
                placeholder="{{ translate('Keywords') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Author') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2" name="author"
                value="{{ settings_data('author') }}" placeholder="{{ translate('Website Auther') }}">
        </div>
        <div class="col-md-12 mb-3">
            <label for="web-des" class="form-label ad-form-label">{{ translate('Website Description') }}</label>
            <textarea class="form-control ad-form-textarea" name="website_description" id="web-des" placeholder="Type here">{{ settings_data('website_description') }}</textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Slogan') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2" name="slogan"
                value="{{ settings_data('slogan') }}" placeholder="{{ translate('Website Slogan') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('System Email') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                value="{{ settings_data('system_email') }}" name="system_email"
                placeholder="{{ translate('Website System Email') }}">
        </div>

        <div class="col-md-12 mb-3">
            <label for="web-des" class="form-label ad-form-label">{{ translate('Address') }}</label>
            <textarea class="form-control ad-form-textarea" name="address" id="web-des" placeholder="Type here">{{ settings_data('address') }}</textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Phone Number') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2" name="phone"
                value="{{ settings_data('phone') }}" placeholder="{{ translate('Website Phone Number') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Youtube Api Key') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                value="{{ settings_data('youtube_api_key') }}" name="youtube_api_key"
                placeholder="{{ translate('Youtube Api Key') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Vimeo Api Key') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                value="{{ settings_data('vimeo_api_key') }}" name="vimeo_api_key"
                placeholder="{{ translate('Vimeo Api Key') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Purchase Code') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                value="{{ settings_data('purchase_code') }}" name="purchase_code"
                placeholder="{{ translate('Enter Purchase Code') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="setting-language" class="form-label ad-form-label">{{ translate('System language') }}</label>
            <select class="ad-select2" name="language" data-minimum-results-for-search="Infinity">
                <option @selected(settings_data('language') == 'english') value="english">English</option>
                <option @selected(settings_data('language') == 'hindi') value="hindi">Hindi</option>
                <option @selected(settings_data('language') == 'bangla') value="bangla">Bangla</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="setting-language"
                class="form-label ad-form-label">{{ translate('Student Email Verification') }}</label>
            <select class="ad-select2" name="student_email_verification" data-minimum-results-for-search="Infinity">
                <option @selected(settings_data('language') == 'enable') value="enable">{{ translate('Enable') }}</option>
                <option @selected(settings_data('language') == 'disable') value="disable">{{ translate('Disable') }}</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2"
                class="form-label ad-form-label">{{ translate('Number of Authorized Devices') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                name="allowed_device_number_of_loging" value="{{ settings_data('allowed_device_number_of_loging') }}"
                placeholder="{{ translate('Enter Number of Authorized Devices') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2"
                class="form-label ad-form-label">{{ translate('Course Selling Tax (%)') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                value="{{ settings_data('course_selling_tax') }}" name="course_selling_tax"
                placeholder="{{ translate('Enter Course Selling Tax ') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2"
                class="form-label ad-form-label">{{ translate('Google Analytics Id') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2"
                value="{{ settings_data('google_analytics_id') }}" name="google_analytics_id"
                placeholder="{{ translate('Enter Google analytics id ') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Meta Pixel Id') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2" name="meta_pixel_id"
                value="{{ settings_data('meta_pixel_id') }}" placeholder="{{ translate('Meta Pixel Id ') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Footer Text') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2" name="footer_text"
                value="{{ settings_data('footer_text') }}" placeholder="{{ translate('Enter Footer Text ') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tagsinput-id-2" class="form-label ad-form-label">{{ translate('Footer Link') }}</label>
            <input type="text" class="form-control ad-form-control " id="tagsinput-id-2" name="footer_link"
                value="{{ settings_data('footer_link') }}" placeholder="{{ translate('Enter Footer Link ') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="setting-language" class="form-label ad-form-label">{{ translate('Timezone') }}</label>
            <select class="ad-select2" name="timezone" data-minimum-results-for-search="Infinity">
                <option value="enable">{{ translate('Enable') }}</option>
                <option value="disable">{{ translate('Disable') }}</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="setting-language" class="form-label ad-form-label">{{ translate('Public signup') }}</label>
            <select class="ad-select2" name="public_signup" data-minimum-results-for-search="Infinity">
                <option value="enable">{{ translate('Enable') }}</option>
                <option value="disable">{{ translate('Disable') }}</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="setting-language"
                class="form-label ad-form-label">{{ translate('Can students disable their own accounts?') }}</label>
            <select class="ad-select2" name="disable_account" data-minimum-results-for-search="Infinity">
                <option value="enable">{{ translate('Yes') }}</option>
                <option value="disable">{{ translate('No') }}</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="setting-language"
                class="form-label ad-form-label">{{ translate('Duplicate Course') }}</label>
            <select class="ad-select2" name="duplicate_course" data-minimum-results-for-search="Infinity">
                <option value="enable">{{ translate('Yes') }}</option>
                <option value="disable">{{ translate('No') }}</option>
            </select>
        </div>

    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>

</form>
