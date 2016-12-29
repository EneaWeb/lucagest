<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Option as Option;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::pluck('value', 'name');
        return view('pages.options', compact('options'));
    }

    public function saveOption(Request $request)
    {
        // get options from previous Form
        $hide_supplier_prices = $request->has('hide_supplier_prices') ? $request->get('hide_supplier_prices') : '0';
        $orders_header = $request->has('orders_header') ? $request->get('orders_header') : '';
        $mail_cc = $request->has('mail_cc') ? $request->get('mail_cc') : '';
        $mail_bcc = $request->has('mail_bcc') ? $request->get('mail_bcc') : '';

        // prepare options array
        $options = [
            'hide_supplier_prices' => $hide_supplier_prices,
            'orders_header' => $orders_header,
            'mail_cc' => $mail_cc,
            'mail_bcc' => $mail_bcc
        ];

        // clean table
        Option::truncate();

        // save options back
        foreach ($options as $name => $value) {
            $option = new Option([
                'name' => $name,
                'value' => $value
            ]);
            $option->save();
        }

        return redirect()->back();

    }
}
