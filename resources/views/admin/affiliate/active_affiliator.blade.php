@if (count($active_affiliators) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">
                        {{ translate('Name') }}</th>
                    <th scope="col">
                        {{ translate('Message') }}</th>
                    <th scope="col">
                        {{ translate('Document') }}</th>
                    <th scope="col">
                        {{ translate('Status') }}</th>
                    <th scope="col">
                        {{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($active_affiliators as $affiliator)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img(get_user($affiliator->user_id)->photo) }}"
                                        alt="">
                                    <div class="title">
                                        {{ get_user($affiliator->user_id)->name }}
                                        <small class="d-block">{{ get_user($affiliator->user_id)->email }}</small>
                                    </div>
                                </label>

                            </div>
                        </td>
                        <td>{!! $affiliator->message !!}</td>
                        <td>
                            @if (isset($affiliator->document))
                                <a href="{{ asset($affiliator->document) }}" download
                                    class="btn ad-btn-primary d-flex align-items-center cg-10px" id="prevent-download">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 3V16M12 16L16 11.625M12 16L8 11.625" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M15 21H9C6.17157 21 4.75736 21 3.87868 20.1213C3 19.2426 3 17.8284 3 15M21 15C21 17.8284 21 19.2426 20.1213 20.1213C19.8215 20.4211 19.4594 20.6186 19 20.7487"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>{{ translate('Download') }}</span>
                                </a>
                            @endif
                        </td>
                        <td>
                            <span class="ad-alert ad-custom-alert light-success-alert text-center p-2">
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
                                                onclick="confirmModal('{{ route('admin.affiliator.status', $affiliator->id) }}')"
                                                href="javascript:void(0)">
                                                {{ translate('Suspend') }}
                                            </a>
                                        </li>

                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.affiliator.delete', $affiliator->id) }}')"
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
@if (count($active_affiliators) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $active_affiliators->firstItem() . ' ' . translate('to') . ' ' . count($active_affiliators) . ' ' . translate('of') . ' ' . $active_affiliators->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $active_affiliators->links('admin.pagination.index') }}
    </div>
@endif
