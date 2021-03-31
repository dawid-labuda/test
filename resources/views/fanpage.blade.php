@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Fanpage ID</th>
                            <th scope="col">ID Aplikacji</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($all_fanpages as $fanpage)
                    <a href="fanpage/{{ $fanpage->fanpage_id }}">
                    <tr>
                        <td><a href="fanpage/{{ $fanpage->fanpage_id }}">{{ $fanpage->nazwa }}</a></td>
                        <td>{{ $fanpage->fanpage_id }}</td>
                        <td>{{ $fanpage->app_id }}</td>
                        <td><a href="fanpage/{{ $fanpage->fanpage_id }}">
                        <button class="btn btn-danger">Edytuj</button>
                        </a></td>
                    </tr>
                    </a>
                    @endforeach
                    </tbody>
                    </table>

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
