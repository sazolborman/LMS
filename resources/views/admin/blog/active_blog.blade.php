@if (count($blogs) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Creator') }}</th>
                    <th scope="col">{{ translate('Title') }}</th>
                    <th scope="col">{{ translate('Category') }}</th>
                    <th scope="col">{{ translate('Status') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img(get_user($blog->user_id)->photo) }}"
                                        alt="">
                                    <div class="title">
                                        {{ get_user($blog->user_id)->name }}
                                        <small class="d-block">{{ get_user($blog->user_id)->email }}</small>
                                    </div>
                                </label>

                            </div>
                        </td>

                        <td>
                            {{ $blog->title }}
                            <br>
                            <small>{{ date('D, d-M-Y', strtotime($blog->created_at)) }}</small>

                        </td>
                        <td>
                            {{ App\Models\BlogCategory::where('id', $blog->category_id)->first()->title }}
                        </td>
                        <td>
                            <span class="ad-alert ad-custom-alert light-success-alert p-2">
                                {{ translate('Active') }}
                            </span>
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
                                                onclick="confirmModal('{{ route('admin.blog.status', $blog->id) }}')"
                                                href="javascript:void(0)">{{ translate('Deactive') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.blog.edit', $blog->id) }}">{{ translate('Edit') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.blog.delete', $blog->id) }}')"
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
@if (count($blogs) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $blogs->firstItem() . ' ' . translate('to') . ' ' . count($blogs) . ' ' . translate('of') . ' ' . $blogs->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $blogs->links('admin.pagination.index') }}
    </div>
@endif
