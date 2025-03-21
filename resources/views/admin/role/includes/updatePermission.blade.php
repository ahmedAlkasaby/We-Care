<div class="col-12">
    <h5>@lang('site.permissions')</h5>
    <div class="table-responsive">
        <table class="table table-flush-spacing">
            <thead>
                <tr>
                    <th>

                        <input type="checkbox" class="selectAll form-check-input" />
                        <label class="fw-bold">@lang('site.select_all')</label>
                    </th>

                    <th>
                        <input type="checkbox" id="selectRead" class="form-check-input select-type" data-type="index" />
                        <label for="selectRead" class="fw-bold">@lang('site.read')</label>
                    </th>
                    <th>
                        <input type="checkbox" id="selectShow" class="form-check-input select-type" data-type="show" />
                        <label for="selectShow" class="fw-bold">@lang('site.show')</label>
                    </th>
                    <th>
                        <input type="checkbox" id="selectToggle" class="form-check-input select-type" data-type="toggle" />
                        <label for="selectToggle" class="fw-bold">@lang('site.toggle')</label>
                    </th>
                    <th>
                        <input type="checkbox" id="selectCreate" class="form-check-input select-type" data-type="store" />
                        <label for="selectCreate" class="fw-bold">@lang('site.create')</label>
                    </th>
                    <th>
                        <input type="checkbox" id="selectEdit" class="form-check-input select-type" data-type="update" />
                        <label for="selectEdit" class="fw-bold">@lang('site.edit')</label>
                    </th>
                    <th>
                        <input type="checkbox" id="selectDelete" class="form-check-input select-type" data-type="destroy" />
                        <label for="selectDelete" class="fw-bold">@lang('site.delete')</label>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($groupedPermissions as $module => $modulePermissions)
                <tr>
                    <td class="text-nowrap fw-medium">
                        <input type="checkbox" class="form-check-input select-module" data-module="{{ $module }}" />
                        {{ $module }}
                    </td>
                    @foreach ($modulePermissions as $permission)
                    @php
                        $permissionValue = $permission->name;
                        $permissionType = explode('.', $permissionValue)[1];
                    @endphp
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" data-type="{{ $permissionType }}"     value="{{ $permissionValue }}"
                            name="permissions[]"
                            {{ in_array($permission->id,  $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}
                            />
                            <label class="form-check-label d-flex align-items-center">
                                <span class="text-dark fw-bold">
                                    @lang('site.' . $permissionType)
                                </span>
                            </label>
                        </div>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


