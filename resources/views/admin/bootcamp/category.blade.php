@extends(ADMIN)
@push('title', translate('Bootcamp Category'))
@push('meta')
@endpush
@push('css')
@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="mb-3 flex-wrap">
                                <h4 class="title fs-18px mb-2">{{ translate('Bootcamp Category') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Dashboard / Bootcamp / Bootcamp Category') }}</p>
                            </div>
                            <div>
                                <a href="javascript:void(0)"
                                    onclick="clickModal('{{ route('modal', ['admin.bootcamp.create_category']) }}', '{{ translate('Add bootcamp category') }}')"
                                    class="btn ad-btn-primary px-12px d-flex align-items-center cg-6px">
                                    <span><i class="fa-solid fa-plus"></i></span>
                                    <span>{{ translate('Add new Category') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-2 g-sm-3 mb-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                            @foreach ($bootcamp_categories as $bootcamp_category)
                                <div class="col">
                                    <div class="ad-card card-hover">
                                        <div class="ad-card-body px-20px py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="title fs-18px">{{ $bootcamp_category->title }}</p>
                                                <div class="d-flex justify-content-center">
                                                    <div class="dropdown ad-icon-dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle rotate-icon"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item"
                                                                    onclick="clickModal('{{ route('modal', ['admin.bootcamp.edit_category', 'id' => $bootcamp_category->id]) }}', '{{ translate('Update blog category') }}')"
                                                                    href="javascript:void(0)">{{ translate('Edit') }}</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="confirmModal('{{ route('admin.bootcamp.category.delete', $bootcamp_category->id) }}')"
                                                                    href="javascript:void(0)">{{ translate('Delete') }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
