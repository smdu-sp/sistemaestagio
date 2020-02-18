<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste</title>

</head>

<body>
    <div>
        <?php 
        $d1 = isset($_GET["dataInicial"])?$_GET["dataInicial"]:null;
        $d2 = isset($_GET["dataFinal"])?$_GET["dataFinal"]:null;
        $result = date_deff($d1, $d2);
        echo "Diferença entre as datas: " . $result . "dias.";
        ?>
    </div>
    <a href="javascript:history.go(-1)">Voltar</a>
</body>

<style>
    .submit {
        padding-bottom: 15px;
        padding-top: 20px;
    }
</style>

</html>