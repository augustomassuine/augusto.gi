<?php
$activo=4;

include_once 'header.php';
include_once 'menuSuper.php';

if(isset($_POST['regeitarPagamento'])){
$referencia = $_POST['referencia'];
  $pagaControl = new pagamentoControl;
   $linha = $pagaControl ->RegeitarPagamento($referencia);
  if($linha>0){
    $msn = new Mensagem();
    $msn->sucesso('<b>Sucesso na operação!','pagamentoSuper.php');
  }
  else{
    $msn = new Mensagem();
    $msn->sucesso('<b>Erro<b> ao Cancelar o Pagamento !','pagamentoSuper.php');
  }

}
elseif(isset($_POST['confirmarPagamento'])){
  $referencia = $_POST['referencia'];

  $pagaControl = new pagamentoControl;
  $linha = $pagaControl ->ConfirmarPagamento($referencia,$data);
  if($linha>0){
    $msn = new Mensagem();
    $msn->sucesso('<b>Pagamento Confirmado !','pagamentoSuper.php');
  }
  else{
    $msn = new Mensagem();
    $msn->sucesso('<b>Erro<b> ao Confirmar Pagamento !','pagamentoSuper.php');
  }
}

//PAGAMENTO AUTOMATICO
elseif(isset($_POST['pagamentoAutomatico'])){
if(!empty($_FILES['arquivo']['tmp_name'])){
$con = new CRUD;



  $arquivo = new DomDocument();
  $arquivo->load($_FILES['arquivo']['tmp_name']);
    //var_dump($arquivo);

  $linhas = $arquivo->getElementsByTagName("sms");
    //var_dump($linhas);



  foreach($linhas as $linha){
 
      $nrOperacao = $linha->getElementsByTagName("body")->item(2)->nodeValue;
      $valor = $linha->getElementsByTagName("body")->item(2)->nodeValue;
       echo $valor.'-';
        
        
    
   
  }

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
            <th class="headTab" scope="col">Representante</th>
            <th class="headTab" scope="col">Estado</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
          <?php 
          $sqlSupLinha1 = array();
          $con = new CRUD;
          $valorTotalPago = 0;

          $sqlSup = $con->Select("id","representante","WHERE superAgente_id=?",array($_SESSION['dados']));
  foreach($sqlSup as  $sqlSupLinha){//SELECTIONAR REPRESENTANTE DE SUPER AGENTE EM SESSAO
//var_dump($sqlSupLinha);
//$sqlSupLinha1 = $sqlSupLinha['id'];
  ///}

  $repRefencia = $con->Select("*","referencia","WHERE representante_id=? AND data> ? ",array($sqlSupLinha['id'],'2019-08-25 00:00:00'));
  foreach($repRefencia as $repRefenciaLinha){//REPRESENTANTE DO SUPERAR QUE ESTA NA REFERENCIA 
    ?>

    <tr>
      <td><?php echo $repRefenciaLinha['dataUpdate'];?></td>
      <td><?php echo $repRefenciaLinha['valorTotal'];?></td>
      <td><?php echo $repRefenciaLinha['formaPagamento'];?></td>
      <td><?php echo $repRefenciaLinha['referencia'];?></td>
      <td>
        
      <?php
     
$sqlRep = $con->Select("usuario_id","representante","WHERE id=?",array($repRefenciaLinha['representante_id']));
foreach($sqlRep as $sqlRepLinha){
$sqlUser = $con->Select("nome","usuario","WHERE id=?",array($sqlRepLinha['usuario_id']));
foreach ($sqlUser as $sqlUserLinha) {
 echo $sqlUserLinha['nome'];
}
}
?> 
      </td>
       <?php if($repRefenciaLinha['estado']==1) {  // CASO O PAGAMENTO AINDA NAO FOI CONFIRMADO
        ?>  
        <td style="color:rgba(130,50,58,1);text-align: center;color:#fff;"><a class="btn btn-primary" style="padding: 0px 4px;margin-bottom: 1px; font-size: 9pt;" data-toggle="modal" data-target="#confirmarPagamento" data-whateverreferencia="<?php echo $repRefenciaLinha['referencia'];?>">Confirmar</a>
          <a style="padding: 0px 4px;margin-bottom: 1px; font-size: 9pt;" class="btn btn-danger" data-toggle="modal" data-target="#regeitarPagamento" data-whateverreferencia="<?php echo $repRefenciaLinha['id'];?>">X</a></td> 
      </tr>
    <?php }
elseif($repRefenciaLinha['estado']==2){    // CASO O PAGAMENTO   SER CONFIRMADO
  ?>  
  <td style="color:rgba(50,110,64,1);font:11pt; text-align: center;" >Confirmado</td> 
  <?php
}

}
}

//}

?>
</tbody>
</table>
</div>



 <div class="alert alert-primary" style="padding: 4px;margin: 10px auto;text-align: center;" role="alert">
    <a style="text-align: center;" href="" data-toggle="modal" data-target="#confPagamento1">Processar o pagamento</a>
  </div>
</div>
</div>
</section>

<?php 

include_once 'footer.php';
?>
