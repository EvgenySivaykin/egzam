<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Services\CartService;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $perPageShow = in_array($request->per_page, Dish::PER_PAGE) ? $request->per_page : 'all';

        if (!$request->s) {
        
            if ($request->restaurant_id && $request->restaurant_id !='all') {
                $dishes = Dish::where('restaurant_id', $request->restaurant_id);
            }
            else {
                $dishes = Dish::where('id', '>', 0);
            }
            
            $dishes = match ($request->sort ?? '') {
                'asc_title' => $dishes->orderBy('title'),
                'desc_title' => $dishes->orderBy('title', 'desc'),
                default => $dishes,
            };

            
            if ($perPageShow == 'all') {
                $dishes = $dishes->get();
            } else {
                $dishes = $dishes->paginate($perPageShow)->withQueryString();
            }
        }
        else {
            // $dishes = Dish::where('title', 'like', '%'.$request->s.'%')->get();
            $s = explode(' ', $request->s);

            if (count($s) == 1) {
                $dishes = Dish::where('title', 'like', '%'.$request->s.'%')->get();
            }
            else {
                $dishes = Dish::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->get();
            }
        }
        


        $restaurants = Restaurant::all()->sortBy('title');

        return view('front.home', [
            'dishes' => $dishes,
            'sortSelect' => Dish::SORT,
            'sortShow' => isset(Dish::SORT[$request->sort]) ? $request->sort :'',
            'perPageSelect' => Dish::PER_PAGE,
            'perPageShow' => $perPageShow,
            'restaurants' => $restaurants,
            'restaurantShow' =>$request->restaurant_id ? $request->restaurant_id : '',
            's' => $request->s ?? '',
        ]);
    }

    public function showDish(Dish $dish)
    {
        return view('front.dish', [
            'dish' => $dish
        ]);
    }

    public function addToCart(Request $request, CartService $cart)
    {
        $id = (int) $request->product;
        $count = (int) $request->count;
        $cart->add($id, $count);
        return redirect()->back();
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
        
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart); 
        }
        return redirect()->back();   
    }



}