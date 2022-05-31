@extends('layouts.app')

@section('content')
    <input type="hidden" id="alertaNoQuintetos" value="{{ $numQuintet }}" />

    @if($numQuintet != 0)
    <div class="container">
        <div class="parentWatch">
            <div class="div1Watch">
                <div class="container">
                    <select class="form-select" name='nombreQuintet' id='nombreQuintet' onchange='loadQuintet()'>
                        @foreach($quintets as $quintet)
                            <option value="{{$quintet->id}}">{{$quintet->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="div3Watch posicionCard">
                <div class="dra">
                    <div class="col-md-12 cardQuintet">
                        <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="rounded-circle" />

                        <p class="p1 p">Nombre Jugador</p>
                    </div>
                </div>
            </div>
            <div class="div4Watch posicionCard">
                <div class="dra">
                    <div class="col-md-12 cardQuintet">
                        <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="rounded-circle" />

                        <p class="p2 p">Nombre Jugador</p>
                    </div>
                </div>
            </div>
            <div class="div5Watch posicionCard">
                <div class="dra">
                    <div class="col-md-12 cardQuintet">
                        <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="rounded-circle" />

                        <p class="p3 p">Nombre Jugador</p>
                    </div>
                </div>
            </div>
            <div class="div6Watch posicionCard">
                <div class="dra">
                    <div class="col-md-12 cardQuintet">
                        <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="rounded-circle" />

                        <p class="p4 p">Nombre Jugador</p>
                    </div>
                </div>
            </div>
            <div class="div7Watch posicionCard">
                <div class="dra">
                    <div class="col-md-12 cardQuintet">
                        <img src="https://us.123rf.com/450wm/jemastock/jemastock1707/jemastock170708629/81879106-jugador-de-baloncesto-masculino-atleta-deporte-avatar-icono-imagen-vector-ilustraci%C3%B3n-dise%C3%B1o.jpg?ver=6" class="rounded-circle" />

                        <p class="p5 p">Nombre Jugador</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('quintetWatch')
    <script>
        $(document).ready(function()
        {
            if(document.getElementById('alertaNoQuintetos').value != 0){
                loadQuintet()
            }else{
                Swal.fire({
                    title: 'Oops...',
                    text: "You don't have any quintet created!",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Return'
                }).then((result) => {
                    window.location.href = "/home";
                })
            }
        })

        function loadQuintet(){
            var id = document.getElementById("nombreQuintet").value;
            console.log(id);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/watchQuintets/load',
                data:{'id': document.getElementById("nombreQuintet").value},
                type:'post',
                success: function (response) {
                    $('.p1').text(response[0]);
                    $('.p2').text(response[1]);
                    $('.p3').text(response[2]);
                    $('.p4').text(response[3]);
                    $('.p5').text(response[4]);
                },
                error:function(x,xs,xt){
                    window.open(JSON.stringify(x));
                }
            });

        }
    </script>
@endpush


