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

                                    <form action="{{route('BikeOrder.store')}}" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                        @csrf
                                        <input type="hidden" name="bike_id" id="bikeid">
                                        <input type="hidden" name="identity_id" id="identityid">
                                        <input type="hidden" name="installment_amount" id="installment_amount_post">
                                        <input type="hidden" name="Interest_include_duelast" id="Interest_include_due_last">
                                        <input type="hidden" name="bikelast_sell_amount" id="bikelast_sellamount">


                                        <div class="separator"> <span class="tx-danger"> * </span> Customer section <span class="tx-danger"> * </span></div>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Customer Name :<span class="tx-danger"> *</span></label>
                                                <input autofocus="autofocus" class="form-control form-control-rounded" type="text" name="customer_name" placeholder="Customer name" required="required" autocomplete="off" value="{{ old('customer_name') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Customer name !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Guardian Name :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="guardian_name" placeholder="Guardian Name" required="required" autocomplete="off" value="{{ old('guardian_name') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Guardian Name !
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Customer Address : <span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="address" placeholder="Customer Address" required="required" autocomplete="off" value="{{ old('address') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Customer Address !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Customer Mobile :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="mobile" placeholder="Customer Mobile" required="required" autocomplete="off" value="{{ old('mobile') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Customer Mobile !
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator"> <span class="tx-danger"> * </span> Product section <span class="tx-danger"> * </span></div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Sell Type :<span class="tx-danger"> *</span></label>
                                                <select class="form-control form-control-rounded" name="bikeselltype" id="bikesell_type" required>
                                                    <option value="">Select Type</option>
                                                    <option value="Cash">Cash Sell</option>
                                                    <option value="Onetime">Onetime Due</option>
                                                    <option value="Installment">Installment</option>

                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Sell Type !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Bike Name :<span class="tx-danger"> *</span></label>
                                                <input autofocus="autofocus" class="form-control form-control-rounded newtag" id="name_tags" placeholder="Bike Name" required autocomplete="off">
                                                <input type="hidden" class="form-control" id="tagsname" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Bike Name !
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Engine NO :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="EngineNO" id="engine_no" placeholder="Engine NO" required="required" autocomplete="off" value="{{ old('EngineNO') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Engine NO !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Chassis No :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="ChassisNo" id="chassis_no" placeholder="Chassis No" required="required" autocomplete="off" value="{{ old('ChassisNo') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Chassis No !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Bike Details :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="bikedetails" id="bike_details" placeholder="Bike Details" disabled/>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Bike Sell Price :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="bikesellprice" id="bike_sell_price" placeholder="Bike Sell Price" required="required" autocomplete="off" value="{{ old('bikesellprice') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Bike Sell Price !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Discount :</label>
                                                <input class="form-control form-control-rounded" type="text" name="discount" placeholder="Discount" id="discount_val" autocomplete="off" value="{{ old('discount') }}"/>

                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Pay Amount :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="payamount" id="pay_amount" placeholder="Pay Amount" disabled/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Pay Amount !
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator"> <span class="tx-danger"> * </span> Payment section <span class="tx-danger"> * </span></div>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Payment Way :<span class="tx-danger"> *</span></label>
                                                <select class="form-control form-control-rounded" name="paymentway" id="payment_way" required>
                                                    <option value="">Select Payment Way</option>
                                                    <option value="Cash Payment">Cash Payment</option>
                                                    <option value="Bank">Bank Check</option>
                                                    <option value="Card">Card Payment</option>
                                                    <option value="Mobile">Mobile Bank</option>

                                                </select>

                                                <div class="invalid-feedback">
                                                    Please provide a valid Payment Way !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Cash Payment :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="cashpayment" id="cash_payment" placeholder="Cash Payment" required="required" autocomplete="off" />
                                                <div class="invalid-feedback">
                                                    Please provide a valid Cash Payment !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Due Amount :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" id="due_amount" placeholder="Due Amount" disabled/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Due Amount !
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Interest :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="interest_cash" id="Interest_amount" placeholder="Interest Amount"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Due Amount !
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">

                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Total Dues :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" id="Interest_include_due" placeholder="Total Due Amount" disabled/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Due Amount !
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_way_append">

                                                </div>
                                            </div>
                                        </div>



                                        <div class="separator"> <span class="tx-danger"> * </span> Installment section <span class="tx-danger"> * </span></div>
                                        <div class="sell_typeappend">

                                        </div>


                                        <div class="separator"> <span class="tx-danger"> * </span> Registration section <span class="tx-danger"> * </span></div>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Vat Amount :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="vatamount" id="vat_payment" placeholder="Vat Payment" autocomplete="off" required value="{{ old('vatamount') }}"/>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Registration Type:<span class="tx-danger"> *</span></label>
                                                <select class="form-control form-control-rounded" name="registrationtype" id="registration_type">
                                                    <option value="">Registration Year</option>
                                                    <option value="2 Years">2 Years</option>
                                                    <option value="5 Years">5 Years</option>
                                                    <option value="10 Years">10 Years</option>

                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Registration Amount :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="registrationamount" id="registration_amount" placeholder="Registration Amount" autocomplete="off" value="{{ old('registrationamount') }}"/>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Total Pay Amount :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="totalpayment" id="total_payment" placeholder="Total Pay Amount" disabled/>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label">Payment :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="payment" id="payment_add" placeholder="Payment" autocomplete="off" required value="{{ old('payment') }}"/>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label"> Due Amount :<span class="tx-danger"> *</span></label>
                                                <input class="form-control form-control-rounded" type="text" name="registrationdue" id="registration_due" placeholder="Registration Due Amount"  autocomplete="off" value="{{ old('registrationdue') }}"/>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-control-label"> Delivery Date :<span class="tx-danger"> *</span></label>
                                                <input type="date" class="form-control form-control-rounded" name="DeliveryDate">

                                            </div>
                                        </div>
{{--                                        <div class="separator"> <span class="tx-danger"> * </span> Document verification  <span class="tx-danger"> * </span></div>--}}
{{--                                        <div class="form-row">--}}
{{--                                            <div class="col-md-3 mb-3">--}}
{{--                                                <label class="switch pr-5 switch-warning mr-3"><span> Customer Image</span>--}}
{{--                                                    <input type="checkbox" id="customer_image" /><span class="slider"></span>--}}
{{--                                                    <input type="hidden" name="customerimage" id="check_customer_image" value="0">--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3 mb-3">--}}
{{--                                                <label class="switch pr-5 switch-warning mr-3"><span> National ID</span>--}}
{{--                                                    <input type="checkbox" id="National_ID" /><span class="slider"></span>--}}
{{--                                                    <input type="hidden" name="NationalID" id="checkNational_ID" value="0">--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3 mb-3">--}}
{{--                                                <label class="switch pr-5 switch-warning mr-3"><span> Driving License </span>--}}
{{--                                                    <input type="checkbox" id="Driving_License" /><span class="slider"></span>--}}
{{--                                                    <input type="hidden" name="DrivingLicense" id="checkDriving_License" value="0">--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3 mb-3">--}}
{{--                                                <label class="switch pr-5 switch-warning mr-3"><span> Address Verify</span>--}}
{{--                                                    <input type="checkbox" id="address_verify" /><span class="slider"></span>--}}
{{--                                                    <input type="hidden" name="addressverify" id="addressverify_data" value="0">--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="separator"> <span class="tx-danger"> * </span> Document Upload  <span class="tx-danger"> * </span></div>
                                        <div class="form-row">
                                            <div class="col-md-3 form-group mb-3">
                                                <label for="credit2">Customer Image</label>
                                                <input type="file" class="form-control form-control-rounded" name="customer_image" id="" />
                                            </div>
                                            <div class="col-md-3 form-group mb-3">
                                                <label for="credit2">National ID</label>
                                                <input type="file" class="form-control form-control-rounded" name="national_id" id="" />
                                            </div>
                                            <div class="col-md-3 form-group mb-3">
                                                <label for="credit2">Address Document</label>
                                                <input type="file" class="form-control form-control-rounded" name="electric_bill" id="" />
                                            </div>
                                            <div class="col-md-3 form-group mb-3">
                                                <label for="credit2">Other Image</label>
                                                <input type="file" class="form-control form-control-rounded" name="other_image" id="" />
                                            </div>
                                        </div>

                                        <div class="separator"></div>
                                        <button class="btn btn-primary" id="submut_btn" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



@endsection


@section('pagescript')
    <script src="{{ asset('js/Bike/order.js') }}"></script>
@endsection


