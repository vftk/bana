<div class="panel panel-{{ $day->weekday==6 ? 'primary' : 'danger' }}">
    <div class="panel-heading">
    	<div class="row">
    		<div class="col-xs-4">
				<h4>{{ $day->weekday==6 ? 'LÖRDAG' : 'SÖNDAG' }}</h4>
    		</div>
    		<div class="col-xs-4 text-center">
				<h4 style="white-space: nowrap;">{{ $day->day }}</h4>
    		</div>
    		<div class="col-xs-4 pull-right text-right">
				<h4>VECKA {{ $day->week }}</h4>
    		</div>
    	</div>
    </div>
    <div class="panel-body">
   		<div class="row">
	    	@foreach( $day->hours as $hour )
			    	@include( 'modules.hour', [ 'hour'=>$hour ] )
			@endforeach
	   	</div>
	</div>
</div>
