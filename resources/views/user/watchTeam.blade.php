@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="card">
                <div class="card-header" style="background-color: #17408B; color: white">
                        <h4>{{ __('My Team') }}</h4>
                </div>
                <div class="card-body" style="align-self: center;">
                    <table class="table table-responsive" style="width: 100%;">
                        <thead class="thead" style="background-color: #17408b!important;color: white; font-weight: bold;">
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
                        @foreach ($avg as $player)
                            @if($player->minutos != null)
                                <tr>
                                    <td>{{$player->name}}</td>
                                    <td>{{number_format($player->minutos, 2)}}</td>
                                    <td>{{number_format($player->puntos, 2)}}</td>
                                    <td>{{number_format($player->rebotes, 2)}}</td>
                                    <td>{{number_format($player->asistencias, 2)}}</td>
                                    <td>{{number_format($player->robo, 2)}}</td>
                                    <td>{{number_format($player->tapones, 2)}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$player->name}}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                <div/>
            </div>
    </div>
@endsection


