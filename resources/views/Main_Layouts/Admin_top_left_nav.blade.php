@php
    use App\Showroom_model\Showroom;$userstatus = Auth::user()->role_id;
        if ($userstatus==1){
            $url = URL::to('Admin/Dashboard');
        }else{
            $url = URL::to('User/Dashboard');
        }

        $userid = Auth::user()->id;
        if (Auth::user()->role_id == 1){
            $allshowroom = Showroom::all();
        }else{
            $allshowroom = DB::table('showroom_user')
                ->select('showrooms.*','showroom_user.user_id as usernewid')
                ->leftJoin('showrooms','showrooms.id','=','showroom_user.showroom_id')
                ->where('showroom_user.user_id',$userid)
                ->get();
        }


        if ($userstatus == 1){
           if(@$allshowroom[0]->showroom_image !=null){
               $showroom_logo=URL::to('/Media/showroom/'.@$allshowroom[0]->showroom_image);
           }else{
               $showroom_logo = URL::to('/Media/showroom/logo.png');
           }
       }else{
         if(@$allshowroom[0]->showroom_image !=null){
               $showroom_logo=URL::to('/Media/showroom/'.@$allshowroom[0]->showroom_image);
           }else{
               $showroom_logo = URL::to('/Media/showroom/logo.png');
           }
       }

@endphp
    <div class="main-header">
        <div class="logo">
            <a href="{{$url}}"><img src="{{@$showroom_logo}}" alt=""></a>
        </div>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>



        <div style="margin: auto;font-size: 21px; font-weight: bold;font-family: cursive; color: rgb(31 173 14 / 75%);">{{@$allshowroom[0]->showroom_name}}</div>
        <div class="header-part-right">
            <div class="dropdown">
                <div class="user col align-self-end">
                    @php
                        $userdata = Auth::user();

                       if ($userdata != null){
                           if($userdata->image !=null){
                               $urlimage=URL::to('/Media/user_profile/'.@$userdata->image);
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
                <li class="nav-item" data-item=""><a class="nav-item-hold" href="{{$url}}"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="servicepanel"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Panel</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="uikits"><a class="nav-item-hold" href="#"><i class="nav-icon i-Add-User"></i><span class="nav-text">Showroom Staff</span></a>
                    <div class="triangle"></div>
                </li>

            </ul>
        </div>
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            {{-- <ul class="childNav" data-parent="servicepanel">
                <li class="nav-item"><a href="{{route('Add.Showroom')}}"><i class="nav-icon i-Add"></i><span class="item-name">Add Showroom  </span></a></li>
            </ul> --}}

            <ul class="childNav" data-parent="servicepanel">
                <li class="nav-item"><a href="{{route('product_panel')}}"><i class="nav-icon i-Add"></i><span class="item-name"> Product Panel </span></a></li>
            </ul>

            <ul class="childNav" data-parent="servicepanel">
                <li class="nav-item"><a href="{{route('bike_panel')}}"><i class="nav-icon i-Add"></i><span class="item-name"> Bike Panel</span></a></li>
            </ul>


            <ul class="childNav" data-parent="uikits">
                <li class="nav-item"><a href="{{route('Add.User')}}"><i class="nav-icon i-Business-Man text-warning"></i><span class="item-name">User Details</span></a></li>
                <?php
                    $user =  Auth::user()->role_id;
                    if ($user == 1){
                 ?>
                       <li class="nav-item"><a href="{{route('menu.permission')}}"><i class="nav-icon i-Business-Man text-warning"></i><span class="item-name">Menu Permission</span></a></li>
                <?php
                    }
                ?>

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
