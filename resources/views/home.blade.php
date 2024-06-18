@extends('layouts.app')

@php
use App\Models\Account;
$user=auth()->user();
$account= Account::where('user_id',$user->id)->first();
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="card bg-success" style="width: 80%;">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <h5 style="margin-bottom: 0;color: white;">caja de ahorro</h5>
                                        <h5 style="color: white;text-align: end;">{{$account->id}}</h5>
                                    </div>
                                </div>
                                <h4 style="color: white;">saldo:</h4>
                                <h3 style="color: white;">{{$account->balance}} Bs</h3>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <a href="{{url('/qr')}}" class="btn btn-primary">Pagar QR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
