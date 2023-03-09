@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add new restaurant</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('restaurants-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Restaurant title</label>
                            <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" name="restaurant_code" value="{{old('restaurant_code')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="restaurant_address" value="{{old('restaurant_address')}}">
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
