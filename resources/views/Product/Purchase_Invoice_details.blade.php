@extends('Purchase_layouts.Purchase_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
                <section class="contact-list">

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('invoicedata.print',$last_invoice->invoice_id)}}" class="btn-success btn-sm" style="float: right; color: #f7f7ff; margin-right: 20px;" target="_blank">Print</a>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Supplier</strong>
                                            </div>
                                            ------------------------
                                            <div><strong> Name :  </strong>{{$singlePurchaseall->supplier->suplier_name}}</div>
                                            <div><strong>Previous Blanch : </strong> {{$previus_invoice->accounts}}</div>
                                            <div><strong>Last Blanch : </strong> {{$last_invoice->accounts}} </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div><a class="btn btn-primary" href="{{ route('Purchase_invoice.Details',$last_invoice->invoice_id -1) }}" role="button">Back</a>	&nbsp;	&nbsp;
                                                <a class="btn btn-primary" href="{{ route('Purchase_invoice.Details',$last_invoice->invoice_id +1) }}" role="button">Next</a></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Last Invoice ({{$last_invoice->invoice_id}})</strong>
                                            </div>

                                            ------------------------
                                            <div><strong>Buy Amount : </strong> {{$singlePurchase->sub_total_buy}} </div>
                                            <div><strong>Discount : </strong>{{$singlePurchase->discount}} </div>
                                            <div><strong>Cost Amount : </strong> {{$singlePurchase->buy_cost}}</div>
                                            <div><strong>Actual Buy : </strong> {{$singlePurchase->actual_buy}}</div>
                                            <div><strong>Invoice Payment : </strong> {{@$supllierpayment->pay_amount}}</div>
                                            <div><strong>Blanch : </strong>{{$singlePurchase->actual_buy - @$supllierpayment->pay_amount}} </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-data3 data-table1">
                                                <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product</th>
                                                    <th>Code</th>
                                                    <th>Symbol</th>
                                                    <th>Quantity</th>
                                                    <th>Buy</th>
                                                    <th>Cost</th>
                                                    <th>Discount</th>
                                                    <th>Payable</th>
                                                    <th>Sell price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php //dd($invoiceviewdata); ?>
                                                <?php $sl = 1; ?>
                                                    @foreach ($InvoicePurchase as $row)
                                                        @php
                                                            $barcodedata = \App\Admin_model\Barcode::where('purchase_id',$row->id)->first();
                                                        @endphp

                                                        <tr>
                                                            <td>{{ $sl}}</td>
                                                            <td>{{$row->product->product_name}}</td>
                                                            <td>{{@$barcodedata->barcode}}</td>
                                                            <td>{{$row->attribute}}</td>
                                                            <td>{{ $row->quantity}}</td>
                                                            <td>{{ $row->buy_price}}</td>
                                                            <td>{{ $row->buy_cost}}</td>
                                                            <td>{{ $row->discount}}</td>
                                                            <td class="buy">{{ $row->actual_buy}}</td>
                                                            <td>{{ $row->sell_price}}</td>
                                                        </tr>
                                                        <?php $sl++; ?>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="7" style="font-size: 14px; font-weight: bold; text-align: right;" class="allbuy"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="footer_list text-center">
                                        <footer>
                                            Invoice was created on a computer and is valid without the signature and seal.
                                        </footer>
                                    </div>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection




