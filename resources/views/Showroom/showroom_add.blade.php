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
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#showroomadd"> Add Showroom</button>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Address</th>

                                                <th scope="col">Mobile</th>
                                                <th scope="col">Details</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Access</th>
                                                <th scope="col">Update</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                            @foreach ($allshowroom as $row)
                                                <tr>
                                                    <td scope="row">{{$sl}}</td>
                                                    <td><a href="">
                                                            <div class="ul-widget-app__profile-pic"><img class="profile-picture avatar-sm mb-2 rounded-circle img-fluid" src="{{ asset($row->showroom_image != null? 'Media/showroom/'. $row->showroom_image:'') }}" alt="" />
                                                                <span class="text-capitalize font-weight-bold">{{ $row->showroom_name }}</span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>{{ $row->address }}</td>
                                                    <td>{{ $row->mobile }}</td>
                                                    <td>{{ $row->showroom_details }}</td>
                                                    <td><span class="badge badge-success"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Inactive";} ?></span></td>
                                                    <td><a class="btn btn-success btn-sm" href="{{ route('access.dashboard',$row->slag) }}"  role="button">Access</a></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm showroom_edit" id="{{$row->id}}" ><i class="nav-icon i-Pen-2"></i></button>
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
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="showroomadd" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Showroom Add</h4>
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
                    <form action="{{route('showroom.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="showroomname" for=""> Name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="showroom_name" class="form-control" id="" placeholder="Showroom Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="ShowroomAddress" for=""> Address :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="" autocomplete="off" placeholder="Showroom Address">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="Showroomphone" for=""> Phone :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="phone" class="form-control" id="" autocomplete="off" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="Showroomlogo" for=""> Logo :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="Showroomlogo" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="Showroomdetails" for=""> Details :</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control"  name="showroomdetails"  placeholder="Showroom Details" rows="4" required></textarea>
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



    <div class="modal fade" id="ShowroomEdit" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Showroom Update</h4>
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
                    <form action="{{route('showroom_update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" id="oldimage">
                        <input type="hidden" name="old_id" id="showroomid">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" id="showroomname" placeholder="Showroom Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Address :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address_edit" class="form-control" id="ShowroomAddress" autocomplete="off" placeholder="Showroom Address">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Phone :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="phone_no" class="form-control" id="Showroomphone" autocomplete="off" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Logo :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="Showroom_logo" class="form-control" id="Showroomlogo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Details :</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control"  name="details" id="details"  placeholder="Showroom Details" rows="4" required></textarea>
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
            $('.showroom_edit').on('click', function(){
                var showroomid = $(this).attr("id");
                //alert(sh_id);
                $.ajax({
                    type: 'GET',
                    url:'/showroomedit/'+showroomid,

                    success: function (data) {
                        $("#oldimage").val(data.showroom_image);
                        $("#showroomid").val(showroomid);
                        $("#showroomname").val(data.showroom_name);
                        $("#ShowroomAddress").val(data.address);
                        $("#Showroomphone").val(data.mobile);
                        $("#details").val(data.showroom_details);
                    }
                });

                $("#ShowroomEdit").modal('show');

            });

        });
    </script>
@endsection
