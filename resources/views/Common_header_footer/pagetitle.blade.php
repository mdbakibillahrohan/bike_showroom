<div class="breadcrumb">
    <?php
    $clickmenu = Request::path();
    $para = explode("/",$clickmenu);
    $array = count($para);
    ?>
    <h1> {{$para[0]}}</h1>
    <ul>
        <?php
        if ($array ==2){
        ?>
        <li><a href="">| {{@$para[1]}}</a></li>
        <?php
        }else if ($array ==3){
        ?>
        <li><a href="">| {{@$para[1]}}</a></li>
        <li><a href="">{{@$para[2]}}</a></li>
        <?php
        }else if ($array ==4){
        ?>
        <li><a href="">| {{@$para[1]}}</a></li>
        <li><a href="">{{@$para[2]}}</a></li>
        <li><a href="">{{@$para[3]}}</a></li>
        <?php
        }
        ?>
    </ul>


</div>

