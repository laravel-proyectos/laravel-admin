<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;

use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
 
    public function index()
    {
        Gate::authorize('view', 'orders');
        $order = Order::paginate();
        return OrderResource::collection($order);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        Gate::authorize('view', 'orders');
        return new OrderResource(Order::find($id));
    }

    public function export()
    {
        Gate::authorize('view', 'orders');
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() {
            $orders = Order::all();
            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file,['ID', 'Nombre', 'Email', 'Titulo de Producto', 'Precio', 'Cantidad']);

            // Body
            foreach ($orders as $order) {
                fputcsv($file, [$order->id, $order->name, $order->email, '', '', '']);
                foreach($order->orderItems as $orderItem) {
                    fputcsv($file, ['', '', '', $orderItem->product_title , $orderItem->price , $orderItem->quantity]);
                };
            };

            fclose($file);
        };

        return \Response::stream($callback, 200, $headers);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
