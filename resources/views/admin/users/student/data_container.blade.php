@if (count($students) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Students') }}</th>
                    <th scope="col">{{ translate('phone') }}</th>
                    <th scope="col">{{ translate('Contact') }}</th>
                    <th scope="col">{{ translate('Courses') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img($student->photo) }}" alt="">
                                    <div class="title">
                                        {{ $student->name }}
                                        <small class="d-block">{{ $student->email }}</small>
                                    </div>
                                </label>

                            </div>
                        </td>

                        <td>{{ $student->phone }}</td>

                        <td>
                            @if (isset($student->facebook))
                                <a href="{{ $student->facebook }}"><i class="bi bi-facebook fs-16px"></i></a>
                            @endif
                            @if (isset($student->instagram))
                                <a href="{{ $student->instagram }}"><i class="bi bi-instagram fs-16px"></i></a>
                            @endif
                            @if (isset($student->twitter))
                                <a href="{{ $student->twitter }}"><i class="bi bi-twitter fs-16px"></i></a>
                            @endif
                            @if (isset($student->linkedin))
                                <a href="{{ $student->linkedin }}"><i class="bi bi-linkedin fs-16px"></i></a>
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach (App\Models\Course::where('user_id', $student->id)->get() as $course)
                                    <li class="d-flex align-items-center gap-1"><i
                                            class="fi-rr-arrow-alt-square-right mt-1"></i>
                                        {{ $course->title }}
                                    </li>
                                @endforeach
                            </ul>
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
                                                href="">{{ translate('Payment Setup') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.student.edit', $student->id) }}">{{ translate('Edit') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.student.delete', $student->id) }}')"
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
@if (count($students) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $students->firstItem() . ' ' . translate('to') . ' ' . count($students) . ' ' . translate('of') . ' ' . $students->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $students->links('admin.pagination.index') }}
    </div>
@endif
