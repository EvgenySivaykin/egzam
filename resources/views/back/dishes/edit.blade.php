@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit dish</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('dishes-update', $dish)}}" method="post" enctype="multipart/form-data">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Dish title</label>
                                        <input type="text" class="form-control" name="dish_title" value="{{old('dish_title', $dish->title)}}">

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Restaurant</label>
                                        <select class="form-select" name="restaurant_id">
                                            @foreach($restaurants as $restaurant)
                                            {{-- <option value="{{$restaurant->id}}"> --}}
                                            <option value="{{$restaurant->id}}" @if($restaurant->id == old('restaurant_id', $dish->restaurant_id)) selected @endif>
                                                {{$restaurant->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Dish photo</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>

                                @if($dish->photo)
                                <div class="col-3">
                                    <div class="mb-3 img">
                                        <img src="{{asset($dish->photo)}}">
                                    </div>
                                </div>
                                @endif

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Dish description</label>
                                        <input type="text" class="form-control" name="dish_desc" value="{{old('dish_desc', $dish->desc)}}">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Save</button>
                        @if($dish->photo)
                        <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">Delete Photo</button>
                        @endif

                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
