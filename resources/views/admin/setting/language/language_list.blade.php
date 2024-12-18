<div class="tab-pane show active" id="list">

    <div class="table-responsive">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">{{ translate('Language') }}</th>
                    <th scope="col">{{ translate('Direction') }}</th>
                    <th scope="col">{{ translate('Option') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $languages = App\Models\Language::get();
                @endphp
                @foreach ($languages as $language)
                    <tr>
                        <td class="text-capitalize">
                            <div class="form-check dtable-check dtable-check-img">
                                <label class="form-check-label d-flex align-items-center" for="dcheck1">
                                    <img class="rounded-img" src="{{ img($language->country_flag) }}" alt="">
                                    <span class="title">{{ $language->name }}</span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <form action="#">
                                    <input onchange="update_language_dir('{{ $language->id }}', 'ltr')" name="direction"
                                        id="direction_ltr{{ $language->id }}" type="radio" value="ltr"
                                        @if ($language->direction == 'ltr') checked @endif>
                                    <label for="direction_ltr{{ $language->id }}">{{ translate('LTR') }}</label>
                                    &nbsp;&nbsp;
                                    <input onchange="update_language_dir('{{ $language->id }}', 'rtl')" name="direction"
                                        id="direction_rtl{{ $language->id }}" type="radio" value="rtl"
                                        @if ($language->direction == 'rtl') checked @endif>
                                    <label for="direction_rtl{{ $language->id }}">{{ translate('RTL') }}</label>
                                </form>
                            </div>
                        </td>
                        <td class="">
                            <a href="javascript:void(0)"
                                onclick="clickModal('{{ route('modal', ['admin.setting.language.edit', 'lan_id' => $language->id]) }}', '{{ translate('Language Update') }}')"
                                class="btn btn-light-white">{{ translate('Edit Language') }}</a>

                            <a href="{{ route('admin.language.phrase.edit', ['id' => $language->id]) }}"
                                class="btn btn-light-white">{{ translate('Edit phrase') }}</a>

                            @if ($language->name == 'english' || $language->name == 'English')
                            @else
                                <a href="javascript:;"
                                    onclick="confirmModal('{{ route('admin.language.delete', ['id' => $language->id]) }}')"
                                    class="btn btn-light-white">{{ translate('Delete language') }}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>
