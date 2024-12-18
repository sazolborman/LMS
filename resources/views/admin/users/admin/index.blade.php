@extends(ADMIN)
@push('title', translate('Admin Management'))
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

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="mb-3 flex-wrap">
                                <h4 class="title fs-18px mb-2">{{ translate('Admin Management') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Dashboard / Users / Admin Management') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.admin.create') }}"
                                    class="btn ad-btn-primary px-12px d-flex align-items-center cg-6px">
                                    <span><i class="fa-solid fa-plus"></i></span>
                                    <span>{{ translate('Add new admin') }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Table -->
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
                                            <option value="">{{ translate('All') }}</option>
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
                                @include('admin.users.admin.data_container', ['admins' => $admins])
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

                    // Make AJAX call
                    $.ajax({
                        url: "{{ route('admin.admins') }}",
                        method: 'GET',
                        data: {
                            search: searchQuery,
                            per_page: perPage
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

                $.ajax({
                    url: "{{ route('admin.admins') }}",
                    method: 'GET',
                    data: {
                        search: searchQuery,
                        per_page: perPage
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
@endpush
