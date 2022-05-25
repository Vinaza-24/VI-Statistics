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
            <div class="card">
                <div class="card-header" style="background-color: #17408B; color: white">
                    <h4>My statistics:</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive" style="width: 100%; margin-bottom: 10%">
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
                            <td>{{number_format($avg->minutos, 2)}}</td>
                            <td>{{number_format($avg->puntos, 2)}}</td>
                            <td>{{number_format($avg->rebotes, 2)}}</td>
                            <td>{{number_format($avg->asistencias, 2)}}</td>
                            <td>{{number_format($avg->robo, 2)}}</td>
                            <td>{{number_format($avg->tapones, 2)}}</td>
                        @endif

                        </tbody>
                    </table>
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
    </script>
@endpush
