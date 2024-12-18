<script type="text/javascript">
    "use strict";

    $(function() {
        // Date range picker
        if ($('.daterangepicker:not(.inited)').length) {
            $('.daterangepicker:not(.inited)').daterangepicker();
            $('.daterangepicker:not(.inited)').addClass('inited');
        }

        // icon picker
        if ($('.icon-picker:not(.inited)').length) {
            $('.icon-picker:not(.inited)').iconpicker();
            $('.icon-picker:not(.inited)').addClass('inited');
        }

        //Select 2
        if ($('#clickModal select.ad-select2:not(.inited)').length) {
            $('#clickModal select.ad-select2:not(.inited)').select2({
                dropdownParent: $('#clickModal')
            });
            $('#clickModal select.ad-select2:not(.inited)').addClass('inited');
        }
        if ($('#right-modal select.ad-select2:not(.inited)').length) {
            $('#right-modal select.ad-select2:not(.inited)').select2({
                dropdownParent: $('#right-modal')
            });
            $('#right-modal select.ad-select2:not(.inited)').addClass('inited');
        }
        if ($('select.ad-select2:not(.inited)').length) {
            $('select.ad-select2:not(.inited)').select2();
            $('select.ad-select2:not(.inited)').addClass('inited');
        }

        if ($('#clickModal select.select2:not(.inited)').length) {
            $('#clickModal select.select2:not(.inited)').select2({
                dropdownParent: $('#clickModal')
            });
            $('#clickModal select.select2:not(.inited)').addClass('inited');
        }
        if ($('#right-modal select.select2:not(.inited)').length) {
            $('#right-modal select.select2:not(.inited)').select2({
                dropdownParent: $('#right-modal')
            });
            $('#right-modal select.select2:not(.inited)').addClass('inited');
        }
        if ($('select.select2:not(.inited)').length) {
            $('select.select2:not(.inited)').select2();
            $('select.select2:not(.inited)').addClass('inited');
        }

        //Text editor
        if ($('.text_editor:not(.inited)').length) {
            $('.text_editor:not(.inited)').summernote({
                height: 180, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true, // set focus to editable area after initializing summernote
                toolbar: [
                    ['color', ['color']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol']],
                    ['table', ['table']],
                    ['insert', ['link']]
                ]
            });
            $('.text_editor:not(.inited)').addClass('inited');
        }
        //summary, note_for_student, short_description, message, biography, type-msg, id="comment", summernote, address, website_description


        $('.tagify:not(.inited)').each(function(index, element) {
            var tagify = new Tagify(element, {
                placeholder: '{{ translate('Enter your keywords') }}'
            });
            $(element).addClass('inited');
        });

        var formElement;
        if ($('.ajaxForm:not(.initialized)').length > 0) {
            $('.ajaxForm:not(.initialized)').ajaxForm({
                beforeSend: function(data, form) {
                    var formElement = $(form);
                },
                uploadProgress: function(event, position, total, percentComplete) {},
                complete: function(xhr) {

                    setTimeout(function() {
                        distributeServerResponse(xhr.responseText);
                    }, 400);

                    if ($('.ajaxForm.resetable').length > 0) {
                        $('.ajaxForm.resetable')[0].reset();
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
            $('.ajaxForm:not(.initialized)').addClass('initialized');
        }
    });
</script>
