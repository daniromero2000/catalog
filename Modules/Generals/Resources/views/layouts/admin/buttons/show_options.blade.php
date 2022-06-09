@php
$actions = session('actionsModule');
@endphp
<div class="d-flex justify-content-center">
    @if($actions)
    @foreach ($actions as $action)
    @if(strpos($action['route'], 'show'))
    <a href="{{ route($action['route'], $id) }}" class="btn btn-primary text-white btn-sm"><i
            class="fa fa-search"></i> Ver</a>
    @endif
    @endforeach
    @endif
</div>
