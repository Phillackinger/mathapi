<?php

//header('Content-Type: application/json');
error_reporting(E_ALL ^ E_NOTICE);

$verfahren = $_GET['ver'];
$n = $_GET['n'];
$function = $_GET['fun'];
$a = $_GET['a'];
$b = $_GET['b'];



if(isset($function)){
    function f($x,$function){
        $functionset = "return" . $function . ";"; 
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

            for($i = $a; $i <= $b; $i++ ){
                if($i == $a || $i == $b){
                $sum + f($i,$function);
                }

                $sum + 2*(f($i,$function));
            }

            echo json_encode(array(
                "code"=>200,
                "result"=>$sum
            ));

            die();
        }

        trapez($function, $n, $a, $b);
    }



}else{
    echo json_encode(array(
        "code"=>401,
        "message"=>"No Function given"
    ));
    die();
}

