@extends('layouts.app')


@section('content')
<div class="container">
    <div>
        <div id="teamLeft">
            <div class="teamHeading" id="teamHeading1">Team @if($userTeamID === 1) Alpha @else($userTeamID === 2) Beta @endif</div>
            </br>
            <div><span class="highlightTeamData">Anzahl Team-Mitglieder: {{$numberOfTeamMates}}</span></div>
            </br>
            @foreach ($teamData as $data)
            <div>{{$data->name}} : {{number_format($data->points)}}</div>
            @endforeach
            </br>
            <div><span id="underlinePointsTeam1">Punkte: <span class="highlightTeamData">{{number_format($teamTotalPoints)}}</span></span></div>
            </br>
        </div>
        <div id="teamRight">
            <div class="teamHeading" id="teamHeading2">Team @if($enemyTeamID === 1) Alpha @else($enemyTeamID === 2) Beta @endif</div>
            </br>
            <div><span class="highlightTeamData">Anzahl Team-Mitglieder: {{$numberOfEnemys}}</span></div>
            </br>
            <div><span id="underlinePointsTeam2">Punkte: <span class="highlightTeamData">{{number_format($enemyTotalPoints)}}</span></span></div>
            </br>
        </div>
    </div>
    
    <canvas id="myChart" width="400" height="400"></canvas>
    <div class="TeamVsTeam"><span class="highlightTeamData">Alpha</span> vs <span class="highlightTeamData">Beta</span></div>

</div>
@endsection

<script>
    window.onload = function () {
        var ctx = document.getElementById('myChart');
        ctx.height = 30;
        var myBarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                datasets: [
                    {
                    label: 'Punkte meines Teams',
                    data: ['{{$teamTotalPoints}}'],
                    backgroundColor: [ '#94EDFF' ],
                    borderWidth: 1,
                    barThickness: 60,
                    },
                    {
                    label: 'Punkte gegnerisches Team',
                    data: ['{{$enemyTotalPoints}}'],
                    backgroundColor: [ '#87FFD1' ],
                    borderWidth: 1,
                    barThickness: 60,
                    }
                ],   
            },
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{ 
                        ticks: {
                            beginAtZero: true,
                            max: {{$enemyTotalPoints}}+{{$teamTotalPoints}},
                            min: 0
                        },
                        stacked: true,
                        gridLines: {
                            display:false
                        },
                        display:false
                    }],
                    yAxes: [{
                        stacked: true,
                        barPercentage: 0,
                        categoryPercentage: 0,
                        gridLines: {
                            display:false
                        }
                    }],
                }
            }
        });
    }
</script>
