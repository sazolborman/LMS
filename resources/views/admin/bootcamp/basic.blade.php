<input type="hidden" name="id" value="{{ $bootcamp->id }}">
<input type="hidden" name="tab" value="basic">
<div class="ad-card-body mb-20px p-20px">

    <div class="w-100">
        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Bootcamp Title') }}</label>
            <input type="text" value="{{ $bootcamp->title }}" class="form-control ad-form-control" id="title"
                name="title" placeholder="{{ translate('Enter Bootcamp title') }}" required>
        </div>
        <div class="mb-3">
            <label for="short_description" class="form-label ad-form-label">{{ translate('Short Description') }}</label>
            <textarea class="form-control ad-form-textarea" id="short_description" name="short_description"
                placeholder="{{ translate('Hare ...') }}" required>{{ $bootcamp->short_description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label ad-form-label">{{ translate('Description') }}</label>
            <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="description" required>{{ $bootcamp->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label ad-form-label">{{ translate('Bootcamp Category') }}</label>
            <select class="ad-select2" name="category" required>
                <option value="">{{ translate('Select a category') }}</option>
                @foreach (App\Models\BootcampCategory::orderBy('title', 'desc')->get() as $category)
                    <option @if ($bootcamp->category_id == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="publish_date" class="form-label ad-form-label">{{ translate('Publish Date') }}</label>
            <input type="date" class="form-control ad-form-control" id="publish_date" name="publish_date"
                value="{{ date('Y-m-d', $bootcamp->publish_date) }}" required>
        </div>
    </div>
</div>
