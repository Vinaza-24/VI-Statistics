@extends('layouts.app')

@section('content')
    <div class="parent">
        <div class="div1 my_scroll_div choice" >
            <h1>Players:</h1>
            @foreach($players as $players => $player)
                <div class="dra" draggable="true">
                    <div class="col-md-12 cardQuintet">
                        <img src="https://www.layoutit.com/img/sports-q-c-140-140-3.jpg" class="rounded-circle" />
                        <input style="width: 100%;" type="text" value="{{$player->name}}" readonly>
                        <input  type="hidden" class="idJugador" value="{{$player->id}}" readonly>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="div2" style="background-image: url('https://static.vecteezy.com/system/resources/previews/001/819/186/large_2x/perspective-basketball-half-court-floor-with-line-on-wood-texture-background-illustration-vector.jpg');  height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;"> </div>

        <div class="div3">
            <div class="row">
                <div class="col-2">
                    <label>Quintet name</label>
                </div>
                <div class="col">
                    <input type="text" name="name_quintet"  id="name_quintet"  class="form-control" placeholder="Quintet name...">
                </div>
                <div class="col-2">
                    <button type="submit" onclick="eneviar()" class="btn btn-warning">Create Quintet</button>
                </div>
            </div>
        </div>

        {{--        <form method="POST" action="{{ route('panel.create.quintet.create') }}">--}}
        <div class="div4 choice drop" > </div>
        <div class="div5 choice drop" > </div>
        <div class="div6 choice drop" > </div>
        <div class="div7 choice drop" > </div>
        <div class="div8 choice drop" > </div>
        {{--        </form>--}}
    </div>
@endsection



@push('quintet')
    <script>
        let p = document.getElementsByClassName('dra');
        let choice = document.getElementsByClassName('choice');
        let dragItem = null;

        for(let i of p){
            i.addEventListener('dragstart', dragStart);
            i.addEventListener('dragend', dragEnd);
        }

        function dragStart(){
            dragItem = this
            setTimeout(() => this.style.display = "none", 0);
        }
        function dragEnd(){
            setTimeout(() => this.style.display = "block", 0);
            dragItem = null;
        }

        for(let j of choice){
            j.addEventListener('dragover', dragOver);
            j.addEventListener('dragenter', dragEnter);
            j.addEventListener('dragleave', dragLeave);
            j.addEventListener('drop', Drop);
        }

        function Drop(){
            this.append(dragItem)
        }
        function dragOver(e){
            e.preventDefault()
        }
        function dragEnter(e){
            e.preventDefault()
        }
        function dragLeave(){
        }


        function eneviar(){

            elementos = document.querySelectorAll(".drop");

            card1 = elementos[0].querySelector(".cardQuintet")?.querySelector(".idJugador")?.value;
            card2 = elementos[1].querySelector(".cardQuintet")?.querySelector(".idJugador")?.value;
            card3 = elementos[2].querySelector(".cardQuintet")?.querySelector(".idJugador")?.value;
            card4 = elementos[3].querySelector(".cardQuintet")?.querySelector(".idJugador")?.value;
            card5 = elementos[4].querySelector(".cardQuintet")?.querySelector(".idJugador")?.value;

            name_quintet = document.querySelector("#name_quintet")?.value;

            if(card1 && card2 && card3 && card4 && card5 && name_quintet){
                console.log(card1);
                console.log(card2);
                console.log(card3);
                console.log(card4);
                console.log(card5);
                console.log(name_quintet);



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:'/createQuintetPanel/create',
                    data:{'player1': card1,
                          'player2': card2,
                          'player3': card3,
                          'player4': card4,
                          'player5': card5,
                          'name_quintet': name_quintet},
                    type:'post',
                    success: function (response) {
                        alert(response)
                    },
                    error:function(x,xs,xt){
                        window.open(JSON.stringify(x));
                    }
                });

            }else{
                console.log("No Enviar");
            }
        }

    </script>
@endpush
