<div class="panel panel-{{ $day->weekday==6 ? 'primary' : 'danger' }}">
    <div class="panel-heading">{{ $day->day }} {{ $day->weekday==6 ? 'LÖRDAG' : 'SÖNDAG' }}</div>
    <div class="panel-body">
    	@foreach( $day->hours as $hour )
	    	@include( 'modules.hour', [ 'hour'=>$hour ] )
		@endforeach
    </div>
</div>
