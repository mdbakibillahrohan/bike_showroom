@extends('Main_Layouts.Admin_master_layout')
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
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#adduser"><i class="i-Add-User text-white mr-2"></i> Add User</button>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>User Type</th>
                                                <th>Status</th>
                                                <th>Showroom</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($alluser as $row)

                                                <tr>
                                                    <td><a href="">
                                                            <div class="ul-widget-app__profile-pic"><img class="profile-picture avatar-sm mb-2 rounded-circle img-fluid" src="{{ asset($row->image != null? 'Media/user_profile/'. $row->image:'') }}" alt="" />
                                                                <span class="text-capitalize font-weight-bold">{{ $row->name }}</span>
                                                            </div>
                                                        </a></td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->mobile != null?$row->mobile:'' }}</td>
                                                    <td><a class="badge badge-primary m-2 p-2" href="#"><?php $role = $row->role_id; if ($role==1) {echo "Owner";}else if($role==2){echo "Manager";}else{echo "User";} ?></a></td>
                                                    <td><span class="badge badge-success"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Inactive";} ?></span></td>

                                                    <td>
                                                        @php
                                                            $count = 0;
                                                        @endphp

                                                        @foreach($row->showrooms as $data)

                                                            @php
                                                                $count++;
                                                            @endphp
                                                            <span><i>{{ $data->showroom_name }}</i></span>
                                                            @if(count($row->showrooms) != $count)
                                                                <br>
                                                            @endif

                                                        @endforeach

                                                    </td>
                                                    <td>

                                                        <button type="button" class="btn btn-success btn-sm user_edit" id="{{$row->id}}" ><i class="i-Edit"></i></button>
                                                    </td>

                                                </tr>
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


    <div class="modal fade" id="adduser" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">User Registration </h4>
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
                    <form action="{{route('user.registration')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="userName" for="">User name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" id="userName" placeholder="User Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="EmailAdd" for="">Email Address :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="form-control" id="EmailAdd" autocomplete="off" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Password :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control" id="" autocomplete="off" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Mobile :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="phone" class="form-control" id="" autocomplete="off" placeholder="Mobile No">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Showroom :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control js-example-basic-multiple" name="showroomid[]" multiple="multiple" style="width: 100%">
                                        @foreach($allshowroom as $ndata)
                                            <option value="{{$ndata->id}}">{{$ndata->showroom_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">User Type :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="usertype" id="">
                                        <option value="">Select User Type</option>
                                            @foreach($usertype as $row)
                                                <option value="{{$row->id}}">{{$row->user_type}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">User Image :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="proficeimage" class="form-control">
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



    <div class="modal fade" id="user_edit" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                    <form action="{{route('userdata_update')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <input type="hidden" name="userid" id="userid_old">
                        <input type="hidden" name="oldimage" id="old_image">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="userName" for="">User name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" id="name_edit" placeholder="User Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="EmailAdd" for="">Email Address :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="form-control" id="Email_edit" autocomplete="off" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Password :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Mobile :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="phone" class="form-control" id="mobile_edit" autocomplete="off" placeholder="Mobile No">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Showroom :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control js-example-basic-multiple" name="showroomid[]" multiple="multiple" style="width: 100%" id="showroom_permit" required>
                                        @foreach($allshowroom as $ndata)
                                            <option value="{{$ndata->id}}">{{$ndata->showroom_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">User Type :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="usertype" id="usertype_edit">
                                        <option value="">Select User Type</option>
                                        @foreach($usertype as $row)
                                            <option value="{{$row->id}}">{{$row->user_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">User Image :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="userimage" class="form-control">
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
            $('.user_edit').on('click', function(){
                var userid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/UserEditData/'+userid,

                    success: function (data) {
                        //console.log(data);

                        $("#old_image").val(data.image);
                        $("#userid_old").val(userid);
                        $("#name_edit").val(data.name);
                        $("#Email_edit").val(data.email);
                        $("#mobile_edit").val(data.mobile);
                        $("#usertype_edit").val(data.role_id);
                    }
                });

                $("#user_edit").modal('show');

            });

        });
    </script>
@endsection


