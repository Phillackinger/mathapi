<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatheApi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body> 
    <div class="container">
        <h1>Numerische Integrationsverfahren</h1>
        <form method="post" class="form-horizontal">
            <div class="input-group mb-3">
                <lable for="func" class="control-label col-sm-2">Funktion: </lable>
                <input type="text" name="func" id=func class="form-control">
                <div id="funcHelpBlock" class="form-form-control  mbtext">>Funktionen müssen in PHP-Syntax angegeben werden: z.B. x^4 => $x**4</div>
            </div>
            <div class="input-group -3">
                <lable for="ver" class="control-label col-sm-2">Verfahren: </lable>
                <select type="text" name="ver" class="form-select">
                    <option selected value="ALL">ALL</option>
                    <option value="T">Trapez</option>
                    <option value="K">Keppler</option>
                    <option value="S">Simpson</option>
                </select>
            </div>
            <div class="input-group form-group  mb-3">
                <lable for="n" class="control-label col-sm-2">Genauigkeit N: </lable>
                <input type="number" name="n" id="n" class="form-control">
            </div>
            <div class="input-group form-group  mb-3">
                <lable for="a" class="control-label col-sm-2">Integrationsgrenze A: </lable>
                <input type="number" name="a" id="a" class="form-control">
            </div>
            <div class="input-group form-group  mb-3">
                <lable for="b" class="control-label col-sm-2">Integrationsgrenze B: </lable>
                <input type="number" name="b" id="b" class="form-control">
            </div>
            <div class="input-group form-group  mb-3">
                <lable for="credit-num" class="control-label col-sm-2">Kreditkartennummer: </lable>
                <input type="text" name="credit card" id="credit-num" class="form-control" disabled>
            </div>
            <div class="input-group form-group  mb-3">
                <lable for="credit-date" class="control-label col-sm-2">Ablaufdatum: </lable>
                <input type="date" name="date" id="credit-date" class="form-control credit" disabled>
            </div>
            <div class="input-group form-group  mb-3">
                <lable for="credit-code" class="control-label col-sm-2">Sicherheitscode: </lable>
                <input type="number" name="code" id="credit-code" class="form-control credit" disabled>
            </div>
            <div class="input-group form-group  mb-3 form-check">
                <input type="checkbox" name="soul" id="soul" class="form-check-input credit" checked>
                <lable for="soul" class="control-label"><lable class="checkbox">No. I don't want to enter my credit card details, take my soul instead: </lable>
            </div>
            <div class="input-group form-group  mb-3">
                <button type="submit" class="btn btn-primary">Rechne!</button>
            </div>

        </form>
    </div>
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

<script>

        document.getElementById('soul').onchange = function(){
            document.getElementById('credit-num').disabled = this.checked;
            document.getElementById('credit-date').disabled = this.checked;
            document.getElementById('credit-code').disabled = this.checked;
        }
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</html>