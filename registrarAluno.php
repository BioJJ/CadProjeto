<?php
require './ModelBean/ALuno.php';
$aluno = new Aluno();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= (!empty($_GET['id_aluno']) ? 'Atualizar Aluno' : 'Registrar Aluno') ?></title>
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
            $logradouro = $_POST['logradouro'];
            $numero = $_POST['numero'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $cep = $_POST['cep'];
            $idcurso = $_POST['idcurso'];

            $aluno->setNome($nome);
            $aluno->setData_nascimento($data_nascimento);
            $aluno->setLogradouro($logradouro);
            $aluno->setNumero($numero);
            $aluno->setBairro($bairro);
            $aluno->setCidade($cidade);
            $aluno->setEstado($estado);
            $aluno->setCep($cep);
            $aluno->setIdcurso($idcurso);
            # Insert
            if ($aluno->insert()) {
                echo "Inserido com sucesso!";
            }

        endif;
        ?>

        <?php
        if (isset($_POST['atualizar'])):

            $id_aluno = $_POST['id_aluno'];
            $nome = $_POST['nome'];
            $data_nascimento = $_POST['data_nascimento'];
            $data_nascimento = implode("-", array_reverse(explode("-", $_POST['data_nascimento'])));
            $logradouro = $_POST['logradouro'];
            $numero = $_POST['numero'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $cep = $_POST['cep'];
            $idcurso = $_POST['idcurso'];

            $aluno->setNome($nome);
            $aluno->setData_nascimento($data_nascimento);
            $aluno->setLogradouro($logradouro);
            $aluno->setNumero($numero);
            $aluno->setBairro($bairro);
            $aluno->setCidade($cidade);
            $aluno->setEstado($estado);
            $aluno->setCep($cep);
            $aluno->setIdcurso($idcurso);

            if ($aluno->update($id_aluno)) {
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
                                <h3 class="panel-title"><?= (!empty($_GET['id_aluno']) ? '<b>Atualizar Aluno</b>' : '<b>Registrar Aluno</b>') ?></h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {

                                    $id_aluno = (int) $_GET['id_aluno'];
                                    $resultado = $aluno->find($id_aluno);
                                    $resultado2 = $aluno->findAllComNome($id_aluno);
                                    ?>

                                    <form class='form'  action="" method="post" >
                                        <input type="hidden" name="id_aluno"  value="<?php echo $resultado->id_aluno; ?>">

                                        <div class="col-md-12">
                                            <b>Nome Do Aluno</b>
                                            <input type="text" value="<?php echo $resultado->nome; ?>" name="nome" class="form-control col-md-4" required >
                                        </div>

                                        <div class="col-md-4">
                                            <br>
                                            <b>Data de Nascimento</b>
                                            <input type="text" value="<?php echo $aluno->inverterData($resultado->data_nascimento); ?>" name="data_nascimento" class="form-control col-md-4" onkeypress="formatarCampo(this, '##-##-####')" maxlength="10" required >
                                        </div> 
                                        <div class="col-md-4">
                                            <br>
                                            <b>Cep</b>
                                            <input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" required="" value="<?php echo $resultado->cep; ?>" type="search" maxlength="8" pattern="[0-9]+$">
                                        </div>
                                        <div class="col-md-4">
                                            <br><br>

                                            <button type="button" class="btn btn-primary" onclick="pesquisacep(cep.value)">Pesquisar</button>
                                        </div>
                                        <div class="col-md-8">
                                            <br>
                                            <b>Logradouro</b>
                                            <input id="logradouro" value="<?php echo $resultado->logradouro; ?>" name="logradouro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                                        </div> 
                                        <div class="col-md-4">
                                            <br>
                                            <b>Numero</b>
                                            <input id="numero"  value="<?php echo $resultado->numero; ?>" name="numero" class="form-control" placeholder="" required=""  type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <b>Bairro</b>
                                            <input id="bairro"  value="<?php echo $resultado->bairro; ?>" name="bairro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                                        </div> 
                                        <div class="col-md-4">
                                            <br>
                                            <b>Cidade</b>
                                            <input id="cidade"  value="<?php echo $resultado->cidade; ?>" name="cidade" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <b>Estado</b>
                                            <input id="estado"  value="<?php echo $resultado->estado; ?>" name="estado" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <b>Curso</b>
                                            <select name="idcurso"  class="form-control col-md-4"required >
                                                <option selected="true" value=" <?php echo $resultado2->idcurso; ?>"> <?php echo $resultado2->idcurso; ?> - <?php echo $resultado2->curso; ?></option>

                                                <?php foreach ($aluno->findAllCurso() as $key => $value): ?>
                                                    <option  value="<?php echo $value->id_curso; ?>"> <?php echo $value->id_curso; ?> -  <?php echo $value->nome; ?>  </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-12">

                                            <br> 
                                            <button type="submit" name="atualizar"class="btn btn-sm btn-primary j_buttom"><b>Atualizar dados </b></button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="location = 'AlunoRegistrados.php'"><b> Voltar</b></button>
                                        </div>
                                    </form>

                                <?php } else { ?>

                                    <form class='form'  action="" method="post" >


                                        <div class="col-md-12">
                                            <br>
                                            <b>Nome do Aluno</b>
                                            <input type="text"  name="nome" class="form-control col-md-4" required >
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <b>Data de Nascimento</b>
                                            <input type="text"  name="data_nascimento" class="form-control col-md-4" onkeypress="formatarCampo(this, '##-##-####')" maxlength="10" required >
                                        </div> 
                                        <div class="col-md-4">
                                            <br>
                                            <b>Cep</b>
                                            <input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
                                        </div>
                                        <div class="col-md-4">
                                            <br><br>

                                            <button type="button" class="btn btn-primary" onclick="pesquisacep(cep.value)">Pesquisar</button>
                                        </div>
                                        <div class="col-md-8">
                                            <br>
                                            <b>Logradouro</b>
                                            <input id="logradouro" name="logradouro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                                        </div> 
                                        <div class="col-md-4">
                                            <br>
                                            <b>Numero</b>
                                            <input id="numero" name="numero" class="form-control" placeholder="" required=""  type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <b>Bairro</b>
                                            <input id="bairro" name="bairro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                                        </div> 
                                        <div class="col-md-4">
                                            <br>
                                            <b>Cidade</b>
                                            <input id="cidade" name="cidade" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <b>Estado</b>
                                            <input id="estado" name="estado" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
                                        </div>


                                        <div class="col-md-12">
                                            <br>
                                            <b>Curso</b>
                                            <select name="idcurso"  class="form-control col-md-4"required >
                                                <option selected="true" >Selecione</option>
                                                <?php foreach ($aluno->findAllCurso() as $key => $value): ?>
                                                    <option value="<?php echo $value->id_curso; ?>"> <?php echo $value->nome; ?>  </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <button type="submit" name="cadastrar"class="btn btn-sm btn-primary j_buttom"><b>Cadastrar dados </b></button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="location = 'cursosRegistrados.php'"><b> Voltar</b></button>
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
        <script type="text/javascript" src="js/cep.js"></script>
    </body>
</html>
