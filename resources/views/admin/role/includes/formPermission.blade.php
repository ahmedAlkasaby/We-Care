<div class="col-12">
    <h5>@lang('site.permissions')</h5>
    <!-- Permission table -->
    <div class="table-responsive">
        <table class="table table-flush-spacing">
            <tbody>
                @foreach ($groupedPermissions as $module => $modulePermissions)
                <tr>
                    <td class="text-nowrap fw-medium">{{ $module }}</td>
                    @foreach ($modulePermissions as $permission)
                    @php
                        $permissionValue = $permission->name;
                    @endphp
                    <td>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                id="perm_{{ $permissionValue }}"
                                value="{{ $permissionValue }}"
                                name="permissions[]"
                                {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}
                                />
                                <label class="form-check-label d-flex align-items-center" for="perm_{{ $permissionValue }}">
                                    
                                    <span class="text-dark fw-bold">
                                        @lang('site.' . explode('.', $permissionValue)[1])
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
    <!-- Permission table -->
</div>
