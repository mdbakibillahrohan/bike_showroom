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
                                        <a href="{{route('supplier_calculation_print')}}" class="btn-success btn-sm" style="float: right; margin-right: 20px;" target="_blank">Print</a>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Supplier</strong>
                                            </div>
                                            ------------------------
                                            <div><strong>Name :  </strong>{{$supplierData->suplier_name}}</div>
                                            <div><strong>Address : </strong> {{$supplierData->address}}</div>
                                            <div><strong>Phone : </strong> {{$supplierData->mobile}} </div>
                                            <div><strong>Supplier ID : </strong> {{$supplierData->id}} </div>
                                        </div>
                                        <div class="col-md-5">

                                        </div>
                                        <div class="col-md-3">
                                            <div><strong>First Added : </strong> {{$supplierFirstAccount->accounts}} </div>
                                            <div><strong>Total Buy : </strong> {{round($totalbuy->actual_buy)}} </div>
                                            <div><strong>Total Payment : </strong>{{round($totalpayment->pay_amount)}} </div>
                                            @php
                                            if ($supplierAccount->status==1){
                                                    $status = round($supplierAccount->accounts)." Tk Due";
                                            }else{
                                                    $status = round($supplierAccount->accounts)." Tk Adv";
                                            }

                                            @endphp
                                            <div><strong>Blanch : </strong> {{$status}}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-data3 data-table1">
                                                <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Invoice</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Buy</th>
                                                    <th>Cost</th>
                                                    <th>Discount</th>
                                                    <th>Buy/Pay</th>
                                                    <th>Blanch</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php use Illuminate\Support\Facades\Cache;$sl = 1;?>
                                                <?php

                                                $totalelement = count($record);
                                                $balance = $record[0]['amount'];

                                                for($x = 0; $x <= $totalelement-1; $x++){

                                                $particular = $record[$x]['particular'];
                                                $amount = $record[$x]['amount'];
                                                $serial = $record[$x]['serial'];

                                                if($serial!=0 && $particular=="Buy"){
                                                    $balance += $amount;
                                                }elseif($serial!=0 && $particular=="Payment"){
                                                    $balance -= $amount;
                                                }elseif($serial==0 && $particular=="Buy"){
                                                    $balance = $balance ;
                                                }elseif($serial==0 && $particular=="Payment"){
                                                    $balance = -$balance ;
                                                }

                                                ?>

                                                <tr>
                                                    <td>{{$sl}}</td>
                                                    <td>
                                                        <?php

                                                        if ($record[$x]['purchase_date']==null){

                                                            echo $record[$x]['payment_date'];

                                                        }else{

                                                            echo $record[$x]['purchase_date'];

                                                        }

                                                        ?></td>
                                                    <td><?php echo $record[$x]['invoice_no']." - ". $record[$x]['particular']?></td>
                                                    <?php
                                                    if ($record[$x]['particular']== "Payment"){
                                                        $product_id = "-";
                                                        $quantity = "-";
                                                        $buyprice = "-";
                                                        $buy_discount = "-";
                                                        $buy_cost = "-";
                                                    }else{
                                                        $product_id = $record[$x]['product_id'];
                                                        $quantity = $record[$x]['quantity'];
                                                        $buyprice = $record[$x]['buy_price'];
                                                        $buy_discount = $record[$x]['discount'];
                                                        $buy_cost = $record[$x]['buy_cost'];
                                                    }
                                                    ?>
                                                    <td>{{$product_id}}</td>
                                                    <td>{{$quantity}}</td>
                                                    <td>{{$buyprice}}</td>
                                                    <td>{{$buy_discount}}</td>
                                                    <td>{{$buy_cost}}</td>
                                                    <td><?php echo $record[$x]['amount']?></td>
                                                    <td>
                                                        <?php echo $balance;?>
                                                    </td>
                                                    <td> <?php if($balance > 0){echo '<span style="color: red">Due</span>';}elseif($balance == 0){ echo '<span style="color: green">Paid</span>';}else{ echo '<span style="color: blue">Advance</span>';}?></td>
                                                </tr>
                                                <?php $sl ++;?>
                                                <?php }

                                                ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection




