@extends(ADMIN)
@push('title', translate('Blog Create'))
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
                        <div class="mb-3 flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="title fs-18px mb-2">{{ translate('Blog Create') }}</h4>
                                <p class="sub-title fs-12px">{{ translate('Deshboard / Blog / Blog Create') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="ad-card-body mb-20px p-20px">
                                    <h4 class="title fs-16px mb-3">{{ translate('Blog Create') }}</h4>

                                    <div class="d-flex gap-3">
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="title"
                                                    class="form-label ad-form-label">{{ translate('Blog Title') }}</label>
                                                <input type="text" class="form-control ad-form-control" id="title"
                                                    name="title" placeholder="{{ translate('Enter your Blog title') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description"
                                                    class="form-label ad-form-label">{{ translate('Description') }}</label>
                                                <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <div class="mb-3">
                                                <label for="category"
                                                    class="form-label ad-form-label">{{ translate('Blog Category') }}</label>
                                                <select class="ad-select2" name="category">
                                                    <option value="">{{ translate('Select a category') }}</option>
                                                    @foreach (App\Models\BlogCategory::get() as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tagsinput-id-1"
                                                    class="form-label ad-form-label">{{ translate('Keywords') }}</label>
                                                <input type="text" class="form-control ad-form-control tagify"
                                                    id="tagsinput-id-1" name="keywords" placeholder="Keywords">
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile"
                                                    class="form-label ad-form-label">{{ translate('Thumbnail') }}</label>
                                                <input class="form-control form-control-file" type="file"
                                                    name="thumbnail" id="formFile">
                                            </div>
                                            <div class="mb-3">
                                                <label for="banner"
                                                    class="form-label ad-form-label">{{ translate('Banner') }}</label>
                                                <input class="form-control form-control-file" type="file" id="banner"
                                                    name="banner">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
