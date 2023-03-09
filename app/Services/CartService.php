<?php

namespace App\Services;
use App\Models\Dish;

class CartService
{

    private $cart, $cartList, $count = 0;

    public function __construct()
    {
        $this->cart = session()->get('cart', []);

        $ids = array_keys($this->cart);
        
        $this->cartList = Dish::whereIn('id', $ids)
        ->get()
        ->map(function($dish) {
            $dish->count = $this->cart[$dish->id];
            return $dish;
        });

        $this->count = $this->cartList->count();
    }

    public function __get($props)
    {
        return match($props) {
            'count' => $this->count,
            'list' => $this->cartList,
            //начало вставки:
            'cart' => $this->cart,
            //конец вставки
            default => null,
        };
    }

    public function add(int $id, int $count)
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id] += $count;
        }
        else {
            $this->cart[$id] = $count;
        }
        session()->put('cart', $this->cart);
    }

    public function update(array $cart)
    { 
        session()->put('cart', $cart);
    }

    public function delete(int $id)
    {
        unset($this->cart[$id]);
        session()->put('cart', $this->cart);
    }




    public function test()
    {
        return 'Hallo this is Cart Service!';
    }

}