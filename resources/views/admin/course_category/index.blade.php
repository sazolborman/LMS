@extends(ADMIN)
@push('title', translate('Course Category'))
@push('meta')
@endpush
@push('css')
@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-3 flex-wrap">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Course Category') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Dashboard / course category') }}</p>
                            </div>
                            <button
                                onclick="clickModal('{{ route('modal', ['admin.course_category.create', 'parent_id' => 0]) }}', '{{ translate('Add New Category') }}')"
                                type="button" class="btn ad-btn-primary"
                                id="nextBtn1">{{ translate('Add New Category') }}</button>
                        </div>
                        <div class="ad-card">
                            <div class="ad-card-body p-4 mb-3">
                                <div class="p-3">
                                    @if ($categories->count() > 0)
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 ">
                                            @foreach ($categories as $category)
                                                <div class="col">
                                                    <div class="single-card-item custom-single-item">
                                                        <div class="single-card-img">
                                                            <img src="{{ img($category->thumbnail) }}" alt="img">
                                                        </div>
                                                        <div class="single-card-content">
                                                            <h4 class="fs-16px title2 mb-3 fw-bold">
                                                                <i class="{{ $category->icon }}"></i>
                                                                {{ $category->title }}
                                                            </h4>
                                                            <ul class="list-group list-group-flush mb-12">
                                                                @foreach ($category->childs as $child_category)
                                                                    <li class="list-group-item text-muted">
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <i class="{{ $child_category->icon }}"></i>
                                                                                <span
                                                                                    class="text-12px">{{ $child_category->title }}</span>
                                                                            </div>
                                                                            <div
                                                                                class="col-auto ms-auto d-flex subcategory-actions">
                                                                                <a class="mx-1" data-bs-toggle="tooltip"
                                                                                    onclick="clickModal('{{ route('modal', ['admin.course_category.edit', 'id' => $child_category->id, 'title' => 'child']) }}', '{{ translate('Edit category') }}')"
                                                                                    title="" href="javascript:void(0)"
                                                                                    data-bs-original-title="{{ translate('Edit') }}"
                                                                                    aria-label="{{ translate('Edit') }}"><i
                                                                                        class="fi fi-rr-pen-clip"></i>
                                                                                </a>
                                                                                <a class="mx-1" data-bs-toggle="tooltip"
                                                                                    title="" href="javascript:void(0)"
                                                                                    onclick="confirmModal('{{ route('admin.category.delete', $child_category->id) }}')"
                                                                                    data-bs-original-title="{{ translate('Delete') }}"
                                                                                    aria-label="{{ translate('Delete') }}"><i
                                                                                        class="fi fi-rr-trash"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between category-action">
                                                                <a href="javascript:void(0)"
                                                                    onclick="clickModal('{{ route('modal', ['admin.course_category.create', 'parent_id' => $category->id]) }}', 'Add new category')"
                                                                    class="btn read-more-transparent-btn d-flex align-items-center gap-1 fs-14px">
                                                                    <i class="fi fi-rr-plus fs-12px mt-1"></i>
                                                                    <span>{{ translate('Add') }}</span>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    onclick="clickModal('{{ route('modal', ['admin.course_category.edit', 'id' => $category->id, 'title' => 'main']) }}', '{{ translate('Edit category') }}')"
                                                                    class="btn read-more-transparent-btn d-flex align-items-center gap-1 fs-14px">
                                                                    <i class="fi fi-rr-pen-clip fs-12px mt-1"></i>
                                                                    <span>{{ translate('Edit') }}</span>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    onclick="confirmModal('{{ route('admin.category.delete', $category->id) }}')"
                                                                    class="btn read-more-transparent-btn d-flex align-items-center gap-1 fs-14px">
                                                                    <i class="fi-rr-trash fs-12px mt-1"></i>
                                                                    <span>{{ translate('Delete') }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        @include('admin.no_data')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
