<?php

header('Content-Type: application/json');
error_reporting(E_ALL ^ E_NOTICE);

$verfahren = $_GET['ver'];
$n = $_GET['n'];
$functionInput = $_GET['func'];
$a = $_GET['a'];
$b = $_GET['b'];
$_['sum'] = 0;
$deltaX = ($b-$a)/$n;
$allowedTrapezNames = array("ALL","all","All","a","A","Trapez", "trapez", "Trap" , "trap", "T","t");
$allowedKepplerNames = array("ALL","all","All","a","A","Keppler","keppler","Kep","kep","K","k","KEPPLER","KEP");
$allowedSimpsonNames = array("ALL","all","All","a","A","Simpson","simpson","S","s");
$json = array(
    "code" => 200
);
$toggle = false;
$counter = 0;




if(isset($functionInput)){
    function f($function,$x){
        $functionset = "return " . $function . ";";
        return eval($functionset);
    }

    if(empty($n)){
        echo json_encode(array(
            "code"=>401,
            "message"=>"Parameter n is missing"
        ));
        die();
    }
    if(empty($a) && $a != 0){
        echo json_encode(array(
            "code"=>401,
            "message"=>"Parameter a is missing"
        ));
        die();
    }
    if(empty($b)){
        echo json_encode(array(
            "code"=>401,
            "message"=>"Parameter b is missing"
        ));
        die();
    }

    if(in_array($verfahren, $allowedTrapezNames)){

        for($i = $a; $i <= $b; $i = $i + $deltaX ){
            if($i == $a || $i == $b){
                $_['sum'] = $_['sum'] + f($functionInput,$i);
            }else{
                $_['sum'] = $_['sum'] + 2*(f($functionInput,$i));
            }
        }

        $trapez = $deltaX/2 * $_['sum']; 
        $json['trapez'] = $trapez;
        $_['sum'] = 0;
    }

    if(in_array($verfahren, $allowedKepplerNames)){

        $keppler = (($b-$a)/6)*(f($functionInput, $a)+ 4*f($functionInput, (($a+$b)/2)) + f($functionInput, $b));
        $json['keppler'] = $keppler;

    }

    if(in_array($verfahren, $allowedSimpsonNames)){
        for($i = $a; $i <= $b; $i = $i + $deltaX, $counter++){
            if($i == $a || $i == $b){ //first or last element *1
                $_['sum'] = $_['sum'] + f($functionInput,$i);
            }
            elseif($counter%2 != 0){ //odd element *4
                $_['sum'] = $_['sum'] + 4*(f($functionInput,$i));
            }
            elseif($counter%2 == 0) //even element *2
                $_['sum'] = $_['sum'] + 2*(f($functionInput,$i));
        }

        $simpson = $deltaX/3 * $_['sum'];
        $json['simpson'] = $simpson;
        $_['sum'] = 0;
        $counter = 0;
    }

    echo json_encode($json);
}

?>