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
                            <div class="card text-left">
                                <div class="card-header text-right bg-transparent">
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#expenseadd"> Add Expense</button>

                                </div>

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{route('expensesearch')}}" method="GET">
                                                {{ csrf_field() }}

                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-9 col-xs-9 col-sm-9 col-lg-9 col-9">
                                                                <div class="form-group">
                                                                    <input class="form-control" placeholder="From date" type="date" name="startdate" name="fromdate" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-9 col-xs-9 col-sm-9 col-lg-9 col-9">
                                                                <div class="form-group">
                                                                    <input class="form-control" placeholder="To date" type="date" name="enddate" name="todate" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-primary btn-md">Search</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="" style="width:100%">
                                            <thead class="thead-dark">
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
                                                <td><?php echo $record[$x]['amount']?></td>
                                                <td><?php echo $record[$x]['user_id']?></td>
                                            </tr>
                                            <?php $sl ++;?>
                                            <?php }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    $recive = Cache::get("expensedata_cash");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('expencedata.print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="expenseadd" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Expense Add</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('showroom.expense')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="showroomname" for=""> Expense Type :</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="cost_reason" id="" class="form-control">
                                        <option value="">Select Reason</option>
                                        <option value="Owner Receive">Owner Receive</option>
                                        <option value="Electric Bill">Electric Bill</option>
                                        <option value="House Rent">House Rent</option>
                                        <option value="Snacks">Snacks</option>
                                        <option value="Employ">Employ </option>
                                        <option value="Other Cost">Other Cost </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="Showroomphone" for=""> Expense Details :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="expense_details" class="form-control" id="" autocomplete="off" placeholder="Expense Details">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Mobile">Amount :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="amount" class="form-control" id="" placeholder="Expense Amount" >
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

