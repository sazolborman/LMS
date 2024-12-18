@if (count($enrolls) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('User') }}</th>
                    <th scope="col">{{ translate('Enroll Course') }}</th>
                    <th scope="col">{{ translate('Enroll Date') }}</th>
                    <th scope="col">{{ translate('Expiry date') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enrolls as $enroll)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img(get_user($enroll->user_id)->photo) }}"
                                        alt="">
                                    <div class="title">
                                        {{ get_user($enroll->user_id)->name }}
                                        <small class="d-block">{{ get_user($enroll->user_id)->email }}</small>
                                    </div>
                                </label>

                            </div>
                        </td>
                        <td>{{ get_course($enroll->course_id)->title }}</td>
                        <td>{{ date('D, d-M-Y', strtotime($enroll->entry_date)) }}</td>
                        <td>{{ date('D, d-M-Y', strtotime($enroll->entry_date)) }}</td>

                        <td>
                            <button type="button"
                                onclick="confirmModal('{{ route('admin.enrollment.history.delete', $enroll->id) }}')"
                                class="btn btn-outline-danger btn-icon btn-rounded btn-sm"> <i
                                    class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    @include('admin.no_data')
@endif
@if (count($enrolls) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $enrolls->firstItem() . ' ' . translate('to') . ' ' . count($enrolls) . ' ' . translate('of') . ' ' . $enrolls->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $enrolls->links('admin.pagination.index') }}
    </div>
@endif
