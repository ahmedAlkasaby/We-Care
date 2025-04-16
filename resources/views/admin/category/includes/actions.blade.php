<td class="text-lg-center">
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
            data-bs-toggle="dropdown">
            <i class="ti ti-dots-vertical"></i>
        </button>
        <div class="dropdown-menu">
            <li>

                @if (auth()->user()->hasPermission('categories.update'))
                <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                    data-bs-target="#categoriesForm"
                    data-id="{{ $category->id }}"
                    data-name-en="{{ $category->nameLang('en') }}"
                    data-name-ar="{{ $category->nameLang('ar') }}"
                    data-desc-en="{{ $category->descriptionLang('en') }}"
                    data-desc-ar="{{ $category->descriptionLang('ar') }}"
                    data-active="{{ $category->active }}">

                    <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                </a>
                @else
                <button disabled class="dropdown-item">
                    <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                </button>
                @endif
            </li>

            <li>
                @if (auth()->user()->hasPermission('categories.destroy'))
                <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                    data-bs-target="#deleteModal{{ $category->id }}">
                    <i class="ti ti-trash me-1"></i> @lang('site.delete')
                </button>
                @else
                <button class="dropdown-item" disabled>
                    <i class="ti ti-trash me-1"></i> @lang('site.delete')
                </button>
                @endif
            </li>
        </div>
    </div>
</td>
