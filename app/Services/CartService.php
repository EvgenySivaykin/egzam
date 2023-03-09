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
            'cart' => $this->cart,
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

    public function order()
    {
        $order = (object)[];
        $order->total = $this->total;
        $order->dishes = [];

        foreach($this->cartList as $dish){
            $order->dishes[] = (object)[
                'title' => $dish->title,
                'count' => $dish->count,
                'id' => $dish->id,
            ];
        }
        return $order;
    }

    public function empty()
    {
        session()->put('cart', []);
        $this->count = 0;
        $this->cartList = collect();
        $this->cart = [];
    }

    public function test()
    {
        return 'Hallo this is Cart Service!';
    }

}