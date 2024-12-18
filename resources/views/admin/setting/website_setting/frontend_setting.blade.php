<form action="#" method="POST">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="web-title" class="form-label ad-form-label">Banner
                title</label>
            <input type="text" class="form-control ad-form-control" name="banner_title" id="web-title"
                placeholder="Title">
        </div>
        <div class="col-md-6 mb-3">
            <label for="web-title" class="form-label ad-form-label">Banner sub title</label>
            <input type="text" class="form-control ad-form-control" name="banner_sub_title" id="web-title"
                placeholder="Title">
        </div>

        <div class="col-md-12 mb-3">
            <label for="web-des" class="form-label ad-form-label">Example
                textarea</label>
            <textarea class="form-control ad-form-textarea" id="web-des" placeholder="Type here"></textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label for="selling-tax" class="form-label ad-form-label">Course
                selling tax</label>
            <input type="number" class="form-control ad-form-control" id="selling-tax" placeholder="0"
                aria-describedby="sellingTax">
            <div id="sellingTax" class="form-text ad-form-text">
                enter 0 if you want to disable the tax option
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone-number" class="form-label ad-form-label">Phone</label>
            <input type="number" class="form-control ad-form-control" id="phone-number" placeholder="Phone">
        </div>
        <!-- Select  -->
        <div class="col-md-6 mb-3">
            <label for="setting-language" class="form-label ad-form-label">System
                language</label>
            <select class="ad-select2" data-minimum-results-for-search="Infinity">
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Urdu">Urdu</option>
            </select>
        </div>

        <!-- File Input  -->
        <div class="col-md-6 mb-3">
            <label for="formFile" class="form-label ad-form-label">File</label>
            <input class="form-control form-control-file" type="file" id="formFile">
        </div>

        <div class="col-md-12 mb-3">
            <label for="summernote" class="form-label ad-form-label">Short
                Description</label>
            <textarea id="summernote"></textarea>
        </div>
    </div>

    <button type="reset" value="reset" class="btn ad-btn-light">Cancel</button>
    <button type="submit" class="btn ad-btn-primary">Save</button>

</form>
