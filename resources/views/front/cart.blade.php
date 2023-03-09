@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card-body">

                {{-- начало большой вставки: --}}
                <div class="card-body">
                    <form action="{{route('update-cart')}}" method="post">
                        <ul class="list-group">
                            @forelse($cartList as $dish)
                            <li class="list-group-item">
                                {{-- <div class="list-table"> --}}
                                <div class="list-table cart">
                                    <div class="list-table__content">
                                        <h3>{{$dish->title}}</h3>
                                        <div class="size">
                                            <input type="number" min="1" name="count[]" value="{{$dish->count}}">dish(-es)
                                            <input type="hidden" name="ids[]" value="{{$dish->id}}">
                                        </div>
                                        <div class="type"> {{$dish->dishRestaurant->title}}</div>

                                        <div class="smallimg">
                                            @if($dish->photo)
                                            <img src="{{asset($dish->photo)}}">
                                            @endif
                                        </div>

                                    </div>
                                    <div class="list-table__buttons">
                                        {{-- <form action="{{route('drinks-delete', $drink)}}" method="post"> --}}
                                        <button type="submit" name="delete" value="{{$dish->id}}" class="btn btn-outline-danger">Delete</button>
                                        {{-- @method('delete') --}}
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item">Cart Empty</li>
                            @endforelse
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-outline-primary">Update cart</button>
                            </li>
                        </ul>
                        @csrf
                    </form>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <form action="{{route('make-order')}}" method="post">
                                <button type="submit" class="btn btn-outline-primary">Buy</button>
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
