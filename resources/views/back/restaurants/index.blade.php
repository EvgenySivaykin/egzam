@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">
                    <h1>All restaurants</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($restaurants as $restaurant)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h3>{{$restaurant->title}}</h3>
                                    {{-- <div class="period"> --}}
                                    <div class="city">
                                        <h4>Code: <b>{{$restaurant->code}}</b></h4>
                                    </div>
                                    <div class="data">
                                        <h4>Address: {{$restaurant->address}}</h4>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="list-table__buttons">

                                    {{-- @if(Auth::user()?->role == 'admin') --}}

                                    <a href="{{route('restaurants-edit', $restaurant)}}" class="btn btn-outline-success">Edit</a>
                                    <form action="{{route('restaurants-delete', $restaurant)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>

                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No restaurants yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
