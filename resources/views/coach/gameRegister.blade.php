@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 10%;">
                <div class="card-header" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;">{{ __('Create Game') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('panel.create.game.create') }}">
                        @csrf

                        <div class="row">

                        <div class="col-md-12">
                            <label>Opposing team</label>
                            <select class="form-select" id="team2" name="team2">
                                <option selected>Opposing team</option>
                                @foreach($array['teams'] as $team)
                                    @if($team->name != "Sin Equipo")
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12" style="margin-top: 2%">
                            <input class="form-control" type="date" id="date_game" name="date_game">
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
                                <td><input type="number" class="form-control" id="Min{{$player->id}}" name="Min{{$player->id}}" value="0"></td>
                                <td><input type="number" class="form-control" id="Pts{{$player->id}}" name="Pts{{$player->id}}" value="0"></td>
                                <td><input type="number" class="form-control" id="Reb{{$player->id}}" name="Reb{{$player->id}}" value="0"></td>
                                <td><input type="number" class="form-control" id="Ast{{$player->id}}" name="Ast{{$player->id}}" value="0"></td>
                                <td><input type="number" class="form-control" id="Rob{{$player->id}}" name="Rob{{$player->id}}" value="0"></td>
                                <td><input type="number" class="form-control" id="Tap{{$player->id}}" name="Tap{{$player->id}}" value="0"></td>
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
@endsection
