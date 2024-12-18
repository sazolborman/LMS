@if (count($admins) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Admins') }}</th>
                    <th scope="col">{{ translate('Email') }}</th>
                    <th scope="col">{{ translate('phone') }}</th>
                    <th scope="col">{{ translate('Contact') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img($admin->photo) }}" alt="">
                                    <span class="title">{{ $admin->name }}</span>
                                </label>
                            </div>
                        </td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>
                            @if (isset($admin->facebook))
                                <a href="{{ $admin->facebook }}"><i class="bi bi-facebook fs-16px"></i></a>
                            @endif
                            @if (isset($admin->instagram))
                                <a href="{{ $admin->instagram }}"><i class="bi bi-instagram fs-16px"></i></a>
                            @endif
                            @if (isset($admin->twitter))
                                <a href="{{ $admin->twitter }}"><i class="bi bi-twitter fs-16px"></i></a>
                            @endif
                            @if (isset($admin->linkedin))
                                <a href="{{ $admin->linkedin }}"><i class="bi bi-linkedin fs-16px"></i></a>
                            @endif
                        </td>

                        <td>
                            @if (!is_root_admin($admin->id))
                                <div class="d-flex justify-content-center">
                                    <div class="dropdown ad-icon-dropdown">
                                        <button class="btn btn-secondary dropdown-toggle rotate-icon" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.permission', $admin->id) }}">{{ translate('Assign Permission') }}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.admin.edit', $admin->id) }}">{{ translate('Edit') }}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    onclick="confirmModal('{{ route('admin.admin.delete', $admin->id) }}')"
                                                    href="javascript:void(0)">{{ translate('Delete') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <span class="ad-alert ad-custom-alert light-success-alert p-2">
                                    {{ translate('Root Admin') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    @include('admin.no_data')
@endif
@if (count($admins) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $admins->firstItem() . ' ' . translate('to') . ' ' . count($admins) . ' ' . translate('of') . ' ' . $admins->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $admins->links('admin.pagination.index') }}
    </div>
@endif
