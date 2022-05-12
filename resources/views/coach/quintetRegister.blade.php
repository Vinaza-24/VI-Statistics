@extends('layouts.app')

@section('content')
    <div class="container-fluid a" style="margin-bottom: 10%; width: 90%;">
        <div class="row">
            <div class="col-md-2 my_scroll_div" style="background-color: white;">
                <h3>
                    Jugadores:
                </h3>
                <div class="col-md-12 choice " style="width: 100%">
                    @foreach($players as $players => $player)
                        <div class="dra" draggable="true">
                            <div class="col-md-12 cardQuintet">
                                <img src="https://www.layoutit.com/img/sports-q-c-140-140-3.jpg" class="rounded-circle" />
                                <input style="width: 100%;" type="text" value="{{$player->name}}" readonly>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-10" style="background-image: url('https://static.vecteezy.com/system/resources/previews/001/819/186/large_2x/perspective-basketball-half-court-floor-with-line-on-wood-texture-background-illustration-vector.jpg');  height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4 choice drop">
                                <h3>
                                    BA:
                                </h3>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4 choice drop">
                                <h3>
                                    ES:
                                </h3>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4 choice drop">
                                <h3>
                                    AL:
                                </h3>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 1rem;">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4 choice drop">
                                <h3>
                                    P:
                                </h3>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4 choice drop">
                                <h3>
                                    AP:
                                </h3>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="background-color: white;">
                <div class="row">
                    <div class="col-md-2">
                        <h5 style="margin: 1rem;font-weight: bold">Name Quintet:</h5>
                    </div>
                    <div class="col-md-9">
                        <input name="name_quintet" id="name_quintet" style="width: 95%; margin: 1rem;" type="text" placeholder="Name Quintet..." width="150px">
                    </div>
                    <div class="col-md-1">
                        <button style="margin: 1rem;" type="button" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
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

    </script>
@endpush
