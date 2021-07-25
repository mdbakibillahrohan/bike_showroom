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
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addbrand"><i class="i-Add-User text-white mr-2"></i> Add Brands</button>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Brand Name</th>
                                                <th>Brand Image</th>
                                                <th>Update</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1;?>
                                            @foreach($allbrand as $row)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{ $row->brand_name }}</td>
                                                    <td><img src="{{ asset('Media/brand/'. $row->brand_image)}}" height="40px;" width="50px;"></td>
                                                    <td width="305px">
                                                        <button type="button" class="btn btn-primary btn-sm brand_edit" id="{{$row->id}}" >Edit</button>
                                                        <a class="btn btn-danger btn-sm" href="{{route('brand.delete',$row->id)}}" id="delete" role="button">Delete</a>
                                                    </td>

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


    <div class="modal fade" id="addbrand" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Brand Add</h4>
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
                    <form action="{{ route('Brands.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Brand Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="brand_name" class="form-control" id="" placeholder="Name Of Brand" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="BrandName">Brand Image</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="brandimage" class="form-control">
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



    <div class="modal fade" id="edit_brand" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Brand Update</h4>
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
                    <form action="" class="editupdate_brand" method="POST"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="oldimage" id="old_image">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="BrandName">Brand Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="brand_name" class="form-control" id="brandname_edit" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="BrandName">Brand Image</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="brandimage" class="form-control" id="">
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
            $('.brand_edit').on('click', function(){
                var brid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/Brands/'+brid+'/edit',
                    success: function (data) {
                        //console.log(data);
                        $("#brandname_edit").val(data.brand_name);
                        $("#old_image").val(data.brand_image);
                        $('.editupdate_brand').attr('action', '/Brands/'+brid);
                    }
                });

                $("#edit_brand").modal('show');

            });

        });
    </script>
@endsection





