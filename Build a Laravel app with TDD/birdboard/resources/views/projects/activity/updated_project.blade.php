@if(count($activity->changes['after']) === 1 )
    Project's {{ key($activity->changes['after']) }}
@else
    Project
@endif
updated
