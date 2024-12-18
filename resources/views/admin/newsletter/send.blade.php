<form action="{{ route('admin.newsletter.send') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="subject" class="form-label ad-form-label">{{ translate('Send To') }}</label>
        <select name="send_to" class="form-control ad-form-control">
            <option value="selected_user">{{ translate('Selected user') }}</option>

            <option value="all">{{ translate('All user') }}</option>
            <option value="student">{{ translate('All student') }}</option>
            <option value="instructor">{{ translate('All instructor') }}</option>
            <option value="all_subscriber">
                {{ translate('Newsletter subscriber') }}
                ({{ translate('All subscriber') }})
            </option>
            <option value="registered_subscriber">
                {{ translate('Newsletter subscriber') }}
                ({{ translate('Registered user') }})
            </option>
            <option value="non_registered_subscriber">
                {{ translate('Newsletter subscriber') }}
                ({{ translate('Non registered user') }})
            </option>
        </select>
    </div>

    <button type="submit" class="btn ad-btn-primary">{{ translate('Send') }}</button>

</form>
