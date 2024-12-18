@if (count($coupons) > 0)
    <div class="table-responsive dashboard-table-responsive mb-2 mt-4">
        <table class="table dashboard-table dashboard-table-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Coupon Code') }}</th>
                    <th scope="col">{{ translate('Discound Percentage') }}</th>
                    <th scope="col">{{ translate('Expriry date') }}</th>
                    <th scope="col">{{ translate('Status') }}</th>
                    <th scope="col">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <div class="title">{{ $coupon->code }}</div>
                                </label>

                            </div>
                        </td>

                        <td>{{ $coupon->discount_percentage }}%</td>
                        <td>{{ date('D, d-M-Y', $coupon->expiry_date) }}</td>
                        <td>
                            @if ($coupon->status == 1)
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
                                                onclick="confirmModal('{{ route('admin.coupon.status', $coupon->id) }}')"
                                                href="javascript:void(0)">
                                                @if ($coupon->status == 1)
                                                    {{ translate('Deactive') }}
                                                @else
                                                    {{ translate('Active') }}
                                                @endif
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="clickModal('{{ route('modal', ['admin.coupons.edit', 'id' => $coupon->id]) }}', 'Update coupon')"
                                                href="javascript:void(0)">{{ translate('Edit') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                onclick="confirmModal('{{ route('admin.coupon.delete', $coupon->id) }}')"
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
@if (count($coupons) > 0)
    <div class="itemshow-pagination d-flex align-items-center justify-content-between">
        <p class="fs-12px">
            {{ translate('Showing') . ' ' . $coupons->firstItem() . ' ' . translate('to') . ' ' . count($coupons) . ' ' . translate('of') . ' ' . $coupons->total() . ' ' . translate('entries') }}
        </p>
        <!-- Pagination -->
        {{ $coupons->links('admin.pagination.index') }}
    </div>
@endif
