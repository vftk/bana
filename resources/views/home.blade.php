@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">

	            @foreach($data as $day)
	                @include('modules.day', ['day'=>$day])
	            @endforeach

	        </div>
	    </div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="book">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Boka bana</h4>
	      </div>
	      <div class="modal-body">

			<div v-show="success" class="alert alert-success">
		        Din bokning är genomförd!
			</div>

			<div v-show="error" class="alert alert-danger">
		        Det gick inte att göra din bokning. Kanske hann någon annan före?
			</div>

	      	@{{ name }} bokar följande tennistid:
	      	<h4>@{{ weekday }} @{{ day }} klockan @{{ hour }}:00 på bana @{{ court }}</h4>
	      	<div id="actionModal">
	
		      	Klickar du på den gröna knappen nedan bekräftar du också att du debiteras kostnaden via faktura i efterskott.

		        <p>
	                <div class="form-group">
	                    <textarea class="form-control" name="note" id="note" placeholder="Eventuellt meddelande i samband med bokningen..."></textarea>
	                </div>
		        </p>
		        <p>
		        	<button class="btn btn-success" v-on:click="bookSlot">Ja, jag bokar denna tid</button>
		        </p>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload();">Stäng</button>
	      </div>
	    </div>
	  </div>
	</div>
@endsection

@section('scripts')

	<script>
	    $( document ).ready(function() {
		    $('#book').on('show.bs.modal', function(event) {
		    	var slotId = $(event.relatedTarget).data('id');

		    	$.ajax({
				  method: "GET",
				  url: "/slots/"+slotId
				}).done(function( result ) {

					var error = false;
					if(result.user_id) {
						error = true;
				      	$('#actionModal').hide();
					}

			    	var bookModal = new Vue({
					  el: '#book',
					  data: {
					  	name: '{{ Auth::user()->name }}',
					  	id: slotId,
					  	day: result.day,
					  	hour: result.hour,
					  	court: result.court,
					  	weekday: result.weekday_title,
					  	error: error,
					  	success: false,
					  },
						methods: {
						  bookSlot: function (e) {
						    e.preventDefault();
						    $.ajax({
						      method: "PUT",
						      url: '/slots/' + this.id,
						      data: {
						      	'_token':'{{ csrf_token() }}'
						      },
						      success:function(data) {
						      	bookModal.success=true;
						      	$('#actionModal').hide();
						      },
						      error:function(err) {
						      	bookModal.error=true;
						      	$('#actionModal').hide();
						      }
						    });

						  }
						}
   					});

				});

		    });
        });
    </script>

@endsection