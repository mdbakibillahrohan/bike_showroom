@php
    use App\Showroom_model\Showroom;$userstatus = Auth::user()->role_id;
        $showroomdata = Cache::get("showroom");
        $getlink =  "Showroom/Access"."/".$showroomdata->slag;
        if ($showroomdata->slag != ""){
            $url = URL::to($getlink);
        }else{
           if ($userstatus==1){
                $url = URL::to('Admin/Dashboard');
            }else{
                $url = URL::to('User/Dashboard');
            }
        }

            if ($userstatus==1){
                $backurl = URL::to('Admin/Dashboard');
            }else{
                $backurl = URL::to('User/Dashboard');
            }

       if($showroomdata->showroom_image !=null){
           $showroom_logo=URL::to('/Media/showroom/'.$showroomdata->showroom_image);
       }else{
           $showroom_logo = URL::to('/Media/showroom/logo.png');
       }


@endphp
    <div class="main-header">
        <div class="logo">
            <a href="{{$url}}"><img src="{{$showroom_logo}}" alt=""></a>
        </div>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>



        <div style="margin: auto;font-size: 21px; font-weight: bold;font-family: cursive; color: rgb(31 173 14 / 75%);">{{$showroomdata->showroom_name}}</div>
        <div class="header-part-right">

            <div class="dropdown">
                <buton></buton>
                <div class="badge-top-container" role="button">
                    <a href="{{$backurl}}"> <img src="{{ URL::to('Media/icon/Go-back.ico') }}" width="20px;"></a>
                </div>
            </div>
            <div class="dropdown">
                <div class="user col align-self-end">
                    @php
                        $userdata = Auth::user();
                       if ($userdata != null){
                           if($userdata->image !=null){
                               $urlimage=URL::to('/Media/user_profile/'.$userdata->image);
                           }else{
                               $urlimage = URL::to('/Media/user_profile/avatar.png');
                           }
                       }else{
                         $urlimage = URL::to('/Media/user_profile/avatar.png');
                       }
                    @endphp
                    <img src="{{$urlimage}}" id="userDropdown" alt="Image" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i> {{Auth::user()->name}}
                        </div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#updateprofile">Profile Update</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><span class="edu-icon edu-locked author-log-ic"></span>
                            {{ __('Sign out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <ul class="navigation-left">
                <li class="nav-item" data-item=""><a class="nav-item-hold" href="{{$dashboardUrl}}"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                    <div class="triangle"></div>
                </li>
                @if ($panelName=="product")
                <li class="nav-item" data-item="Product"><a class="nav-item-hold" href="#"><i class="nav-icon i-Checkout-Basket"></i><span class="nav-text">Product</span></a>
                    <div class="triangle"></div>
                </li>
                @endif

                <li class="nav-item" data-item="Order"><a class="nav-item-hold" href="#"><i class="nav-icon i-Financial"></i><span class="nav-text">Order</span></a>
                    <div class="triangle"></div>
                </li>

                @if ($panelName=="bike")
                <li class="nav-item" data-item="Bike_nav"><a class="nav-item-hold" href="#"><img src="{{ URL::to('Media/icon/bikelogo.png')}}" alt="" width="55px"><span class="nav-text">Bike</span></a>
                    <div class="triangle"></div>
                </li>
                @endif

                <li class="nav-item" data-item="accounts"><a class="nav-item-hold" href="#"><i class="nav-icon i-Money-2"></i><span class="nav-text">Accounts</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="report"><a class="nav-item-hold" href="#"><i class="nav-icon i-Bell"></i><span class="nav-text">Report</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="setting"><a class="nav-item-hold" href="#"><i class="nav-icon i-Gear"></i><span class="nav-text">Setting</span></a>
                    <div class="triangle"></div>
                </li>

            </ul>
        </div>
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <ul class="childNav" data-parent="Product">

                @if ($panelName=="product")
                <li class="nav-item"><a href="{{route('categories.index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Add Category  </span></a></li>
                <li class="nav-item"><a href="{{route('subcategories.index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Sub Category  </span></a></li>
                <li class="nav-item"><a href="{{route('brand.index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Brand  </span></a></li>
                <li class="nav-item"><a href="{{route('Product.index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Add Product  </span></a></li>
                <li class="nav-item"><a href="{{route('Product.List')}}"><i class="nav-icon i-Add"></i><span class="item-name">Product List </span></a></li>
                <li class="nav-item"><a href="{{route('product.purchase_index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Product Purchase  </span></a></li>
                <li class="nav-item"><a href="{{route('product.stoke_index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Product Stoke  </span></a></li>
                <li class="nav-item"><a href="{{route('product.details_index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Purchase Details  </span></a></li>
                @endif

                &nbsp&nbsp&nbsp----------------------------
                @if ($panelName=="bike")

                @endif

            </ul>
            <ul class="childNav" data-parent="Order">
                <li class="nav-item"><a href="{{route('bike.sell')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Bike Sell</span></a></li>
                <li class="nav-item"><a href="{{route('bikesell.details')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Sell Details </span></a></li>
                &nbsp&nbsp&nbsp -----------------------------
                <li class="nav-item"><a href="{{route('Order.Index')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Sell Order</span></a></li>
                <li class="nav-item"><a href="{{route('Order.Invoice')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Invoice Order </span></a></li>
                <li class="nav-item"><a href="{{route('Order.Details')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Order Details </span></a></li>
                <li class="nav-item"><a href="{{route('order.return')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Return Order </span></a></li>
                <li class="nav-item"><a href="{{route('return.details')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Return Details </span></a></li>
            </ul>
            <ul class="childNav" data-parent="accounts">
                <li class="nav-item"><a href="{{route('supplier.indexdata')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Suppliers</span></a></li>
                <li class="nav-item"><a href="{{route('customer.index')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Customers</span></a></li>
                <li class="nav-item"><a href="{{route('showroom.cost')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Showroom Cost</span></a></li>
                <li class="nav-item"><a href="{{route('showroom.profit')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Showroom Profit</span></a></li>
                <li class="nav-item"><a href="{{route('showroom.recivecash')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Receive Cash</span></a></li>
            </ul>
            <ul class="childNav" data-parent="report">
                <li class="nav-item"><a href="{{route('showroom.summery')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Showroom Summery</span></a></li>
                <li class="nav-item"><a href="{{route('product.stokefilter')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Product Stoke Search</span></a></li>
                <li class="nav-item"><a href="{{route('selling.details')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Selling Report</span></a></li>
            </ul>
            <ul class="childNav" data-parent="setting">
                <li class="nav-item"><a href="{{route('showroom.vatsetting')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Vat setting</span></a></li>
                <li class="nav-item"><a href="{{route('showroom.printerset')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Print Setting</span></a></li>
                <li class="nav-item"><a href="{{route('barcode.generate')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Product Barcode</span></a></li>
            </ul>

            <ul class="childNav" data-parent="Bike_nav">

                <li class="nav-item"><a href="{{route('bike.nameadd')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Bike Add</span></a></li>
                <li class="nav-item"><a href="{{route('bike.purchase')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Bike Purchase</span></a></li>
                <li class="nav-item"><a href="{{route('bike.stokedetails')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Bike Stoke</span></a></li>

                <li class="nav-item"><a href="{{route('bikesell.installment')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Installment </span></a></li>
                <li class="nav-item"><a href="{{route('payment.received')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Payment Receive </span></a></li>
                <li class="nav-item"><a href="{{route('registration.details')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name">Bike Registration </span></a></li>
                <li class="nav-item"><a href="{{route('customer.accounts_details')}}"><i class="nav-icon i-Car-Items"></i><span class="item-name"> Customer Accounts</span></a></li>
            </ul>

        </div>

        <div class="sidebar-overlay"></div>

    </div>



{{--Profile Update--}}

<div class="modal fade" id="updateprofile" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog model-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="">Update Profile</h4>
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
                <form action="{{route('profice_update')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <input type="hidden" name="userid" value="{{$userdata->id}}">
                    <input type="hidden" name="nameold" value="{{$userdata->name}}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class=" " for="Showroom Name">Full Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="user_name" class="form-control" placeholder="Full Name" value="{{$userdata->name}}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="" for="Contact">Contact</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="mobile" class="form-control" value="{{@$userdata->mobile}}" placeholder="Contact">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="" for="Contact">Profile Image</label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="profileimage" class="form-control">
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
