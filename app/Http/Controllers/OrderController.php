<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('foods')->orderBy('id')->get();
        return view('order.index', ['orders' => $orders]);
    }

    public function create()
    {
        $foods = Food::all();
        return view('order.create', compact('foods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foods' => 'required|array',
            'foods.*.food_id' => 'required|exists:foods,id',
            'foods.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;
        $orderDetails = [];

        foreach ($request->foods as $foodItem) {
            $food = Food::find($foodItem['food_id']);
            $quantity = $foodItem['quantity'];
            $totalPrice += $food->price * $quantity;

            $orderDetails[] = [
                'food' => $food,
                'quantity' => $quantity,
                'price' => $food->price * $quantity,
            ];
        }

        $order = Order::create([
            'total_price' => $totalPrice,
        ]);

        foreach ($orderDetails as $detail) {
            $order->foods()->attach($detail['food']->id, [
                'quantity' => $detail['quantity'],
                'total_price' => $detail['price']
            ]);
        }

        $qrCode = QrCode::size(200)->generate(route('orders.show', $order->id));

        return view('order.show', compact('order', 'orderDetails', 'qrCode'));
    }

    public function show(Order $order)
    {
        $orderDetails = $order->foods()->withPivot('quantity', 'total_price')->get();

        $qrCode = QrCode::size(200)->generate(route('orders.show', $order->id));

        return view('order.show', compact('order', 'orderDetails', 'qrCode'));
    }

    public function edit(Order $order)
    {
        $foods = Food::all();
        $orderDetails = $order->foods()->withPivot('quantity', 'total_price')->get();

        return view('order.edit', compact('order', 'foods', 'orderDetails'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'foods' => 'required|array',
            'foods.*.food_id' => 'required|exists:foods,id',
            'foods.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;
        $orderDetails = [];

        foreach ($request->foods as $foodItem) {
            $food = Food::find($foodItem['food_id']);
            $quantity = $foodItem['quantity'];
            $totalPrice += $food->price * $quantity;

            $orderDetails[] = [
                'food' => $food,
                'quantity' => $quantity,
                'price' => $food->price * $quantity,
            ];
        }

        $order->update([
            'total_price' => $totalPrice,
        ]);

        $order->foods()->detach();
        foreach ($orderDetails as $detail) {
            $order->foods()->attach($detail['food']->id, [
                'quantity' => $detail['quantity'],
                'total_price' => $detail['price']
            ]);
        }

        return redirect()->route('orders.index')->with('info', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('info', 'Order deleted successfully.');
    }
}
