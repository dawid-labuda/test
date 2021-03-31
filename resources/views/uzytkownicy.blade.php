@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Użytkownicy') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




                    @foreach($all_users as $user)
                        <a href="#">
                        {{ $user->email }}</a><br>
                    @endforeach
                    <br>
                    <a href="fanpage/dodaj">
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
