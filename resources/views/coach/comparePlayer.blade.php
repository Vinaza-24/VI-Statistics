@extends('layouts.app')

@section('content')

    <div class="card-header container" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;  display: flex; justify-content: space-between; align-items: center;">
        <h5>{{ __('Compare ')}}</h5>
        <a class="navbar-brand" href="{{ route('home') }}" style="color: white !important;">
            <i class="fa-solid fa-reply"></i>
        </a>
    </div>
    <div class="card container" style="background-color: white !important; margin-bottom: 5%;">
        <div class="container-fluid">
            <div class="row m-3">
                <div class="col-md-12">
                    <img src="http://localhost/vistatistics/resources/images/vistatistics.png" class="rounded mx-auto d-block" width="100rem"height="100rem">
                    <p>
                        Desde aquí puedes acceder a la lista de los jugadores que juegan o han jugado en la NBA a lo largo de la historia de la liga por orden alfabético así como a diversas clasificaciones y rankings de jugadores destacados y a sus datos personales, noticias y estadísticas a lo largo de su carrera, tanto en temporada regular como en playoff.
                    </p>
                </div>
            </div>
    <form method="POST" id="formulario" name="formulario" action="{{ route('panel.compare.statistics') }}">
        @csrf
            <div class="row m-5">
                <div class="col-md-6">
                    <label style="font-weight: bold">Player 1:</label>
                    <select class="form-select" aria-label="Default select example" id="player1" name="player1">
                        @foreach($players as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label style="font-weight: bold">Player 2:</label>
                    <select class="form-select" aria-label="Default select example" id="player2" name="player2">
                        @foreach($players as $player)
                        <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row m-5">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-lg btn-block" value="Compare" />
                </div>
            </div>
    </form>
        </div>
    </div>
@endsection
@push('compare-player')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("formulario").addEventListener('submit', validarFormulario);
        });

        function validarFormulario(evento) {
            evento.preventDefault();
            var p1 = document.getElementById('player1').value;
            var p2 = document.getElementById('player2').value;
            if(p1 === p2) {
                Swal.fire({
                    title: 'Oops...',
                    text: "You cannot compare a player with the same player.",
                    icon: 'error',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonText: 'Ok'
                })
            }else{
                this.submit();
            }
        }
    </script>
@endpush
