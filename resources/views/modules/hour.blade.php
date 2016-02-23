<div class="col-sm-3 col-xs-6 text-center">
	<h4>{{ $hour->hour }}:00</h4>
	<hr/>
	@foreach($hour->slots as $slot)
		<p>
			<button class="btn btn-success">Boka bana {{ $slot->court }}</button>
		</p>
	@endforeach
</div>