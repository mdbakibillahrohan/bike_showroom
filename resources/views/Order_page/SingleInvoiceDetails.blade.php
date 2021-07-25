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
                                    <a href="{{route('Order_invoice.Print',$last_invoice->invoice_id)}}" class="btn-success btn-sm" style="float: right; color: #f7f7ff; margin-right: 20px;" target="_blank">Print</a>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Customer</strong>
                                            </div>
                                            ------------------------
                                            <div><strong> Name :  </strong>{{$orderdata->customer->customer_name}}</div>
                                            <div><strong>Previous Blanch : </strong> {{round($previus_invoice->accounts)}}</div>
                                            <div><strong>Last Blanch : </strong> {{round($last_invoice->accounts)}} </div>
                                            <div><strong>Return Invoice : </strong> {{$orderdata->return_invoice}} </div>
                                            <div><strong>Return Cash : </strong> {{$orderdata->return_cash}} </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div><a class="btn btn-primary" href="{{route('Order.show',$last_invoice->invoice_id -1)}}" role="button">Back</a>	&nbsp;	&nbsp;
                                                <a class="btn btn-primary" href="{{ route('Order.show',$last_invoice->invoice_id +1) }}" role="button">Next</a></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Last Invoice ({{$last_invoice->invoice_id}})</strong>
                                            </div>

                                            ------------------------
                                            <div><strong>Sell Amount : </strong> {{$orderdata->total_sellprice}} </div>
                                            <div><strong>Discount : </strong>{{$orderdata->sell_discount}} </div>
                                            <div><strong>Cost Amount : </strong> {{$orderdata->sell_cost}}</div>
                                            <div><strong>Actual Sell : </strong> {{$orderdata->lastsell_amount}}</div>
                                            <div><strong>Invoice Payment : </strong> {{@$customerpayment->pay_amount}}</div>
                                            <div><strong>Blanch : </strong>{{$orderdata->lastsell_amount - @$customerpayment->pay_amount}} </div>
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
                                                    <th>Sell</th>
                                                    <th>Sell Total</th>
                                                    <th>Cost</th>
                                                    <th>Discount</th>
                                                    <th>Payable</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php //dd($invoiceviewdata); ?>
                                                <?php $sl = 1; ?>
                                                @foreach ($InvoicePurchase as $row)
                                                    <tr>
                                                        <td>{{ $sl}}</td>
                                                        <td>{{$row->product->product_name}}</td>
                                                        <td>{{ $row->product_code}}</td>
                                                        <td>{{ $row->attribute}}</td>
                                                        <td>{{ $row->quantity}}</td>
                                                        <td>{{ $row->sellprice}}</td>
                                                        <td>{{ $row->sellprice * $row->quantity}}</td>
                                                        <td>{{ $row->sell_cost}}</td>
                                                        <td>{{ $row->sell_discount}}</td>
                                                        <td class="buy">{{ $row->lastsell_amount}}</td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
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




