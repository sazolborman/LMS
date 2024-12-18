<form action="{{ route('admin.affiliator.store') }}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ad-form-label">
                {{ translate('User') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ad-form-control ol-select2" data-toggle="select2" name="user_id">
                <option value="">{{ translate('Select an option') }}</option>
                @foreach (App\Models\User::where('role', '!=', 'admin')->get() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="fpb-7 mb-3">
        <label for="message" class="form-label ad-form-label col-form-label">{{ translate('Message') }}</label>
        <textarea name="message" rows="5" class="form-control ad-form-control text_editor"></textarea>
    </div>

    <div class="mb-3">
        <label for="banner" class="form-label ad-form-label">{{ translate('Document') }}
            <small>{{ translate('(.pdf, .png, .jpg, .jpeg)') }}</small></label>
        <input class="form-control form-control-file" type="file" id="document" name="document">
    </div>

    <div class="fpb7">
        <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
    </div>
</form>

@include('admin.inited')
