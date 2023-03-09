@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="col-12">
                <div class="card-header">

                    {{-- начало вставки: --}}

                    <form action="{{route('start')}}" method="get">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <h2 class="dishes">All dishes</h2>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Sort by</label>
                                        <select class="form-select" name="sort">
                                            <option>default</option>
                                            @foreach($sortSelect as $value => $name)
                                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                            {{-- <option value="{{$value}}">{{$name}}</option> --}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Restaurant</label>
                                        <select class="form-select" name="restaurant_id">
                                            <option value="all">All</option>
                                            @foreach($restaurants as $restaurant)
                                            {{-- <option value="{{$value}}"> --}}
                                            <option value="{{$restaurant->id}}" @if($restaurant->id == $restaurantShow) selected @endif>
                                                {{$restaurant->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-1">
                                    <div class="mb-3">
                                        <label class="form-label">Per page</label>
                                        <select class="form-select" name="per_page">
                                            @foreach($perPageSelect as $value)
                                            <option value="{{$value}}" @if($perPageShow==$value) selected @endif>
                                                {{$value}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>




                                <div class="col-2">
                                    <div class="head-buttons">
                                        <button type="submit" class="btn btn-outline-primary mt-3">Show</button>
                                        <a href="{{route('start')}}" class="btn btn-outline-info mt-3">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- поиск ниже: --}}

                    <form action="{{route('start')}}" method="get">
                        <div class="container">
                            <div class="row justify-content-center">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Find dish</label>
                                        <input type="text" class="form-control" name="s" value="{{$s}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="head-buttons">
                                        <button type="submit" class="btn btn-outline-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    {{-- конец вставки --}}


                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">


                            @forelse($dishes as $dish)

                            <div class="col-3">

                                <div class="list-table">
                                    <div class="top">
                                        <h3>{{$dish->title}}</h3>
                                        <a href="{{route('show-dish', $dish)}}">
                                            <div class="smallimg">
                                                @if($dish->photo)
                                                <img src="{{asset($dish->photo)}}">
                                                @else
                                                <img src="{{asset('no.jpeg')}}">
                                                @endif
                                            </div>
                                        </a>

                                    </div>

                                    <div class="bottom">


                                        <div class="info">
                                            <div>Restaurant: {{$dish->dishRestaurant->title}}</div>
                                        </div>

                                        <div class="buy">
                                            <form action="{{route('add-to-cart')}}" method="post">
                                                <button type="submit" class="btn btn-outline-primary">Add</button>
                                                <input type="number" min="1" name="count" value="1">
                                                <input type="hidden" name="product" value="{{$dish->id}}">
                                                @csrf
                                            </form>
                                        </div>


                                    </div>
                                </div>




                            </div>

                            @empty
                            No dishes yet
                            @endforelse

                        </div>
                    </div>

                    @if($perPageShow != 'all')
                    <div class="m-2">{{ $dishes->links() }}</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
