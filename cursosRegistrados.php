<?php
require './ModelBean/Curso.php';

$curso = new Curso();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cursos</title>
        <link href="css/bootstrap-theme.min.css">
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
        <?php include './view/menuPrincipal.php'; ?>
        <?php
        if (isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

            $curso = (int) $_GET['id_curso'];
            if ($curso->delete($curso)) {
                
            }

        endif;
        ?>

        <section id="main">
            <div class="container">
                <div class="row">
                    <?php include './view/menuLateral.php'; ?>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title"><b>Cursos Registrados</b></h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action>
                                    <br><div class="col-md-9">
                                        <input type="text" name="nome" placeholder="Pesquisar Curso" value="<?= (!empty($_POST['nome']) ? $_POST['nome'] : '' ) ?>" class="form-control col-md-4" >
                                    </div>

                                    <div class="visible-lg visible-md">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-default"><b class="glyphicon glyphicon-search"></b> </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" style="margin-left: 30px" onclick="location = 'registrarCurso.php'" class="btn btn-sm btn-default" ><b> Registrar</b> </button>
                                        </div>
                                    </div>

                                    <div class="visible-sm visible-xs">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <br> <button type="submit" class="btn btn-default btn-sm"><b class="glyphicon glyphicon-search"></b> </button>
                                                <button type="button"  onclick="location = 'professorRegistrados.php'" class="btn btn-sm btn-default" ><b> Registrar</b> </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <BR> 

                                        <table class="table ">
                                            <thead>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Data de Criação</th>
                                            <th>Professor</th>
                                            <th></th>
                                            </thead>

                                            <?php
                                            $dados = $curso->listagem((!empty($_POST['nome']) ? $_POST['nome'] : ''));
                                            if (!empty($dados)) {
                                                foreach ($dados as $key => $value) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $value->id_curso; ?></td>
                                                    <td><?php echo $value->nome; ?></td>
                                                    <td><?php echo $value->data_criacao; ?></td>
                                                    <td><?php echo $value->professor; ?></td>

                                                    <td width="12%">
                                                        <button type="button" onclick="location = 'registrarCurso.php?acao=editar&id_curso=<?= $value->id_curso; ?>'" class="btn btn-sm btn-primary" ><b class=" glyphicon glyphicon-edit"></b> </button>
                                                        <button type="button" onclick="location = 'cursosRegistrados.php?acao=deletar&id_curso=<?= $value->id_curso; ?>'" class="btn btn-sm btn-danger" ><b class="glyphicon glyphicon-remove-circle"></b> </button>
                                                    </td>
                                                </tr>
                                           <?php
                                                }
                                            } else {
                                                ?>
                                                <tr><td>Curso não existente</td></tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
