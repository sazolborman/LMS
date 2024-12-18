@if (count($ebooks) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Creator') }}</th>
                    <th scope="col">{{ translate('title') }}</th>
                    <th scope="col">{{ translate('category') }}</th>
                    <th scope="col">{{ translate('Status') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ebooks as $ebook)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img(get_user($ebook->user_id)->photo) }}"
                                        alt="">
                                    <div class="title">
                                        {{ get_user($ebook->user_id)->name }}
                                        <small class="d-block">{{ get_user($ebook->user_id)->email }}</small>
                                    </div>
                                </label>

                            </div>
                        </td>
                        <td>{{ $ebook->title }}</td>
                        <td>{{ get_ebook_category($ebook->category)->title }}</td>
                        <td>
                            @if ($ebook->status == 1)
                                <span class="ad-alert ad-custom-alert light-success-alert p-2">
                                    {{ translate('Active') }}
                                </span>
                            @else
                                <span class="ad-alert ad-custom-alert light-danger-alert p-2">
                                    {{ translate('Pending') }}
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
                                                onclick="confirmModal('{{ route('admin.ebook.status', $ebook->id) }}')"
                                                href="javascript:void(0)">
                                                @if ($ebook->status == 1)
                                                    {{ translate('Make as pending') }}
                                                @else
                                                    {{ translate('Active') }}
                                                @endif
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.ebook.edit', ['id' => $ebook->id]) }}">{{ translate('Edit') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.ebook.delete', $ebook->id) }}')"
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
@if (count($ebooks) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $ebooks->firstItem() . ' ' . translate('to') . ' ' . count($ebooks) . ' ' . translate('of') . ' ' . $ebooks->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $ebooks->links('admin.pagination.index') }}
    </div>
@endif
