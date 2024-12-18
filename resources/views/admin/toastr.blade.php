<div class="toast-container position-fixed top-0 end-0 p-3"></div>

{{-- <div class="toaster2 border-left-success">
    <div class="toaster-title">
        <div class="d-flex align-item-center justify-content-between gap-2">
            <div class="d-flex align-item-center gap-2">
                <span>
                    <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect y="0.5" width="25" height="25" rx="12.5" fill="#17C653"></rect>
                        <path d="M10.6163 16.9C10.2984 16.9001 9.99347 16.7689 9.76885 16.5351L7.20676 13.8742C6.93108 13.5877 6.93108 13.1233 7.20676 12.8368C7.48253 12.5503 7.92956 12.5503 8.20533 12.8368L10.6163 15.3416L16.9947 8.71481C17.2704 8.4284 17.7175 8.4284 17.9932 8.71481C18.2689 9.00133 18.2689 9.46576 17.9932 9.75227L11.4637 16.5351C11.2391 16.7689 10.9342 16.9001 10.6163 16.9Z" fill="white"></path>
                    </svg>
                </span>
                <div>
                    <p class="title fs-16">Success</p>
                    <p class="fs-14">Hey word! this is a toast message</p>
                </div>
            </div>



            <span class="toaster-close2"><i class="fa-solid fa-xmark"></i></span>

        </div>
    </div>
</div> --}}
<script>
    "Use strict";


    function toaster_message(type, border, icon, header, message) {
        var toasterMessage = '<div class="toast ' + type +
            ' fade ' + border +
            ' text-12" role="alert" aria-live="assertive" aria-atomic="true" class="rounded-3"><div class="toast-header"> <i class="' +
            icon + ' me-2 mt-2px fs-4 d-flex"></i> <strong class="me-auto"> ' + header +
            ' </strong><small>Just now</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' +
            message + '</div></div>';
        $('.toast-container').prepend(toasterMessage);
        const toast = new bootstrap.Toast('.toast')
        toast.show()
    }

    function success(message) {
        toaster_message('success', 'border-left-success', 'fi-sr-badge-check text-info', 'Success !', message);
    }

    function warning(message) {
        toaster_message('warning', 'border-left-warning', 'fi-sr-exclamation text-danger', 'Attention !', message);
    }

    function error(message) {
        toaster_message('error', 'border-left-info', 'fi-sr-triangle-warning text-danger', 'An Error Occurred !',
            message);
    }

    function dark(message) {
        toaster_message('dark', 'border-left-info', '', '', message);
    }
</script>

@if ($message = Session::get('success'))
    <script>
        success("{{ $message }}");
    </script>
    @php Session()->forget('success'); @endphp
@elseif($message = Session::get('error'))
    <script>
        error("{{ $message }}");
    </script>
    @php Session()->forget('error'); @endphp
@elseif($message = Session::get('warning'))
    <script>
        warning("{{ $message }}");
    </script>
    @php Session()->forget('warning'); @endphp
@elseif($message = Session::get('info'))
    <script>
        info("{{ $message }}");
    </script>
    @php Session()->forget('info'); @endphp
@elseif($message = Session::get('dark'))
    <script>
        dark("{{ $message }}");
    </script>
    @php Session()->forget('dark'); @endphp
@elseif($message = Session::get('light'))
    <script>
        light("{{ $message }}");
    </script>
    @php Session()->forget('light'); @endphp
@elseif($errors->any())
    @php
        $message = '<ul>';
        foreach ($errors->all() as $error):
            $message .= '<li>' . $error . '</li>';
        endforeach;
        $message .= '</ul>';
    @endphp
    <script>
        error("{!! $message !!}");
    </script>
@endif
