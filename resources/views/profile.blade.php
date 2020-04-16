@extends('layouts.app')

@section('content')
<div class="container">
    <div class="highlightTeamData defineWidthProfile" id="teamHeading1">Hey {{$username}}!</div>
    </br>

    <div id="containerProfile">
        <div class="makeMarginBottomProfile">Aktivität: <span class="highlightProfileItems">{{$fitnesslevelString}}</span></div>
    </div>
</div>
@endsection
