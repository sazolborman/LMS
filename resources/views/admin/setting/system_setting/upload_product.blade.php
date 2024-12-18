<form action="#" method="POST">
    <div class="row">
        <!-- File Input  -->
        <div class="col-md-6 mb-3">
            <label for="formFile" class="form-label ad-form-label">File</label>
            <input class="form-control form-control-file" type="file" id="formFile">
        </div>

        <div class="col-md-6 mb-3">
            <div
                class="light-border-alert alert-width border-info-alert light-info-alert p-3 d-flex align-items-center gap-2">
                <div class="alert-icon">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M23.175 5.1498L16.3 2.5748C15.5875 2.3123 14.425 2.3123 13.7125 2.5748L6.8375 5.1498C5.5125 5.6498 4.4375 7.1998 4.4375 8.6123V18.7373C4.4375 19.7498 5.1 21.0873 5.9125 21.6873L12.7875 26.8248C14 27.7373 15.9875 27.7373 17.2 26.8248L24.075 21.6873C24.8875 21.0748 25.55 19.7498 25.55 18.7373V8.6123C25.5625 7.1998 24.4875 5.6498 23.175 5.1498ZM19.35 12.1498L13.975 17.5248C13.7875 17.7123 13.55 17.7998 13.3125 17.7998C13.075 17.7998 12.8375 17.7123 12.65 17.5248L10.65 15.4998C10.2875 15.1373 10.2875 14.5373 10.65 14.1748C11.0125 13.8123 11.6125 13.8123 11.975 14.1748L13.325 15.5248L18.0375 10.8123C18.4 10.4498 19 10.4498 19.3625 10.8123C19.725 11.1748 19.725 11.7873 19.35 12.1498Z"
                            fill="#009EF7"></path>
                    </svg>
                </div>
                <div class="alert-content">
                    <h4 class="fs-16px mb-1">{{ translate('Note') }}</h4>
                    <p class="fs-14px">
                        {{ translate('The user-friendly interface makes it easy to manage both products and their associated addons in one place. Product and Addon file type zip.') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Upload') }}</button>

</form>
