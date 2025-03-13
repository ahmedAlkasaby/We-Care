@if (auth()->user()->hasPermission('categories.toggle'))
    <a href="{{ route('categories.toggle', ['category' => $category->id]) }}">
        <button type="button" class="btn {{ $category->active ? 'btn-success' : 'btn-danger' }} toggle-category waves-effect waves-light" data-category-id="{{ $category->id }}">
            <i class="fa-solid {{ $category->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
        </button>
    </a>
@else
    <button type="button" class="btn {{ $category->active ? 'btn-success' : 'btn-danger' }} toggle-category waves-effect waves-light" disabled>
        <i class="fa-solid {{ $category->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
    </button>
@endif
