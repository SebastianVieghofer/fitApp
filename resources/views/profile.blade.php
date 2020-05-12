@extends('layouts.app')

@section('content')
<div class="container">
    <div class="highlightTeamData defineWidthProfile" id="teamHeading1">Hey {{$username}}!</div>
    </br>
    <div id="containerProfile">
        <div class="makeMarginBottomProfile">Aktivität: <span class="highlightProfileItems">{{$fitnesslevelString}}</span></div>
        <div class="makeMarginBottomProfile">Team: <span class="highlightProfileItems">{{$team}}</span></div>
        <div class="makeMarginBottomProfile">Deine Punkte: <span class="highlightProfileItems">{{$totalPoints}}</span></div>
        <div class="makeMarginBottomProfile">Dein Streak: <span class="highlightProfileItems">{{$multiplier}}</span></div>
        @if($multiplier < 5)
        <details>
            <summary>Was ist ein Streak?</summary>
            <div>Mache dein nächstes Workout innerhalb von 2 Tagen und dein Streak wird steigen! Ist deine letzte Trainingseinheit mehr als 2 Tage her wird dein Streak wieder auf 1.00 zurückgesetzt! Für jede Trainingseinheit bekommst du Punkte, welche mit deinem Streak multipliziert werden.</div>
        </details>
        
        @elseif($multiplier == 5)
        <div>Dein Streak ist am Maximum angekommen!</div>
        @endif 
    </div>
</div>
@endsection
