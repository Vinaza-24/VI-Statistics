@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="card" style="margin-bottom: 5%;">
                <div class="card-header" style="background-color: #17408B; color: white; display: flex; justify-content: space-between; align-items: center;">
                        <h5>{{ __('My Team') }}</h5>
                        <a class="navbar-brand" href="{{ route('home') }}" style="color: white !important;">
                            <i class="fa-solid fa-reply"></i>
                        </a>
                </div>
                <div class="card-body" style="align-self: center;">
                    <table class="table">
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
                                    <td data-toggle="tooltip" data-placement="top" title="Name">{{$player->name}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Min">{{number_format($player->minutos, 2)}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Pts">{{number_format($player->puntos, 2)}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Reb">{{number_format($player->rebotes, 2)}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Ast">{{number_format($player->asistencias, 2)}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Rob">{{number_format($player->robo, 2)}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Tap">{{number_format($player->tapones, 2)}}</td>
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


