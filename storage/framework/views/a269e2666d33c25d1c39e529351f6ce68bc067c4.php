<html style="width:100%">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    body {
        padding:50px;
        font-family:'Courier', sans-serif;
    }
    * { box-sizing:border-box; margin:0; font-weight:normal;}
    html, p {font-size:11px; line-height:16px;}
    
    div.page-break { page-break-inside:avoid; page-break-after:always; }
    
    h6 {
        font-size:13px;
    }
    h3 {
        font-size:17px;
    }
    h4 {
        font-size:15px;
    }
    table.bordered td {
        border:1px solid #FFDEFD;
        padding:10px 4px;
        max-width:30px;
    }
    table.bordered th {
       padding:16px 10px;
    }
    table.bordered th span {
        border-bottom:1px solid #770476;
    }
    .clearfix {
      overflow: auto;
      zoom: 1;
    }
    </style>
    <title>
        Ordine <?php echo $order->id; ?> di <?php echo $order->name; ?>

    </title>
</head>
<body style="width:100%">
<div id="container" style="width:100%;">

    <h3 style="line-height:1.3em">
        <?php echo \App\Option::where('name', 'orders_header')->value('value'); ?>

    </h3>
    <br><br>
    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <td style="width:50%; border:2px solid black; padding:10px">
                <h3>Ordine # <?php echo $order->id; ?></h3>
            </td>
            <td style="width:50%; border:2px solid black; padding:10px">
                <h3>Data: <?php echo $order->created_at->format('d/m/Y'); ?></h3>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:100%; border:2px solid black">
        <tr>
            <td style="width:50%; padding:10px">
                <h4><u><?php echo $order->customer_name; ?></u></h4>
                <p>
                    <br>
                    <?php echo $order->customer_email; ?><br>
                    <?php echo $order->customer_contact; ?><br>
                    <br>
                </p>
            </td>
        </tr>
    </table>
    <br>

    <table style="width:100%">
        <tr>
            <td style="width:100%">
                Di seguito l'elenco dei servizi acquistati:
            </td>
        </tr>
    </table>
    <br><br>
    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <th style="border:2px solid black; padding:10px;">
                <h4>Tipologia</h4>
            </th>
            <th style="border:2px solid black; padding:10px;">
                <h4>Servizio</h4>
            </th>
            <th style="border:2px solid black; padding:10px;">
                <h4>Prezzo</h4>
            </th>
        </tr>

        <?php $__currentLoopData = \App\OrderDetail::where('order_id', $order->id)->orderBy('area_id')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
               <td style="padding:10px; border:2px solid black">
                  <?php echo \App\Area::find($detail->area_id)->name; ?>

               </td>
               <td style="padding:10px; border:2px solid black">
                  <?php echo $detail->name; ?>

               </td>
               <td style="padding:10px; border:2px solid black; text-align:center">
                  €   <?php echo $detail->total_price; ?>

               </td>
            </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

         <tr>
            <td></td>
            <td></td>
            <td style="padding:10px; border:2px solid black; text-align:center; font-weight:bold">
               €   <?php echo number_format( \App\OrderDetail::where('order_id', $order->id)->sum('total_price'), 2, ',','.'); ?>

            </td>
         </tr>
    </table>
    <br><br>
    <div>
        
    </div>

</body>
</html>