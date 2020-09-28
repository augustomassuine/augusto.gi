<?php 
include_once('../Model/representante.php');
include_once('../Model/pagamento.php');
include_once('../Model/solicitacao.php');
include_once('../Model/agente.php');
include_once('../Model/mensagemInfo.php');
include_once('../Model/referencia.php');
include_once('../Control/representanteControl.php');
include_once('../Control/pagamentoControl.php');
include_once('../Control/agenteControl.php');
include_once('../Control/solicitacaoControl.php');
include_once('../Control/sessaoControl.php');

 date_default_timezone_set("Africa/Maputo");
 $d = date("Y-m-d"); 
 $h = date("H:i:s"); 
 $data = $d.' '.$h;


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.js"></script>

  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="css/glyphicon.css">

  
   <link rel="stylesheet" type="text/css" href="css/geral.css">
   <link rel="stylesheet" type="text/css" href="css/superAgente.css">
   <link rel="stylesheet" type="text/css" href="css/representante.css">
   <link rel="stylesheet" type="text/css" href="css/definicao.css">
 

<link rel="icon" href="Visao/img/download.png">
    <title style="background: #000;">MozSuperAgente</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg top">
  <a class="navbar-brand" href="#" style="color: #fff; "><span style="font-weight: bold;">Moz</span>SuperAgente</a>
  <div style="margin-left:65%;margin-right: 1%;color:  #fff;font-size: 12pt;">
    <span style="font-size: 14pt;" class="glyphicon glyphicon-user"></span>
      <?php echo $_SESSION['usuarioLogin']['nomeUsuario'];?>
     &nbsp;&nbsp;
     <a href="../Model/sair.php" style="text-decoration: none; color: #fff;"> <span style="font-size: 14pt;" class="glyphicon glyphicon-log-out"></span>&nbsp;Sair</a>
   

</div>
<form method="">  </form>


</nav>


