<?php

namespace App\Mail;
use Config;
use Mail;
use PDF;

class OrderMail
{

   protected $recipient;
   protected $order_id;
   protected $customer_name;
   protected $sender;
   protected $bcc;
   protected $cc;

   function __construct($order)
   {
      $this->recipient = $order->customer_email;
      $this->order_id = $order->id;
      $this->customer_name = $order->customer_name;
      $this->sender = Config::get('mail.from.address');
      $this->bcc = \App\Option::where('name', 'mail_bcc')->value('value');
      $this->cc = \App\Option::where('name', 'mail_cc')->value('value');
   }

    public function send()
    {

      $order_id = $this->order_id;
      $recipient = $this->recipient;
      $sender = $this->sender;
      $customer_name = $this->customer_name;
      $bcc = $this->bcc;
      $cc = $this->cc;

      // prepare pdf
      $order = \App\Order::find($order_id);
      $pdf = PDF::loadView('pdf.invoice', compact('order'));

      // prepare content
      $data = [
         'title' => 'Ordine #'.$order_id,
         'content' => "In allegato il dettaglio dell'ordine # ".$order_id.' di '.$customer_name,
         ]; 
      
      // send mail
      Mail::send('email.invoice', $data, function($message) use ($data, $pdf, $order, $order_id, $recipient, $sender, $bcc, $cc, $customer_name)
      {
         $message->subject('Ordine #'.$order_id);
         $message->from($sender);
         if ($cc !== '')
            $message->cc($cc);
         if ($bcc !== '')
            $message->bcc($bcc);
         $message->to($recipient);
         $message->attachData($pdf->output(), 'Ordine #'.$order_id.'.pdf');
      });
      
      return true;
    }

}
