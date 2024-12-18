@extends(ADMIN)
@push('title', translate('Edit Phrase'))
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
                                <h4 class="title fs-18px mb-2">{{ translate('Edit Phrase') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Dashboard / Setting / Language Setting/ Edit Phrase') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.language') }}"
                                    class="btn ad-btn-primary d-flex align-items-center gap-1"><i
                                        class="fi-sr-arrow-turn-down-left mt-1"></i>{{ translate('Back') }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-primary" role="alert">
                                    <a href="javascript:void(0)" onclick="replaceInputData()">ReplaceInputData</a>
                                    <a href="javascript:void(0)"
                                        onclick="replaceInputDataUpdate()">ReplaceInputDataUpdate</a>
                                    The symbol ___ represents dynamic values that will be replaced dynamically. So, do not
                                    remove the ___ symbol.
                                </div>
                            </div>
                            @foreach ($phrases as $phrase)
                                <div class="col-md-4 mb-3">
                                    <div class="ad-card p-4">
                                        <div class="ad-card-body translation-fields">
                                            <label class="ad-form-label"
                                                for="translated_phrase_{{ $phrase->id }}">{{ $phrase->phrase }}</label>
                                            <input type="text" id="translated_phrase_{{ $phrase->id }}"
                                                value="{{ $phrase->translated }}" class="form-control ad-form-control">
                                            <button type="button" onclick="updatePhrase({{ $phrase->id }})"
                                                class="btn ad-btn-primary mt-3 update-translation-fields">{{ translate('Update') }}</button>
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
@endsection
@push('js')
    <script type="text/javascript">
        "use strict";

        function replaceInputData() {
            $('.translation-fields:not(.added)').each(function(index) {
                var element = $(this);
                var translated_text = element.find('label').text();
                element.find('input').val(translated_text);
                element.addClass('added');
                console.log(translated_text)
            });
        }

        function replaceInputDataUpdate() {
            $('.update-translation-fields').each(function(index) {
                var element = $(this);
                setTimeout(function() {
                    element.trigger('click');
                    element.addClass('d-none');
                }, index * 1000); // index * 1000 will delay each by 1 second
            });
        }

        function updatePhrase(phrase_id) {
            var translated_phrase = $('#translated_phrase_' + phrase_id).val();
            $.ajax({
                type: "POST",
                url: `{{ route('admin.language.phrase.update') }}/${phrase_id}`,
                data: {
                    translated_phrase: translated_phrase
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    success('{{ translate('Phrase updated') }}');
                }
            });
        }
    </script>
@endpush
