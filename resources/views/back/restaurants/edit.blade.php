@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit restaurant</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('restaurants-update', $restaurant)}}" method="post">

                        <div class="mb-3">
                            <label class="form-label">Restaurant title</label>
                            <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant->title', $restaurant->title)}}">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" name="restaurant_code" value="{{old('restaurant_code', $restaurant->code)}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="restaurant_address" value="{{old('restaurant_address', $restaurant->address)}}">
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Save</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
