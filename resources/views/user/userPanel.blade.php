@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
            <div class="card">
                <div class="card-header" style="background-color: #17408B; color: white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h4>{{ __('My Data') }}</h4>
                        <div class="form-switch mb-3" data-toggle="tooltip" data-placement="right" title="Activate / Disable Editing">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckActivate">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <form class="row g-3"  method="POST" action="{{ route('panel.myData.modify') }}">
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name}}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position"  value="{{ Auth::user()->position}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ Auth::user()->birth_date}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="team" class="form-label">Team</label>
                                <input type="text" class="form-control" id="team" value="{{ Auth::user()->team_id}}" readonly>
                            </div>
                            <div class="col-12 mt-3">
                                <button id="save" type="submit" class="btn" style="width: 100%; background-color: #17408B; color: white" hidden>Save</button>
                            </div>
                        </form>
                    <div/>
                <div/>
            </div>
    </div>
@endsection

@push('my-data-panel')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(document).ready(function(){
            const check = document.getElementById('SwitchCheckActivate');

            if($('#SwitchCheckActivate').attr('checked')){
                check.prop("checked", false);
            }

            check.onclick = function() {checkSwitchCheckActivate()};

            let  condition = 1;

            function checkSwitchCheckActivate() {
                if(condition === 1) {
                    $("#name").attr("readonly", false);
                    $("#email").attr("readonly", false);
                    $("#birth_date").attr("readonly", false);
                    $("#save").attr("hidden", false);
                    condition = 0;
                }else{
                    $("#name").attr("readonly", true);
                    $("#email").attr("readonly", true);
                    $("#birth_date").attr("readonly", true);
                    $("#save").attr("hidden", true);
                    condition = 1;
                }
            }

        })




    </script>
@endpush

