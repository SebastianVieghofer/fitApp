@extends('layouts.app')

@section('content')
<div class="container">
    <div>Hallo {{$username}}</div>
    <div>Fitnesslevel: {{$fitnesslevelString}}</div>
</div>
@endsection
