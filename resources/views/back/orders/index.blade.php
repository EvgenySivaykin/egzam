@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Orders</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($orders as $order)
                        <li class="list-group-item">
                            <div class="list-table">


                                <div class="list-table__content">
                                    <h3>#{{$order->id}}</h3>
                                    <b class="m-5">{{$order->user->name}}</b>
                                    <ul class="list-group">

                                        @foreach($order->dishes->dishes as $dish)
                                        <li class="list-group-item">
                                            {{$dish->title}} X {{$dish->count}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="list-table__buttons">


                                </div>
                            </div>
                        </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
