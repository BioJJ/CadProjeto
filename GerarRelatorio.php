<?php
require './ModelBean/Aluno.php';
$aluno = new Aluno();

 
$html .= '
<header id="header2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span class="glyphicon glyphicon-import" aria-hidden="true"></span>  <font color=#fff> Flex Peak  <small><font color=#fff> Tecnologia e Assessoria</font></small> </h1>
            </div>  
            </div>
    </div>
</header>    

<section id = "main">
    <div class = "container">
        <div class = "row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title"> <font color=#F5FBEF ><b>Relatório Geral</b> </font></h3>
                    </div>
                    <div class="panel-body">

                        <div class="col-md-12">
';
                                    $html .= '<table class="table " >';
                                    $html .= '<tr>
                                                <th>#</th>
                                                <th>Nome do Aluno</th>
                                                <th>Nome do Curso</th>
                                                <th>Nome do Professor</th>

                                            </tr>';
                                    foreach ($aluno->Relatorio() as $key => $value) {
                                    $html .= '<tr>';
                                    $html .= '<td>' . $value->id_aluno . "</td>";
                                    $html .= '<td>' . $value->nome . "</td>";
                                    $html .= '<td>' . $value->curso . "</td>";
                                    $html .= '<td>' . $value->professor . "</td>";
                                    }
                                    $html .= '</tr>';



                                    $html .= '</table>
</div>
                        </div>

                     </div>
                </div>

            </div>

        </div>
</section>';




include("mpdf60/mpdf.php");

$mpdf = new mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents('css/bootstrap.min.css');
$css1 = file_get_contents('css/style.css');
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($css1, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();

exit;




       



//<!--
// backup kk
//$html .= '<h1 id=titulo>Relatório Geral</h1>';
//$html .= '<table class="table " border=1 width=100%>';
//$html .= '<tr>
//            <th>ID</th>
//            <th>Nome do Aluno</th>
//            <th>Nome do Curso</th>
//            <th>Nome do Professor</th>
//
//        </tr>';
//foreach ($aluno->Relatorio() as $key => $value) {
//$html .= '<tr>';
//$html .= '<td>' . $value->id_aluno . "</td>";
//$html .= '<td>' . $value->nome . "</td>";
//$html .= '<td>' . $value->curso . "</td>";
//$html .= '<td>' . $value->professor . "</td>";
//}
//$html .= '</tr>';
//
//
//
//$html .= '</table>'; 
//
//-->