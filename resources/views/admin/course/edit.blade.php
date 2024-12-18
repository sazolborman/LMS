@extends(ADMIN)
@push('title', translate('Course Edit'))
@push('meta')
@endpush
@push('css')

@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="mb-3 flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="title fs-18px mb-2">{{ translate('Update:') }} {{ $courses->title }}</h4>
                        <p class="sub-title fs-12px">{{ translate('Deshboard / Manage Course /') }} {{ $courses->title }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.course') }}" class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                    </div>
                </div>
                <form class="ajaxForm" action="{{ route('admin.course.update') }}" method="post"
                    enctype="multipart/form-data">
                    <div class="row g-3 gy-4">
                        <div class="col-xl-3  col-md-4">
                            <div class="message-sidebar-area">
                                @php
                                    $tab = request('tab');
                                @endphp
                                <div class="course-edit-area " id="pills-tab" role="tablist">

                                    <div role="presentation">
                                        <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'curriculum']) }}"
                                            class=" @if ($tab == 'curriculum' || $tab == '') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                            <i class="fi-rr-book-user"></i>
                                            {{ translate('Curriculum') }}
                                        </a>
                                    </div>
                                    <div role="presentation">
                                        <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'progress']) }}"
                                            class=" @if ($tab == 'progress') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                            <i class="fi-rr-chart-histogram"></i>
                                            {{ translate('Education Progress') }}
                                        </a>
                                    </div>
                                    <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'basic']) }}"
                                        class=" @if ($tab == 'basic') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi fi-rr-attribution-pencil"></i>
                                        {{ translate('Basic') }}
                                    </a>
                                    <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'info']) }}"
                                        class=" @if ($tab == 'info') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-file-circle-info"></i>
                                        {{ translate('Information') }}
                                    </a>
                                    <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'price']) }}"
                                        class=" @if ($tab == 'price') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-box-dollar"></i>
                                        {{ translate('Pricing') }}
                                    </a>
                                    <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'gallery']) }}"
                                        class=" @if ($tab == 'gallery') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-gallery"></i>
                                        {{ translate('Gallery') }}
                                    </a>
                                    <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'seo']) }}"
                                        class="@if ($tab == 'seo') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-chart-network"></i>
                                        {{ translate('Seo') }}
                                    </a>
                                    <a href="{{ route('admin.course.edit', [$courses->id, 'tab' => 'release']) }}"
                                        class="btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi fi-rr-calendar-clock"></i>
                                        {{ translate('Release Time') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9  col-md-8">
                            <div class="messenger-area">
                                <div class="course-box-area">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="#"
                                            class="btn outline-dashed btn-primary d-flex align-items-center gap-2">
                                            <samp>{{ translate('Course Player') }}</samp>
                                            <svg fill="var(--skinColor)" width="16" height="16" viewBox="0 0 24 24"
                                                id="export" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg"
                                                class="icon flat-color">
                                                <path id="secondary"
                                                    d="M21,2H17a1,1,0,0,0,0,2h1.59l-8.3,8.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L20,5.41V7a1,1,0,0,0,2,0V3A1,1,0,0,0,21,2Z"
                                                    style="fill: var(--skinColor);"></path>
                                                <path id="primary"
                                                    d="M18,22H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4h6.11a1,1,0,0,1,0,2H4V20H18V13.89a1,1,0,0,1,2,0V20A2,2,0,0,1,18,22Z"
                                                    style="fill: var(--skinColor);"></path>
                                            </svg>
                                        </a>

                                        <button type="submit"
                                            class="btn outline-dashed btn-primary @if ($tab == 'progress' || $tab == 'curriculum' || $tab == '') opacity-0 @endif">
                                            <samp>{{ translate('Save Changes') }}</samp>
                                        </button>



                                    </div>
                                    @includeWhen($tab == 'curriculum' || $tab == '', 'admin.course.curriculum')
                                    @includeWhen($tab == 'progress', 'admin.course.param.progress')
                                    @includeWhen($tab == 'basic', 'admin.course.basic')
                                    @includeWhen($tab == 'price', 'admin.course.price')
                                    @includeWhen($tab == 'info', 'admin.course.info')
                                    @includeWhen($tab == 'gallery', 'admin.course.gallery')
                                    @includeWhen($tab == 'seo', 'admin.course.seo')
                                    @includeWhen($tab == 'release', 'admin.course.param.course_release')
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.ad-select2').select2({
                placeholder: "Select instructor",
                allowClear: true // Optional: to allow clearing the selection
            });
        });
    </script>
    <script type="text/javascript">
        "Use strict";

        var blank_faq = jQuery('#blank_faq_field').html();
        var blank_outcome = jQuery('#blank_outcome_field').html();
        var blank_requirement = jQuery('#blank_requirement_field').html();
        jQuery(document).ready(function() {
            jQuery('#blank_faq_field').hide();
            jQuery('#blank_outcome_field').hide();
            jQuery('#blank_requirement_field').hide();
        });

        function appendFaq() {
            jQuery('#faq_area').append(blank_faq);
        }

        function removeFaq(faqElem) {
            jQuery(faqElem).parent().parent().remove();
        }

        function appendOutcome() {
            jQuery('#outcomes_area').append(blank_outcome);
        }

        function removeOutcome(outcomeElem) {
            jQuery(outcomeElem).parent().parent().remove();
        }

        function appendRequirement() {
            jQuery('#requirement_area').append(blank_requirement);
        }

        function removeRequirement(requirementElem) {
            jQuery(requirementElem).parent().parent().remove();
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#discounted').change(function() {
                if ($(this).is(':checked')) {
                    $('#discounted-section').show();
                } else {
                    $('#discounted-section').hide();
                }
            });
        });
    </script>

@endpush
