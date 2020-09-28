

<div class="container-fluid estrutura">
  <div class="row">
  <aside class="col-sm-2 ">
   <div class="nav flex-column nav-pills" id="v-pills-tab" role="" aria-orientation="vertical">
      <a class="nav-link<?php if($activo==1){?> active <?php }?>"  href="solicitacaoSuper.php" role="tab" >
      SOLICITAÇÃO <span style="font-size: 13pt;" class="glyphicon glyphicon-send"></span></a>
      <a class="nav-link<?php if($activo==2){?> active <?php }?> "  href="representanteSuper.php" role="tab">REPRESENTANTES</a>
      <a class="nav-link<?php if($activo==3){?> active <?php }?>"  href="#" role="tab" >DÍVIDAS <span style="font-size: 13pt;" class="glyphicon glyphicon-export"></span></a>
      <a class="nav-link<?php if($activo==4){?> active <?php }?>"  href="pagamentoSuper.php" role="tab" >PAGAMENTOS  <span style="font-size: 13pt;" class="glyphicon glyphicon-log-in"></a>
      <a class="nav-link<?php if($activo==5){?> active <?php }?>"  href="relatorioSuper.php" role="tab" >RELATÓRIO <span style="font-size: 13pt;" class="glyphicon glyphicon-file"></a>
         <a class="nav-link<?php if($activo==6){?> active <?php }?>"  href="definicao.php" role="tab" >DEFINIÇÕES <span style="font-size: 13pt;" class="glyphicon glyphicon-cog"> </span></a>
    </div>
  </aside>
