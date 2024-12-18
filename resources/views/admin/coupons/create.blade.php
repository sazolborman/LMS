<form action="{{ route('admin.coupon.store') }}" method="post">
    @csrf
    <div class="input-group-field mb-3">
        <label for="Coupon code" class="form-label ad-form-label">{{ translate('Coupon code') }}</label>
        <div class="d-flex align-items-center gap-2">
            <input type="text" class="form-control ad-form-control" name="code" id="code"
                placeholder="{{ translate('Coupon code') }}" required>
            <button type="button" class="btn ad-btn-success d-flex align-items-center cg-10px" id="generate">
                <span>{{ translate('Generate') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_801_4830" fill="white">
                        <path
                            d="M2.60673e-06 8C2.44493e-06 9.85084 0.641756 11.6444 1.81592 13.0751C2.99008 14.5059 4.624 15.4852 6.43928 15.8463C8.25456 16.2074 10.1389 15.9279 11.7712 15.0554C13.4035 14.1829 14.6827 12.7714 15.391 11.0615C16.0993 9.35151 16.1928 7.44887 15.6555 5.67772C15.1183 3.90658 13.9835 2.37652 12.4446 1.34825C10.9056 0.319972 9.0578 -0.142892 7.21587 0.0385229C5.37394 0.219937 3.65189 1.0344 2.34315 2.34315L3.31709 3.31709C4.40051 2.23367 5.82607 1.55943 7.35087 1.40926C8.87568 1.25908 10.4054 1.64225 11.6793 2.49348C12.9533 3.34472 13.8927 4.61135 14.3375 6.07755C14.7822 7.54376 14.7049 9.11882 14.1185 10.5344C13.5322 11.9499 12.4732 13.1184 11.1219 13.8406C9.77063 14.5629 8.21073 14.7943 6.70799 14.4954C5.20525 14.1965 3.85264 13.3857 2.88064 12.2014C1.90863 11.017 1.37737 9.53218 1.37737 8L2.60673e-06 8Z">
                        </path>
                    </mask>
                    <path
                        d="M2.60673e-06 8C2.44493e-06 9.85084 0.641756 11.6444 1.81592 13.0751C2.99008 14.5059 4.624 15.4852 6.43928 15.8463C8.25456 16.2074 10.1389 15.9279 11.7712 15.0554C13.4035 14.1829 14.6827 12.7714 15.391 11.0615C16.0993 9.35151 16.1928 7.44887 15.6555 5.67772C15.1183 3.90658 13.9835 2.37652 12.4446 1.34825C10.9056 0.319972 9.0578 -0.142892 7.21587 0.0385229C5.37394 0.219937 3.65189 1.0344 2.34315 2.34315L3.31709 3.31709C4.40051 2.23367 5.82607 1.55943 7.35087 1.40926C8.87568 1.25908 10.4054 1.64225 11.6793 2.49348C12.9533 3.34472 13.8927 4.61135 14.3375 6.07755C14.7822 7.54376 14.7049 9.11882 14.1185 10.5344C13.5322 11.9499 12.4732 13.1184 11.1219 13.8406C9.77063 14.5629 8.21073 14.7943 6.70799 14.4954C5.20525 14.1965 3.85264 13.3857 2.88064 12.2014C1.90863 11.017 1.37737 9.53218 1.37737 8L2.60673e-06 8Z"
                        stroke="white" stroke-width="4" mask="url(#path-1-inside-1_801_4830)"></path>
                </svg>
            </button>
        </div>

    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Discount percentage') }}
            <small>(%)</small></label>
        <input type="number" class="form-control ad-form-control" name="discount_percentage" id="discount_percentage"
            value="0">
    </div>
    <div class="input-group-field mb-3">
        <label for="name" class="form-label ad-form-label">{{ translate('Expiry date') }}</label>
        <input type="date" class="form-control ad-form-control" name="expiry_date" id="expiry_date" required>
    </div>
    <button type="submit" class="btn ad-btn-primary">{{ translate('Save') }}</button>
</form>

<script>
    $(document).ready(function() {
        $('#generate').click(function(e) {
            e.preventDefault();
            // Function to generate a random alphanumeric string of a given length
            function generateRandomString(length) {
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var result = '';
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                return result;
            }

            // Generate a random string of length 8
            var randomString = generateRandomString(8);

            // Set the value of the input field
            $('#code').val(randomString);
        });
    });
</script>
