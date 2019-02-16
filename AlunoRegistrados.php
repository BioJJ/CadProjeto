<?php
require 'ModelBean/Aluno.php';
$aluno = new Aluno();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cursos</title>
        <!--<link href="css/bootstrap-theme.min.css">-->
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
        <?php include 'view/menuPrincipal.php'; ?>
        <?php
        if (isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

            $aluno = (int) $_GET['id_aluno'];
            if ($aluno->delete($aluno)) {
                
            }
        endif;
        ?>
        <section id="main">
            <div class="container">
                <div class="row">
                    <?php include 'view/menuLateral.php'; ?>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title"><b>Alunos Registrados</b></h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action>
                                    <br><div class="col-md-9">
                                        <input type="text" name="nome" placeholder="Pesquisar Aluno" value="<?= (!empty($_POST['nome']) ? $_POST['nome'] : '' ) ?>" class="form-control col-md-4" >
                                    </div>

                                    <div class="visible-lg visible-md">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-default"><b class="glyphicon glyphicon-search"></b> </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" style="margin-left: 30px" onclick="location = 'registrarAluno.php'" class="btn btn-sm btn-default" ><b> Registrar</b> </button>
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
                                            <th>Nome do Aluno</th>
                                            <th style="text-align: center">Data de Nascimento</th>
                                            <th>Curso</th>
                                            <th style="text-align: center">Detalhes</th>
                                            <th></th>
                                            </thead>

                                            <?php
                                            $dados = $aluno->listagem((!empty($_POST['nome']) ? $_POST['nome'] : ''));
                                            if (!empty($dados)) {
                                                foreach ($dados as $key => $value) {
                                                    ?>
                                                    <tr>

                                                        <td><?php echo $value->id_aluno; ?></td>
                                                        <td><?php echo $value->nome; ?></td>
                                                        <td style="text-align: center"><?php echo $aluno->inverterData($value->data_nascimento); ?></td>
                                                        <td><?php echo $value->curso; ?></td>
                                                        <td style="text-align: center">
                                                            <a href="#"   type="button" data-toggle="modal" data-target="#myModalpg1<?php echo $value->id_aluno; ?>"class="glyphicon glyphicon-book"></a>


                                                            <div class="modal fade" id="myModalpg1<?php echo $value->id_aluno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label=""><span aria-hidden="true">&times;</span></button>
                                                                            <h3 class="panel-title"><b>Detalhes do Endereço</b></h3>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-md-12">
                                                                                <BR> 

                                                                                <table class="table">
                                                                                    <thead>

                                                                                    <th>Logradouro</th>
                                                                                    <th>Numero</th>
                                                                                    <th>Bairro</th>
                                                                                    <th>cidade</th>
                                                                                    <th>Estado</th>
                                                                                    <th>Cep</th>
                                                                                    <th></th>
                                                                                    </thead>

                                                                                    <tr>
                                                                                        <td><?php echo $value->logradouro; ?></td>
                                                                                        <td><?php echo $value->numero; ?></td>
                                                                                        <td><?php echo $value->bairro; ?></td>
                                                                                        <td><?php echo $value->cidade; ?></td>
                                                                                        <td><?php echo $value->estado; ?></td>
                                                                                        <td><?php echo $value->cep; ?></td>
                                                                                        <td>

                                                                                        </td>
                                                                                    </tr>

                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                        <td width="12%">
                                                            <button type="button" name="id_clicado" value="<?= $value->id_aluno; ?>" onclick="location = 'registrarAluno.php?acao=editar&id_aluno=<?= $value->id_aluno; ?>'" class="btn btn-sm btn-primary" ><b class=" glyphicon glyphicon-edit"></b></button>
                                                            <button type="button" onclick="location = 'AlunoRegistrados.php?acao=deletar&id_aluno=<?= $value->id_aluno; ?>'" class="btn btn-sm btn-danger" ><b class="glyphicon glyphicon-remove-circle"></b> </button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr><td>Aluno não existente</td></tr>
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
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>


        <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>
