@extends('layouts.app')

@section('content')
<div class="container">
    <div>Mein Fitnesslevel: {{$fitnesslevelString}}</div>
    <div id="clock" class="stickyTime"><span id="demo">16m 0s</span> Minuten übrig!</div>
    <button type="button" onclick="countDown();" style="margin-bottom:20px;" id="WoStartButton">Starte dein Workout</button>

    <div>
        <button type="button" class="explainWorkout" data-toggle="collapse" data-target="#explainWorkout">Wie funktioniert das Workout?</button>
        <div id="explainWorkout" class="collapse">
            Das Workout dauert insgesamt 16 Minuten. Jede Übung dauert genau 4 Minuten und jede Übung hat 2 Sätze. 
            Ein Satz dauert 2 Minuten. Mache in diesen 2 Minuten die Übung 12 Mal. Wenn von den 2 Minuten noch Zeit 
            übrig ist, dann mach in der restlichen Zeit Pause. In manchen Beinübungen musst du die Übung 1 mal mit dem
            linken Fuß und einmal mit dem rechten Fuß absolvieren. Hier machst du die Übung 12 mal pro Bein. 
            Beispiel: Wenn die Uhr von 16 runter zählt und die erste Übung Liegestütz sind, dann machst du von Minute
            16 bis Minute 14 12 Liegestütz. Ab Minute 14 bis Minute 12 machst du nocheinmal 12 Liegestütz. Von Minute 12 bis 10
            machst du dann die nächste Übung. Dieser Übungsmodus bleibt immer der gleiche, du dir diesen Erklärungstext also nur 
            1 mal durchlesen und kannst ihn von nun an ignorieren. 
        </div>
    </div>

    <div style="margin-bottom:50px; margin-top:50px">
        <div class="ExerciseHeading margingWorkoutInbetween">
            1: {{$randomPush->name}}
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomPush->src}}" class="imageWidth"> 
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomPush->description}}
        </div>
    </div>

    <div style="margin-bottom:50px">
        <div class="ExerciseHeading margingWorkoutInbetween">
            2: {{$randomLeg->name}}
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomLeg->src}}" class="imageWidth"> 
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomLeg->description}}
        </div>
    </div>

    <div style="margin-bottom:50px">
        <div class="ExerciseHeading margingWorkoutInbetween">
            3: {{$randomPull->name}}
        </div>
        <div class="margingWorkoutInbetween">
            <img src="{{$randomPull->src}}" class="imageWidth"> 
        </div>
        <div class="margingWorkoutInbetween widthWorkoutDescription">
            {{$randomPull->description}}
        </div>
    </div>

    <div style="margin-bottom:50px">
        <div class="ExerciseHeading margingWorkoutInbetween">
            4: {{$randomBackCore->name}}
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
        const DURATION_IN_MINUTES = 0.1;
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

            if (distance < 0) {
                clearInterval(updateCountdownEverySecond);
                document.getElementById("clock").innerHTML = "Geschafft!";
                updateUserAfterWorkoutIsFinished();
            }
        }, 1000);
    }
</script>