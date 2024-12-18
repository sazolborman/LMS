@if (count($bootcamps) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 pt-4" id="course_list">
        <table class="print-table table dashboard-table dashboard-table-1">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Title') }}</th>
                    <th scope="col">{{ translate('Category') }}</th>
                    <th scope="col">{{ translate('Module & Class') }}</th>
                    <th scope="col">{{ translate('Enrolled Student') }}</th>
                    <th scope="col">{{ translate('Price') }}</th>
                    <th scope="col" class="print-d-none">{{ translate('Option') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bootcamps as $bootcamp)
                    <tr>
                        <td>
                            <div class="form-check dtable-check d-block">
                                <a href="{{ route('admin.bootcamp.edit', ['id' => $bootcamp->id]) }}">
                                    <h6>{{ $bootcamp->title }}</h6>
                                </a>

                                <p>{{ translate('Instructor:') }}
                                    {{ get_user($bootcamp->user_id)->name }}</p>
                            </div>
                        </td>
                        <td>{{ get_bootcampCategory($bootcamp->category_id)->title }}</td>
                        <td>
                            <p>{{ translate('Module:') }}
                            </p>
                            <p>{{ translate('Class:') }} </p>
                        </td>
                        <td>{{ translate('Enrollments:') }}
                        </td>

                        <td>
                            @if ($bootcamp->is_paid == 0)
                                <p class="ad-md-btn-info">{{ translate('Free') }}</p>
                            @else
                                <del>{{ currency($bootcamp->price) }}</del>
                                <p>{{ currency($bootcamp->price - $bootcamp->discounted_price) }}
                                </p>
                            @endif
                        </td>
                        <td class="print-d-none">
                            <div class="d-flex justify-content-center">
                                <div class="dropdown ad-icon-dropdown">
                                    <button class="btn btn-secondary dropdown-toggle rotate-icon" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.bootcamp.edit', ['id' => $bootcamp->id]) }}">{{ translate('Edit Bootcamp') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.bootcamp.delete', $bootcamp->id) }}')"
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
@if (count($bootcamps) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $bootcamps->firstItem() . ' ' . translate('to') . ' ' . count($bootcamps) . ' ' . translate('of') . ' ' . $bootcamps->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $bootcamps->links('admin.pagination.index') }}
    </div>
@endif
