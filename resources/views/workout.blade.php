@extends('layouts.app')

@section('content')
<div class="container">
    <div>Mein Fitnesslevel: {{$fitnesslevelString}}</div>
    <div id="clock" class="stickyTime"><span id="demo">16m 0s</span> Minuten übrig!</div>
    <div id="showAfterWorkout">
        <div>Punkte für das Workout: 200</div>
        <div>Deine Streak: {{$multiplier}}</div>
        <div>Deine Punkte: 200 * {{$multiplier}} = {{200 * $multiplier}}</div>
    </div>
    <button type="button" onclick="countDown();" style="margin-bottom:20px;" id="WoStartButton">Starte dein Workout</button>

    <div style="margin-bottom:50px; margin-top:50px" id="push">
        <div class="ExerciseHeading margingWorkoutInbetween">
            {{$randomPush->name}}
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomPush->src}}" class="imageWidth"> 
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
            document.getElementById("backcore").style.display = "block";
        }
        if (distance < fifthTimeslot && distance > sixthTimeslot){
            document.getElementById("push").style.display = "block";
        }
        if (distance < sixthTimeslot && distance > seventhTimeslot){
            document.getElementById("leg").style.display = "block";
        }
        if (distance < seventhTimeslot && distance > eightTimeslot){
            document.getElementById("pull").style.display = "block";
        }
        if (distance < eightTimeslot && distance > 0){
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
            url:'/updateAfterWorkoutCompleted',
        });
    }
</script>