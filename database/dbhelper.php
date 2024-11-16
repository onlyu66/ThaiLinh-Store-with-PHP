<?php
    require_once('config.php');

    //insert, update, delete, select

    // SQL: select -> lấy dữ liệu đầu ra
    function select($sql, $isSingle = false){
        $data = null;

        //open connect
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn,'utf8');
        //query
        $resultset=mysqli_query($conn,$sql);
        if($resultset){
            if($isSingle){
                $data = mysqli_fetch_array($resultset,1);
            }else{
                $data = [];
                while(($row=mysqli_fetch_array($resultset,1)) != null ){
                    $data[]=$row;
                }
            }
        }
        
        //close connection
        mysqli_close($conn);
        return $data;
    }
    function iud($sql){
        //open connect
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn,'utf8');
        //query
        mysqli_query($conn,$sql);
        //close connection
        mysqli_close($conn);
    }
?>