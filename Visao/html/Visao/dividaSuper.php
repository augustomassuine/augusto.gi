<?php
 $activo=3;
 include_once 'header.php';
 include_once 'menuSuper.php';
 if(isset($_POST['pagamento'])){
  $valor = $_POST['valor'];
  $idDivida = $_POST['idDivida'];
  $referencia_id =1;
  $pag = new PagamentoModel($valor,$idDivida,$referencia_id,$data);
  $pagControl = new PagamentoControl();
  $linha = $pagControl->pagar($pag);
  if($linha==-300){
    $msn = new Mensagem;
    echo $msn->sucesso('O valor pago nao pode ser Superior que a divida !','dividaRep.php');
  }
  elseif($linha>0){
    $msn = new Mensagem;
    echo $msn->sucesso('Já podes finalizar o pagamento  .','dividaRep.php');
  }
  else{
    $msn = new Mensagem;
    echo $msn->sucesso('<b>Erro</b> ao efectuar o pagamento !','dividaRep.php');
  }
}
?>
<section class="col-sm-9">
  <!-- <a href="../Control/dividaSuperControl">Ver</a> -->
  <div class="tab-content" id="v-pills-tabContent">
   <div class="" id="" role="tabpanel" aria-labelledby="">
    <h5 class="sucesso "> </h5>
    <h4>Dívidas</h4>
    <div class="table-responsive-sm table-responsive-md   ">
      <table class="table myTable table-bordered table-striped table-hover tableDivida">
        <thead>
          <tr>
            <th class="headTab" scope="col">Data</th>
            <th class="headTab" scope="col">Valor</th>
            <th class="headTab" scope="col">Reprsentante</th>
          </tr>
        </thead>
        <tbody id="prod-listSuper">
         
      </tbody>
    </table>
     <div class="alert alert-secondary" style="padding: 2px;margin: 3px auto;text-align: center;color: rgba(92,145,155,1);" role="alert">
    Total por receber com os Reresentantes é : <span id="total-dividaSuper"> </span>.
  </div> 
  <div  id="carregandoSuper" style="display: none;width: 25%; margin: auto; background: #eef;"><img  class="img-responsive" style="width: 100%;height: 100%; position: relative;" src="img/pageLoader.gif"></div>

  </div>
</div>     
</div>
</section>
<?php 
include_once 'footer.php';
?>
<script src="js/appSuper.js"></script>

