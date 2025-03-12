<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th class="text-lg-center">@lang('site.category_cases')</th>
            <th class="text-lg-center">@lang('site.cases')</th>
            <th class="text-lg-center">@lang('site.status')</th>
            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($categories->isNotEmpty())
        @foreach ($categories as $category)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td>{{ $loop->iteration }}</td>
            <td class="text-lg-center">{{ $category->nameLang() }}</td>
            <td class="text-lg-center">
                <button type="button" class="btn btn-primary" {{ $category->cases->count() > 0 ? '' : 'disabled' }}>
                    <a href="{{ route('cases.index', ['category_case_id' => $category->id]) }}" class="text-white">
                        {{ $category->cases->count() }}
                        <i class="fa-solid fa-hands-holding-child ms-1 me-3"></i>
                    </a>
                </button>
            </td>

            {{-- status --}}
            <td class="text-center">
                <a href="{{ route('category_cases.toggle', ['category' => $category->id]) }}">
                    <button type="button"
                        class="btn {{ $category->active ? 'btn-success' : 'btn-danger' }} toggle-category waves-effect waves-light"
                        data-category-id="{{ $category->id }}">
                        <i class="fa-solid {{ $category->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                    </button>
                </a>
            </td>

            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        @if (auth()->user()->hasPermission('category_cases.update'))

                        <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                            data-bs-target="#categoriesCaseForm" data-id="{{ $category->id }}"
                            data-name-en="{{ $category->nameLang('en') }}"
                            data-name-ar="{{ $category->nameLang('ar') }}"
                            data-desc-en="{{ $category->descriptionLang('en') }}"
                            data-desc-ar="{{ $category->descriptionLang('ar') }}" data-active="{{ $category->active }}">
                            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                        </a>

                        @else
                        <button disabled class="dropdown-item">
                            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                        </button>
                        @endif

                        @if (auth()->user()->hasPermission('category_cases.destroy'))

                        <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $category->id }}">
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @else
                        <button class="dropdown-item" disabled>
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @endif
                    </div>
                </div>
            </td>
        </tr>

        <!-- Modal for Deletion -->
        @include('admin.includes.modal.delete',["id"=>$category->id,"main_name"=>"category_cases","name"=>"category_case"])
        @endforeach
        @else
        <tr>
            <td colspan="4" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-3">
    {{ $categories->links() }}
</div>
