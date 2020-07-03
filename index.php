<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatheApi</title>
    <style>
    </style>
</head>
<body style="margin: 10px;">
    <h1>Numerische Integrationsverfahren</h1>
    
    <form action="" method="post" class="">
    <div class="form-group">
    Funktionen müssen in PHP-Syntax angegeben werden: z.B. x^4 => $x**4
    <br>

    <table class="table table-sm">
    <div class="form-group">
        <tr>
            <td>Funktion: </td>
            <td><input type="text" name="func" class="form-control"><br></td>
        </tr>
        <tr>
            <td>Verfahren: </td>
            <td><input type="text" name="ver" class="form-control"><br></td>
        </tr>
        <tr>
            <td>Genauigkeit N: </td>
            <td><input type="text" name="n" class="form-control"><br></td>
        </tr>
        <tr>
            <td>Integrationsgrenze A: </td>
            <td><input type="text" name="a" class="form-control"><br></td>
        </tr>
        <tr>
            <td>Integrationsgrenze B: </td>
            <td><input type="text" name="b" class="form-control"><br></td>
        </tr>
    </div>
    <div class="form-group">
        <tr>
            <td>Kreditkartennummer: </td>
            <td><input type="text" name="credit card" class="form-control"><br></td>
        </tr>
        <tr>
            <td>Ablaufdatum: </td>
            <td><input type="text" name="date" class="form-control"><br></td>
        </tr>
        <tr>
            <td>Sicherheitscode: </td>
            <td><input type="text" name="code" class="form-control"><br></td>
        </tr>
        <tr>
            <td><lable class="checkbox">No. I don't want to enter my <br>credit card details, take my soul instead: </lable></td>
            <td><input type="checkbox" class="checkbox"><br></td>
        </tr>
    </div>
        <tr>
            <td><button type="submit" class="btn btn-primary mb-2">Rechne!</button></td>
        </tr>
    </table>

    </div>

    </form>

    <?php
        error_reporting(E_ALL ^ E_NOTICE);

        if(isset($_POST['func'])){
            $function = $_POST['func'];
            $ver = $_POST['ver'];
            $n = $_POST['n'];
            $a = $_POST['a'];
            $b = $_POST['b'];

            $url = "https://api.philsoft.at/matheapi/numInt.php?func=" . $function . "&ver=" . $ver . "&n=" . $n . "&a=" . $a . "&b=" . $b;
            $json = file_get_contents($url);
            $object = json_decode($json);

            if($object->code == 200){
                echo "<hr>";
                echo "Trapez: " . $object->trapez;
                echo "<br>";
                echo "Keppler: " . $object->keppler;
                echo "<br>";
                echo "Simpson: " . $object->simpson;
                echo "<br>";
                

            }

        }

    ?>

</body>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>