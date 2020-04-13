@extends('layouts.app')

@section('content')
<div class="container">
    <div>Hey {{$username}}!</div>
    <div>Fitnesslevel: {{$fitnesslevelString}}</div>
    <div>Deine Punkte: {{$totalPoints}}</div>
    <div>Dein Streak: {{$multiplier}}</div>
    @if($multiplier < 5)
    <div>Mache dein nächstes Workout innerhalb von 2 Tagen und dein Streak wird steigen!</div>
    @elseif($multiplier == 5)
    <div>Dein Streak ist am Maximum angekommen!</div>
    @endif 
</div>
@endsection
