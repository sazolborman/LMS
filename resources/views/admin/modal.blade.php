<div class="modal fade ad-modal" id="clickModal" tabindex="-1" aria-labelledby="clickModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h1 class="modal-title title fs-16px" id="clickModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal eModal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sweet-alerts text-sweet-alerts">
        <div class="modal-content">
            <div class="modal-body">
                <div class="icon icon-confirm">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                        <path d="M22.5 29V10H25.5V29ZM22.5 38V35H25.5V38Z" />
                    </svg>
                </div>
                <p>{{ translate('Are you sure?') }}</p>
                <p class="focus-text">{{ translate("You can't bring it back!") }}</p>
                <div class="confirmBtn">
                    <button type="button" class="eBtn eBtn-red"
                        data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a href="javascript:void(0)"
                        class="confirm-btn eBtn e_sAlert eBtn-green">{{ translate("Yes, I'm sure") }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal eModal fade" id="deleteModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sweet-alerts text-sweet-alerts">
        <div class="modal-content">
            <div class="modal-body">
                <div class="icon icon-confirm">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                        <path d="M22.5 29V10H25.5V29ZM22.5 38V35H25.5V38Z" />
                    </svg>
                </div>
                <p>{{ translate('Are you sure?') }}</p>
                <p class="focus-text">{{ translate("You can't bring it back!") }}</p>
                <div class="confirmBtn">
                    <button type="button" class="eBtn eBtn-red"
                        data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a href="javascript:void(0)" id="confirmDelete"
                        class="confirm-btn eBtn e_sAlert eBtn-green">{{ translate("Yes, I'm sure") }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function clickModal(url, title, modalClasses = 'modal-md', animation = 'fade') {
        $('#clickModal .modal-dialog').removeClass('modal-sm');
        $('#clickModal .modal-dialog').removeClass('modal-md');
        $('#clickModal .modal-dialog').removeClass('modal-lg');
        $('#clickModal .modal-dialog').removeClass('modal-xl');
        $('#clickModal .modal-dialog').removeClass('modal-xxl');
        $('#clickModal .modal-dialog').removeClass('modal-fullscreen');
        $('#clickModal .modal-dialog').addClass(modalClasses);

        $('#clickModal').removeClass('fade');
        $('#clickModal').addClass(animation);

        $('#clickModal .modal-title').html(title);
        $("#clickModal").modal('show');
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {
                $('#clickModal .modal-body').html(response);
            }
        });
    }

    const myModalEl = document.getElementById('clickModal')
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $('#clickModal .modal-body').html(
            '<div class="w-100 text-center py-5"><div class="spinner-border my-5" role="status"><span class="visually-hidden"></span></div></div>'
        );
    })



    function confirmModal(url, elem = false, actionType = null, content = null) {

        $("#confirmModal").modal('show');


        if (elem != false) {
            $.ajax({
                url: url,
                success: function(response) {
                    response = JSON.parse(response);
                    //For redirect to another url
                    if (typeof response.success != "undefined") {
                        window.location.href = response.success;
                    }
                    distributeServerResponse(response);
                }
            });
        } else {
            $('#confirmModal .confirm-btn').attr('href', url);
            $('#confirmModal .confirm-btn').removeAttr('onclick');
        }
    }
</script>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">{{ translate('AI Assistant') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="aiAjaxFormSubmission" action="{{ route('admin.ai.generate') }}" method="post">
            @csrf

            <div class="mb-3">
                <label class="form-label ad-form-label"
                    for="ai_service_selector">{{ translate('Select your service') }}</label>
                <select class="ad-select2" id="ai_service_selector" name="service_type"
                    onchange="if(this.value == 'Course thumbnail'){$('#aiLanguageField').hide()}else{$('#aiLanguageField').show()}">
                    <option value="Course title" data-select2-id="2">{{ translate('Course title') }}</option>
                    <option value="Course short description">{{ translate('Course short description') }}</option>
                    <option value="Course short description">{{ translate('Course long description') }}</option>
                    <option value="Course requirements">{{ translate('Course requirements') }}</option>
                    <option value="Course outcomes">{{ translate('Course outcomes') }}</option>
                    <option value="Course FAQ">{{ translate('Course faq') }}</option>
                    <option value="Course SEO Tags">{{ translate('Course seo tags') }}</option>
                    <option value="Course lesson text">{{ translate('Course lesson text') }}</option>
                    <option value="Course certificate text">{{ translate('Course certificate text') }}</option>
                    <option value="Course quiz text">{{ translate('Course quiz text') }}</option>
                    <option value="Course blog title">{{ translate('Course blog title') }}</option>
                    <option value="Course blog post">{{ translate('Course blog post') }}</option>
                    <option value="Course thumbnail">{{ translate('Course thumbnail') }}</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label ad-form-label" for="ai_keywords">{{ translate('Enter your keyword') }}</label>
                <input type="text" class="form-control ad-form-control" id="ai_keywords" name="ai_keywords">
            </div>

            <div class="mb-3" id="aiLanguageField">
                <label class="form-label ad-form-label" for="language">{{ translate('Language') }}</label>
                <select class="ad-select2" name="language">
                    @foreach (App\Models\Language::get() as $language)
                        <option value="{{ strtolower($language->name) }}" class="text-capitalize">
                            {{ $language->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" id="aiSubmissionBtn"
                class="btn ad-btn-primary w-100">{{ translate('Generate') }}</button>
        </form>

        <div class="row mt-3">
            <div class="col-md-12">
                <h5 id="aiResultHeader"></h5>
                <div id="aiGeneratedText" contenteditable="true"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    "use strict";


    $(function() {
        //The form of submission to RailTeam js is defined here.(Form class or ID)
        $('.aiAjaxFormSubmission').ajaxForm({
            beforeSend: function() {
                $('#aiSubmissionBtn').html("{{ translate('Generating') }}");
                $('#aiSubmissionBtn').attr('disabled', true);
            },
            uploadProgress: function(event, position, total, percentComplete) {

            },
            complete: function(xhr) {
                var response = xhr.responseText;

                if (/^[\],:{}\s]*$/.test(response.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
                        ']').replace(/(?:^|:|,)(?:\s*\[)+/g, '')) && $('#ai_service_selector')
                    .val() == 'Course thumbnail') {
                    var parsedJson = JSON.parse(response);
                    $('#aiGeneratedText').html('<div class="row"></div>');
                    console.log(parsedJson.length);
                    for (let i = 0; i < parsedJson.length; i++) {
                        var exi = i + 1;
                        var img =
                            '<div class="w-50 p-2 position-relative"><a class="position-absolute btn btn-success px-1 py-0 m-1" href="admin/ai_img_download?index=' +
                            exi +
                            '" target="_blank"><i class="fas fa-download"></i></a><img class="radius-5px" width="100%" src="' +
                            parsedJson[i].url +
                            '"></div>';
                        $('#aiGeneratedText .row').append(img);
                    }
                    $('#aiResultHeader').html('{{ translate('Your images') }}:');
                    $('#aiGeneratedText').attr('contenteditable', 'false');
                } else {
                    $('#aiGeneratedText').html(response);
                    $('#aiGeneratedText').append('<input type="text" value="' + response +
                        '" id="generatedAiText" class="visibility-hidden">');
                    $('#aiResultHeader').html(
                        '<span class="text-14px">{{ translate('Generated text') }}:</span> <a href="javascript:;" onclick="copy_text(this)" data-toggle="tooltip" data-placement="top" title="{{ translate('Copy') }}" class="float-right btn p-0"><i class="far fa-copy"></i> {{ translate('Copy') }}</a>'
                    );
                }


                $('#aiSubmissionBtn').html("{{ translate('Generate') }}");
                $('#aiSubmissionBtn').attr('disabled', false);
            },
            error: function() {
                //You can write here your js error message
            }
        });
    });

    function copy_text(e) {
        // Get the text field
        var copyText = document.getElementById("generatedAiText");
        console.log(copyText);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        $(e).html('<i class="far fa-copy"></i> {{ translate('Copied') }}!')
    }
</script>
