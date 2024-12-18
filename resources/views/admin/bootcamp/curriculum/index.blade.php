@php
    $bootcampbodule = App\Models\BootcampModule::where('bootcamp_id', $bootcamp->id)
        ->orderBy('sort')
        ->get();
@endphp

@if ($bootcampbodule->count() > 0)
    <div>
        <div class="ad-curriculum d-flex justify-content-center align-items-center gap-3">
            <a href="javascript:void(0)"
                onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.module', 'bootcamp_id' => $bootcamp->id]) }}', 'Add new module')"
                class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                <i class="fi-rr-plus-small"></i>
                {{ translate('Add Module') }}
            </a>
            <a href="javascript:void(0)"
                onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.live_class', 'bootcamp_id' => $bootcamp->id]) }}', '{{ translate('Add new live class') }}', 'modal-lg')"
                class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                <i class="fi-rr-plus-small"></i>
                {{ translate('Add Class') }}
            </a>
            <a href="javascript:void(0)"
                onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.module_sort', 'bootcamp_id' => $bootcamp->id]) }}', '{{ translate('Sorting module') }}')"
                class="btn custom-light-primary ad-btn-light-primary ad-btn-rounded d-flex align-items-center gap-1">
                <i class="fi-rr-apps-sort"></i>
                {{ translate('Sort Module') }}
            </a>
        </div>
        @foreach (App\Models\BootcampModule::where('bootcamp_id', $bootcamp->id)->orderBy('sort')->get() as $key => $module)
            <div class="section-box">
                <div class="section-card">
                    <div class="mb-2">
                        <h5 class="section-title"> <span>{{ translate('Module') }} {{ ++$key }}:
                                {{ $module->title }}</span>
                            <div class="hover">
                                <div class="d-flex justify-content-end align-items-center gap-1 section-menu">
                                    <a href="javascript:void(0)"
                                        onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.live_class_sort', 'bootcamp_id' => $bootcamp->id, 'module_id' => $module->id]) }}', '{{ translate('Sorting live class') }}')"
                                        class="btn ad-btn-dark d-flex align-items-center gap-1 ad-btn-rounded custom-add-btn">
                                        <i class="bi bi-sort-down"></i>
                                        <small>{{ translate('Sort Class') }}</small>
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.module_edit', 'id' => $module->id]) }}', 'Update Module')"
                                        class="btn ad-btn-dark d-flex align-items-center gap-1 ad-btn-rounded custom-add-btn">
                                        <i class="fi-rr-attribution-pen"></i>
                                        <small>{{ translate('Edit Module') }}</small>
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="confirmModal('{{ route('admin.module.delete', $module->id) }}')"
                                        class="btn ad-btn-dark d-flex align-items-center gap-1 ad-btn-rounded custom-add-btn">
                                        <i class="fi-rr-trash"></i>
                                        <small>{{ translate('Delete Module') }}</small>
                                    </a>
                                </div>
                            </div>
                        </h5>
                    </div>
                    @foreach (App\Models\BootcampLiveClass::where('bootcamp_id', $bootcamp->id)->where('module_id', $module->id)->orderBy('sort')->get() as $class)
                        <div class="mt-3">
                            <div class="custom-lesson">
                                <div class="ad-alert light-dark-alert p-3 w-100">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="alert-icon fs-18px">
                                                @if ($class->status == 1)
                                                    <p class="ad-md-btn-danger">{{ translate('Live') }}</p>
                                                @elseif($class->status == 0)
                                                    <p class="ad-md-btn-warning">{{ translate('Upcoming') }}</p>
                                                @else
                                                    <p class="ad-md-btn-success">{{ translate('Completed') }}</p>
                                                @endif
                                            </div>
                                            <div class="alert-content">
                                                <h5>{{ ucfirst($class->title) }}</h5>
                                            </div>
                                        </div>
                                        <div class="menu-hover">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="javascript:void(0)" id="placement-top" class="placement-top"
                                                    data-toggle="tooltip"
                                                    data-bs-original-title="{{ translate('Resource File') }}">
                                                    <i class="bi bi-folder2-open fs-16px"></i>
                                                </a>

                                                <a href="javascript:void(0)" id="placement-btton" class="placement-top"
                                                    onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.live_class_edit', 'bootcamp_id' => $bootcamp->id, 'class_id' => $class->id]) }}', '{{ translate('Lesson Update') }}', 'modal-lg')"
                                                    data-toggle="tooltip"
                                                    data-bs-original-title="{{ translate('Edit') }}">
                                                    <i class="bi bi-pencil-square fs-16px"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="placement-top" class="placement-top"
                                                    onclick="confirmModal('{{ route('admin.class.delete', $class->id) }}')"
                                                    data-toggle="tooltip"
                                                    data-bs-original-title="{{ translate('Delete') }}">
                                                    <i class="bi bi-trash fs-16px"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>{{ translate('Schedule: ') }} {{ date('d-m-Y H:i:s', $class->start_time) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="question-btn">
        <a href="javascript:void(0)" class="add-question"
            onclick="clickModal('{{ route('modal', ['admin.bootcamp.curriculum.module', 'bootcamp_id' => $bootcamp->id]) }}', '{{ translate('Add new module') }}')">
            <p><i class="fi-rr-add"></i></p>
            <h3>{{ translate('Add Module') }}</h3>
        </a>
    </div>
@endif
