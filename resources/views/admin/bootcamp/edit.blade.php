@extends(ADMIN)
@push('title', translate('Bootcamp Edit'))
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
                        <h4 class="title fs-18px mb-2">{{ translate('Update:') }} {{ $bootcamp->title }}</h4>
                        <p class="sub-title fs-12px">{{ translate('Deshboard / Manage Bootcamp / Edit') }}
                            {{ $bootcamp->title }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.bootcamp') }}" class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                    </div>
                </div>
                <form class="ajaxForm" action="{{ route('admin.bootcamp.update') }}" method="post"
                    enctype="multipart/form-data">
                    <div class="row g-3 gy-4">
                        <div class="col-xl-3  col-md-4">
                            <div class="message-sidebar-area">
                                @php
                                    $tab = request('tab');
                                @endphp
                                <div class="course-edit-area " id="pills-tab" role="tablist">

                                    <div role="presentation">
                                        <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'curriculum']) }}"
                                            class=" @if ($tab == 'curriculum' || $tab == '') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                            <i class="fi-rr-book-user"></i>
                                            {{ translate('Curriculum') }}
                                        </a>
                                    </div>
                                    <div role="presentation">
                                        <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'progress']) }}"
                                            class=" @if ($tab == 'progress') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                            <i class="fi-rr-chart-histogram"></i>
                                            {{ translate('Education Progress') }}
                                        </a>
                                    </div>
                                    <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'basic']) }}"
                                        class=" @if ($tab == 'basic') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi fi-rr-attribution-pencil"></i>
                                        {{ translate('Basic') }}
                                    </a>
                                    <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'info']) }}"
                                        class=" @if ($tab == 'info') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-file-circle-info"></i>
                                        {{ translate('Information') }}
                                    </a>
                                    <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'price']) }}"
                                        class=" @if ($tab == 'price') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-box-dollar"></i>
                                        {{ translate('Pricing') }}
                                    </a>
                                    <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'gallery']) }}"
                                        class=" @if ($tab == 'gallery') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-gallery"></i>
                                        {{ translate('Gallery') }}
                                    </a>
                                    <a href="{{ route('admin.bootcamp.edit', [$bootcamp->id, 'tab' => 'seo']) }}"
                                        class="@if ($tab == 'seo') active show @endif btn ad-btn-light-primary ad-btn-rounded custom-btn d-flex align-items-center gap-1">
                                        <i class="fi-rr-chart-network"></i>
                                        {{ translate('Seo') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9  col-md-8">
                            <div class="messenger-area">
                                <div class="course-box-area">
                                    <div class="d-flex align-items-center justify-content-end">

                                        <button type="submit"
                                            class="btn outline-dashed btn-primary @if ($tab == 'progress' || $tab == 'curriculum' || $tab == '') opacity-0 @endif">
                                            <samp>{{ translate('Save Changes') }}</samp>
                                        </button>



                                    </div>
                                    @includeWhen(
                                        $tab == 'curriculum' || $tab == '',
                                        'admin.bootcamp.curriculum.index')
                                    @includeWhen($tab == 'basic', 'admin.bootcamp.basic')
                                    @includeWhen($tab == 'price', 'admin.bootcamp.price')
                                    @includeWhen($tab == 'info', 'admin.bootcamp.info')
                                    @includeWhen($tab == 'gallery', 'admin.bootcamp.gallery')
                                    @includeWhen($tab == 'seo', 'admin.bootcamp.seo')
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
