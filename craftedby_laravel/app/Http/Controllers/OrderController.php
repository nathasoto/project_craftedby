<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'total' => 'required|numeric',
            'shipping_address' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:15',
            'status' => 'required|string|max:50',
            'products' => 'required|array',
            'products.*.id' => 'required|string|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
            'products.*.color' => 'nullable|string|max:50',
            'products.*.size' => 'nullable|string|max:50',
        ]);

        if (empty($data['user_id'])) {
            $data['user_id'] = 1;
        }

        try {
            DB::transaction(function () use ($data) {
                $order = Order::create([
                    'user_id' => $data['user_id'],
                    'total' => $data['total'],
                    'shipping_address' => $data['shipping_address'],
                    'mobile_phone' => $data['mobile_phone'],
                    'status' => $data['status'],
                ]);

                foreach ($data['products'] as $productData) {
                    $order->products()->attach($productData['id'], [
                        'quantity' => $productData['quantity'],
                        'unit_price' => $productData['unit_price'],
                        'color' => $productData['color'],
                        'size' => $productData['size'],
                    ]);
                }
            });

            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $orders = Order::with('user', 'products')->get();
        return response()->json($orders, 200);
    }
    public function delete($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        try {
            DB::transaction(function () use ($order) {
                $order->products()->detach(); // Eliminar relaciones con productos
                $order->delete(); // Eliminar la orden
            });

            return response()->json(['message' => 'Order deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete order', 'error' => $e->getMessage()], 500);
        }
    }

    public function ordersByUser($userId)
    {
        $orders = Order::where('user_id', $userId)
            ->with('user', 'products')
            ->get();

        return response()->json($orders, 200);
    }
}
