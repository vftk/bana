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
        	<input type="hidden" id="book_id" />
	        <p>
	        	{{ Auth::user()->name }} vill boka följande:
	        	<h4>Bana 3 lördagen den 19 mars klockan 15:00</h4>
	        	Du förbinder dig att betala kostnad för bokningen som faktureras i efterskott.
	        </p>
	        <p>
                <div class="form-group">
                    <textarea class="form-control" name="note" id="note" placeholder="Eventuellt meddelande i samband med bokningen..."></textarea>
                </div>
	        </p>
	        <p>
	        	<button class="btn btn-success" onclick="alert('Funktionen är inte klar...');">Ja, jag bokar denna tid</button>
	        </p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
	      </div>
	    </div>
	  </div>
	</div>
@endsection

@section('scripts')

	<script>
	    $( document ).ready(function() {
		    $('#book').on('show.bs.modal', function(event) {
		        $("#book_id").val($(event.relatedTarget).data('id'));
		    });
        });
    </script>

@endsection