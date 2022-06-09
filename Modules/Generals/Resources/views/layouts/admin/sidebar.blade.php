@php
$permissions = session('permission');
@endphp
<ul class="navbar-nav">
    @if ($permissions)
    @foreach ($permissions as $group => $value)
    <li class="nav-item">
        <a class="nav-link">
            <h6 class="navbar-heading p-0 text-muted">{{$group}}</h6>
        </a>
        @foreach($permissions[$group] as $key => $module )
        <a class="nav-link @if(request()->segment(2) == $module['name']) active @endif" href="
                #{{$module['name']}}" data-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="{{$module['name']}}">
            <i class="{{$module['icon']}}"></i>
            {{-- <i class="nav-icon {{$module['icon']}}" aria-hidden="true"></i> --}}
            <span class="nav-link-text">{{ $module['display_name'] }}</span>
        </a>
        @foreach ($module['actionsPrincipal'] as $action)
        <div class="collapse" id="{{$module['name']}}">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{route('admin.redirectAction', [$action['id']])}}"
                        class="nav-link">{{$action['name']}}</a>
                </li>
            </ul>
        </div>
        @endforeach
        @endforeach
    </li>
    @endforeach
    @endif
</ul>
