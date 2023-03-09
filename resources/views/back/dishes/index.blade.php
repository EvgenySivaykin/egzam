@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="col-md-10"> --}}
            <div class="card">
                <div class="card-header">
                    <h1>All dishes</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($dishes as $dish)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h3>{{$dish->title}}</h3>
                                    <div class="data">
                                        <div>Restaurant: {{$dish->dishRestaurant->title}}</div>
                                    </div>
                                    <div class="smallimg">
                                        @if($dish->photo)
                                        <img src="{{asset($dish->photo)}}">
                                        @endif
                                    </div>

                                </div>
                                <div class="list-table__buttons">

                                    <a href="{{route('dishes-show', $dish)}}" class="btn btn-outline-primary">Show</a>

                                    <a href="{{route('dishes-edit', $dish)}}" class="btn btn-outline-success">Edit</a>

                                    {{-- @if(Auth::user()?->role == 'admin') --}}

                                    <form action="{{route('dishes-delete', $dish)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>

                                    {{-- @endif --}}

                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No dishes yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- @if($perPageShow != 'all')
        <div class="m-2">{{ $drinks->links() }}
        </div>
        @endif --}}
    </div>
</div>
</div>
@endsection
