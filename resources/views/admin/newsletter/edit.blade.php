@php
    $newsletter = App\Models\Newsletter::where('id', $id)->first();
@endphp
<form action="{{ route('admin.newsletter.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <div class="mb-3">
        <label for="subject" class="form-label ad-form-label">{{ translate('Newsletter Subject') }}</label>
        <input type="text" class="form-control ad-form-control" id="subject" name="subject"
            value="{{ $newsletter->subject }}" placeholder="{{ translate('Enter newsletter subject') }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label ad-form-label">{{ translate('Newsletter Description') }}</label>
        <textarea class="text_editor" placeholder="{{ translate('Hare ...') }}" id="summernote" name="description">{{ $newsletter->description }}</textarea>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>

</form>

@include('admin.inited')
