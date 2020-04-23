@extends('layouts.app')

@section('content')
<div class="container">
    <div id="clock" class="stickyTime makeButtonInMiddle"><span id="demo">16m 0s</span></div>
    <div id="showAfterWorkout">
        <div id="teamHeading1" class="makeMarginBottomProfile settingsMiddle divWidth25">Punkte für das Workout: <span class="highlightTeamData">200</span></div>
        <div id="teamHeading1" class="makeMarginBottomProfile divWidth25">Deine Streak: <span class="highlightTeamData">{{$multiplier}}</span></div>
        <div id="teamHeading2" class="makeMarginBottomProfile divWidth25">Deine Punkte: 200 * {{$multiplier}} = <span class="highlightTeamData">{{200 * $multiplier}}</span></div>
    </div>
    <div class="makeButtonInMiddle">
        <button type="button" onclick="countDown();" style="margin-bottom:20px;" id="WoStartButton">Starte dein Workout</button>
        <div id="displayNoneWhenButtonClicked">Für manche der Übungen brauchst du ein Handtuch.</div> 
    </div>

    <div style="margin-bottom:50px; margin-top:50px" id="push">
        <div class="ExerciseHeading margingWorkoutInbetween">
            {{$randomPush->name}} 
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomPush->src}}" class="imageWidth"> 
        </div>
        <div class="highlightTeamData makeMarginBottomProfile">
            8 - 12 Wiederholungen
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomPush->description}}
        </div>
    </div>

    <div style="margin-bottom:50px" id="leg">
        <div class="ExerciseHeading margingWorkoutInbetween">
            {{$randomLeg->name}} 
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomLeg->src}}" class="imageWidth"> 
        </div>
        <div class="highlightTeamData makeMarginBottomProfile">
            8 - 12 Wiederholungen
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomLeg->description}}
        </div>
    </div>

    <div style="margin-bottom:50px" id="pull">
        <div class="ExerciseHeading margingWorkoutInbetween">
            {{$randomPull->name}} 
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomPull->src}}" class="imageWidth"> 
        </div>
        <div class="highlightTeamData makeMarginBottomProfile">
            8 - 12 Wiederholungen
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomPull->description}}
        </div>
    </div>

    <div style="margin-bottom:50px" id="backcore">
        <div class="ExerciseHeading margingWorkoutInbetween">
            {{$randomBackCore->name}} 
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomBackCore->src}}" class="imageWidth">
        </div> 
        <div class="highlightTeamData makeMarginBottomProfile">
            8 - 12 Wiederholungen
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomBackCore->description}}
        </div>
    </div>
</div>
@endsection

<script>
    function countDown()
    {
        const DURATION_IN_MINUTES = 16;
        const ONE_MINUTE = 60000;
        var workoutDuration = DURATION_IN_MINUTES * ONE_MINUTE;
        var countDownDate = new Date().getTime() + workoutDuration;

        document.getElementById("WoStartButton").style.display = "none";
        document.getElementById("displayNoneWhenButtonClicked").style.display = "none";
        document.getElementById("clock").style.display = "block";

        var updateCountdownEverySecond = setInterval(function() {
            var todaysDateAndTime = new Date().getTime();
            var distance = countDownDate - todaysDateAndTime;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

            showExerciseAccordingToDistance(distance);

            if (distance < 0) {
                clearInterval(updateCountdownEverySecond);
                document.getElementById("clock").innerHTML = "Geschafft!";
                document.getElementById("showAfterWorkout").style.display = "block";
                document.getElementById("backcore").style.display = "none";
                updateUserAfterWorkoutIsFinished();
            }
        }, 1000);
    }

    function showExerciseAccordingToDistance(distance){
        var firstTimeslot = 960000; //16 Minuten
        var secondTimeslot = 840000; //14 Minuten
        var thirdTimeslot = 720000; //12 Minuten
        var fourthTimeslot = 600000; //10 Minuten
        var fifthTimeslot = 480000; //8 Minuten
        var sixthTimeslot = 360000; //6 Minuten
        var seventhTimeslot = 240000; // 4 Minuten
        var eightTimeslot = 120000; // 2 Minuten

        if (distance < firstTimeslot && distance > secondTimeslot){
            document.getElementById("push").style.display = "block";
        }
        if (distance < secondTimeslot && distance > thirdTimeslot){
            document.getElementById("push").style.display = "none";
            document.getElementById("leg").style.display = "block";
        }
        if (distance < thirdTimeslot && distance > fourthTimeslot){
            document.getElementById("leg").style.display = "none";
            document.getElementById("pull").style.display = "block";
        }
        if (distance < fourthTimeslot && distance > fifthTimeslot){
            document.getElementById("pull").style.display = "none";
            document.getElementById("backcore").style.display = "block";
        }
        if (distance < fifthTimeslot && distance > sixthTimeslot){
            document.getElementById("backcore").style.display = "none";
            document.getElementById("push").style.display = "block";
        }
        if (distance < sixthTimeslot && distance > seventhTimeslot){
            document.getElementById("push").style.display = "none";
            document.getElementById("leg").style.display = "block";
        }
        if (distance < seventhTimeslot && distance > eightTimeslot){
            document.getElementById("leg").style.display = "none";
            document.getElementById("pull").style.display = "block";
        }
        if (distance < eightTimeslot && distance > 0){
            document.getElementById("pull").style.display = "none";
            document.getElementById("backcore").style.display = "block";
        }
    }

    function updateUserAfterWorkoutIsFinished(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'GET',
            url:'{{URL::to('/updateAfterWorkoutCompleted')}}'
        });
    }   
</script>