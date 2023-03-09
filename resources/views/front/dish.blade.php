@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-12">
                            <div class="list-table one">

                                <div class="top">
                                    <h3>
                                        {{$dish->title}}
                                    </h3>
                                    <h4> Restaurant: {{$dish->dishRestaurant->title}} </h4>

                                    <div class="smallimg">
                                        @if($dish->photo)
                                        <img src="{{asset($dish->photo)}}">
                                        @else
                                        <img src="{{asset('no.jpg')}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="bottom">
                                    <div class="info">
                                        <div class="size"> {{$dish->desc}}</div>
                                    </div>

                                    {{-- <div class="buy">
                                        <button type="submit" class="btn btn-outline-primary">Add</button>
                                    </div> --}}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
