@php
    $current_route = Route::currentRouteName();
@endphp
<style>
    .showMenu {
        display: block !important;
    }
</style>
<aside class="ad-sidebar">
    <div class="sidebar-logo-area">
        <a href="#" class="sidebar-logos">
            <img class="sidebar-logo-lg" src="{{ asset('/') }}assets/backend/images/logo-full.svg" alt="">
            <img class="sidebar-logo-lg-dark" src="{{ asset('/') }}assets/backend/images/logo-full-dark.svg"
                alt="">
            <img class="sidebar-logo-sm" src="{{ asset('/') }}assets/backend/images/logo-small.svg" alt="">
        </a>
        <button class="menu-toggler">
            <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21 5.25H3C2.59 5.25 2.25 4.91 2.25 4.5C2.25 4.09 2.59 3.75 3 3.75H21C21.41 3.75 21.75 4.09 21.75 4.5C21.75 4.91 21.41 5.25 21 5.25Z"
                        fill="#778CA6" />
                    <path
                        d="M21 10.25H11.53C11.12 10.25 10.78 9.91 10.78 9.5C10.78 9.09 11.12 8.75 11.53 8.75H21C21.41 8.75 21.75 9.09 21.75 9.5C21.75 9.91 21.41 10.25 21 10.25Z"
                        fill="#778CA6" />
                    <path
                        d="M21 15.25H3C2.59 15.25 2.25 14.91 2.25 14.5C2.25 14.09 2.59 13.75 3 13.75H21C21.41 13.75 21.75 14.09 21.75 14.5C21.75 14.91 21.41 15.25 21 15.25Z"
                        fill="#778CA6" />
                    <path
                        d="M21 20.25H11.53C11.12 20.25 10.78 19.91 10.78 19.5C10.78 19.09 11.12 18.75 11.53 18.75H21C21.41 18.75 21.75 19.09 21.75 19.5C21.75 19.91 21.41 20.25 21 20.25Z"
                        fill="#778CA6" />
                </svg>
            </span>
        </button>
    </div>
    <div class="sidebar-nav-area">
        <nav class="sidebar-nav">
            <ul class="px-14px pb-24px">

                {{-- dashboard sidemenu --}}
                <li class="sidebar-first-li @if ($current_route == 'admin.dashboard') active @endif">
                    <a href="{{ route('admin.dashboard') }}">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 12.5C7.72667 12.5 7.5 12.2733 7.5 12V10C7.5 9.72667 7.72667 9.5 8 9.5C8.27333 9.5 8.5 9.72667 8.5 10V12C8.5 12.2733 8.27333 12.5 8 12.5Z"
                                fill="#778CA6" />
                            <path
                                d="M11.7333 15.04H4.26664C3.05331 15.04 1.94664 14.1066 1.74664 12.9133L0.859974 7.59996C0.713307 6.7733 1.11997 5.7133 1.77997 5.18663L6.39997 1.48663C7.29331 0.766629 8.69997 0.773296 9.59997 1.4933L14.22 5.18663C14.8733 5.7133 15.2733 6.7733 15.14 7.59996L14.2533 12.9066C14.0533 14.0866 12.92 15.04 11.7333 15.04ZM7.99331 1.9533C7.63997 1.9533 7.28664 2.05996 7.02664 2.26663L2.40664 5.9733C2.03331 6.2733 1.76664 6.96663 1.84664 7.43996L2.73331 12.7466C2.85331 13.4466 3.55331 14.04 4.26664 14.04H11.7333C12.4466 14.04 13.1466 13.4466 13.2666 12.74L14.1533 7.4333C14.2266 6.96663 13.96 6.25996 13.5933 5.96663L8.97331 2.2733C8.70664 2.05996 8.34664 1.9533 7.99331 1.9533Z"
                                fill="#778CA6" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('Dashboard') }}</span>
                        </div>
                    </a>
                </li>

                {{-- course category sidemenu --}}
                <li class="sidebar-first-li @if ($current_route == 'admin.category') active @endif">
                    <a href="{{ route('admin.category') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.75 4.5L4.5 3.75H10.5L11.25 4.5V10.5L10.5 11.25H4.5L3.75 10.5V4.5ZM5.25 5.25V9.75H9.75V5.25H5.25ZM13.5 3.75L12.75 4.5V10.5L13.5 11.25H19.5L20.25 10.5V4.5L19.5 3.75H13.5ZM14.25 9.75V5.25H18.75V9.75H14.25ZM17.25 20.25H15.75V17.25H12.75V15.75H15.75V12.75H17.25V15.75H20.25V17.25H17.25V20.25ZM4.5 12.75L3.75 13.5V19.5L4.5 20.25H10.5L11.25 19.5V13.5L10.5 12.75H4.5ZM5.25 18.75V14.25H9.75V18.75H5.25Z"
                                fill="#778CA6" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('Course Category') }}</span>
                        </div>
                    </a>
                </li>

                {{-- course Sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub  @if (
                    $current_route == 'admin.course.create' ||
                        $current_route == 'admin.course' ||
                        $current_route == 'admin.course.edit' ||
                        $current_route == 'admin.coupon') active @endif">
                    <a href="javascript:void(0);">
                        <svg width="16" height="16" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="28" width="36" height="14" rx="4" stroke="#778CA6"
                                stroke-width="4" />
                            <path d="M20 7H10C7.79086 7 6 8.79086 6 11V17C6 19.2091 7.79086 21 10 21H20"
                                stroke="#778CA6" stroke-width="4" stroke-linecap="round" />
                            <circle cx="34" cy="14" r="8" fill="#778CA6" stroke="#778CA6"
                                stroke-width="4" />
                            <circle cx="34" cy="14" r="3" fill="#778CA6" />
                        </svg>

                        <div class="text">
                            <span>{{ translate('Courses') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.course.create' ||
                            $current_route == 'admin.course' ||
                            $current_route == 'admin.course.edit' ||
                            $current_route == 'admin.coupon') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Courses') }}</li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.course' || $current_route == 'admin.course.edit') active @endif"><a
                                href="{{ route('admin.course') }}">{{ translate('Manage Course') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.course.create') active @endif"><a
                                href="{{ route('admin.course.create') }}">{{ translate('Create Course') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.coupon') active @endif"><a
                                href="{{ route('admin.coupon') }}">{{ translate('Coupons') }}</a></li>
                    </ul>
                </li>

                {{-- course bundle sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub  @if (
                    $current_route == 'admin.bundle.create' ||
                        $current_route == 'admin.bundle' ||
                        $current_route == 'admin.bundle.edit') active @endif">
                    <a href="javascript:void(0);">
                        <svg fill="#778CA6" height="16" width="16" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 463 463"
                            xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 463 463">
                            <g>
                                <path
                                    d="m423.5,40h-384c-21.78,0-39.5,17.72-39.5,39.5v304c0,21.78 17.72,39.5 39.5,39.5h384c21.78,0 39.5-17.72 39.5-39.5v-304c0-21.78-17.72-39.5-39.5-39.5zm24.5,39.5v136.5h-270.394l27.197-27.197c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606,0l-27.197,27.197v-150.394h256.5c13.509,0 24.5,10.991 24.5,24.5zm-408.5-24.5h112.5v138.306c-9.276-17.088-20.292-36.426-25.13-41.264-10.704-10.705-28.123-10.705-38.828,0-10.705,10.705-10.705,28.124 0,38.828 4.838,4.838 24.176,15.854 41.264,25.13h-114.306v-136.5c0-13.509 10.991-24.5 24.5-24.5zm102.045,150.545c-19.667-10.585-39.41-21.795-42.897-25.282-4.856-4.856-4.856-12.759 0-17.615 2.429-2.428 5.618-3.642 8.808-3.642 3.189,0 6.38,1.214 8.808,3.642 3.486,3.487 14.695,23.23 25.281,42.897zm-126.545,177.955v-152.5h126.394l-27.197,27.197c-2.929,2.929-2.929,7.678 0,10.606 1.464,1.464 3.384,2.197 5.303,2.197s3.839-0.732 5.303-2.197l27.197-27.197v166.394h-112.5c-13.509,0-24.5-10.991-24.5-24.5zm408.5,24.5h-256.5v-154.306c9.276,17.088 20.292,36.426 25.13,41.264 5.352,5.353 12.383,8.029 19.414,8.029 7.031,0 14.062-2.676 19.415-8.029 10.705-10.705 10.705-28.124 0-38.828-4.838-4.838-24.176-15.854-41.264-25.13h258.305v152.5c0,13.509-10.991,24.5-24.5,24.5zm-246.045-166.545c19.667,10.585 39.41,21.795 42.897,25.282 4.856,4.856 4.856,12.759 0,17.615-4.857,4.856-12.759,4.855-17.615,0-3.487-3.487-14.696-23.23-25.282-42.897z" />
                                <path
                                    d="m367.5,175c21.78,0 39.5-17.72 39.5-39.5s-17.72-39.5-39.5-39.5-39.5,17.72-39.5,39.5 17.72,39.5 39.5,39.5zm0-64c13.509,0 24.5,10.991 24.5,24.5s-10.991,24.5-24.5,24.5-24.5-10.991-24.5-24.5 10.991-24.5 24.5-24.5z" />
                                <path
                                    d="m399.5,264h-112c-8.547,0-15.5,6.953-15.5,15.5v80c0,8.547 6.953,15.5 15.5,15.5h112c8.547,0 15.5-6.953 15.5-15.5v-80c0-8.547-6.953-15.5-15.5-15.5zm.5,95.5c0,0.276-0.224,0.5-0.5,0.5h-112c-0.276,0-0.5-0.224-0.5-0.5v-80c0-0.276 0.224-0.5 0.5-0.5h112c0.276,0 0.5,0.224 0.5,0.5v80z" />
                                <path
                                    d="m375.5,296h-64c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5 7.5,7.5h64c4.142,0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z" />
                                <path
                                    d="m375.5,328h-64c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5 7.5,7.5h64c4.142,0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z" />
                            </g>
                        </svg>
                        <div class="text">
                            <span>{{ translate('Course Bundle') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.bundle.create' ||
                            $current_route == 'admin.bundle' ||
                            $current_route == 'admin.bundle.edit') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Courses Bundle') }}</li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.bundle' || $current_route == 'admin.bundle.edit') active @endif"><a
                                href="{{ route('admin.bundle') }}">{{ translate('Manage Bundle') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.bundle.create') active @endif"><a
                                href="{{ route('admin.bundle.create') }}">{{ translate('Create Bundle') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.subscription.report') active @endif"><a
                                href="{{ route('admin.subscription.report') }}">{{ translate('Subscription Report') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- bootcamp sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub  @if (
                    $current_route == 'admin.bootcamp' ||
                        $current_route == 'admin.bootcamp.create' ||
                        $current_route == 'admin.bootcamp.edit' ||
                        $current_route == 'admin.bootcamp.category' ||
                        $current_route == 'admin.bootcamp.purchasehistory') active @endif">
                    <a href="javascript:void(0);">
                        <svg fill="#778CA6" width="16" height="16" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>users</title>
                            <path
                                d="M16 21.916c-4.797 0.020-8.806 3.369-9.837 7.856l-0.013 0.068c-0.011 0.048-0.017 0.103-0.017 0.16 0 0.414 0.336 0.75 0.75 0.75 0.357 0 0.656-0.25 0.731-0.585l0.001-0.005c0.875-3.885 4.297-6.744 8.386-6.744s7.511 2.859 8.375 6.687l0.011 0.057c0.076 0.34 0.374 0.59 0.732 0.59 0 0 0.001 0 0.001 0h-0c0.057-0 0.112-0.007 0.165-0.019l-0.005 0.001c0.34-0.076 0.59-0.375 0.59-0.733 0-0.057-0.006-0.112-0.018-0.165l0.001 0.005c-1.045-4.554-5.055-7.903-9.849-7.924h-0.002zM9.164 10.602c0 0 0 0 0 0 2.582 0 4.676-2.093 4.676-4.676s-2.093-4.676-4.676-4.676c-2.582 0-4.676 2.093-4.676 4.676v0c0.003 2.581 2.095 4.673 4.675 4.676h0zM9.164 2.75c0 0 0 0 0 0 1.754 0 3.176 1.422 3.176 3.176s-1.422 3.176-3.176 3.176c-1.754 0-3.176-1.422-3.176-3.176v0c0.002-1.753 1.423-3.174 3.175-3.176h0zM22.926 10.602c2.582 0 4.676-2.093 4.676-4.676s-2.093-4.676-4.676-4.676c-2.582 0-4.676 2.093-4.676 4.676v0c0.003 2.581 2.095 4.673 4.675 4.676h0zM22.926 2.75c1.754 0 3.176 1.422 3.176 3.176s-1.422 3.176-3.176 3.176c-1.754 0-3.176-1.422-3.176-3.176v0c0.002-1.753 1.423-3.174 3.176-3.176h0zM30.822 19.84c-0.878-3.894-4.308-6.759-8.406-6.759-0.423 0-0.839 0.031-1.246 0.089l0.046-0.006c-0.049 0.012-0.092 0.028-0.133 0.047l0.004-0.002c-0.751-2.129-2.745-3.627-5.089-3.627-2.334 0-4.321 1.485-5.068 3.561l-0.012 0.038c-0.017-0.004-0.030-0.014-0.047-0.017-0.359-0.053-0.773-0.084-1.195-0.084-0.002 0-0.005 0-0.007 0h0c-4.092 0.018-7.511 2.874-8.392 6.701l-0.011 0.058c-0.011 0.048-0.017 0.103-0.017 0.16 0 0.414 0.336 0.75 0.75 0.75 0.357 0 0.656-0.25 0.731-0.585l0.001-0.005c0.737-3.207 3.56-5.565 6.937-5.579h0.002c0.335 0 0.664 0.024 0.985 0.070l-0.037-0.004c-0.008 0.119-0.036 0.232-0.036 0.354 0.006 2.987 2.429 5.406 5.417 5.406s5.411-2.419 5.416-5.406v-0.001c0-0.12-0.028-0.233-0.036-0.352 0.016-0.002 0.031 0.005 0.047 0.001 0.294-0.044 0.634-0.068 0.98-0.068 0.004 0 0.007 0 0.011 0h-0.001c3.379 0.013 6.203 2.371 6.93 5.531l0.009 0.048c0.076 0.34 0.375 0.589 0.732 0.59h0c0.057-0 0.112-0.007 0.165-0.019l-0.005 0.001c0.34-0.076 0.59-0.375 0.59-0.733 0-0.057-0.006-0.112-0.018-0.165l0.001 0.005zM16 18.916c-0 0-0 0-0.001 0-2.163 0-3.917-1.753-3.917-3.917s1.754-3.917 3.917-3.917c2.163 0 3.917 1.754 3.917 3.917 0 0 0 0 0 0.001v-0c-0.003 2.162-1.754 3.913-3.916 3.916h-0z">
                            </path>
                        </svg>
                        <div class="text">
                            <span>{{ translate('Bootcamp') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.bootcamp' ||
                            $current_route == 'admin.bootcamp.create' ||
                            $current_route == 'admin.bootcamp.edit' ||
                            $current_route == 'admin.bootcamp.category' ||
                            $current_route == 'admin.bootcamp.purchasehistory') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Bootcamp Management') }}</li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.bootcamp' || $current_route == 'admin.bootcamp.edit') active @endif"><a
                                href="{{ route('admin.bootcamp') }}">{{ translate('Bootcamp manage') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.bootcamp.create') active @endif"><a
                                href="{{ route('admin.bootcamp.create') }}">{{ translate('Create Bootcamp') }}</a>
                        </li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.bootcamp.category') active @endif"><a
                                href="{{ route('admin.bootcamp.category') }}">{{ translate('Category Manage') }}</a>
                        </li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.bootcamp.purchasehistory') active @endif"><a
                                href="{{ route('admin.bootcamp.purchasehistory') }}">{{ translate('Purchase History') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- Course Enroll sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub  @if ($current_route == 'admin.enrollment' || $current_route == 'admin.enrollment.history') active @endif">
                    <a href="javascript:void(0);">

                        <svg fill="#778CA6" height="16" width="16" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512.003 512.003" xml:space="preserve">
                            <g>
                                <g>
                                    <g>
                                        <path
                                            d="M96.003,106.668c29.419,0,53.333-23.936,53.333-53.333S125.422,0.002,96.003,0.002
                                                c-29.419,0-53.333,23.936-53.333,53.333S66.585,106.668,96.003,106.668z M96.003,21.335c17.643,0,32,14.357,32,32
                                                c0,17.643-14.357,32-32,32c-17.643,0-32-14.357-32-32C64.003,35.692,78.361,21.335,96.003,21.335z" />
                                        <path d="M480.003,21.335h-42.667c-17.643,0-32,14.357-32,32v42.667c0,17.643,14.357,32,32,32h42.667c17.643,0,32-14.357,32-32
                                                V53.335C512.003,35.692,497.646,21.335,480.003,21.335z M490.67,96.002c0,5.888-4.8,10.667-10.667,10.667h-42.667
                                                c-5.867,0-10.667-4.779-10.667-10.667V53.335c0-5.888,4.8-10.667,10.667-10.667h42.667c5.867,0,10.667,4.779,10.667,10.667
                                                V96.002z" />
                                        <path d="M480.003,213.335h-42.667c-17.643,0-32,14.357-32,32v42.667c0,17.643,14.357,32,32,32h42.667c17.643,0,32-14.357,32-32
                                                v-42.667C512.003,227.692,497.646,213.335,480.003,213.335z M490.67,288.002c0,5.888-4.8,10.667-10.667,10.667h-42.667
                                                c-5.867,0-10.667-4.779-10.667-10.667v-42.667c0-5.888,4.8-10.667,10.667-10.667h42.667c5.867,0,10.667,4.779,10.667,10.667
                                                V288.002z" />
                                        <path d="M480.003,405.335h-42.667c-17.643,0-32,14.357-32,32v42.667c0,17.643,14.357,32,32,32h42.667c17.643,0,32-14.357,32-32
                                                v-42.667C512.003,419.692,497.646,405.335,480.003,405.335z M490.67,480.002c0,5.888-4.8,10.667-10.667,10.667h-42.667
                                                c-5.867,0-10.667-4.779-10.667-10.667v-42.667c0-5.888,4.8-10.667,10.667-10.667h42.667c5.867,0,10.667,4.779,10.667,10.667
                                                V480.002z" />
                                        <path d="M177.646,179.82c-3.349-29.547-26.752-51.819-54.4-51.819H68.782c-27.648,0-51.051,22.293-54.4,51.819L0.238,303.724
                                                c-1.173,10.368,2.027,20.672,8.768,28.224c5.803,6.507,13.525,10.304,21.909,10.773l11.776,159.403
                                                c0.427,5.568,5.056,9.877,10.645,9.877h85.333c5.589,0,10.219-4.309,10.667-9.877l11.776-159.403
                                                c8.363-0.469,16.107-4.245,21.909-10.773c6.741-7.573,9.941-17.856,8.768-28.224L177.646,179.82z M167.086,317.74
                                                c-1.216,1.365-3.883,3.691-7.808,3.691h-8.107c-5.589,0-10.219,4.309-10.645,9.877l-11.776,159.36H63.257l-11.797-159.36
                                                c-0.427-5.568-5.056-9.877-10.645-9.877h-8.107c-3.904,0-6.571-2.325-7.808-3.691c-2.709-3.051-3.968-7.275-3.477-11.605
                                                l14.144-123.904c2.133-18.752,16.405-32.896,33.195-32.896h54.464c16.789,0,31.061,14.144,33.195,32.896l14.144,123.904
                                                C171.076,310.466,169.795,314.69,167.086,317.74z" />
                                        <path d="M330.67,85.335h42.667c5.888,0,10.667-4.779,10.667-10.667s-4.779-10.667-10.667-10.667H330.67
                                                c-29.419,0-53.333,23.936-53.333,53.333v138.667h-53.333c-5.888,0-10.667,4.779-10.667,10.667s4.779,10.667,10.667,10.667h53.333
                                                v138.667c0,29.397,23.915,53.333,53.333,53.333h42.667c5.888,0,10.667-4.779,10.667-10.667s-4.779-10.667-10.667-10.667H330.67
                                                c-17.643,0-32-14.357-32-32V277.335h74.667c5.888,0,10.667-4.779,10.667-10.667s-4.779-10.667-10.667-10.667H298.67V117.335
                                                C298.67,99.692,313.027,85.335,330.67,85.335z" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <div class="text">
                            <span>{{ translate('Course Enroll') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if ($current_route == 'admin.enrollment.history' || $current_route == 'admin.enrollment') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Courses Enroll') }}</li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.enrollment') active @endif"><a
                                href="{{ route('admin.enrollment') }}">{{ translate('Enrollment') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.enrollment.history') active @endif"><a
                                href="{{ route('admin.enrollment.history') }}">{{ translate('Enroll History') }}</a>
                        </li>

                    </ul>
                </li>

                {{-- Ebook management sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub @if (
                    $current_route == 'admin.ebook' ||
                        $current_route == 'admin.ebook.edit' ||
                        $current_route == 'admin.ebook.create' ||
                        $current_route == 'admin.ebook.category') active @endif">
                    <a href="javascript:void(0);">
                        <svg fill="#778CA6" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                            <g>
                                <g>
                                    <rect x="230.4" y="341.333" width="16" height="16" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M426.667,392.533V25.6c0-14.14-11.46-25.6-25.6-25.6h-256c-32.939,0-59.733,26.795-59.733,59.733v392.533
                                            c0,32.939,26.795,59.733,59.733,59.733h268.8c7.066,0,12.8-5.734,12.8-12.8c0-7.066-5.734-12.8-12.8-12.8h-12.8v-68.267
                                            C415.206,418.133,426.667,406.673,426.667,392.533z M110.933,59.733c0-18.85,15.283-34.133,34.133-34.133h256v264.533h-256
                                            c-12.689,0-24.448,4.011-34.133,10.786V59.733z M375.467,486.4h-230.4c-18.85,0-34.133-15.283-34.133-34.133
                                            c0-18.85,15.283-34.133,34.133-34.133h230.4V486.4z M145.067,392.533c-12.689,0-24.448,4.011-34.133,10.786v-53.453
                                            c0-18.85,15.283-34.133,34.133-34.133h256v76.8H145.067z" />
                                </g>
                            </g>
                        </svg>
                        <div class="text">
                            <span>{{ translate('Ebook Management') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.ebook' ||
                            $current_route == 'admin.ebook.edit' ||
                            $current_route == 'admin.ebook.create' ||
                            $current_route == 'admin.ebook.category') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Ebook Management') }}</li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.ebook' || $current_route == 'admin.ebook.edit' || $current_route == 'admin.ebook.create') active @endif"><a
                                href="{{ route('admin.ebook') }}">{{ translate('All Ebooks') }}</a></li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.ebook.category') active @endif"><a
                                href="{{ route('admin.ebook.category') }}">{{ translate('Ebook Category') }}</a></li>

                        <li class="sidebar-second-li second-li-have-sub">
                            <a href="javascript:void(0);">{{ translate('Payment History') }}</a>
                            <ul class="second-sub-menu">
                                <li class="sidebar-third-li"><a href="">{{ translate('Admin Revenue') }}</a>
                                </li>
                                <li class="sidebar-third-li"><a
                                        href="">{{ translate('Instructor Revenue') }}</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- User management Sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub @if (
                    $current_route == 'admin.admin.create' ||
                        $current_route == 'admin.admin.edit' ||
                        $current_route == 'admin.admins' ||
                        $current_route == 'admin.permission' ||
                        $current_route == 'admininstructor' ||
                        $current_route == 'admin.instructor.create' ||
                        $current_route == 'admin.instructor.edit' ||
                        $current_route == 'admin.student.edit' ||
                        $current_route == 'admin.student.create' ||
                        $current_route == 'admin.student' ||
                        $current_route == 'admin.instructor.setting') active @endif">
                    <a href="javascript:void(0);">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.63411 9.68342C7.60911 9.68342 7.59245 9.68342 7.56745 9.68342C7.52578 9.67508 7.46745 9.67508 7.41745 9.68342C5.00078 9.60842 3.17578 7.70842 3.17578 5.36675C3.17578 2.98342 5.11745 1.04175 7.50078 1.04175C9.88411 1.04175 11.8258 2.98342 11.8258 5.36675C11.8174 7.70842 9.98411 9.60842 7.65911 9.68342C7.65078 9.68342 7.64245 9.68342 7.63411 9.68342ZM7.50078 2.29175C5.80911 2.29175 4.42578 3.67508 4.42578 5.36675C4.42578 7.03342 5.72578 8.37508 7.38411 8.43342C7.43411 8.42508 7.54245 8.42508 7.65078 8.43342C9.28412 8.35842 10.5674 7.01675 10.5758 5.36675C10.5758 3.67508 9.19245 2.29175 7.50078 2.29175Z"
                                fill="#778CA6" />
                            <path
                                d="M13.784 9.79158C13.759 9.79158 13.734 9.79158 13.709 9.78325C13.3673 9.81659 13.0173 9.57492 12.984 9.23325C12.9506 8.89158 13.159 8.58325 13.5006 8.54158C13.6006 8.53325 13.709 8.53325 13.8006 8.53325C15.0173 8.46659 15.9673 7.46659 15.9673 6.24159C15.9673 4.97492 14.9423 3.94992 13.6756 3.94992C13.334 3.95825 13.0506 3.67492 13.0506 3.33325C13.0506 2.99159 13.334 2.70825 13.6756 2.70825C15.6256 2.70825 17.2173 4.29992 17.2173 6.24992C17.2173 8.16658 15.7173 9.71659 13.809 9.79158C13.8006 9.79158 13.7923 9.79158 13.784 9.79158Z"
                                fill="#778CA6" />
                            <path
                                d="M7.64037 18.7916C6.00703 18.7916 4.36536 18.3749 3.1237 17.5416C1.96536 16.7749 1.33203 15.7249 1.33203 14.5833C1.33203 13.4416 1.96536 12.3833 3.1237 11.6083C5.6237 9.94992 9.6737 9.94992 12.157 11.6083C13.307 12.3749 13.9487 13.4249 13.9487 14.5666C13.9487 15.7083 13.3154 16.7666 12.157 17.5416C10.907 18.3749 9.2737 18.7916 7.64037 18.7916ZM3.81536 12.6583C3.01536 13.1916 2.58203 13.8749 2.58203 14.5916C2.58203 15.2999 3.0237 15.9833 3.81536 16.5083C5.89036 17.8999 9.39036 17.8999 11.4654 16.5083C12.2654 15.9749 12.6987 15.2916 12.6987 14.5749C12.6987 13.8666 12.257 13.1833 11.4654 12.6583C9.39036 11.2749 5.89036 11.2749 3.81536 12.6583Z"
                                fill="#778CA6" />
                            <path
                                d="M15.2844 17.2917C14.9928 17.2917 14.7344 17.0917 14.6761 16.7917C14.6094 16.45 14.8261 16.125 15.1594 16.05C15.6844 15.9417 16.1678 15.7333 16.5428 15.4417C17.0178 15.0833 17.2761 14.6333 17.2761 14.1583C17.2761 13.6833 17.0178 13.2333 16.5511 12.8833C16.1844 12.6 15.7261 12.4 15.1844 12.275C14.8511 12.2 14.6344 11.8667 14.7094 11.525C14.7844 11.1917 15.1178 10.975 15.4594 11.05C16.1761 11.2083 16.8011 11.4917 17.3094 11.8833C18.0844 12.4667 18.5261 13.2917 18.5261 14.1583C18.5261 15.025 18.0761 15.85 17.3011 16.4417C16.7844 16.8417 16.1344 17.1333 15.4178 17.275C15.3678 17.2917 15.3261 17.2917 15.2844 17.2917Z"
                                fill="#778CA6" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('User Management') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.admin.create' ||
                            $current_route == 'admin.admin.edit' ||
                            $current_route == 'admin.admins' ||
                            $current_route == 'admin.permission' ||
                            $current_route == 'admin.instructor.create' ||
                            $current_route == 'admin.instructor' ||
                            $current_route == 'admin.instructor.edit' ||
                            $current_route == 'admin.student.edit' ||
                            $current_route == 'admin.student.create' ||
                            $current_route == 'admin.student' ||
                            $current_route == 'admin.instructor.setting') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('User Management') }}</li>
                        <li
                            class="sidebar-second-li second-li-have-sub @if (
                                $current_route == 'admin.admin.create' ||
                                    $current_route == 'admin.admin.edit' ||
                                    $current_route == 'admin.admins' ||
                                    $current_route == 'admin.permission') active @endif">
                            <a href="javascript:void(0);">{{ translate('Admin') }}</a>
                            <ul class="second-sub-menu @if (
                                $current_route == 'admin.admin.create' ||
                                    $current_route == 'admin.admin.edit' ||
                                    $current_route == 'admin.admins' ||
                                    $current_route == 'admin.permission') showMenu @endif">
                                <li class="sidebar-third-li @if ($current_route == 'admin.admins' || $current_route == 'admin.admin.edit' || $current_route == 'admin.permission') active @endif"><a
                                        href="{{ route('admin.admins') }}">{{ translate('Admin Manage') }}</a>
                                </li>
                                <li class="sidebar-third-li @if ($current_route == 'admin.admin.create') active @endif"><a
                                        href="{{ route('admin.admin.create') }}">{{ translate('Create Admin') }}</a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="sidebar-second-li second-li-have-sub @if (
                                $current_route == 'admin.instructor.create' ||
                                    $current_route == 'admin.instructor' ||
                                    $current_route == 'admin.instructor.edit' ||
                                    $current_route == 'admin.instructor.setting') active @endif">
                            <a href="javascript:void(0);">{{ translate('Instructor') }}</a>
                            <ul class="second-sub-menu @if (
                                $current_route == 'admin.instructor.create' ||
                                    $current_route == 'admin.instructor' ||
                                    $current_route == 'admin.instructor.edit' ||
                                    $current_route == 'admin.instructor.setting') showMenu @endif">
                                <li class="sidebar-third-li  @if ($current_route == 'admin.instructor' || $current_route == 'admin.instructor.edit') active @endif"><a
                                        href="{{ route('admin.instructor') }}">{{ translate('Instructor Manage') }}</a>
                                </li>
                                <li class="sidebar-third-li @if ($current_route == 'admin.instructor.create') active @endif"><a
                                        href="{{ route('admin.instructor.create') }}">{{ translate('Create Instructor') }}</a>
                                </li>
                                <li class="sidebar-third-li"><a
                                        href="#">{{ translate('Instructor Payout') }}</a>
                                </li>
                                <li class="sidebar-third-li @if ($current_route == 'admin.instructor.setting') active @endif"><a
                                        href="{{ route('admin.instructor.setting') }}">{{ translate('Instructor Setting') }}</a>
                                </li>
                                <li class="sidebar-third-li"><a href="">{{ translate('Application') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="sidebar-second-li second-li-have-sub @if (
                                $current_route == 'admin.student.create' ||
                                    $current_route == 'admin.student' ||
                                    $current_route == 'admin.student.edit') active @endif">
                            <a href="javascript:void(0);">{{ translate('Student') }}</a>
                            <ul class="second-sub-menu @if (
                                $current_route == 'admin.student.create' ||
                                    $current_route == 'admin.student' ||
                                    $current_route == 'admin.student.edit') showMenu @endif">
                                <li class="sidebar-third-li @if ($current_route == 'admin.student.edit' || $current_route == 'admin.student') active @endif"><a
                                        href="{{ route('admin.student') }}">{{ translate('Student Manage') }}</a>
                                </li>
                                <li class="sidebar-third-li @if ($current_route == 'admin.student.create') active @endif"><a
                                        href="{{ route('admin.student.create') }}">{{ translate('Create Student') }}</a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </li>

                {{-- Affiliate sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub @if ($current_route == 'admin.affiliator') active @endif">
                    <a href="javascript:void(0);">

                        <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: none;
                                    stroke: #778CA6;
                                    stroke-width: 2;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-miterlimit: 10;
                                }

                                .st1 {
                                    fill: none;
                                    stroke: #778CA6;
                                    stroke-width: 2;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                }

                                .st2 {
                                    fill: none;
                                    stroke: #778CA6;
                                    stroke-width: 2;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-dasharray: 5.2066, 0;
                                }
                            </style>
                            <circle class="st0" cx="16" cy="26" r="3" />
                            <circle class="st0" cx="26" cy="26" r="3" />
                            <circle class="st0" cx="6" cy="26" r="3" />
                            <g>
                                <g>
                                    <line class="st1" x1="16" y1="23" x2="16"
                                        y2="19.5" />
                                    <line class="st1" x1="16" y1="19.5" x2="16"
                                        y2="19.5" />
                                    <polyline class="st1" points="16,19.5 16,16 13.1,18 		" />
                                    <line class="st2" x1="13.1" y1="18" x2="8.9"
                                        y2="21" />
                                    <line class="st1" x1="8.9" y1="21" x2="6"
                                        y2="23" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <line class="st1" x1="16" y1="16" x2="18.9"
                                        y2="18" />
                                    <line class="st2" x1="18.9" y1="18" x2="23.1"
                                        y2="21" />
                                    <line class="st1" x1="23.1" y1="21" x2="26"
                                        y2="23" />
                                </g>
                            </g>
                            <path class="st0" d="M17.3,8.6c0,1,0.6,1.8,1.6,2.1c1.1,0.3,1.9,1.2,2.2,2.3l-10,0c0.2-1.1,1.1-2,2.1-2.3c0.9-0.3,1.6-1.1,1.6-2.1v0
                                        " />
                            <path class="st0"
                                d="M16,9L16,9c-1.1,0-2-0.9-2-2V5c0-1.1,0.9-2,2-2h0c1.1,0,2,0.9,2,2v2C18,8.1,17.1,9,16,9z" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('Affiliate') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if ($current_route == 'admin.affiliator') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Affiliate') }}</li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.affiliator') active @endif"><a
                                href="{{ route('admin.affiliator') }}">{{ translate('Affiliator Manage') }}</a></li>
                        <li class="sidebar-second-li"><a href="">{{ translate('Affiliator History') }}</a>
                        </li>
                        <li class="sidebar-second-li "><a href="">{{ translate('Payout') }}</a></li>
                        <li class="sidebar-second-li"><a href="">{{ translate('Affiliator Setting') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- Blog sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub @if (
                    $current_route == 'admin.blog.create' ||
                        $current_route == 'admin.blog' ||
                        $current_route == 'admin.blog.edit' ||
                        $current_route == 'admin.blog.setting' ||
                        $current_route == 'admin.blog.category') active @endif">
                    <a href="javascript:void(0);">
                        <svg fill="#778CA6" width="16" height="16" viewBox="0 0 32 32" id="icon"
                            xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: none;
                                    }
                                </style>
                            </defs>
                            <title>blog</title>
                            <rect x="4" y="24" width="10" height="2" />
                            <rect x="4" y="18" width="10" height="2" />
                            <path
                                d="M26,14H6a2,2,0,0,1-2-2V6A2,2,0,0,1,6,4H26a2,2,0,0,1,2,2v6A2,2,0,0,1,26,14ZM6,6v6H26V6Z"
                                transform="translate(0 0)" />
                            <path
                                d="M26,28H20a2,2,0,0,1-2-2V20a2,2,0,0,1,2-2h6a2,2,0,0,1,2,2v6A2,2,0,0,1,26,28Zm-6-8v6h6V20Z"
                                transform="translate(0 0)" />
                            <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;"
                                class="cls-1" width="32" height="32" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('Blog') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.blog.create' ||
                            $current_route == 'admin.blog' ||
                            $current_route == 'admin.blog.edit' ||
                            $current_route == 'admin.blog.setting' ||
                            $current_route == 'admin.blog.category' ||
                            $current_route == 'admin.blog.pending') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Blog') }}</li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.blog' || $current_route == 'admin.blog.edit') active @endif"><a
                                href="{{ route('admin.blog') }}">{{ translate('Blog Manage') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.blog.create') active @endif"><a
                                href="{{ route('admin.blog.create') }}">{{ translate('Create Blog') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.blog.category') active @endif"><a
                                href="{{ route('admin.blog.category') }}">{{ translate('Blog Category') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.blog.setting') active @endif"><a
                                href="{{ route('admin.blog.setting') }}">{{ translate('Blog Setting') }}</a></li>
                    </ul>
                </li>

                {{-- Newsletter Sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub  @if ($current_route == 'admin.newsletter' || $current_route == 'admin.subscribed.user') active @endif">
                    <a href="javascript:void(0);">

                        <svg fill="#778CA6" width="16" height="16" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 490 490" xml:space="preserve">
                            <g id="Black_2_">
                                <path
                                    d="M436.406,76.563L367.5,0H53.594v490h382.813V76.563z M84.219,459.375V30.625h269.531v60.806h52.032v367.944H84.219z" />
                                <rect x="137.858" y="281.827" width="214.375" height="30.625" />
                                <rect x="137.858" y="335.068" width="214.375" height="30.625" />
                                <rect x="245.046" y="125.256" width="107.187" height="30.625" />
                                <rect x="245.046" y="178.498" width="107.187" height="30.625" />
                                <rect x="137.858" y="231.724" width="214.375" height="30.625" />
                                <rect x="137.767" y="125.287" width="83.928" height="83.928" />
                            </g>
                        </svg>
                        <div class="text">
                            <span>{{ translate('Newsletters') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if ($current_route == 'admin.newsletter' || $current_route == 'admin.subscribed.user') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Newsletters') }}</li>

                        <li class="sidebar-second-li @if ($current_route == 'admin.newsletter') active @endif"><a
                                href="{{ route('admin.newsletter') }}">{{ translate('All Newsletter') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.subscribed.user') active @endif"><a
                                href="{{ route('admin.subscribed.user') }}">{{ translate('Subscribed User') }}</a>
                        </li>

                    </ul>
                </li>

                {{-- Setting sidemenu --}}
                <li class="sidebar-first-li first-li-have-sub @if (
                    $current_route == 'admin.system.settings' ||
                        $current_route == 'admin.ai.settings' ||
                        $current_route == 'admin.language' ||
                        $current_route == 'admin.language.phrase.edit') active @endif">
                    <a href="javascript:void(0);">

                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.48 18.5368H21M4.68 12L3 12.044M4.68 12C4.68 13.3255 5.75451 14.4 7.08 14.4C8.40548 14.4 9.48 13.3255 9.48 12C9.48 10.6745 8.40548 9.6 7.08 9.6C5.75451 9.6 4.68 10.6745 4.68 12ZM10.169 12.0441H21M12.801 5.55124L3 5.55124M21 5.55124H18.48M3 18.5368H12.801M17.88 18.6C17.88 19.9255 16.8055 21 15.48 21C14.1545 21 13.08 19.9255 13.08 18.6C13.08 17.2745 14.1545 16.2 15.48 16.2C16.8055 16.2 17.88 17.2745 17.88 18.6ZM17.88 5.4C17.88 6.72548 16.8055 7.8 15.48 7.8C14.1545 7.8 13.08 6.72548 13.08 5.4C13.08 4.07452 14.1545 3 15.48 3C16.8055 3 17.88 4.07452 17.88 5.4Z"
                                stroke="#778CA6" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('Settings') }}</span>
                        </div>
                    </a>
                    <ul class="first-sub-menu @if (
                        $current_route == 'admin.system.settings' ||
                            $current_route == 'admin.website.settings' ||
                            $current_route == 'admin.ai.settings' ||
                            $current_route == 'admin.language' ||
                            $current_route == 'admin.language.phrase.edit') showMenu @endif">
                        <li class="first-sub-menu-title fs-14px mb-18px">{{ translate('Settings') }}</li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.system.settings') active @endif"><a
                                href="{{ route('admin.system.settings') }}">{{ translate('System Setting') }}</a>
                        </li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.website.settings') active @endif"><a
                                href="{{ route('admin.website.settings') }}">{{ translate('Website Setting') }}</a>
                        </li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Certificate Setting') }}</a>
                        </li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.ai.settings') active @endif"><a
                                href="{{ route('admin.ai.settings') }}">{{ translate('AI Setting') }}</a></li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Zoom Live Setting') }}</a>
                        </li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Jitsi Live Setting') }}</a>
                        </li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Bbb Live Setting') }}</a></li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Payment Setting') }}</a></li>
                        <li class="sidebar-second-li @if ($current_route == 'admin.language' || $current_route == 'admin.language.phrase.edit') active @endif"><a
                                href="{{ route('admin.language') }}">{{ translate('Language Setting') }}</a></li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Notification Setting') }}</a>
                        </li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('Custom Page Builder') }}</a>
                        </li>
                        <li class="sidebar-second-li"><a href="#">{{ translate('About') }}</a></li>
                    </ul>
                </li>

                {{-- manage profile sidemenu --}}
                <li class="sidebar-first-li">
                    <a href="#">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 19.5H14.5" stroke="#778CA6" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M16.5 21.5V17.5" stroke="#778CA6" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12.16 10.87C12.06 10.86 11.94 10.86 11.83 10.87C9.44997 10.79 7.55997 8.84 7.55997 6.44C7.54997 3.99 9.53997 2 11.99 2C14.44 2 16.43 3.99 16.43 6.44C16.43 8.84 14.53 10.79 12.16 10.87Z"
                                stroke="#778CA6" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M11.99 21.8101C10.17 21.8101 8.36004 21.3501 6.98004 20.4301C4.56004 18.8101 4.56004 16.1701 6.98004 14.5601C9.73004 12.7201 14.24 12.7201 16.99 14.5601"
                                stroke="#778CA6" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <div class="text">
                            <span>{{ translate('Manage Profile') }}</span>
                        </div>
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>
