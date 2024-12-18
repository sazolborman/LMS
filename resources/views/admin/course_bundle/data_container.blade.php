@if (count($bundles) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Bundle Title') }}</th>
                    <th scope="col">{{ translate('courses') }}</th>
                    <th scope="col">{{ translate('subscription') }}</th>
                    <th scope="col">{{ translate('Price') }}</th>
                    <th scope="col">{{ translate('Status') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bundles as $bundle)
                    @php
                        $courses = json_decode($bundle->course_id);
                    @endphp
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <div class="title">{{ $bundle->title }}</div>
                                </label>

                            </div>
                        </td>
                        <td>
                            <ul>
                                @foreach ($courses as $course)
                                    <li>{{ get_course($course)->title }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $bundle->subscription_day }} {{ translate('Days') }}</td>
                        <td>{{ currency($bundle->price) }}</td>
                        <td>
                            @if ($bundle->status == 1)
                                <span class="ad-alert ad-custom-alert light-success-alert p-2">
                                    {{ translate('Active') }}
                                </span>
                            @else
                                <span class="ad-alert ad-custom-alert light-danger-alert p-2">
                                    {{ translate('Inactive') }}
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="dropdown ad-icon-dropdown">
                                    <button class="btn btn-secondary dropdown-toggle rotate-icon" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.bundle.status', $bundle->id) }}')"
                                                href="javascript:void(0)">
                                                @if ($bundle->status == 1)
                                                    {{ translate('Deactive') }}
                                                @else
                                                    {{ translate('Active') }}
                                                @endif
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.bundle.edit', ['id' => $bundle->id]) }}">{{ translate('Edit') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.bundle.delete', $bundle->id) }}')"
                                                href="javascript:void(0)">{{ translate('Delete') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    @include('admin.no_data')
@endif
@if (count($bundles) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $bundles->firstItem() . ' ' . translate('to') . ' ' . count($bundles) . ' ' . translate('of') . ' ' . $bundles->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $bundles->links('admin.pagination.index') }}
    </div>
@endif
