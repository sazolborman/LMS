@extends(ADMIN)
@push('title', translate('Newsletter'))
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

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3 flex-wrap">
                                <h4 class="title fs-18px mb-2">{{ translate('Newsletter') }}</h4>
                                <p class="sub-title fs-12px">
                                    {{ translate('Dashboard / Newsletter ') }}</p>
                            </div>
                            <div>
                                <a href="javascript:void(0)"
                                    onclick="clickModal('{{ route('modal', ['admin.newsletter.create']) }}', '{{ translate('Create Newsletter') }}', 'modal-lg')"
                                    class="btn ad-btn-primary px-12px d-flex align-items-center cg-6px">
                                    <span><i class="fa-solid fa-plus"></i></span>
                                    <span>{{ translate('Add New Newsletter') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="ad-card">
                            <div class="p-5">
                                @foreach ($newsletters as $newsletter)
                                    <div class="accordion basic-2-accordion mb-3"
                                        id="basic-2-accordionExample_{{ $newsletter->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="basic-2-headingOne">
                                                <button
                                                    class="accordion-button fs-14px title collapsed d-flex justify-content-between"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#basic-2-collapseOne_{{ $newsletter->id }}"
                                                    aria-expanded="false" aria-controls="collapseOne">
                                                    {{ $newsletter->subject }}
                                                    <ul class="action-btn">
                                                        <li class="sub_action-btn">
                                                            <a onclick="clickModal('{{ route('modal', ['admin.newsletter.send', 'id' => $newsletter->id]) }}', '{{ translate('Newsletter Send') }}', 'modal-lg')"
                                                                data-bs-toggle="tooltip" href="javascript:void(0)"
                                                                class="edit" aria-label="Send newsletter"
                                                                data-bs-original-title="Send newsletter"><span
                                                                    class="fi-rr-paper-plane"></span></a>
                                                        </li>
                                                        <li class="sub_action-btn">
                                                            <a onclick="clickModal('{{ route('modal', ['admin.newsletter.edit', 'id' => $newsletter->id]) }}', '{{ translate('Update Newsletter') }}', 'modal-lg')"
                                                                data-bs-toggle="tooltip" href="javascript:vodi(0)"
                                                                class="edit" aria-label="Edit"
                                                                data-bs-original-title="Edit"><span
                                                                    class="fi fi-rr-pen-clip"></span></a>
                                                        </li>
                                                        <li class="sub_action-btn">
                                                            <a onclick="confirmModal('{{ route('admin.newsletter.delete', $newsletter->id) }}')"
                                                                data-bs-toggle="tooltip" href="javascript:vodi(0)"
                                                                class="delete" aria-label="Delete"
                                                                data-bs-original-title="Delete"><span
                                                                    class="fi-rr-trash"></span></a>
                                                        </li>
                                                    </ul>
                                                </button>
                                            </h2>
                                            <div id="basic-2-collapseOne_{{ $newsletter->id }}"
                                                class="accordion-collapse collapse" aria-labelledby="basic-2-headingOne"
                                                data-bs-parent="#basic-2-accordionExample_{{ $newsletter->id }}"
                                                style="">
                                                <div class="accordion-body">
                                                    {!! $newsletter->description !!}
                                                </div>
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
    </div>
@endsection
@push('js')
@endpush
