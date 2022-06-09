<div id="accordion">
    @foreach($permissions as $key => $group)
    <div class="card mb-0">
        <div class="card-header p-0" id="heading_permission_{{ $key }}">
            <h5 class="mb-0">
                <button type="button" class="btn btn-link" data-toggle="collapse"
                    data-target="#collapse_permission_{{ $key }}" aria-expanded="true"
                    aria-controls="collapse_permission_{{ $key }}">
                    Grupo {{$group[0]->permissionGroup->name}}
                </button>
            </h5>
        </div>
        <div id="collapse_permission_{{ $key }}" class="collapse" aria-labelledby="heading_permission_{{ $key }}"
            data-parent="#accordion">
            <div class="card-body bg-secondary">
                @foreach($group as $permission)
                <div id="action_accordion_{{ $permission->id }}">
                    @foreach($actions as $actionsKey => $actionsGroup)
                    @if ($actionsKey == $permission->id)
                    <div class="card mb-0">
                        <div class="card-header p-0" id="heading_action_{{ $actionsKey }}">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                    data-parent="#action_accordion_{{ $actionsKey }}"
                                    data-target="#collapse_action_{{ $actionsKey }}" aria-expanded="true"
                                    aria-controls="collapse_action_{{ $actionsKey }}">
                                    Grupo {{$actionsGroup[0]->permission->display_name}}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse_action_{{ $actionsKey }}" class="collapse"
                            aria-labelledby="heading_action_{{ $actionsKey }}" data-parent="#accordion">
                            <div class="card-body pt-3 pb-0">
                                <div class="row">
                                    @foreach($actionsGroup as $action)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                        <div class="px-2">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input " name="actions[]"
                                                    id="{{ $action->id }}" type="checkbox" value="{{ $action->id }}"
                                                    @if(isset($attachedActionsArrayIds) && in_array($action->id,
                                                $attachedActionsArrayIds))checked="checked" @endif>
                                                <label class="custom-control-label"
                                                    for="{{ $action->id }}">{{ $action->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
