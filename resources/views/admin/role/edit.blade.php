<div class="modal fade" id="editRoleModal-{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-4">
            {{-- <button type="reset" class="btn-close btn-pinned"  data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-body border-top">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">@lang('site.edit_role')</h3>
                </div>
                <!-- Add role form -->
                <form action="{{ route('roles.update',['role'=>$role->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="col-12 mb-4">
                        <label class="form-label">@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" tabindex="-1" value="{{ $role->name }}"
                            required />
                    </div>
                    {{-- <div class="col-12">
                        <h5>@lang('site.permissions')</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">@lang('site.module')</th>
                                        <th class="text-center">@lang('site.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $groupedPermissions = collect($permissions)->groupBy('description');
                                    @endphp
                                        @dd($groupedPermissions)

                                    @foreach ($groupedPermissions as $module => $modulePermissions)
                                        <tr>
                                            <td class="fw-bold text-center bg-light">{{ ucfirst($module) }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-3">
                                                    @foreach ($modulePermissions as $permission)
                                                        @php
                                                            $permissionValue = $permission->name;
                                                        @endphp
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="perm_{{ $permissionValue }}"
                                                                value="{{ $permissionValue }}"
                                                                name="permissions[]"
                                                                {{ in_array($permissionValue, old('permissions', $permissionsInDb)) ? 'checked' : '' }} />
                                                            <label class="form-check-label" for="perm_{{ $permissionValue }}">
                                                                <span class="badge bg-primary text-white">
                                                                    @lang('site.' . explode('.', $permissionValue)[1])
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- Permission table -->
                    </div> --}}
                    @include('admin.role.includes.formPermission')
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">@lang('site.edit')</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            @lang('site.discard')
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
