@extends(ADMIN)
@push('title', translate('Affiliate Management'))
@push('meta')
@endpush
@push('css')
@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3 flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Affiliator Management') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Affiliate / Affiliator Management') }}
                                </p>
                            </div>
                            <div>
                                <a href="javascript:void(0)"
                                    onclick="clickModal('{{ route('modal', ['admin.affiliate.create']) }}', '{{ translate('Create New Affiliator') }}', 'modal-lg')"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1">{{ translate('Add New Affiliator') }}</a>
                            </div>
                        </div>
                        @php
                            $tab = request('tab');
                        @endphp
                        <div class="ad-body-content">
                            <div class="container-fluid">
                                <div class="ad-body-content-inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ad-card mb-20px">
                                                <div class="ad-card-body p-3 ad-tab-body">
                                                    <div class="custom-tab-button">
                                                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a href="{{ route('admin.affiliator', ['tab' => 'active']) }}"
                                                                    class="nav-link @if ($tab == 'active' || $tab == '') active @endif d-flex gap-2">{{ translate('Active Affiliator') }}
                                                                    <span
                                                                        class="ad-alert ad-custom-count light-success-alert p-2">
                                                                        {{ App\Models\Affiliator::where('status', 1)->count() }}
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a href="{{ route('admin.affiliator', ['tab' => 'suspend']) }}"
                                                                    class="nav-link @if ($tab == 'suspend') active @endif d-flex gap-2">{{ translate('Suspend Affiliator') }}
                                                                    <span
                                                                        class="ad-alert ad-custom-count light-warning-alert p-2">
                                                                        {{ App\Models\Affiliator::where('status', 2)->count() }}
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a href="{{ route('admin.affiliator', ['tab' => 'pending']) }}"
                                                                    class="nav-link @if ($tab == 'pending') active @endif d-flex gap-2">{{ translate('Pending Affiliator') }}
                                                                    <span
                                                                        class="ad-alert ad-custom-count light-danger-alert p-2">
                                                                        {{ App\Models\Affiliator::where('status', 0)->count() }}
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                    @if ($tab == 'active' || $tab == '')
                                                        <input type="hidden" class="tab" value="{{ $tab }}">
                                                        <div class="dashboard-table-wrap">
                                                            <div class="table-title-option-area">
                                                                <div class="item-show-wrap">
                                                                    <p class="info">{{ translate('Showing') }}</p>
                                                                    <div>
                                                                        <select id="showing" class="ad-select2"
                                                                            data-minimum-results-for-search="Infinity">
                                                                            <option value="10">10</option>
                                                                            <option value="20">20</option>
                                                                            <option value="30">30</option>
                                                                            <option value="40">40</option>
                                                                            <option value="50">50</option>
                                                                            <option value="">
                                                                                {{ translate('All') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <p class="info">{{ translate('of') }} 50</p>
                                                                </div>
                                                                <div class="table-filter-wrap four-filter-wrap">
                                                                    <input type="text" id="searchQuery" name="search"
                                                                        class="form-control mform-control custom-ad-search"
                                                                        placeholder="{{ translate('search...') }}">
                                                                </div>

                                                            </div>
                                                            <div id="data-container">
                                                                @include(
                                                                    'admin.affiliate.active_affiliator',
                                                                    [
                                                                        'active_affiliators' => $active_affiliators,
                                                                    ]
                                                                )
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($tab == 'suspend')
                                                        <input type="hidden" class="tab" value="{{ $tab }}">
                                                        <div class="dashboard-table-wrap">
                                                            <div class="table-title-option-area">
                                                                <div class="item-show-wrap">
                                                                    <p class="info">{{ translate('Showing') }}</p>
                                                                    <div>
                                                                        <select id="showing" class="ad-select2"
                                                                            data-minimum-results-for-search="Infinity">
                                                                            <option value="10">10</option>
                                                                            <option value="20">20</option>
                                                                            <option value="30">30</option>
                                                                            <option value="40">40</option>
                                                                            <option value="50">50</option>
                                                                            <option value="">
                                                                                {{ translate('All') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <p class="info">{{ translate('of') }} 50</p>
                                                                </div>
                                                                <div class="table-filter-wrap four-filter-wrap">
                                                                    <input type="text" id="searchQuery" name="search"
                                                                        class="form-control mform-control custom-ad-search"
                                                                        placeholder="{{ translate('search...') }}">
                                                                </div>

                                                            </div>
                                                            <div id="data-container">
                                                                @include(
                                                                    'admin.affiliate.suspend_affiliator',
                                                                    [
                                                                        'suspend_affiliators' => $suspend_affiliators,
                                                                    ]
                                                                )
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($tab == 'pending')
                                                        <input type="hidden" class="tab" value="{{ $tab }}">
                                                        <div class="dashboard-table-wrap">
                                                            <div class="table-title-option-area">

                                                                <div class="item-show-wrap">
                                                                    <p class="info">{{ translate('Showing') }}</p>
                                                                    <div>
                                                                        <select id="showing" class="ad-select2"
                                                                            data-minimum-results-for-search="Infinity">
                                                                            <option value="10">10</option>
                                                                            <option value="20">20</option>
                                                                            <option value="30">30</option>
                                                                            <option value="40">40</option>
                                                                            <option value="50">50</option>
                                                                            <option value="">
                                                                                {{ translate('All') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <p class="info">{{ translate('of') }} 50</p>
                                                                </div>
                                                                <div class="table-filter-wrap four-filter-wrap">
                                                                    <input type="text" id="searchQuery" name="search"
                                                                        class="form-control mform-control custom-ad-search"
                                                                        placeholder="{{ translate('search...') }}">
                                                                </div>

                                                            </div>
                                                            <div id="data-container">
                                                                @include(
                                                                    'admin.affiliate.pending_affiliator',
                                                                    [
                                                                        'pending_affiliators' => $pending_affiliators,
                                                                    ]
                                                                )
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let debounceTimer;

            // Trigger AJAX on input change with debouncing
            $('#searchQuery').on('input', function() {
                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    const searchQuery = $(this).val();
                    const perPage = $('#showing').val();
                    const tab = $('.tab').val();


                    // Make AJAX call
                    $.ajax({
                        url: "{{ route('admin.affiliator') }}",
                        method: 'GET',
                        data: {
                            search: searchQuery,
                            per_page: perPage,
                            tab: tab
                        },
                        beforeSend: function() {
                            $('#data-container').html(
                                `@include('admin.loading')`
                            ); // Optional: Show loader
                        },
                        success: function(response) {
                            $('#data-container').html(
                                response); // Update the table content
                        },
                        error: function() {
                            alert('Error fetching data. Please try again.');
                        }
                    });
                }, 300); // 300ms delay
            });

            // Handle pagination change
            $('#showing').on('change', function() {
                const perPage = $(this).val();
                const searchQuery = $('#searchQuery').val();
                const tab = $('.tab').val();

                $.ajax({
                    url: "{{ route('admin.affiliator') }}",
                    method: 'GET',
                    data: {
                        search: searchQuery,
                        per_page: perPage,
                        tab: tab
                    },
                    beforeSend: function() {
                        $('#data-container').html(
                            `@include('admin.loading')`); // Optional: Show loader
                    },
                    success: function(response) {
                        $('#data-container').html(response); // Update the table content
                    },
                    error: function() {
                        alert('Error fetching data. Please try again.');
                    }
                });
            });
        });
    </script>
    <script>
        // Get the button and add a click event listener
        document.getElementById('prevent-download').addEventListener('click', function() {
            // Use the resolved URL from Blade
            downloadFile(); // Call the download function with the file URL
        });
    </script>
@endpush
