@extends(ADMIN)
@push('title', translate('Ebook Category'))
@push('css')
@endpush
@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3 flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Ebook categories') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Deshboard / Ebook Management / Ebook category ') }}</p>
                            </div>
                            <div>
                                <a href="javascript:void(0)"
                                    onclick="clickModal('{{ route('modal', ['admin.ebook.create_category']) }}', '{{ translate('Add a new ebook category') }}')"
                                    class="btn ad-btn-primary px-12px d-flex align-items-center cg-6px">
                                    <span><i class="fa-solid fa-plus"></i></span>
                                    <span>{{ translate('Add new category') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <div class="mb-3">
                                <div class="p-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 ">
                                        @foreach ($categories as $category)
                                            <div class="col">
                                                <div class="single-card-item">
                                                    <div
                                                        class="single-card-content d-flex align-items-center justify-content-between">
                                                        <h4 class="fs-16px title2 mb-1">{{ ucfirst($category->title) }}</h4>
                                                        <div class="dropdown ad-icon-dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="true">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-start"
                                                                data-popper-placement="bottom-start"
                                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 26px, 0px);">

                                                                <li><a class="dropdown-item"
                                                                        onclick="clickModal('{{ route('modal', ['admin.ebook.edit_category', 'id' => $category->id]) }}', '{{ translate('Update ebook category') }}')"
                                                                        href="javascript:void(0)">{{ translate('Edit') }}</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        onclick="confirmModal('{{ route('admin.ebook.category.delete', $category->id) }}')"
                                                                        href="javascript:void(0)">{{ translate('Delete') }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="single-card-img radius-bottom">
                                                        <img src="{{ img($category->thumbnail) }}" alt="img">
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
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
