@extends('layouts.app')

@section('content')

    <div class="card-header container" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;  display: flex; justify-content: space-between; align-items: center;">
        <h5>{{ __('Compare ')}}</h5>
        <a class="navbar-brand" href="{{ route('panel.compare.players') }}" style="color: white !important;">
            <i class="fa-solid fa-reply"></i>
        </a>
    </div>
    <div class="card container" style="background-color: white !important; margin-bottom: 5%;">
        <div style="margin-bottom: 5%;">
            <input type="hidden" id="namePlayer1"  value="{{$namePlayer1}}"/>
            <input type="hidden" id="namePlayer2"  value="{{$namePlayer2}}"/>

                <input type="hidden" id="minP1"  value="{{number_format($mediaPlayer1->minutos, 2)}}"/>
                <input type="hidden" id="punP1"  value="{{number_format($mediaPlayer1->puntos, 2)}}"/>
                <input type="hidden" id="rebP1"  value="{{number_format($mediaPlayer1->rebotes, 2)}}"/>
                <input type="hidden" id="asiP1"  value="{{number_format($mediaPlayer1->asistencias, 2)}}"/>
                <input type="hidden" id="robP1"  value="{{number_format($mediaPlayer1->robo, 2)}}"/>
                <input type="hidden" id="tapoP1" value="{{number_format($mediaPlayer1->tapones, 2)}}"/>

                <input type="hidden" id="minP2"  value="{{number_format($mediaPlayer2->minutos, 2)}}"/>
                <input type="hidden" id="punP2"  value="{{number_format($mediaPlayer2->puntos, 2)}}"/>
                <input type="hidden" id="rebP2"  value="{{number_format($mediaPlayer2->rebotes, 2)}}"/>
                <input type="hidden" id="asiP2"  value="{{number_format($mediaPlayer2->asistencias, 2)}}"/>
                <input type="hidden" id="robP2"  value="{{number_format($mediaPlayer2->robo, 2)}}"/>
                <input type="hidden" id="tapoP2" value="{{number_format($mediaPlayer2->tapones, 2)}}"/>

            <div id="chart-containerP1"></div>
            <div id="chart-containerP2"></div>
        </div>
    </div>
@endsection
@push('echarts-player-compare')

    <script>
        let namePlayer1 = document.getElementById("namePlayer1")?.value;
        let namePlayer2 = document.getElementById("namePlayer2")?.value;

        let minP1 = document.getElementById("minP1")?.value;
        let punP1 = document.getElementById("punP1")?.value;
        let asiP1 = document.getElementById("asiP1")?.value;
        let rebP1 = document.getElementById("rebP1")?.value;
        let robP1 = document.getElementById("robP1")?.value;
        let tapoP1 = document.getElementById("tapoP1")?.value;

        let minP2 = document.getElementById("minP2")?.value;
        let punP2 = document.getElementById("punP2")?.value;
        let asiP2 = document.getElementById("asiP2")?.value;
        let rebP2 = document.getElementById("rebP2")?.value;
        let robP2 = document.getElementById("robP2")?.value;
        let tapoP2 = document.getElementById("tapoP2")?.value;

        var domP1 = document.getElementById('chart-containerP1');
        var myChartP1 = echarts.init(domP1, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var appP1 = {};

        var optionP1;

        optionP1 = {
            title: {
                text: namePlayer1,
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'horizontal',
                top: 30,
                left: 'center'
            },
            series: [
                {
                    name: 'Access From',
                    type: 'pie',
                    radius: '40%',
                    data: [
                        { value: minP1, name: 'Minutos' },
                        { value: punP1, name: 'Puntos' },
                        { value: asiP1, name: 'Asistencias' },
                        { value: rebP1, name: 'Rebotes' },
                        { value: robP1, name: 'Robos' },
                        { value: tapoP1, name: 'Tapones' }
                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };

        if (optionP1 && typeof optionP1 === 'object') {
            myChartP1.setOption(optionP1);
        }

        window.addEventListener('resize', myChartP1.resize);

        var domP2 = document.getElementById('chart-containerP2');
        var myChartP2 = echarts.init(domP2, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var appP2 = {};

        var optionP2;

        optionP2 = {
            title: {
                text: namePlayer2,
                top: 10,
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'horizontal',
                top: 30,
                left: 'center'
            },
            series: [
                {
                    name: 'Access From',
                    type: 'pie',
                    radius: '40%',
                    data: [
                        { value: minP2, name: 'Minutos' },
                        { value: punP2, name: 'Puntos' },
                        { value: asiP2, name: 'Asistencias' },
                        { value: rebP2, name: 'Rebotes' },
                        { value: robP2, name: 'Robos' },
                        { value: tapoP2, name: 'Tapones' }
                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };

        if (optionP2 && typeof optionP2 === 'object') {
            myChartP2.setOption(optionP2);
        }

        window.addEventListener('resize', myChartP2.resize);
    </script>
@endpush
