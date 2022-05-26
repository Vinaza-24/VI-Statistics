@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{session('danger')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(@Auth::user()->hasRole('CoachTeam'))
            <div class="row justify-content-center">
                <div class="row" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;">
                    <div class="col-sm-8">
                        <h2 class="card-header"><i class="fa-solid fa-basketball"></i> {{__('My Players')}}</h2>
                    </div>
                    <div class="col-sm-4">
                        <h2 class="card-header">Players {{$players->count()-1}}/12 </h2>
                    </div>
                </div>
                <div class="row align-content-center" style="margin-bottom: 3%">
                    @foreach($players as $player)
                        @if($player->position !== 'Coach')
                            <div class="col-sm-6  col-md-4 m-6 mb-3 mt-3">
                                <div class="card" style="float: left;  background-color: white">
                                    <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$player->name}}</h5>
                                        <h5 class="card-title">Position <i class="fa-solid fa-arrow-right"></i> {{$player->position}}</h5>
                                        <h5 class="card-title">Number <i class="fa-solid fa-arrow-right"></i> {{$player->id}}</h5>
                                        <a href="{{ route('panel.whatch.player', ['id_player' => $player->id]) }}"  class="btn center" style="color: white; text-shadow: 0 0 5px black; float:left; margin-right: 1%; width: 100%; background-color: #17408B !important;"><i class="fa-solid fa-eye"></i> Show</a>

                                        <form method="POST" action="{{ route('panel.create.player.delete')}}" name="deleteAlert{{$player->id}}" id="deleteAlert{{$player->id}}">
                                            @csrf
                                            <input type="hidden" id="id" name="id" value="{{$player->id}}">
                                            <p id="cancelar" class="btn btn-danger" onclick="deleteAlert({{$player->id}})" style="color: white; text-shadow: 0 0 5px black; float:left; margin-top: 1%; margin-right: 1%; width: 100%;">Remove from template</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
            @if(@Auth::user()->hasRole('Player'))
                <div class="card-header container" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;">{{ __('Player ') . Auth::user()->id }}</div>
                    <div class="card container" style="background-color: white !important; margin-bottom: 5%;">
                        <div class="container-fluid">
                            <div class="row" style="margin-top: 5%; text-align: center; display: flex; align-items: center;">
                                <div class="col-md-4">
                                    <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6"  class="rounded-circle" style="width: 5rem" />
                                    <h5>{{Auth::user()->name}}</h5>
                                </div>
                                <div class="col-md-4">
                                    <label style="font-weight: bold">Birth Date:</label>
                                    <h5>{{Auth::user()->birth_date}}</h5>
                                </div>
                                <div class="col-md-4">
                                    <label style="font-weight: bold">Position:</label>
                                    <h5>{{Auth::user()->position}}</h5>
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
            @endif

    </div>
@endsection


@push('alert-card-players')
    <script>
        $(document).ready(function()
        {
            if(document.getElementById('alertpruebas')){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You have the maximum number of players in your team!'
                })
            }
        });

        function deleteAlert(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                document.getElementById('deleteAlert'+id).submit();
            })
        }

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
                        radius: 150
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

