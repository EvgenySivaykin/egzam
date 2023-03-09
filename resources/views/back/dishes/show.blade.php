@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Show dish</h1>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    {{-- <label class="form-label">Dish title:</label> --}}
                                    <h3>{{$dish->title}}</h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Restaurant:</label>
                                    <h3>{{$dish->dishRestaurant->title}}</h3>
                                </div>
                            </div>

                            @if($dish->photo)
                            <div class="col-12">
                                <div class="mb-3 img">
                                    <img src="{{asset($dish->photo)}}">
                                </div>
                            </div>
                            @endif

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Dish description:</label>
                                    <h4>{{$dish->desc}}</h4>
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
