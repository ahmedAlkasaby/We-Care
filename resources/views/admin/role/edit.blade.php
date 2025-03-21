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

                    @include('admin.role.includes.updatePermission')
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
