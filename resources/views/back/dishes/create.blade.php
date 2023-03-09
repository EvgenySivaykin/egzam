@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Add new dish</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('dishes-store')}}" method="post" enctype="multipart/form-data">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Dish title</label>
                                        <input type="text" class="form-control" name="dish_title" value="{{old('dish_title')}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Restaurant</label>
                                        <select class="form-select" name="restaurant_id">
                                            @foreach($restaurants as $restaurant)
                                            {{-- <option value="{{$restaurant->id}}"> --}}
                                            <option value="{{$restaurant->id}}" @if($restaurant->id == old('restaurant_id')) selected @endif>
                                                {{$restaurant->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Dish photo</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>

                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Dish description</label>
                                        <input type="text" class="form-control" name="dish_desc" value="{{old('dish_desc')}}">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Add New</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
