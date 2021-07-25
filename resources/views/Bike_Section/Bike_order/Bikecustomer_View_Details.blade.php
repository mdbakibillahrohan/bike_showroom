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

                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <div class="card-body" style="background: aliceblue;border: 1px;border-radius: 15px;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <a href="">
                                                            <div class="ul-widget-app__profile-pic"><img class="profile-picture avatar-sm mb-2 rounded-circle img-fluid w-2" src="{{ asset($customerdata->customer_image != null? 'Media/Registration_document/'. $customerdata->customer_image:'') }}" alt="" style="width: 86px; height: 86px"/>

                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h4><a href=""><strong>Name : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->customer_name }}</span></a></h4>
                                                        <h5><strong>Guardian Name : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->guardian_name }}</span></h5>
                                                        <h5><strong>Address : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->address }}</span></h5>
                                                        <h5><strong>Mobile : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->mobile }}</span></h5>
                                                        <h5><strong>Customer ID : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->id }}</span></h5>
                                                        <div class="separator"> Guarantor Details </div>
                                                        <h5><strong>Guarantor Name : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->guarantorname }}</span></h5>
                                                        <h5><strong>Guarantor Address : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->guarantor_address }}</span></h5>
                                                        <h5><strong>Guarantor Phone : </strong> <span class="text-capitalize font-weight-bold">{{ $customerdata->guarantor_mobile }}</span></h5>
                                                        <div class="separator"> Purchase Details </div>
                                                        <h5><strong>Sell Type : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->bikesell_type }}</span></h5>
                                                        <h5><strong>Bike : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->bike->name }}</span></h5>
                                                        <h5><strong>Engine no : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->engine_no }}</span></h5>
                                                        <h5><strong>Sell price : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->sell_price }}</span></h5>
                                                        <h5><strong>Discount : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->discount }}</span></h5>
                                                        <h5><strong>Cash Payment : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->cashpayment }}</span></h5>
                                                        <h5><strong>Interest : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->interest }}</span></h5>
                                                        <h5><strong>EMI : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->installmentno }}</span></h5>
                                                        <h5><strong>EMI Amount : </strong> <span class="text-capitalize font-weight-bold">{{ $purchesh->installmentamount }}</span></h5>

                                                        <div class="separator"> Registration Details </div>
                                                        <h5><strong>Registration : </strong> <span class="text-capitalize font-weight-bold">{{ $registration->registrationtype }}</span></h5>
                                                        <h5><strong>Registration Amount : </strong> <span class="text-capitalize font-weight-bold">{{ $registration->registrationamount }}</span></h5>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body" style="background: aliceblue;border: 1px;border-radius: 15px;">
                                                <div>
                                                    <h4>National ID :</h4>
                                                     <img class="profile-picture mb-2 img-fluid w-2" src="{{ asset($customerdata->national_id != null? 'Media/Registration_document/'. $customerdata->national_id:'') }}" alt="" style="height: 272px;width: 372px;"/>
                                                </div>
                                                <div>
                                                    <h4>Address verification :</h4>
                                                      <img class="profile-picture mb-2 img-fluid w-2" src="{{ asset($customerdata->electric_bill != null? 'Media/Registration_document/'. $customerdata->electric_bill:'') }}" alt=""style="height: 272px;width: 372px;"/>
                                                </div>
                                                <div>
                                                    <h4>Other Document :</h4>
                                                    <img class="profile-picture mb-2 img-fluid w-2" src="{{ asset($customerdata->other_image != null? 'Media/Registration_document/'. $customerdata->other_image:'') }}" alt=""style="height: 272px;width: 372px;"/>
                                                </div>


                                            </div>
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


@section('pagescript')

@endsection


