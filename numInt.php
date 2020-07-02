<?php

//header('Content-Type: application/json');
error_reporting(E_ALL ^ E_NOTICE);

$verfahren = $_GET['ver'];
$n = $_GET['n'];
$functionInput = $_GET['func'];
$a = $_GET['a'];
$b = $_GET['b'];
$_['sum'] = 0;




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
    if(empty($a)){
        echo json_encode(array(
            "code"=>401,
            "message"=>"Parameter a is missing"
        ));
        die();
    }
    if(empty($b)){
        echo json_encode(array(
            "code"=>401,
            "message"=>"Parameter a is missing"
        ));
        die();
    }

    $allowedTrapezVerfahren = array("Trapez", "trapez", "Trap" , "trap", "T","t");

    if(in_array($verfahren, $allowedTrapezVerfahren)){
        function trapez($function, $n, $a ,$b){
            $deltaX = ($b-$a)/$n;
            $sum = 0;

            for($i = $a; $i <= $b; $i = $i + $deltaX ){
                if($i == $a || $i == $b){
                    $_['sum'] = $_['sum'] + f($functionInput,$i);
                }else{
                    $_['sum'] = $_['sum'] + 2*(f($functionInput,$i));
                }
            }

            $finalSum = $deltaX/2 * $_['sum']; 

            echo json_encode(array(
                "code"=>200,
                "result"=>$finalsum
            ));

            die();
        }

        trapez($functionInput, $n, $a, $b);
    }

}else{
    echo json_encode(array(
        "code"=>401,
        "message"=>"No Function given"
    ));
    die();
}

