

@extends('Purchase_layouts.Purchase_master_layout')
@section('content')
    <style>
        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 10px;
        }
    </style>
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
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addsupplier"><i class="i-Add-User text-white mr-2"></i> Add Supplier</button>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Supplier</th>
                                                <th>Address</th>
                                                <th>Mobile</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <th>Payment</th>
                                                <th>Edit</th>
{{--                                                <th>Delete</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use App\Product_model\Purchase;$i=1;?>
                                            @foreach($allsupplier as $row)
                                                @php
                                                $supplier_ac = DB::table('supplier_accounts')
                                                ->where('supplier_id',$row->id)
                                                ->orderBy('supplier_accounts.id', 'DESC')
                                                ->first();

                                                 if ($supplier_ac->status==1){
                                                    $status = "Due";
                                                }else{
                                                    $status = "Adv";
                                                }
                                                @endphp
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->suplier_name}}</td>
                                                    <td>{{$row->address}}</td>
                                                    <td>{{$row->mobile}}</td>
                                                    <td>{{$supplier_ac->accounts}}</td>
                                                    <td>{{$status}}</td>
                                                    <td>
                                                        <?php
                                                        $totalbuy = Purchase::where('supplier_id',$row->id)
                                                            ->select('supplier_id', DB::raw('SUM(actual_buy) as actual_buy'))
                                                            ->groupBy('supplier_id')
                                                            ->first();
                                                        if ($totalbuy==null){
                                                        ?>
                                                        <a href="#" class="btn btn-primary btn-sm" >view</a>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <a href="{{route('supplier.show',$row->id)}}" target="_blank" class="btn btn-primary btn-sm" >view</a>
                                                        <?php

                                                        }
                                                        ?>

                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-sm supplier_payment" id="{{$row->id}}">Payment</button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm supplier_edit" id="{{$row->id}}" >Edit</button>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        <button type="button" class="btn btn-danger btn-sm" id="delete" >Delete</button>--}}
{{--                                                    </td>--}}


                                                </tr>
                                                <?php $i++;?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addsupplier" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Supplier</h4>
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
                    <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Supplier Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="suplier_name" class="form-control" placeholder="Supplier Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="address_add" placeholder="Address" >
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" class="form-control" id="mobile_add" placeholder="Contact" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Previous Ledger</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="previus_ledger" class="form-control"  placeholder="Previous Ledger">
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


    <div class="modal fade" id="suplier_payment" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Supplier Payment <b id="suplier_name" style="float: right"></b></h4>
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

                    <form action="{{route('supplier.payment')}}" method="POST"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="suplierid" name="suplier_id">
                        <input type="hidden" id="previus_bala" name="previusbalanch">
                        <input type="hidden" id="last_balanch" name="lastbalanch">
                        <input type="hidden" id="showroom" name="showroom_id">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Previous Blanch</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="balanch_status" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Invoice ID By</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control"  name="invoice_id" id="select_invoice" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Payment</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="newpay" class="form-control"  id="new_pay_amount" placeholder="Payment Amount">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Last Blanch</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="last_status" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Receipt no</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="reciptno" class="form-control"  id="" placeholder="Money Receipt No">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Payment Way</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control"  name="paymentway" id="">
                                        <option value="">Select Payment Way</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Check">Bank</option>
                                        <option value="Mobile_bank">Mobile Bank</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Payment Date</label>
                                </div>
                                <div class="col-md-8">
                                    <?php  $n_dat= date("Y-m-d"); ?>
                                    <input type="date" class="form-control" name="paymentdate" id="" value="{{$n_dat}}" required>
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


    <div class="modal fade" id="editsupplier" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Update Supplier</h4>
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
                    <form action="" class="editsupplier_data" method="POST"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="account_id" id="accounts_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Supplier Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" placeholder="Supplier Name" id="supplier_nameedit">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="address_edit" placeholder="Address" >
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" class="form-control" id="mobile_edit" placeholder="Contact" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Previous Ledger</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="previus_ledger" class="form-control"  id="ledger_edit">
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

@section('pagescript')

    <script>
        $(function(){
            var oldbalanch = 0;
            var oldstatus = '';

            $('.supplier_payment').on('click', function(){
                var supplier = $(this).attr("id");
                $("#suplierid").val(supplier);
                $.ajax({
                    type: 'GET',
                    url:'/SupplierpreviusData/'+supplier,

                    success: function (data) {
                        var mydata = $.parseJSON(data);
                        var account = (mydata.Accounts);
                        var payment= (mydata.Payment);
                        var invoice= (mydata.invoicedata);
                        oldbalanch = account.accounts;
                        oldstatus = account.status;
                        var select = '';
                        if (invoice != null){
                            select += '<option value="">Select Invoice</option>';
                            $.each(invoice, function (index, obj) {
                                select += ('<option value="'+ obj.id +'">' + obj.invoice_no + '</option>');
                            });
                        }
                        $('#select_invoice').html(select);

                        $("#balanch_status").val(oldbalanch);
                        $("#previus_bala").val(oldbalanch);
                        $("#showroom").val(account.showroom_id);

                    }
                });
                $("#suplier_payment").modal('show');

                $('#new_pay_amount').on('change', function(){
                    var payamount = $("#new_pay_amount").val();
                    var newbalanch = oldbalanch - payamount;
                    $("#last_balanch").val(newbalanch);
                    $("#last_status").val(newbalanch);

                });

            });


            $(".supplier_edit").click(function(event) {
                var supplierid = $(this).attr('id');

                $.ajax({
                    type: 'GET',
                    url:'/supplier/'+supplierid+'/edit',

                    success: function (data) {
                        //console.log(data);
                        $("#ledger_edit").val(data.accounts);
                        $("#address_edit").val(data.address);
                        $("#mobile_edit").val(data.mobile);
                        $("#supplier_nameedit").val(data.suplier_name);
                        $("#accounts_id").val(data.account_id);

                        $('.editsupplier_data').attr('action', '/supplier/'+supplierid);
                    }
                });
                $("#editsupplier").modal('show');

            });

        });
    </script>




@endsection


