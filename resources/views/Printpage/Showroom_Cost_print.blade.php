<link rel="stylesheet" href="{{ asset('Admin_asset/print/fullprint.css')}}">
@extends('print_layouts.print_master_layout')
@section('content')

    <div id="product">
        <div class="product overflow-auto">

            <div class="shohroomdata">
                <?php
                $showroomdata = Cache::get("showroom");
                $id = $showroomdata->id;
                $showroomdata = DB::table('showrooms')
                    ->where('id',$id)
                    ->first();
                ?>
                <div class="row">
                    <div class="col">
                        <div class="printhead">
                            <h4>{{$showroomdata->showroom_name}}</h4>
                            <h6>{{$showroomdata->showroom_details}}</h6>
                            <h6>{{$showroomdata->address.", ".$showroomdata->mobile}}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-b-40">
                            <table class="table table-striped table-data3 data-table1">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Showroom</th>
                                        <th>Expense</th>
                                        <th>Amount</th>
                                        <th>Cost By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php use Illuminate\Support\Facades\Cache;$sl = 1;?>
                                <?php

                                $totalelement = count($record);
                                $balance = $record[0]['amount'];

                                for($x = 0; $x <= $totalelement-1; $x++){

                                $particular = $record[$x]['reason'];
                                $amount = $record[$x]['amount'];
                                $serial = $record[$x]['serial'];


                                ?>

                                <tr>
                                    <td>{{$sl}}</td>
                                    <td><?php echo $record[$x]['date']?></td>
                                    <td><?php echo $record[$x]['showroom_id']?></td>
                                    <td><?php echo $record[$x]['reason']?></td>
                                    <td class="cost"><?php echo $record[$x]['amount']?></td>
                                    <td><?php echo $record[$x]['user_id']?></td>
                                </tr>
                                <?php $sl ++;?>
                                <?php }

                                ?>

                                <tr>
                                    <td colspan="5" style="font-size: 14px; font-weight: bold; text-align: right;" class="allcost"> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="signaturre">
                    <h6 style="text-align: right;
    margin-right: 46px; text-decoration: underline; margin-bottom: 10px;"></h6>
                    <hr>
                    <p style="text-align: center">Invoice was created on a computer and is valid without the signature and seal.</p>
                </div>
            </main>
        </div>
    </div>

@endsection
@section('pagescript')
    <script type="text/javascript" src="{{ asset('Admin_asset/print/ajax.jquery.min.js') }}"></script>
    <script>

        $(function(){
            function tally (selector, columnname, textline="") {
                $(selector).each(function () {
                    var total = 0,
                        column = $(this).siblings(selector).andSelf().index(this);
                    $(this).parents().prevUntil(':has(' + selector + ')').each(function () {
                        total += parseFloat($(columnname + column + ')', this).html()) || 0;
                    })
                    $(this).html(textline+total);
                });
            }
            tally('td.allcost','td.cost:eq(' , "Total Cost Amount : ");
            tally('td.allpay','td.buy:eq(' , "Total Buy Amount : ");

        });
    </script>
@endsection
