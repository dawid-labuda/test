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




                    <form action="/fanpage" method="POST">
                    @csrf
                        <div class="form-group">
                        <label for="">Email: </label>
                        <input type="text" class="form-control" name="nazwa">
                        <label for="">Fanpage ID</label>
                        <input type="text" class="form-control" name="fanpage_id">
                        <label for="">Fanpage Access Token</label>
                        <input type="text" class="form-control" name="fanpage_token">
                        </div>
                        <button class="btn btn-primary">Dodaj</button>
                    </form>
        





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
