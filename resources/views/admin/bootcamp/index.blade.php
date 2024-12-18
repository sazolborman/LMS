@extends(ADMIN)
@push('title', translate('Bootcamp Management'))

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

                        <div class="mb-3 flex-wrap d-flex justify-content-between ol-card">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Bootcamp Management') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Bootcamp Management') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.bootcamp.create') }}"
                                    class="btn ad-btn-primary">{{ translate('Add New Bootcamp') }}</a>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="dashboard-table-wrap">

                            <div class="table-title-option-area ol-card-2">
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
                                            <option value="">{{ translate('All') }}</option>
                                        </select>
                                    </div>
                                    <p class="info">{{ translate('of') }} 50</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">




                                </div>

                                {{-- search --}}
                                <div class="table-filter-wrap four-filter-wrap">
                                    <input type="text" id="searchQuery" name="search"
                                        class="form-control custom-ad-search mform-control" placeholder="Type course name">

                                    {{-- export --}}
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            class="btn ad-btn-primary px-12px d-flex align-items-center gap-2">
                                            <span>{{ translate('Export') }}</span>
                                            <img src="{{ asset('assets/backend/images/icons/export.svg') }}"
                                                alt="https:\\www.syncsofts.com">

                                        </button>
                                        <ul class="dropdown-menu secondaryBg custom-export-dropdown">
                                            <li class="mb-2">
                                                <a href="javascript:void(0)"
                                                    onclick="downloadPDF('.print-table', 'bootcamp-list')">
                                                    <i class="fi-rr-file-pdf"></i>
                                                    <samp>{{ translate('PDF') }}</samp>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="printableDiv('course_list')">
                                                    <i class="fi-rr-print"></i>
                                                    <samp>{{ translate('Print') }}</samp>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- filter --}}

                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            class="btn ad-btn-primary px-12px d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/backend/images/icons/filter.svg') }}"
                                                alt="https:\\www.syncsofts.com">
                                            <span>{{ translate('Filter') }}</span>
                                        </button>
                                        <ul class="dropdown-menu secondaryBg custom-filter-dropdown">
                                            <li>
                                                <div class="mb-3">
                                                    <label for="title"
                                                        class="form-label ad-form-label">{{ translate('Category') }}</label>
                                                    <select class="form-control ad-form-control" name="category">
                                                        <option value="all">
                                                            {{ translate('All') }}</option>
                                                        @foreach (App\Models\BootcampCategory::orderBy('title', 'desc')->get() as $category)
                                                            <option value="{{ $category->slug }}">
                                                                {{ $category->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status"
                                                        class="form-label ad-form-label">{{ translate('Instructor') }}</label>
                                                    <select class="form-control ad-form-control" name="instructor">
                                                        <option value="all">
                                                            {{ translate('All') }}
                                                        </option>
                                                        @foreach (App\Models\User::where('role', '!=', 'student')->get() as $instructor)
                                                            <option value="{{ $instructor->id }}">
                                                                {{ $instructor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status"
                                                        class="form-label ad-form-label">{{ translate('Price') }}</label>
                                                    <select class="form-control ad-form-control" name="price">
                                                        <option value="all">
                                                            {{ translate('All') }}
                                                        </option>
                                                        <option value="paid">{{ translate('Paid') }}</option>
                                                        <option value="free">{{ translate('Free') }}</option>
                                                        <option value="discount">{{ translate('Discount') }}
                                                        </option>
                                                        </option>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @if (isset($_GET) && count($_GET) > 0)
                                        <a href="{{ route('admin.course') }}" class="me-2" data-bs-toggle="tooltip"
                                            title="{{ translate('Clear') }}"><i class="fi-rr-cross-circle"></i></a>
                                    @endif

                                </div>

                            </div>
                            <div id="data-container">
                                @include('admin.bootcamp.data_container', ['bootcamps' => $bootcamps])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        "use strict";

        // Function to make AJAX request for search, filter and pagination
        function fetchCoursesData() {
            var searchQuery = $('#searchQuery').val();
            var category = $('select[name="category"]').val();
            var status = $('select[name="status"]').val();
            var instructor = $('select[name="instructor"]').val();
            var price = $('select[name="price"]').val();
            var showing = $('#showing').val();

            $.ajax({
                url: "{{ route('admin.bootcamp') }}",
                method: 'GET',
                data: {
                    search: searchQuery,
                    category: category,
                    status: status,
                    instructor: instructor,
                    price: price,
                    showing: showing
                },
                beforeSend: function() {
                    $('#data-container').html(
                        `@include('admin.loading')`); // Optional: Show loader
                },
                success: function(response) {
                    $('#data-container').html(response); // Update the course table with new data
                },
                error: function(xhr) {
                    console.error("Error fetching data:", xhr);
                }
            });
        }

        // Event listeners
        $(document).ready(function() {
            // Trigger the fetchCoursesData function when filters or search query change
            $('#searchQuery').on('input', function() {
                fetchCoursesData();
            });

            $('#showing').on('change', function() {
                fetchCoursesData();
            });

            $('select[name="category"], select[name="status"], select[name="instructor"], select[name="price"]').on(
                'change',
                function() {
                    fetchCoursesData();
                });
        });
    </script>
    <script type="text/javascript">
        "use strict";

        function printableDiv(printableAreaDivId) {
            var printContents = document.getElementById(printableAreaDivId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
