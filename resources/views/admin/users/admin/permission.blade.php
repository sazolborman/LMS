@extends(ADMIN)
@push('title', translate('Admin Permission'))
@push('meta')
@endpush
@push('css')
@endpush
@section('content')
    @php
        $modules = ['category', 'course', 'user', 'instructor', 'student', 'enrolment', 'revenue', 'messaging'];
        $Features = ['blog', 'addon', 'theme', 'settings', 'coupon', 'academy_cloud', 'newsletter', 'contact'];
        $permissions = (array) json_decode(App\Models\Permission::where('admin_id', $admin->id)->value('permissions'));
    @endphp
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="mb-3 flex-wrap">
                                <h4 class="title fs-18px mb-2">{{ translate('Admin Permission') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Dashboard / Users / Admin Management / Permission') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.admins') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="dashboard-table-wrap text-center mb-3">
                            <h5>{{ translate('Assign permission for : ') }} {{ get_user($admin->id)->name }}</h5>
                            <strong>{{ translate('Note: ') }}</strong><small>{{ translate('You can toggle the switch for enabling or disabling a feature to access.') }}</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="dashboard-table-wrap w-50">
                                <table class="table dashboard-table dashboard-table-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ translate('Feature') }}</th>
                                            <th scope="col">{{ translate('Permission') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($modules as $module)
                                            <tr>
                                                <td class="fw-bold p-3">{{ ucfirst($module) }}</td>
                                                <td class="d-flex justify-content-center p-3">
                                                    <div class="form-switch dtable-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="{{ $admin->id . '-' . $module }}"
                                                            onchange="is_Permission('{{ $admin->id }}', '{{ $module }}')"
                                                            @if (count($permissions) > 0 && in_array($module, $permissions)) checked @endif>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="dashboard-table-wrap w-50">
                                <table class="table dashboard-table dashboard-table-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ translate('Feature') }}</th>
                                            <th scope="col">{{ translate('Permission') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Features as $Feature)
                                            <tr>
                                                <td class="fw-bold p-3">{{ ucfirst($Feature) }}</td>
                                                <td class="d-flex justify-content-center p-3">
                                                    <div class="form-switch dtable-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="{{ $admin->id . '-' . $Feature }}"
                                                            onchange="is_Permission('{{ $admin->id }}', '{{ $Feature }}')"
                                                            @if (count($permissions) > 0 && in_array($Feature, $permissions)) checked @endif>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        "use strict";

        function is_Permission(user_id, permission) {
            console.log(user_id + permission);

            $.ajax({
                type: "post",
                url: "{{ route('admin.permission.store') }}",
                data: {
                    user_id: user_id,
                    permission: permission,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    if (response.success) {
                        toaster_message('success', 'border-left-success', 'fi-sr-badge-check text-info',
                            'Success !', 'Update successfully.');

                    }


                }
            });
        }
    </script>
@endpush
