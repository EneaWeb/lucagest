<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Order as Order;
use \App\OrderDetail as OrderDetail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('pages.orders', compact('orders'));
    }

    public function newOrder()
    {
        return view('pages.new_order');
    }

    public function showOrder($id)
    {
        $order = Order::find($id);

        if ($order == NULL)
            return redirect()->back();

        return view('pages.order', compact('order'));
    }

    public function editOrder($id)
    {
        $order = Order::find($id);

        if ($order == NULL)
            return redirect()->back();

        return view('pages.edit_order', compact('order'));
    }

    public function saveOrder(Request $request)
    {

        $services = array_diff($request->get('service'), ['', '-']);
        $totals = array_diff($request->get('total'), ['', '-']);

        $customerName = $request->has('customer_name') ? $request->get('customer_name') : '';
        $customerContact = $request->has('customer_contact') ? $request->get('customer_contact') : '';
        $serviceIdsAndTotals = array_combine($services, $totals);
        $payed = $request->has('payed') ? '1' : '0';

        if ($request->has('order_id')) {

            $myOrder = Order::find($request->get('order_id'));

            if ($myOrder == NULL)
                return redirect()->back();

            $myOrder->delete();
            OrderDetail::where('order_id', $request->get('order_id'))->delete();

        }

        $order = new Order([
            'customer_name' => $customerName,
            'customer_contact' => $customerContact,
            'payed' => $payed
        ]); $order->save();

        foreach ($serviceIdsAndTotals as $serviceId => $total) {
            $orderDetail = new OrderDetail([
                'order_id' => $order->id,
                'service_id' => $serviceId,
                'price' => $total
            ]); $orderDetail->save();
        }

        return redirect('/orders');
    }

    public function deleteOrder(Request $request)
    {
        Order::find($request->get('order_id'))->delete();
        OrderDetail::where('order_id', $request->get('order_id'))->delete();
        return redirect()->back();
    }
}
