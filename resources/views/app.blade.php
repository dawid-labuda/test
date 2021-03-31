@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista aplikacji') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




                    @foreach($all_apps as $app)
                        <a href="#">
                        {{ $app->nazwa }}</a><br>
                    @endforeach
                    <br>
                    <a href="aplikacje/dodaj">
                    <button class="btn btn-primary">
                    Dodaj
                    </button>
                    </a>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
