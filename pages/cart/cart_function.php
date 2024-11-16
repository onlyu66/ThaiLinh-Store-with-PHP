<?php
    
    function totalQuantity($cart){
        $totalQuantity=0;
        foreach($cart as $value){
          $totalQuantity+=$value['quantity'];
        }
    return $totalQuantity;
    }

    function totalPrice($cart){
      $totalPrice=0;
      foreach($cart as $value){
        $totalPrice+=$value['quantity']*$value['price'];
      }
    return $totalPrice;
    }
?>