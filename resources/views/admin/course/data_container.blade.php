@if (count($courses) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 pt-4" id="course_list">
        <table class="print-table table dashboard-table dashboard-table-1">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Title') }}</th>
                    <th scope="col">{{ translate('Category') }}</th>
                    <th scope="col">{{ translate('Section & Lesson') }}</th>
                    <th scope="col">{{ translate('Enrolled Student') }}</th>
                    <th scope="col" class="print-d-none">{{ translate('Status') }}</th>
                    <th scope="col">{{ translate('Price') }}</th>
                    <th scope="col" class="print-d-none">{{ translate('Option') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>
                            <div class="form-check dtable-check d-block">
                                <a href="{{ route('admin.course.edit', ['id' => $course->id]) }}">
                                    <h6>{{ $course->title }}</h6>
                                </a>

                                <p>{{ translate('Instructor:') }}
                                    {{ get_user($course->user_id)->name }}</p>
                            </div>
                        </td>
                        <td>{{ get_category($course->category_id)->title }}</td>
                        <td>
                            <p>{{ translate('Section:') }} {{ section_count($course->id) }}
                            </p>
                            <p>{{ translate('Lesson:') }} {{ lesson_count($course->id) }}</p>
                        </td>
                        <td>{{ translate('Enrollments:') }}
                            {{ course_by_enrolled($course->id) }}
                        </td>
                        <td class="print-d-none">
                            @if ($course->status == 'Active')
                                <p class="ad-md-btn-success">{{ ucfirst($course->status) }}
                                </p>
                            @elseif ($course->status == 'Private')
                                <p class="ad-md-btn-primary">{{ ucfirst($course->status) }}
                                </p>
                            @elseif ($course->status == 'Deactive')
                                <p class="ad-md-btn-dark">{{ ucfirst($course->status) }}</p>
                            @elseif ($course->status == 'Upcoming')
                                <p class="ad-md-btn-info">{{ ucfirst($course->status) }}</p>
                            @else
                                <p class="ad-md-btn-dark">{{ ucfirst($course->status) }}</p>
                            @endif
                        </td>

                        <td>
                            @if ($course->is_paid == 0)
                                <p class="ad-md-btn-info">{{ translate('Free') }}</p>
                            @else
                                <del>{{ currency($course->price) }}</del>
                                <p>{{ currency($course->price - $course->discounted_price) }}
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
                                        <li><a class="dropdown-item" href="#">{{ translate('View Course') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="#">{{ translate('Course Playing') }}</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.course.status', $course->id) }}')"
                                                href="javacript:void(0)">
                                                @if ($course->status == 'Active')
                                                    {{ translate('Make Inactive') }}
                                                @else
                                                    {{ translate('Make Active') }}
                                                @endif
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.course.edit', ['id' => $course->id]) }}">{{ translate('Edit Course') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.course.delete', $course->id) }}')"
                                                href="javascript:void(0)">{{ translate('Delete Course') }}</a>
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
@if (count($courses) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $courses->firstItem() . ' ' . translate('to') . ' ' . count($courses) . ' ' . translate('of') . ' ' . $courses->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $courses->links('admin.pagination.index') }}
    </div>
@endif
