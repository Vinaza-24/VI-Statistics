@extends('layouts.app')

@section('content')

    <div class="card-header container" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;  display: flex; justify-content: space-between; align-items: center;">
        <h5>{{ __('Player ') . $player->id }}</h5>
        <a class="navbar-brand" href="{{ route('home') }}" style="color: white !important;">
            <i class="fa-solid fa-reply"></i>
        </a>
    </div>
    <div class="card container" style="background-color: white !important; margin-bottom: 5%;">
        <div class="container-fluid">
            <div class="row" style="margin-top: 5%; text-align: center; display: flex; align-items: center;">
                <div class="col-md-4">
                    <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6"  class="rounded-circle" style="width: 5rem" />
                    <h5>{{$player->name}}</h5>
                </div>
                <div class="col-md-4">
                    <label style="font-weight: bold">Birth Date:</label>
                    <h5>{{$player->birth_date}}</h5>
                </div>
                <div class="col-md-4">
                    <label style="font-weight: bold">Position:</label>
                    <h5>{{$player->position}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style=" display: flex; align-items: center; justify-content: center;">
                    <div id="chart-container" style="width: 30rem; height: 30rem"></div>
                    @if($noAVG == 1)
                        <input type="hidden" id="min"  value="0"/>
                        <input type="hidden" id="pun"  value="0"/>
                        <input type="hidden" id="reb"  value="0"/>
                        <input type="hidden" id="asi"  value="0"/>
                        <input type="hidden" id="rob"  value="0" />
                        <input type="hidden" id="tapo" value="0"/>
                    @else
                        <input type="hidden" id="min"  value="{{number_format($avg->minutos, 2)}}"/>
                        <input type="hidden" id="pun"  value="{{number_format($avg->puntos, 2)}}"/>
                        <input type="hidden" id="reb"  value="{{number_format($avg->rebotes, 2)}}"/>
                        <input type="hidden" id="asi"  value="{{number_format($avg->asistencias, 2)}}"/>
                        <input type="hidden" id="rob"  value="{{number_format($avg->robo, 2)}}"/>
                        <input type="hidden" id="tapo" value="{{number_format($avg->tapones, 2)}}"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('echarts-player')

    <script>
        $(document).ready(function () {
            let min = document.getElementById("min")?.value;
            let pun = document.getElementById("pun")?.value;
            let asi = document.getElementById("asi")?.value;
            let reb = document.getElementById("reb")?.value;
            let rob = document.getElementById("rob")?.value;
            let tapo = document.getElementById("tapo")?.value;

            var dom = document.getElementById('chart-container');
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option;

            option = {
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    left: 'center',
                    data: [
                        'A Software',
                    ]
                },
                radar: [
                    {
                        indicator: [
                            {name: 'Minutos', max: 48},
                            {name: 'Puntos', max: 60},
                            {name: 'Asistencias', max: 15},
                            {name: 'Rebotes', max: 30},
                            {name: 'Robos', max: 10},
                            {name: 'Tapones', max: 10}
                        ],
                        center: ['50%', '50%'],
                        radius: 120
                    },
                ],
                series: [
                    {
                        type: 'radar',
                        tooltip: {
                            trigger: 'item'
                        },
                        areaStyle: {},
                        data: [
                            {
                                value: [min, pun, asi, reb, rob, tapo],
                                name: 'Statistics'
                            }
                        ]
                    },
                ]
            };

            if (option && typeof option === 'object') {
                myChart.setOption(option);
            }

            window.addEventListener('resize', myChart.resize);
        });
    </script>
@endpush
