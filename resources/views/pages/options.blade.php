@extends('layout.main')
@section('content')

    <div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-8">
        <!-- START PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
            <div class="panel-title">
               Opzioni di configurazione
            </div>
            </div>
            <div class="panel-body">
            <h5></h5>
            {!!Form::open(['url'=>'options/save', 'method'=>'POST'])!!}
               <hr>
                <div class="form-group required ">
                    <label>
                        Nascondi il costo fornitore durante la creazione dell'ordine
                        <input type="checkbox" name="hide_supplier_prices" value="1" @if ($options['hide_supplier_prices'] == 1) checked="checked" @endif style="margin-left:10px" />
                    </label>
                </div>
                <hr>
                <div class="form-group required ">
                    <label>Indirizzo mail CC</label>
                    <input type="email" name="mail_cc" class="form-control" value="{!!$options['mail_cc']!!}"></input>
                </div>
                <hr>
                <div class="form-group required ">
                    <label>Indirizzo mail CCN</label>
                    <input type="email" name="mail_bcc" class="form-control" value="{!!$options['mail_bcc']!!}"></input>
                </div>
                <hr>
                <div class="form-group required ">
                    <label>Intestazione Ordini</label>
                    <textarea name="orders_header" class="form-control summernote">{!!$options['orders_header']!!}</textarea>
                </div>
                <hr>
                <br>
                {!!Form::submit('SALVA OPZIONI', ['class'=>'btn btn-danger'])!!}
            {!!Form::close()!!}
            </div>
        </div>
        <!-- END PANEL -->
        </div>
        <div class="col-md-4">
        <!-- START PANEL -->
            <div class="panel panel-transparent">
                <div class="panel-heading">
                <div class="panel-title">Configura l'applicazione
                </div>
                </div>
                <div class="panel-body">
                <h3>
                    In questa sezione puoi gestire alcune funzionalità variabili all'interno dell'applicazione
                </h3>
                <br><br>
                <p>CHANGELOG:</p>
                <br>
                    29.12.2016 - v. 0.2 - Svariate aggiunte/modifiche:
                    <ul>
                        <li>Nuova gestione macro aree</li>
                        <li>Aggiunte funzionalità tabelle (filtering, ordering, export)</li>
                        <li>Ampliata la maschera di inserimento/modifica ordine</li>
                        <li>Nuova pagina di configurazione app</li>
                        <li>Possibilità di nascondere il prezzo fornitore</li>
                        <li>PDF export dell'ordine</li>
                        <li>Invio dell'ordine via Email</li>
                        <li>Bug fix minori</li>
                    </ul>
                    24.12.2016 - v. 0.1 - Prima versione pubblicata.
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END CONTAINER FLUID -->
</div>
<!-- END PAGE CONTENT -->

@stop