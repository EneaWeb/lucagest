<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Order as Order;
use \App\OrderDetail as OrderDetail;
use PDF;
use \App\Mail\OrderMail as OrderMail;

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

        // check if there are old areas
        $oldAreas = array();
        foreach ($order->details as $detail) {
            if ($detail->area->active == 0)
                $oldAreas[] = $detail->area_id;
        }

        if ($order == NULL)
            return redirect()->back();

        return view('pages.edit_order', compact('order', 'oldAreas'));
    }

    public function saveOrder(Request $request)
    {

        //return dd($request->all());

        $services = array_diff($request->get('service'), ['', '-']);
        $supplier_prices = array_diff($request->get('supplier_price'), ['', '-']);
        $total_prices = array_diff($request->get('total_price'), ['', '-']);
        $payed = $request->has('payed') ? '1' : '0';

        //return dd($total_prices);

        $customerName = $request->has('customer_name') ? $request->get('customer_name') : '';
        $customerEmail = $request->has('customer_email') ? $request->get('customer_email') : '';
        $customerContact = $request->has('customer_contact') ? $request->get('customer_contact') : '';
        $notes = $request->has('notes') ? $request->get('notes') : '';

        //return dd($services_array);


        // if is an UPDATE
        if ($request->has('order_id')) {
            // get original order id
            $order = \App\Order::find($request->get('order_id'));

            $services_array = array();
            for ($i = 0; $i < count($services); $i++) {

                if (is_numeric($services[$i])) {
                    $service = \App\Service::find($services[$i]);
                    $service_name = $service->name;
                    $service_area_id = $service->area_id;
                } else {
                    $service_name = substr($services[$i], 0, strpos($services[$i], "&area_id="));
                    $service_area_id = substr($services[$i], strpos($services[$i], "&area_id=") + 9);
                }
            }
            // remove all order details before saving it again
            \App\OrderDetail::where('order_id', $order->id)->delete();

        } else {
            // save new Order
            $order = new Order([
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'customer_contact' => $customerContact,
                'notes' => $notes,
                'payed' => $payed
            ]); $order->save();
        }

        $services_array = array();
        for ($i = 0; $i < count($services); $i++) {

            if (is_numeric($services[$i])) {
                $service = \App\Service::find($services[$i]);
                $service_name = $service->name;
                $service_area_id = $service->area_id;
            } else {
                $service_name = substr($services[$i], 0, strpos($services[$i], "&area_id="));
                $service_area_id = substr($services[$i], strpos($services[$i], "&area_id=") + 9);
            }

            $services_array[] = [
                'name' => $service_name,
                'area_id' => $service_area_id, 
                'supplier_price' => $supplier_prices[$i],
                'total_price' => $total_prices[$i]
            ];
        }

        // save Order Detail
        foreach ($services_array as $k => $v) {
            $orderDetail = new OrderDetail([
                'order_id' => $order->id,
                'area_id' => $v['area_id'],
                'name' => $v['name'],
                'supplier_price' => $v['supplier_price'],
                'total_price' => $v['total_price']
            ]); $orderDetail->save();
        }

        return redirect('/order/edit/'.$order->id);
    }

    public function deleteOrder(Request $request)
    {
        Order::find($request->get('order_id'))->delete();
        OrderDetail::where('order_id', $request->get('order_id'))->delete();
        return redirect()->back();
    }

    public function PDF($id)
    {
        $order = \App\Order::find($id);
        $pdf = PDF::loadView('pdf.invoice', compact('order'));
        return $pdf->stream('Ordine #'.$id.'.pdf');
    }

    public function sendmail(Request $request)
    {
        $order = \App\Order::find($request->get('order_id'));
        $mail = new OrderMail($order);
        $mail->send();

        return redirect()->back();
    }
}
