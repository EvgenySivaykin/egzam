<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all()->sortBy('title');
        return view('back.restaurants.index', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'restaurant_title' => 'required|alpha|min:3|max:100',
                'restaurant_code' => 'required|min:3|max:100',
                'restaurant_address' => 'required|min:3|max:100',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $restaurant = new Restaurant;
        $restaurant->title = $request->restaurant_title;
        $restaurant->code = $request->restaurant_code;
        $restaurant->address = $request->restaurant_address;
        $restaurant->save();

        return redirect()->route('restaurants-index')->with('ok', 'New restaurant was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('back.restaurants.edit', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'restaurant_title' => 'required|alpha|min:3|max:100',
                'restaurant_code' => 'required|min:3|max:100',
                'restaurant_address' => 'required|min:3|max:100',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $restaurant->title = $request->restaurant_title;
        $restaurant->code = $request->restaurant_code;
        $restaurant->address = $request->restaurant_address;
        $restaurant->save();

        return redirect()->route('restaurants-index')->with('ok', 'New restaurant was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if (!$restaurant->restaurantDishes()->count()) {
            $restaurant->delete();
            return redirect()->route('restaurants-index')->with('ok', 'Restaurant was deleted');
        } else {
            return redirect()->back()->with('not', 'Restaurant has dishes!');
        }
    }
}