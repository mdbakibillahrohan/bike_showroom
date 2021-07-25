@extends('Admin_layouts.admin_master_layout')
@section('content')

    <div class="inbox-main-content" data-sidebar-content="main">
        <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">

            <div data-sidebar-content="secondary">
                <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                    <!-- EMAIL DETAILS-->
                    <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3"> Access User </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark">
                                        <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Type</th>

                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $sl = 1; ?>
                                        @foreach ($userdata as $row)
                                            <tr>
                                                <th scope="row">{{$sl}}</th>
                                                <td>{{$row->name}}</td>
                                                <td>{{ $row->role->name }}</td>
                                                <td><span class="badge badge-success"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Inactive";} ?></span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" type="button"><i class="nav-icon i-Pen-2"></i></button>
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
            </div>
            <!-- Secondary Inbox sidebar start-->
            <div class="inbox-secondary-sidebar perfect-scrollbar rtl-ps-none" data-sidebar="secondary"><i class="sidebar-close i-Close" data-sidebar-toggle="secondary"></i>
                @foreach($allservice as $data)
                    <div class="mail-item">

                        <div class="col-md-8">
                            <h5 style="font-weight: bold">{{$data->name}} Department</h5>
                        </div>
                        <div class="col-md-4">
                            @if($data->id == 1)
                                <a href="{{ route('purchase.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                            @elseif($data->id == 2)
                                <a href="{{ route('hradmin.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                            @elseif($data->id == 3)
                                <a href="{{ route('accounts.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                            @elseif($data->id == 4)
                                <a href="{{ route('commercial.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                            @elseif($data->id == 5)
                                <a href="{{ route('store.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                            @elseif($data->id == 6)
                                <a href="{{ route('sales.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>


@endsection
