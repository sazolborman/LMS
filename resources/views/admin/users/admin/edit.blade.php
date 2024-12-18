@extends(ADMIN)
@push('title', translate('Admin Edit'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Update Admin') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Dashboard / Users / Admin Management / Update Admin') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.admins') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="ad-card">
                            <form action="{{ route('admin.admin.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                <div class="ad-card-body mb-20px p-20px">
                                    <div class="admin-info">
                                        <h4 class="title fs-16px mb-3">{{ translate('Admin Information') }}</h4>
                                        <div class="d-flex gap-3">
                                            <div class="w-100">
                                                <div class="mb-3">
                                                    <label for="name"
                                                        class="form-label ad-form-label">{{ translate('Full Name') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="name" name="name" value="{{ $admin->name }}"
                                                        placeholder="{{ translate('Enter your name') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address"
                                                        class="form-label ad-form-label">{{ translate('Address') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="address" name="address" value="{{ $admin->address }}"
                                                        placeholder="{{ translate('Enter your address') }}">
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="mb-3">
                                                    <label for="phone"
                                                        class="form-label ad-form-label">{{ translate('Phone') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="phone" name="phone" value="{{ $admin->phone }}"
                                                        placeholder="{{ translate('Enter your phone') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formFile"
                                                        class="form-label ad-form-label">{{ translate('Image') }}</label>
                                                    <input class="form-control form-control-file" type="file"
                                                        name="image" id="formFile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="biography"
                                                class="form-label ad-form-label">{{ translate('Biography') }}</label>
                                            <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="biography">{{ $admin->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="admin-login">
                                        <h4 class="title fs-16px mb-3">{{ translate('Login Credentials') }}</h4>
                                        <div class="d-flex gap-3">
                                            <div class="w-100">
                                                <div class="mb-3">
                                                    <label for="email"
                                                        class="form-label ad-form-label">{{ translate('Email') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="email" name="email" value="{{ $admin->email }}"
                                                        placeholder="{{ translate('Enter your email') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-social">
                                        <h4 class="title fs-16px mb-3">{{ translate('Social Information') }}</h4>
                                        <div class="d-flex gap-3">
                                            <div class="w-100">
                                                <div class="mb-3">
                                                    <label for="facbook"
                                                        class="form-label ad-form-label">{{ translate('Facebook') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="facbook" name="facbook" value="{{ $admin->facbook }}"
                                                        placeholder="{{ translate('Enter your facbook url') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="instagram"
                                                        class="form-label ad-form-label">{{ translate('Instagram') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="instagram" name="instagram" value="{{ $admin->instagram }}"
                                                        placeholder="{{ translate('Enter your instagram url') }}">
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="mb-3">
                                                    <label for="linkedin"
                                                        class="form-label ad-form-label">{{ translate('Linkedin') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="linkedin" name="linkedin" value="{{ $admin->linkedin }}"
                                                        placeholder="{{ translate('Enter your linkedin url') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="twitter"
                                                        class="form-label ad-form-label">{{ translate('Twitter') }}</label>
                                                    <input type="text" class="form-control ad-form-control"
                                                        id="twitter" name="twitter" value="{{ $admin->twitter }}"
                                                        placeholder="{{ translate('Enter your twitter url') }}">
                                                </div>
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
