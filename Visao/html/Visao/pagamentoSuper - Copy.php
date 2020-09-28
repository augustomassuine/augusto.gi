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
$processaDell = $con->Delete("processa","",array());

  $cont =-false;
  $arquivo = new DomDocument();
  $arquivo->load($_FILES['arquivo']['tmp_name']);
    //var_dump($arquivo);

  $linhas = $arquivo->getElementsByTagName("Row");
    //var_dump($linhas);

  $primeira_linha = true;

  foreach($linhas as $linha){
    if($primeira_linha == false){
      $nrOperacao = $linha->getElementsByTagName("Data")->item(1)->nodeValue;


      $valor = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
      $exp = explode(",", $valor); 
      $exp1 = explode(".", $exp[0]); 
      $exp2 = substr($exp1[0],0,1);
      if($exp2=='+'){
        $exp2 = substr($exp1[0],1);
        $valorFinal =$exp2.''.$exp1[1];

        
        $sql = $con->Insert("processa","nrOperacao=?,valorPago=?",array($nrOperacao,$valorFinal));
      }
    }
    $primeira_linha = false;
  }
  if($sql>0){

    $processa = $con->Select("nrOperacao,valorPago","processa","",array());
    foreach($processa as $processaLinha){
      $referencia = $con->Select("id,valorTotal,referencia","referencia","WHERE estado = ?",array(1));
      foreach($referencia as $referenciaLinha){
        if($processaLinha['nrOperacao']==$referenciaLinha["referencia"] and $processaLinha['valorPago']==$referenciaLinha["valorTotal"] ){
          $confirmado = $con->Update("referencia","estado=? WHERE id=?",array(2,$referenciaLinha["id"]));
              if($confirmado->rowCount()>0){


                $sqlIdPagamento = $con->Select("id","pagamentos","WHERE referencia_id =?",array($referenciaLinha["id"]));

              foreach($sqlIdPagamento as $sqlIdPagamentoLinha){ //SELECIONAR PAGAMENTOS QUE TEM A REFERENCIA ACIMA CITADO PARA INTRODUZIR NA OPERACAO
$inserirIdPagamento = $con->Insert("operacao","tipo_operacao =?,pagamentos_id=?,data=?",array(2,$sqlIdPagamentoLinha['id'],$data)); //TIPO OPERACAO DE PAGEMNTO É 2 E DE DIVIDA É 1
}


  $cont= true;
              }
          break;
        }

      }
      
    }
 if($cont== true){
  $msn = new Mensagem();
    $msn->sucesso('<b>Pagamentos Confirmados.','pagamentoSuper.php');
 }
 else{
  $msn = new Mensagem();
    $msn->sucesso('<b>Nenhum pagamento confirmado.','pagamentoSuper.php');
 }

  }
  else{
$msn = new Mensagem();
    $msn->sucesso('<b>Erro ao inserir o aquivo.','pagamentoSuper.php');
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
