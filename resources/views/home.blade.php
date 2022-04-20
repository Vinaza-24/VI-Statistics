@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- SESSION --}}
            @if (session('status'))
                <div class="alert alert-success" data-dismiss="alert" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            {{-- SESSION --}}

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3><strong>Players</strong></h3>
                            </div>
                        </div>
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
