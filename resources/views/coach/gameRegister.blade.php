@extends('layouts.app')

@section('content')
    <input type="hidden" id="alertaMenos5Players" value="{{$array['numPlayers']}}" />

    @if($array['numPlayers'] >= 5)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="margin-bottom: 10%;">
                        <div class="card-header" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black; display: flex; justify-content: space-between; align-items: center;">
                            <h5>{{ __('Create Game') }}</h5>
                            <a class="navbar-brand" href="{{ route('home') }}" style="color: white !important;">
                                <i class="fa-solid fa-reply"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('panel.create.game.create') }}">
                                @csrf

                                <div class="row">

                                    <div class="col-md-12">
                                        <label>Opposing team</label>
                                        <select class="form-select" id="team2" name="team2">
                                            @foreach($array['teams'] as $team)
                                                @if($team->name != "Sin Equipo")
                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 2%">
                                        <input name="date_game" id="date_game" type="date" class="form-control @error('date_game') is-invalid @enderror"  value="{{ old('date_game') }}" required autocomplete="date_game">

                                        @error('date_game')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Min</th>
                                        <th scope="col">Pts</th>
                                        <th scope="col">Reb</th>
                                        <th scope="col">Ast</th>
                                        <th scope="col">Rob</th>
                                        <th scope="col">Tap</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($array['players'] as $player)
                                        <tr>
                                            <td>{{$player->name}}</td>
                                            <td data-toggle="tooltip" data-placement="top" title="Min"><input type="number" class="form-control" id="Min{{$player->id}}" name="Min{{$player->id}}" value="0"></td>
                                            <td data-toggle="tooltip" data-placement="top" title="Pts"><input type="number" class="form-control" id="Pts{{$player->id}}" name="Pts{{$player->id}}" value="0"></td>
                                            <td data-toggle="tooltip" data-placement="top" title="Reb"><input type="number" class="form-control" id="Reb{{$player->id}}" name="Reb{{$player->id}}" value="0"></td>
                                            <td data-toggle="tooltip" data-placement="top" title="Ast"><input type="number" class="form-control" id="Ast{{$player->id}}" name="Ast{{$player->id}}" value="0"></td>
                                            <td data-toggle="tooltip" data-placement="top" title="Rob"><input type="number" class="form-control" id="Rob{{$player->id}}" name="Rob{{$player->id}}" value="0"></td>
                                            <td data-toggle="tooltip" data-placement="top" title="Top"><input type="number" class="form-control" id="Tap{{$player->id}}" name="Tap{{$player->id}}" value="0"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" style="width: 100%;" class="btn btn-success">Create</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection


@push('alert-card-create-game')
    <script>
        $(document).ready(function()
        {
            if(document.getElementById('alertaMenos5Players').value < 5){
                Swal.fire({
                    title: 'Oops...',
                    text: "You don't have the minimum number of players to create a match!",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Return'
                }).then((result) => {
                    window.location.href = "/home";
                })
            }
        });
    </script>
@endpush
