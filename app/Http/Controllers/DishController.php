<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Imagemanager;

class DishController extends Controller
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
        $restaurants = Restaurant::all();
        $dishes = Dish::all()->sortBy('title');

        return view('back.dishes.index', [
            'dishes' => $dishes,
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all()->sortBy('title');
        return view('back.dishes.create', [
            'restaurants' => $restaurants,
        ]);
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
                'dish_title' => 'required|alpha|min:3|max:100',
                'restaurant_id' => 'required|numeric|min:1',
                'dish_desc' => 'required|min:3|max:500',

            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        $dish = new Dish;

        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 600);

            // $image = Image::make($photo)->pixelate(12);
            $image->save(public_path().'/dishes/'.$file);
            
            // $photo->move(public_path().'/hotels', $file);

            // $hotel->photo = asset('/hotels') . '/' . $file;
            $dish->photo = '/dishes/' . $file;
        }

        $dish->title = $request->dish_title;
        $dish->restaurant_id = $request->restaurant_id;
        $dish->desc = $request->dish_desc;
        $dish->save();

        return redirect()->route('dishes-index')->with('ok', 'New dish was created');





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('back.dishes.show', [
            'dish' => $dish,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $restaurants = Restaurant::all();
        return view('back.dishes.edit', [
            'restaurants' => $restaurants,
            'dish' => $dish,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        if ($request->delete_photo) {
            $dish->deletePhoto();
            return redirect()->back()->with('ok', 'Photo was deleted');
        }
        
        $validator = Validator::make(
            $request->all(),
            [
                'dish_title' => 'required|alpha|min:3|max:100',
                'restaurant_id' => 'required|numeric|min:1',
                'dish_desc' => 'required|min:3|max:500',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 600);

            if ($dish->photo) {
                $dish->deletePhoto();
            }

            // $image = Image::make($photo)->pixelate(12);
            $image->save(public_path().'/dishes/'.$file);
            
            // $photo->move(public_path().'/hotels', $file);

            // $hotel->photo = asset('/hotels') . '/' . $file;
            $dish->photo = '/dishes/' . $file;
        }



        $dish->title = $request->dish_title;
        $dish->restaurant_id = $request->restaurant_id;
        $dish->desc = $request->dish_desc;
        $dish->save();

        return redirect()->route('dishes-index')->with('ok', 'Dish was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->back()->with('ok', 'Dish was deleted');
    }
}