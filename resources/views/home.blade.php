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
@endsection
