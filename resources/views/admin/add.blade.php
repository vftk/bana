@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Lägg till slots/tider</div>

                <div class="panel-body">

                    <form method="POST">
                        <div class="form-group">
                            <label for="start">Startdatum</label>
                            <input type="text" class="form-control" name="start" placeholder="{{ date('Y-m-d') }}" value="{{ old('start') }}">
                        </div>
                        <div class="form-group">
                            <label for="stop">Till och med</label>
                            <input type="text" class="form-control" name="stop" placeholder="{{ date('Y-m-d', time()+3600*24*14) }}" value="{{ old('stop') }}">
                        </div>
                        <button type="submit" class="btn btn-danger">Skapa Lördagar+Söndagar</button>
                        {!! csrf_field() !!}
                    </form>

                    @if(isset($result))
                        <p>&nbsp;</p>
                        <div class="alert alert-info">
                            {!! $result !!}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
