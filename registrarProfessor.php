<?php
require './ModelBean/Professor.php';
$professor = new Professor();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= (!empty($_GET['id_professor']) ? 'Atualizar Funcionário' : 'Registrar Funcionário') ?></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script>
            function formatarCampo(src, mask)
            {
                var i = src.value.length;
                var saida = mask.substring(0, 1);
                var texto = mask.substring(i)
                if (texto.substring(0, 1) != saida)
                {
                    src.value += texto.substring(0, 1);
                }
            }
        </script>
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


    </head>
    <body onload="startTime()">

        <?php include './view/menuPrincipal.php'; ?>
        <?php
        if (isset($_POST['cadastrar'])):

            $nome = $_POST['nome'];
            $data_nascimento = implode("-", array_reverse(explode("-", $_POST['data_nascimento'])));

            $professor->setNome($nome);
            $professor->setData_nascimento($data_nascimento);

            # Insert
            if ($professor->insert()) {
                echo "Inserido com sucesso!";
            }

        endif;
        ?>

        <?php
        if (isset($_POST['atualizar'])):

            $id_professor = $_POST['id_professor'];
            $nome = $_POST['nome'];
            $data_nascimento = $_POST['data_nascimento'];
            $data_nascimento = implode("-", array_reverse(explode("-", $_POST['data_nascimento'])));

            $professor->setNome($nome);
            $professor->setData_nascimento($data_nascimento);

            if ($professor->update($id_professor)) {
                echo "Atualizado com sucesso!";
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
                                <h3 class="panel-title"><?= (!empty($_GET['id_professor']) ? '<b>Atualizar Professor</b>' : '<b>Registrar Professor</b>') ?></h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {

                                    $id_professo = (int) $_GET['id_professor'];
                                    $resultado = $professor->find($id_professo);
                                    ?>

                                    <form class='form'  action="" method="post" >
                                        <input type="hidden" name="id_professor"  value="<?php echo $resultado->id_professor; ?>">

                                        <div class="col-md-12">
                                            <b>Nome</b>
                                            <input type="text" name="nome" value="<?php echo $resultado->nome; ?>"  class="form-control col-md-4"  >
                                        </div>

                                        <div class="col-md-12">
                                            <br> <b>Data de Nascimento</b>
                                            <input type="text" name="data_nascimento" class="form-control col-md-4" value="<?php echo $professor->inverterData($resultado->data_nascimento); ?>" onkeypress="formatarCampo(this, '##-##-####')" maxlength="10"  required>
                                        </div>
                                        <div class="col-md-12">

                                            <br> 
                                            <button type="submit" name="atualizar"class="btn btn-sm btn-primary j_buttom"><b>Atualizar dados </b></button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="location = 'professorRegistrados.php'"><b> Voltar</b></button>
                                        </div>
                                    </form>

                                <?php } else { ?>

                                    <form class='form'  action="" method="post" >

                                        <div class="col-md-12">
                                            <b>Nome</b>
                                            <input type="text"  name="nome" class="form-control col-md-4" required >
                                        </div>

                                        <div class="col-md-12">
                                            <br> <b>Data de Nascimento</b>
                                            <input type="text" name="data_nascimento" class="form-control col-md-4" onkeypress="formatarCampo(this, '##-##-####')" maxlength="10" required>
                                        </div>



                                        <div class="col-md-12">

                                            <br> 
                                            <button type="submit" name="cadastrar"class="btn btn-sm btn-primary j_buttom"><b>Cadastrar dados </b></button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="location = 'professorRegistrados.php'"><b> Voltar</b></button>
                                        </div>
                                    </form>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div>

        </div>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
