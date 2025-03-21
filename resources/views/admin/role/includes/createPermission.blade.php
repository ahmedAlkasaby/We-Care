<div class="col-12">
    <h5>@lang('site.permissions')</h5>
    <div class="table-responsive">
        <table class="table table-flush-spacing">
            @include('admin.role.includes.thead')

           


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


