<?php
require './ModelBean/Aluno.php';
$aluno = new Aluno();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="3">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Flex Peak Tecnologia e Assessoria</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <script type="text/javascript">
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
            t = setTimeout('startTime()', 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>
    <body onload="startTime()">
        <?php include './menuPrincipal.php'; ?>


        <section id="main">
            <div class="container">
                <div class="row">
                    <?php include './menuLateral.php'; ?>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title"><b>Bem vindo</b></h3>
                            </div>
                            <div class="panel-body">


                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

