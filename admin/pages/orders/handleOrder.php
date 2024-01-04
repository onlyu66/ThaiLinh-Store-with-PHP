<?php
include_once "../../../database/config.php";
include_once "../../../database/dbhelper.php";
    if(isset($_POST['confirm'])){
        $orderCode=$_POST['confirm'];
        $sql="update orders set status='2' where orderCode='$orderCode'";
        iud($sql);
    }
    if(isset($_POST['delete'])){
        $orderCode=$_POST['delete'];
        $sql="delete from orders where orderCode='$orderCode'";
        iud($sql);
        $sql_="delete from orderdetails where orderCode='$orderCode'";
        iud($sql_);
    }
    if(isset($_POST['confirms'])){
        $orderCode=$_POST['confirms'];
        echo "<pre>";
        var_dump($orderCode);
    }
?>