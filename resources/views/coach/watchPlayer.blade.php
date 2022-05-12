@extends('layouts.app')

@section('content')

    <div class="card-header container" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;">{{ __('Player ') . $player->id }}</div>
    <div class="card container" style="background-color: white !important; margin-bottom: 5%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-6" >
                                <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="card-img-top" alt="...">

                            </div>
                            <div class="col-md-6" style="display: flex;flex-direction: column; justify-content: space-evenly;">
                                <div class="row">
                                    <div class="col-md-12"  style="width: 100%; margin-bottom: 10%">
                                        <label style="font-weight: bold">Name:</label>
                                        <input type="text" style="width: 100%;" value="{{$player->name}}"  readonly/>

                                        <label style="font-weight: bold">Birth Date:</label>
                                        <input type="text" style="width: 100%;" value="{{$player->birth_date}}"  readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="width: 100%; margin-bottom: 10%">
                                        <label style="font-weight: bold">Position:</label>
                                        <input type="text" style="width: 100%;" value="{{$player->position}}"  readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center">
                                        <table class="table table-responsive-md" style="width: 100%; margin-bottom: 10%">
                                            <thead class="thead" style="background-color: #17408b!important;color: white; font-weight: bold;">
                                            <tr>
                                                <th scope="col">Min</th>
                                                <th scope="col">Pts</th>
                                                <th scope="col">Reb</th>
                                                <th scope="col">Ast</th>
                                                <th scope="col">Rob</th>
                                                <th scope="col">Tap</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($noAVG == 1)
                                                <td> Not statistics </td>
                                                <td> Not statistics </td>
                                                <td> Not statistics </td>
                                                <td> Not statistics </td>
                                                <td> Not statistics </td>
                                                <td> Not statistics </td>
                                            @else
                                                <td>{{$avg->minutos}}</td>
                                                <td>{{$avg->puntos}}</td>
                                                <td>{{$avg->rebotes}}</td>
                                                <td>{{$avg->asistencias}}</td>
                                                <td>{{$avg->robo}}</td>
                                                <td>{{$avg->tapones}}</td>
                                            @endif

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
