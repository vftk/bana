<div class="col-sm-3 col-xs-6 text-center">
	<h4>{{ $hour->hour }}:00</h4>
	<hr/>
	@foreach($hour->slots as $slot)
		@if($slot->user_id)
		<p>
			<button class="btn btn-danger btn-outline" onclick="alert('Tiden är redan reserverad!')">Boka bana {{ $slot->court }}</button>
		</p>
		@else
		<p>
			<button class="btn btn-success" data-toggle="modal" data-target="#book" data-id="{{ $slot->id }}">Boka bana {{ $slot->court }}</button>
		</p>
		@endif
	@endforeach
</div>