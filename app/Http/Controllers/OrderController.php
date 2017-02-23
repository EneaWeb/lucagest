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

    /*
    EXAMPLE

    "customer_name" => ""
    "customer_email" => ""
    "customer_contact" => ""
    "notes" => "<p><br></p>"
    "service" => array:5 [▼
        0 => "5"
        1 => "-"
        2 => "15"
        3 => "19"
        4 => "-"
    ]
    "supplier_price" => array:5 [▼
        0 => "60.00"
        1 => ""
        2 => "60.00"
        3 => "50.00"
        4 => ""
    ]
    "total_price" => array:5 [▼
        0 => "36"
        1 => ""
        2 => "270.00"
        3 => "32723"
        4 => ""
    ]

    */

    public function saveOrder(Request $request)
    {

        //return dd($request->all());

        $services = array_values(array_diff($request->get('service'), ['', '-']));
        $supplier_prices = array_values(array_diff($request->get('supplier_price'), ['', '-']));
        $total_prices = array_values(array_diff($request->get('total_price'), ['', '-']));
        $payed = $request->has('payed') ? '1' : '0';

        //return dd($total_prices);

        $customerName = $request->has('customer_name') ? $request->get('customer_name') : '';
        $customerEmail = $request->has('customer_email') ? $request->get('customer_email') : '';
        $customerContact = $request->has('customer_contact') ? $request->get('customer_contact') : '';
        $notes = $request->has('notes') ? $request->get('notes') : '';

        // if is an UPDATE
        if ($request->has('order_id')) {
            // get original order id
            $order = \App\Order::find($request->get('order_id'));

            $order->update([
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'customer_contact' => $customerContact,
                'notes' => $notes,
                'payed' => $payed,
                'status' => $request->get('status')
            ]);

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
                'payed' => $payed,
                'status' => $request->get('status') == null ? 'lavorazione' : $request->get('status')
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

        return redirect('/orders');
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
