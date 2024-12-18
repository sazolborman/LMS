@php
    $multi_instructor = json_decode($courses->multi_instructor, true);

@endphp

<input type="hidden" name="course_id" value="{{ $courses->id }}">
<input type="hidden" name="tab" value="basic">
<div class="ad-card-body mb-20px p-20px">

    <div class="w-100">
        <div class="mb-3">
            <label for="title" class="form-label ad-form-label">{{ translate('Course Title') }}</label>
            <input type="text" value="{{ $courses->title }}" class="form-control ad-form-control" id="title"
                name="title" placeholder="{{ translate('Enter your course title') }}" required>
        </div>
        <div class="mb-3">
            <label for="short_description" class="form-label ad-form-label">{{ translate('Short Description') }}</label>
            <textarea class="form-control ad-form-textarea" id="short_description" name="short_description"
                placeholder="{{ translate('Hare ...') }}" required>{{ $courses->short_description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label ad-form-label">{{ translate('Description') }}</label>
            <textarea placeholder="{{ translate('Hare ...') }}" id="summernote" name="description" required>{{ $courses->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label ad-form-label">{{ translate('Course Status') }}</label>
            <select class="ad-select2" name="status" required>
                <option value="">{{ translate('Select your course status') }}
                </option>
                <option @if ($courses->status == 'Active') selected @endif value="Active">{{ translate('Active') }}
                </option>
                <option @if ($courses->status == 'Private') selected @endif value="Private">
                    {{ translate('Private') }}</option>
                <option @if ($courses->status == 'Upcoming') selected @endif value="Upcoming">
                    {{ translate('Upcoming') }}</option>
                <option @if ($courses->status == 'Pending') selected @endif value="Pending">
                    {{ translate('Pending') }}</option>
                <option @if ($courses->status == 'Draft') selected @endif value="Draft">{{ translate('Draft') }}
                </option>
                <option @if ($courses->status == 'Inactive') selected @endif value="Inactive">
                    {{ translate('Inactive') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label ad-form-label">{{ translate('Course Category') }}</label>
            <select class="ad-select2" name="category" required>
                <option value="">{{ translate('Select a category') }}</option>
                @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'desc')->get() as $category)
                    <optgroup label="{{ $category->title }}">
                        @foreach ($category->childs as $sub_category)
                            <option @if ($courses->category_id == $sub_category->id) selected @endif value="{{ $sub_category->id }}">
                                &nbsp {{ $sub_category->title }}
                            </option>
                        @endforeach
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label for="language" class="form-label ad-form-label">{{ translate('Course Language') }}</label>
            <select class="ad-select2" name="language" required>
                <option value="">{{ translate('Select your course language') }}
                </option>
                <option @if ($courses->language == 1) selected @endif value="1">{{ translate('English') }}
                </option>
                <option @if ($courses->language == 2) selected @endif value="2">{{ translate('Bangla') }}
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label for="level" class="form-label ad-form-label">{{ translate('Course Level') }}</label>
            <select class="ad-select2" name="level" required>
                <option value="">{{ translate('Select your course level') }}
                </option>
                <option @if ($courses->level == 'beginner') selected @endif value="beginner">
                    {{ translate('Beginner') }}</option>
                <option @if ($courses->level == 'intermediate') selected @endif value="intermediate">
                    {{ translate('Intermediate') }}</option>
                <option @if ($courses->level == 'advanced') selected @endif value="advanced">
                    {{ translate('Advanced') }}</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="course_id" class="form-label ad-form-label">{{ translate('Multiple Instructor') }}</label>
        <select class="ad-select2" name="instructor[]" multiple="multiple">
            @foreach (App\Models\User::where('role', '!=', 'student')->get() as $instructor)
                <option @if (is_array($multi_instructor) && in_array($instructor->id, $multi_instructor)) selected @endif value="{{ $instructor->id }}">
                    {{ $instructor->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
