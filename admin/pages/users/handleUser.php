<?php
include_once "../../../database/dbhelper.php";
    if(isset($_POST['block'])){
        $id=$_POST['block'];
        // echo $id;
        $active=($_POST['active']==1)?0:1;
        $status=($_POST['active']==0)?2:3;
        $sql="update users set active='$active', status='$status' where id='$id'";
        iud($sql);
        // header("location: http://localhost/ThaiLinhStore/admin/?action=users");
    }
?>