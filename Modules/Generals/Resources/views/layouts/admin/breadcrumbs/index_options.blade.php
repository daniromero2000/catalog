@php
$actions = session('actionsModule');
@endphp

@if($actions)
@foreach ($actions as $action)
@if(strpos($action['route'], 'index'))
<a href="{{route('admin.redirectAction', [$action['id']])}}">{{$module}}</a>
@endif
@endforeach
@endif
