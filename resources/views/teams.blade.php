@extends('layouts.app')

@section('content')
<div class="container">
    <div>Mein Team Punkte: {{$teamTotalPoints}}</div>
    </br>
    <div>Team-Mitglieder: {{$numberOfTeamMates}}</div>
    </br>
    @foreach ($teamData as $data)
    <div>{{ $data->name }} : {{ $data->points }}</div>
    @endforeach
    </br>
    <div>Punkte des Gegners: {{$enemyTotalPoints}}</div>
    </br>
    <div>Anzahl Gegner: {{$numberOfEnemys}}</div>
    </br>
    
</div>
@endsection
