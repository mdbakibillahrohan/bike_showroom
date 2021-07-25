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
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addsubcategories"><i class="i-Add-User text-white mr-2"></i> Add Subcategories</button>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Subcategory Name</th>
                                                <th>Category Name</th>
                                                <th>Update</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1;?>
                                            @foreach($allsubcategories as $row)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{ $row->subcategory_name }}</td>
                                                    <td>{{ $row->categorie->category_name }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm subcategory_edit" id="{{$row->id}}" >Edit</button>
                                                        <a class="btn btn-danger btn-sm" href="{{route('subcategorie.delete',$row->id)}}" id="delete" role="button">Delete</a>
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


    <div class="modal fade" id="addsubcategories" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Subcategory Add</h4>
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
                    <form action="{{ route('SubCategories.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Category Name</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="category_id" id="">
                                        <option value=""> Select Category</option>
                                        @foreach ($allcategories as $cdata)
                                            <option value="{{$cdata->id}}">{{$cdata->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Subcategory Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="subcategory_name" class="form-control" id="" placeholder="Sub Category" >
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


    <div class="modal fade" id="edit_subcategory" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Sub Category Add</h4>
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
                    <form action="" class="editupdate_subcat" method="POST"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Category Name">Category Select</label>
                                </div>
                                <div class="col-md-8">
                                    @php

                                        @endphp
                                    <select class="form-control" name="category_id" id="cat_id">
                                        @foreach ($allcategories as $data)
                                            <option value="{{$data->id}}">{{$data->category_name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Category Name">Sub Category</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="subcategory_name" class="form-control" id="subcategoryname_edit" placeholder="Sub Category" >
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
            $('.subcategory_edit').on('click', function(){
                var subcatid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/SubCategories/'+subcatid+'/edit',
                    success: function (data) {
                        //console.log(data);
                        $("#cat_id").val(data.categorie_id);
                        $("#subcategoryname_edit").val(data.subcategory_name);
                        $('.editupdate_subcat').attr('action', '/SubCategories/'+subcatid);
                    }
                });

                $("#edit_subcategory").modal('show');

            });


        });
    </script>
@endsection


