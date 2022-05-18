@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="row" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;">
            <div class="col-sm-8">
                <h2 class="card-header"><i class="fa-solid fa-basketball"></i> {{__('Player Pool')}}</h2>
            </div>
            <div class="col-sm-4">
                <h2 class="card-header">Nº Players: {{$players->count()-1}} </h2>
            </div>
        </div>
        <div class="row align-content-center" style="margin-bottom: 3%">
            @foreach($players as $player)
                @if($player->position !== 'Coach')
                    <div class="col-sm-3 m-6 mb-3 mt-3">
                        <div class="card" style="float: left;  background-color: white">
                            <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$player->name}}</h5>
                                <h5 class="card-title">Position <i class="fa-solid fa-arrow-right"></i> {{$player->position}}</h5>
                                <h5 class="card-title">Number <i class="fa-solid fa-arrow-right"></i> {{$player->id}}</h5>
                                <a href="{{ route('panel.whatch.player', ['id_player' => $player->id]) }}"  class="btn center" style="color: white; text-shadow: 0 0 5px black; float:left; margin-right: 1%; width: 100%; background-color: #17408B !important;"><i class="fa-solid fa-eye"></i> Show</a>
                                <a href="{{ route('panel.hire.player', ['id_player' => $player->id]) }}"  class="btn center btn-success" style="color: white; text-shadow: 0 0 5px black; float:left; margin-right: 1%; width: 100%;">Hire</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
