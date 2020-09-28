<?php
$activo=4;

include_once 'header.php';
include_once 'menuRep.php';



if(isset($_REQUEST['massuine'])){
 $id=substr($_REQUEST['massuine'],32);
  $con = new CRUD;
  $sql = $con->Delete("pagamentos","WHERE id =? AND referencia_id=?",array($id,1));
}
elseif(isset($_POST['pagamentoDeposito'])){
 $valorDepositado = $_POST['valorDepositado'];
 $idRepresentante = $_POST['idRepresentante'];
 $estadoReferencia =1;
 $formaPagamento = $_POST['formaPagamento'];
 $referencia = $_POST['referencia'];
// var_dump($valorDepositado);
 $ref = new referenciaModel($valorDepositado,$idRepresentante,$estadoReferencia,$formaPagamento,$referencia,$data);
 $pagControl = new PagamentoControl();
 $linha = $pagControl->finalizarPagamento ($ref);
 if($linha==-200){
  $msn = new Mensagem;
  echo $msn->sucesso('A referencia do pagamento ja foi usada.','pagamentoRep.php');
}
// elseif($linha==-300){
//   $msn = new Mensagem;
//   echo $msn->sucesso('O valor pago nao pode ser Superior que a divida !','pagamentoRep.php');
// }
elseif($linha>0){
  $msn = new Mensagem;
  echo $msn->sucesso('Aguarde a confirmacao do pagamento !','pagamentoRep.php');
}
else{
  $msn = new Mensagem;
  echo $msn->sucesso('<b>Erro</b> ao efectuar o pagamento !','pagamentoRep.php');
}
}

?>


<section class="col-sm-9">
  <div class="tab-content" id="v-pills-tabContent">


   <div class="" id="" role="tabpanel" aria-labelledby="">
    <h5 class="sucesso "> </h5>
    <h4>Pagamentos</h4>

    <div class="table-responsive-sm table-responsive-md   "> 
      <table class="table myTable table-bordered table-striped table-hover tableRepresentante " style="font-size: 10pt;" >
        <thead>
          <tr>
            <th class="headTab" scope="col">Data</th>
            <th class="headTab" scope="col">Valor Pago</th>
            <th class="headTab" scope="col">Forma de pagamento</th>
            <th class="headTab" scope="col">Referencia</th>
            <th class="headTab" scope="col">Agente</th>
            <th class="headTab" scope="col">Estado</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
          <?php 
          $aleatoria = rand(1000,9999);
          $md5=md5($aleatoria);

          $con = new CRUD;
          $dividaTotalDeposito =0;
          $estadoOn = false;
          $sqlPag = $con->SelectInnerJoinPagamentoRep($_SESSION['dados'],array());
          foreach($sqlPag as $sqlPagLinha){
            if($sqlPagLinha['rEstado']==0){

              ?>
              <tr>

                <td><?php echo $sqlPagLinha['pData']?></td>
                <td><?php echo $sqlPagLinha['pValor'];?></td>
                <td style="border: none;background: rgba(236,236,236,1);"></td>
                <td style="border: none;background: rgba(236,236,236,1);"></td>
                <td ><?php echo $sqlPagLinha['aNome'].' , '.$sqlPagLinha['aCodigo']?></td>
                <td style="border: none;background: rgba(236,236,236,1);"><a href="pagamentoRep.php?massuine=<?php echo $md5.''.$sqlPagLinha['pId'];?>">
                  N達o pagar
                </a>
                <?php if($estadoOn == false){
                  $estadoOn = true;
                } ?></td>

              </tr>
              <?php
            } 
            else{?>
              <tr>
                <td><?php echo $sqlPagLinha['rDataUpdate'];?></td>
                <td><?php echo $sqlPagLinha['pValor'];?></td>
                <td><?php echo $sqlPagLinha['rForma'];?></td>
                <td><?php echo $sqlPagLinha['rReferencia'];?></td>
                <td><?php echo $sqlPagLinha['aNome'].' , '.$sqlPagLinha['aCodigo']?></td>
       <?php if($sqlPagLinha['rEstado']==1) {  // CASO O PAGAMENTO AINDA NAO FOI CONFIRMADO
        ?>  
        <td style="color:rgba(130,50,58,1);font:11pt;text-align: center;">A espera de Confirmacao</td> 

      <?php }
elseif($sqlPagLinha['rEstado']==2){    // CASO O PAGAMENTO   SER CONFIRMADO
  ?>  
  <td style="color:rgba(50,110,64,1);font:11pt; text-align: center;" >Confirmado</td>

  <?php
}
?>
</tr>
<?php
}

}?>

</tbody>

</table>

</div>
<?php 
if($estadoOn ==true){?> 

  <div class="alert alert-danger" style="padding: 4px;margin: 10px auto;text-align: center;" role="alert">
    <a style="color: rgb(114,28,36);text-align: center;" href="" data-toggle="modal" data-target="#pagamentoDeposito"   >Finalizar o pagamento</a>
  </div>
<?php   }
?>
</div>
</div>
</section>

<?php 
include_once 'footer.php';
?>
