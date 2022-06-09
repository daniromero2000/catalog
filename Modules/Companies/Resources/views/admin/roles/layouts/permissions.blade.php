<div id="accordion">
    @foreach($permissions as $key => $group)
    <div class="card mb-0">
        <div class="card-header p-0" id="heading_{{ $key }}">
            <h5 class="mb-0">
                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $key }}"
                    aria-expanded="true" aria-controls="collapse{{ $key }}">
                        Grupo {{$group[0]->permissionGroup->name}}
                </button>
            </h5>
        </div>
        <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading_{{ $key }}"
            data-parent="#accordion">
            <div class="card-body pt-3 pb-0">
                <div class="row">
                    @foreach($group as $permission)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="px-2">
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input " name="permissions[]" id="{{ $permission->id }}"
                                    type="checkbox" value="{{ $permission->id }}" @if(isset($attachedPermissionsArrayIds) &&
                                    in_array($permission->id,
                                $attachedPermissionsArrayIds))checked="checked" @endif>
                                <label class="custom-control-label"
                                    for="{{ $permission->id }}">{{ $permission->display_name }}</label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
