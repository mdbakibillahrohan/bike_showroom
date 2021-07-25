<div class="breadcrumb">
    <?php
    $userstatus = Auth::user()->role_id;
    if ($userstatus==1){
        $url = URL::to('Admin/Dashboard');
    }else{
        $url = URL::to('User/Dashboard');
    }

    $clickmenu = Request::path();
    $para = explode("/",$clickmenu);
    ?>
    <h1> {{$para[0]}}</h1>
    <ul>
        <li><a href="{{$url}}">{{@$para[1]}}</a></li>
    </ul>

</div>
