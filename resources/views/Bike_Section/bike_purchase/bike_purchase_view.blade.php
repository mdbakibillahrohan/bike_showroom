@extends('Purchase_layouts.Purchase_master_layout')
@section('content')
    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
                <section class="contact-list">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card text-center">
                                <div class="card-body">

                                    <form action="{{route('Bikepurchase.store')}}" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="ProductName">Dealer Name</label>
                                                            <select class="form-control form-control-rounded" name="suplier_id" id="ProductName">
                                                                <option value="">Select Dealer</option>
                                                                @foreach($supplier as $data)
                                                                    <option value="{{$data->id}}">{{$data->suplier_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please provide a valid Dealer Name !
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="ProductName">Name Of Bike</label>
                                                            <select class="form-control form-control-rounded" name="bike_id" id="ProductName">
                                                                <option value="">Select Bike</option>
                                                                @foreach($allbike as $data)
                                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please provide a valid Product Name !
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="Quantity">Bike Quantity</label>
                                                            <input class="form-control form-control-rounded" type="text" name="quantity" id="Quantity" placeholder="Bike Quantity" required="required" autocomplete="off" value="{{ old('quantity') }}"/>
                                                            <div class="invalid-feedback">
                                                                Please provide a valid Bike Quantity !
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="BuyPrice">Buy Price</label>
                                                            <input class="form-control form-control-rounded" type="text" name="buyprice" id="BuyPrice" placeholder="Buy Price" required="required" autocomplete="off" value="{{ old('buyprice') }}"/>
                                                            <div class="invalid-feedback">
                                                                Please provide a valid Buy Price !
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="BuyCommission">Buy Commission</label>
                                                            <input class="form-control form-control-rounded" type="text" name="buycommission" id="BuyCommission" placeholder="Buy Commission" required="required" autocomplete="off" value="{{ old('buycommission') }}"/>
                                                            <div class="invalid-feedback">
                                                                Please provide a valid Buy Commission !
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="SellPrice">Sell Price</label>
                                                            <input class="form-control form-control-rounded" type="text" name="sellprice" id="SellPrice" placeholder="Sell Price" required="required" autocomplete="off" value="{{ old('sellprice') }}"/>
                                                            <div class="invalid-feedback">
                                                                Please provide a valid Sell Price !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3 field_wrapper">
                                                            <label for="credit2">Engine NO</label>
                                                            <div class="appendbody">
                                                                <input type="text"  class="form-control form-control-rounded appendform" name="engine_no[]" value="" placeholder="Engine NO" required autocomplete="off" />
                                                                <a href="javascript:void(0);" class="add_group" title="Add field"><img src="{{asset('Media/image/add-icon.png')}}" alt="image" /></a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 form-group mb-3 field_wrappergroup">
                                                            <label for="credit2">Chassis No</label>
                                                            <div class="appendbody">
                                                                <input type="text"  class="form-control form-control-rounded appendform" name="chassis_no[]" value="" placeholder="Chassis No" required autocomplete="off"/>
                                                                <a href="javascript:void(0);" class="add_group" title="Add field"><img src="{{asset('Media/image/add-icon.png')}}" alt="image"/></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="table-responsive">
                    <table class="table" id="ul-contact-list" style="width:100%">
                        <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>Invoice</th>
                            <th>Bike</th>
                            <th>Quantity</th>
                            <th>Buy Amount</th>
                            <th>Total Amount</th>
                            <th>Update</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl = 1; ?>
                        @foreach ($bikepurches as $row)
                            <tr>
                                <td>{{ $sl}}</td>
                                <td>{{ $row->date}}</td>
                                <td>{{ $row->supplier->suplier_name}}</td>
                                <td>{{ $row->invoice}}</td>
                                <td>{{ $row->bike->name}}</td>
                                <td>{{ $row->quantity}}</td>
                                <td>{{ $row->buy_price}}</td>
                                <td>{{ $row->buy_price * $row->quantity}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success">View</a>
                                    <a href="#" class="btn btn-sm btn-warning">Delete</a>
                                </td>
                            </tr>
                            <?php $sl++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('pagescript')
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 30;
            var addButton = $('.add_group');
            var wrapper = $('.field_wrapper');
            var fieldHTML = '<div class="appendbody"><input type="text" class="form-control form-control-rounded appendform" name="engine_no[]" value="" placeholder="Engine NO" required autocomplete="off"/><a href="javascript:void(0);" class="remove_button"><img src="{{asset('Media/image/remove-icon.png')}}" /></a></div>';

            var x = 1;
            $(addButton).click(function(){
                if(x < maxField){
                    x++;
                    $(wrapper).append(fieldHTML);
                }
            });


            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 30;
            var addgroup = $('.add_group');
            var wrapper_group = $('.field_wrappergroup');
            var fieldHTMLg = '<div class="appendbody"><input type="text" class="form-control form-control-rounded appendform" name="chassis_no[]" value="" placeholder="Chassis No" required autocomplete="off"/><a href="javascript:void(0);" class="remove_group"><img src="{{asset('Media/image/remove-icon.png')}}" /></a></div>';

            var x = 1;
            $(addgroup).click(function(){
                if(x < maxField){
                    x++;
                    $(wrapper_group).append(fieldHTMLg);
                }
            });

            $(wrapper_group).on('click', '.remove_group', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            });
        });
    </script>
@endsection


