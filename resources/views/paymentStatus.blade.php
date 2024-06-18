@extends('layouts.app')

@section('content')
    <div class="card {{$color}}">
        <div class="card-body">
            <div class="col">
                <h1 style="width: 100%;color: white;" class="text-center">
                    {{ $result }}
                </h1>
            </div>
        </div>
        <div class="card-footer">
            <div class="col">
                <a style="width: 100%;" class="btn btn-primary" href="{{ route('home') }}">Atras</a>
            </div>
        </div>
    </div>
@endsection
