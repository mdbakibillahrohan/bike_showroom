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
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-7" id="userpermition">
                                            <input type="hidden" id="useriddata" value="">
                                            <table id="results" class="table table-bordered table-sm text-center">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Main Menu</th>
                                                    <th>Sub Menu</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody class="ajaxdata">

                                                </tbody>
                                            </table>
{{--                                            <table class="table table-bordered table-sm text-center">--}}
{{--                                                @foreach($allmenu as $row)--}}
{{--                                                    <tr>--}}
{{--                                                        <td><b>{{$row->mainmenu_id}}</b></td>--}}
{{--                                                        <td>--}}
{{--                                                            <table class="table table-bordered table">--}}
{{--                                                                @php--}}
{{--                                                                    $submenudata  = \App\Admin_model\ Submenu::where('mainmenu_id',$row->mainmenu_id)->get();--}}
{{--                                                                @endphp--}}
{{--                                                                @foreach($submenudata as $subdata)--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td style="width: 255px">{{$subdata->submenu_name}}</td>--}}
{{--                                                                        <td class="checkmenu" style="text-align: right">--}}
{{--                                                                            <label class="switch pr-5 switch-warning mr-3"><span> Permission</span>--}}
{{--                                                                                <input type="checkbox" value="" id="{{$subdata->id}}" class="submenuid" /><span class="slider"></span>--}}

{{--                                                                            </label>--}}
{{--                                                                        </td>--}}
{{--                                                                    </tr>--}}
{{--                                                                @endforeach--}}
{{--                                                            </table>--}}
{{--                                                        </td>--}}

{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                            </table>--}}
                                        </div>
                                        <div class="col-md-5">
                                            <div class="col-md-5">
                                                <label class="" for="">User Menu Permission</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="form-control" name="userid"  id="user_id">
                                                    <option value="">Select User</option>
                                                    @foreach($alluser as $udata)
                                                        <option value="{{$udata->id}}">{{$udata->name}}</option>
                                                    @endforeach
                                                </select>
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

    <script>
        $(function(){

            $('#user_id').on('change', function(){
                var iduser = $(this).val();
                $("#useriddata").val(iduser);
                //alert(iduser);

                $.ajax({
                    url:'/UsermenuData/'+iduser,
                    type: "GET",
                    contentType: "json;",
                    success: function (data) {
                        //console.log(data);
                        var subMenu = data[0];
                        var allmenu = data[1];

                        if (allmenu.length > 0) {
                            var sl=1;
                            for (var i = 0; i < allmenu.length; i++) {
                                $('#userpermition .ajaxdata').append(
                                    '<tr><td>' + sl +
                                    '</td><td>' + allmenu[i]['mainmenu_id'] +
                                    '</td><td>' + allmenu[i]['submenu_name'] +
                                    '</td><td class="checkmenu" style="text-align: right"><label class="switch pr-5 switch-warning mr-3"><span> Permission</span>' + '<input type="checkbox" name="permit" value ="'+allmenu[i]['id']+'" id="ck1" class="'+allmenu[i]['id']+'" /><span class="slider"></span>'+'</label>' +
                                    '</td></tr>'

                                )
                                sl++;
                            }
                        }


                        if (subMenu.length > 0) {
                            for (var i = 0; i < subMenu.length; i++) {
                                document.getElementsByClassName(subMenu[i]['id'])[0].setAttribute("checked", "checked");
                            }
                        }


                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                    }

                });

            });

        });

    </script>

    <script>
        $('table').on('change', '[type=checkbox]', function() {
            var menuid = $(this).val();
            var userid = $("#useriddata").val();

            $.ajax({
                type: 'GET',
                url:'/menupermision_user',
                data:{"menuid":menuid,"userid":userid,},
                dataType: 'json',
                success: function (data) {

                }
            });

        });
    </script>


    <script>
        $(function(){
            $('#_sduser_id').on('change', function(){
                var userid = $(this).val();

                $.ajax({
                    url:'/UsermenuData/'+userid,
                    type: "GET",
                    contentType: "json;",
                    success: function (data) {
                        var mydata = $.parseJSON(data);
                        var subMenu = mydata.allsubmenu;
                        var mainmenu = mydata.mainmenu;

                        if (subMenu.length > 0) {
                            var sl=1;
                            for (var i = 0; i < subMenu.length; i++) {
                                $('#userpermition .ajaxdata').append(
                                    '<tr><td>' + sl +
                                   // '</td><td>' + mainmenu[i].mainmenu +
                                    '</td><td>' + subMenu[i][i+1].menu +

                                    '</td><td>' + subMenu[i][i+1].submenu_name +
                                    '</td><td>' + '<input type="checkbox" value="" id="'+ subMenu[i][i+1].id+'" class="submenuid" /><span class="slider"></span>' +
                                    // '</td><td>' + '<input type="checkbox" name="permit" class="'+subMenu[i][i+1].id+'" value ="'+subMenu[i][i+1].id+'" id="ck1" >' +
                                    '</td></tr>'
                                )
                                sl++;
                            }
                        }

                        if (subMenu.length > 0) {
                            for (var i = 0; i < subMenu.length; i++) {
                                document.getElementsByClassName(subMenu[i][i+1]['id'])[0].setAttribute("checked", "checked");
                            }
                        }
                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                    }

                });

            });


            var purmitionSection = document.getElementsByClassName('submenuid');

            for(var i = 0; i < purmitionSection.length; i++){
                var checkBox = purmitionSection[i];
                checkBox.addEventListener('click', purmitionChecked);
            }

            function purmitionChecked(event){
                var checkBox = event.target;
                if(checkBox.checked){


                }
                var id = checkBox.getAttribute('id');
            }

        });
    </script>
@endsection


