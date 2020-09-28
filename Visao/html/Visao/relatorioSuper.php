<?php
$activo=5;
include_once 'header.php';
include_once 'menuSuperRelatorio.php';
$con = new CRUD;
$valor = 0;
?>

<section class="col-sm-9 solicitaRep">
  <div class="tab-content" id="v-pills-tabContent">
   <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
    <h4>Relatorio</h4>
    <div  class="solicitarRepr">
      <form method="POST" class="col-md-4" style="margin: 2% auto;">
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-6">
            <label for="dataInicio">Início</label>
            <input style="font-size: 10pt;" type="date" class="form-control" id="dataInicio" name="dataInicio" value="<?php echo date('Y/m/d');?>"   required>
          </div>
          <div class="form-group col-md-6">
            <label for="dataFim">Término</label>
            <input style="font-size: 10pt;" type="date" class="form-control" id="dataFim" name="dataFim" value="<?php echo date('Y/m/d');?>" required>
          </div>
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-12">
            <select class="form-control" name="repRelatorio" required>
              <option value="TodosRep">Relatório Geral</option>
              <?php 
              $sqlRepres = $con->Select("id,usuario_id","representante","WHERE superAgente_id=?",array($_SESSION['dados'])); 
              foreach($sqlRepres as $sqlRepresLinha){
                $sqlUserRep = $con->Select("nome","usuario","WHERE id =?",array($sqlRepresLinha['usuario_id']));
                foreach($sqlUserRep as $sqlUserRepLinha){
                  ?>
                  <option value="<?php echo $sqlRepresLinha['id']; ?>"><?php echo $sqlUserRepLinha['nome'];?></option>
                  <?php
                }
              }
              ?>

            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary" name="buscar">Buscar</button>
      </form>
    </div>
    <?php
    $credito = 0;
    $debito = 0;
    ?>


    <div class="table-responsive-sm table-responsive-md "> 
      <table id="example" class="table table-hover example" style="font-size: 8pt;">
        <thead>
          <tr>
            <th class="headTab" scope="col">Operação n</th>
            <th class="headTab" scope="col">Tipo</th>
            <th class="headTab" scope="col">Data</th>
            <th class="headTab" scope="col">Funcionário</th>
            <th class="headTab" scope="col">Valor</th>
            <th class="headTab" scope="col">Meio</th>
            <th class="headTab" scope="col">Agente</th>
            <th class="headTab" scope="col">Saldo</th>
          </tr>
        </thead>
        <tbody style="">
          <?php 
          if(isset($_POST['buscar'])){

            $dataInicio = $_POST['dataInicio'].' 00:00:00';
            $dataFim = $_POST['dataFim'].' 23:59:59';   
            $representanteRel =$_POST['repRelatorio'];

if($representanteRel =="TodosRep"){ //TODOS REPRESENTANTES


$sqlOperacao =$con->Select("*","operacao","WHERE data BETWEEN  ? AND ?  ORDER BY data DESC",array($dataInicio,$dataFim));//SELECIONAR OPERACAO
foreach($sqlOperacao as $sqlOperacaoLinha){ 
  if($sqlOperacaoLinha['tipo_operacao']==1){ //CASO O TIPO DE OPERACAO SEJA DIVIDA OU DEPOSITO
    ?>

    <?php 
    $sqlDiv = $con->Select("representante_id,agente_id,valor_emprestimo,superAgente_id","divida","WHERE id=? AND superAgente_id=?",array($sqlOperacaoLinha['divida_id'],$_SESSION['dados'])); //SELECIONAR DIVIDAS DE REPRESENTANTE EM SESSAO
    foreach($sqlDiv as $sqlDivLinha){
  if($sqlDivLinha['superAgente_id'] == $_SESSION['dados']){//VERIFICAR SE O SUPER AGENTE EM SESAO TEM PRIVILEGIO PARA VER
    ?>
    <tr> 
      <td> <?php echo $sqlOperacaoLinha['id'] ;?> </td>
      <td>Deposito</td>
      <td><?php echo $sqlOperacaoLinha['data'] ;?>  </td>

      <?php
    }
  $sqlRep = $con->Select("usuario_id","representante","WHERE id = ?",array($sqlDivLinha['representante_id'])); //SELECIONAR REPRESENTANTE QUE TEM DIVIDA
  foreach($sqlRep as $sqlRepLinha){
  $sqlUser = $con->Select("nome","usuario","WHERE id=?",array($sqlRepLinha['usuario_id']));//SELECIONAR NOME DO USUARIO QUE É REPRESENTENTE
  foreach($sqlUser as $sqlUserLinha){?> 

  <td> <?php echo $sqlUserLinha['nome'] ;?></td>
  <?php 

}

}
?>
<td> <?php echo 'MT '.$sqlDivLinha['valor_emprestimo'].',00' ;?></td>
<td> ----</td>
<?php
$credito = $credito + $sqlDivLinha['valor_emprestimo'];
$sqlAgente = $con->Select("nomeAgente,codigoAgente","agente","WHERE id =? AND representante_id=?",array($sqlDivLinha['agente_id'],$sqlDivLinha['representante_id']));//SELECUINAR AGENTE QUE DEVEU A REPRESENTANTE 



// CASO O AGENTE SE APAGADO POSSA MOSTRAR #####

if($sqlAgente->rowCount()<1){ ?>

<td><?php echo '########';?></td>

<?php
}
else{

foreach($sqlAgente as $sqlAgenteLinha){?>
  <td>
   <?php  echo $sqlAgenteLinha['nomeAgente'].' , '.$sqlAgenteLinha['codigoAgente'];?>
   </td> 
<?php
}
}

 ?> 



<td> <?php echo 'saldo' ;?></td>

</tr>

<?php
}
} //TERMINA CASO A OPERACAO SEJA DIVIDA
//INICIO DE  CASO A OPERACAO SEJA PAGAMENTO
elseif($sqlOperacaoLinha['tipo_operacao']==2) //CASO A OPERACAO SEJA PAGAMENTO 
{ ?>
  <?php
    $sqlPagamento = $con->Select("referencia_id,valorPago,divida_id","pagamentos","WHERE id =?",array($sqlOperacaoLinha['pagamentos_id']));//SELECIONAR PAGAMENTO DA OPERACAO
    foreach($sqlPagamento as $sqlPagamentoLinha)
      $sqlDiviPag =$con->Select("superAgente_id,representante_id,agente_id","divida","WHERE id=? AND superAgente_id=?",array($sqlPagamentoLinha['divida_id'],$_SESSION['dados']));//SELECIONADO DIVIDA DO PAGAMENTO OU LINHA DEA DIVIDA
    foreach( $sqlDiviPag as $sqlDiviPagLinha){


if($sqlDiviPagLinha['superAgente_id'] == $_SESSION['dados']){//VERIFICAR SE O SUPER AGENTE EM SESAO TEM PRIVILEGIO PARA VER
  ?>
  <tr>
    <td><?php echo $sqlOperacaoLinha['id'] ;?> </td>
    <td>Levantamento</td>
    <td><?php echo $sqlOperacaoLinha['data'] ;?>  </td>

    <?php
  }









 $sqlRepPag = $con->Select("usuario_id","representante","WHERE id = ?",array($sqlDiviPagLinha['representante_id'])); //SELECIONAR REPRESENTANTE EM QUE TEM DIVIDA QUE SEJA DO SUPER AGENTE
 foreach($sqlRepPag  as $sqlRepPagLinha){
$sqlUserDiv = $con->Select("nome","usuario","WHERE id=?",array($sqlRepPagLinha['usuario_id']));//SELECIONAR NOME DO USUARIO QUE É REPRESENTENTE
foreach($sqlUserDiv as $sqlUserDivLinha){ ?>

<td><?php echo $sqlUserDivLinha['nome'];?></td>

<?php
}
}
?>

<td><?php echo 'MT '.$sqlPagamentoLinha['valorPago'].',00'?></td>
<?php

$sqlFormaPag = $con->Select("formaPagamento,referencia","referencia","WHERE id =?",array($sqlPagamentoLinha['referencia_id']));
foreach($sqlFormaPag as $sqlFormaPagLinha){ ?>
<td ><?php   echo $sqlFormaPagLinha['formaPagamento'].'  #'.$sqlFormaPagLinha['referencia'].'#'; ?></td>
<?php
          /*BANK*/
if($sqlFormaPagLinha['formaPagamento']!='Mpesa'){
$valor =$valor + $sqlPagamentoLinha['valorPago'];
}
}


$debito = $debito + $sqlPagamentoLinha['valorPago'];
  $sqlAgenteDiv = $con->Select("nomeAgente,codigoAgente","agente","WHERE id =? AND representante_id=?",array($sqlDiviPagLinha['agente_id'],$sqlDiviPagLinha['representante_id']));//SELECUINAR AGENTE QUE DEVEU A REPRESENTANTE 



// CASO O AGENTE SE APAGADO POSSA MOSTRAR #####

if($sqlAgenteDiv->rowCount()<1){ ?>

<td><?php echo '########';?></td>

<?php
}
else{

foreach($sqlAgenteDiv as $sqlAgenteDivLinha){?>
  <td>
   <?php  echo $sqlAgenteDivLinha['nomeAgente'].' , '.$sqlAgenteDivLinha['codigoAgente'];?>
   </td> 
<?php
}
}

 ?> 


<td>saldo</td>
</tr>


<?php
}

}

}?>
















<?php

}//TERMINA AQUI A CONDICAO DE SELECIONAR TODOS REPRESENTANTES
else { //REPRESENTANTES ESPECIFICO


$sqlOperacao =$con->Select("*","operacao","WHERE data BETWEEN  ? AND ?  ORDER BY data DESC",array($dataInicio,$dataFim));//SELECIONAR OPERACAO
foreach($sqlOperacao as $sqlOperacaoLinha){ 
  if($sqlOperacaoLinha['tipo_operacao']==1){ //CASO O TIPO DE OPERACAO SEJA DIVIDA OU DEPOSITO POR PARTE DE SUPER AGENTE
    ?>
      <?php 
    $sqlDiv = $con->Select("representante_id,agente_id,valor_emprestimo,superAgente_id","divida","WHERE id=? AND superAgente_id=? AND representante_id=?",array($sqlOperacaoLinha['divida_id'],$_SESSION['dados'],$representanteRel)); //SELECIONAR DIVIDAS DE REPRESENTANTE EM SESSAO
    foreach($sqlDiv as $sqlDivLinha){

      ?>
       <tr>  
      <td> <?php echo $sqlOperacaoLinha['id'] ;?> </td>
      <td>Depósito</td>
      <td><?php echo $sqlOperacaoLinha['data'] ;?>  </td>

      <?php
  //}
  $sqlRep = $con->Select("usuario_id","representante","WHERE id = ?",array($sqlDivLinha['representante_id'])); //SELECIONAR REPRESENTANTE QUE TEM DIVIDA
  foreach($sqlRep as $sqlRepLinha){
  $sqlUser = $con->Select("nome","usuario","WHERE id=?",array($sqlRepLinha['usuario_id']));//SELECIONAR NOME DO USUARIO QUE É REPRESENTENTE
  foreach($sqlUser as $sqlUserLinha){?> 

  <td> <?php echo $sqlUserLinha['nome'] ;?></td>
  <?php 

}

}
?>
<td> <?php echo 'MT '.$sqlDivLinha['valor_emprestimo'].',00' ;?></td>
<td>----</td>
<?php
$credito = $credito + $sqlDivLinha['valor_emprestimo'];
$sqlAgente = $con->Select("nomeAgente,codigoAgente","agente","WHERE id =? AND representante_id=?",array($sqlDivLinha['agente_id'],$sqlDivLinha['representante_id']));//SELECUINAR AGENTE QUE DEVEU A REPRESENTANTE 


// CASO O AGENTE SE APAGADO POSSA MOSTRAR #####

if($sqlAgente->rowCount()<1){ ?>

<td><?php echo '########';?></td>

<?php
}
else{

foreach($sqlAgente as $sqlAgenteLinha){?>
  <td>
   <?php  echo $sqlAgenteLinha['nomeAgente'].' , '.$sqlAgenteLinha['codigoAgente'];?>
   </td> 
<?php
}
}

 ?> 

<td> <?php echo 'saldo' ;?></td>

</tr>

<?php
}
} //TERMINA CASO A OPERACAO SEJA DIVIDA
//INICIO DE  CASO A OPERACAO SEJA PAGAMENTO
elseif($sqlOperacaoLinha['tipo_operacao']==2) {//CASO A OPERACAO SEJA PAGAMENTO OU LEVANTAMENTO POR PARTE DE SUPERAGENTE
  $sqlPagamento = $con->Select("referencia_id,valorPago,divida_id","pagamentos","WHERE id =?",array($sqlOperacaoLinha['pagamentos_id']));
  foreach( $sqlPagamento as  $sqlPagamentoLinha){

    $sqlDivPag = $con->Select("*","divida","WHERE id =? AND representante_id=?",array($sqlPagamentoLinha['divida_id'],$representanteRel));
    foreach($sqlDivPag as $sqlDivPagLinha){
      $sqlPagamentoFinal = $con->Select("*","pagamentos","WHERE id=? AND divida_id=?",array($sqlOperacaoLinha['pagamentos_id'],$sqlDivPagLinha['id']));
      foreach($sqlPagamentoFinal as $sqlPagamentoFinalLinha){
        ?>
        <tr>
          <td><?php echo $sqlOperacaoLinha['id'] ;?> </td>
          <td>Levantamento</td>
          <td><?php echo $sqlOperacaoLinha['data'] ;?>  </td>

          <?php
   $sqlRepPag = $con->Select("usuario_id","representante","WHERE id = ?",array($sqlDivPagLinha['representante_id'])); //SELECIONAR REPRESENTANTE EM QUE TEM DIVIDA QUE SEJA DO SUPER AGENTE
   foreach($sqlRepPag  as $sqlRepPagLinha){
$sqlUserDiv = $con->Select("nome","usuario","WHERE id=?",array($sqlRepPagLinha['usuario_id']));//SELECIONAR NOME DO USUARIO QUE É REPRESENTENTE
foreach($sqlUserDiv as $sqlUserDivLinha){ ?>

<td><?php echo $sqlUserDivLinha['nome'];?></td>

<?php
}
}
?>
<td><?php echo 'MT '.$sqlPagamentoFinalLinha['valorPago'].',00' ?></td>
<?php

$sqlFormaPag = $con->Select("formaPagamento,referencia","referencia","WHERE id =?",array($sqlPagamentoLinha['referencia_id']));
foreach($sqlFormaPag as $sqlFormaPagLinha){ ?>
<td ><?php   echo $sqlFormaPagLinha['formaPagamento'].'  #'.$sqlFormaPagLinha['referencia'].'#'; ?></td>
<?php

}

$debito = $debito + $sqlPagamentoFinalLinha['valorPago'];
$sqlAgenteDiv = $con->Select("nomeAgente,codigoAgente","agente","WHERE id =? AND representante_id=?",array($sqlDivPagLinha['agente_id'],$sqlDivPagLinha['representante_id']));//SELECUINAR AGENTE QUE DEVEU A REPRESENTANTE 



// CASO O AGENTE SE APAGADO POSSA MOSTRAR #####

if($sqlAgenteDiv->rowCount()<1){ ?>

<td><?php echo '########';?></td>

<?php
}
else{

foreach($sqlAgenteDiv as $sqlAgenteDivLinha){?>
  <td>
   <?php  echo $sqlAgenteDivLinha['nomeAgente'].' , '.$sqlAgenteDivLinha['codigoAgente'];?>
   </td> 
<?php
}
}

 ?> 


<td>saldo</td>

</tr>
<?php


}

}

}

}

}
}//TERMINA AQUI A CONDICAO DE CADA REPRESENTANCAO
?>

<?php
}     ?>

 <tr style="font-weight: bold;">  
<td>Total de crédito : <?php echo $credito; ?> </td>
<td>Total de débito : <?php echo $debito; ?>  </td>
<td>Líquido : <?php echo $debito-$credito; ?>  </td>
<td>  </td>
<td>  </td>
<td>  </td>
<td>  </td>
<td>  </td>
</tr> 
</tbody>




</table>

<div class="alert alert-secondary" style="padding: 2px;margin: 3px auto;text-align: center;color: rgba(92,145,155,1);" role="alert">

  Total de crédito : <?php echo $credito; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total de débito : <?php echo $debito; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Líquido : <?php echo $debito-$credito;?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank : <?php echo $valor; ?>
</div>


</div>








</div>
</div>
</section>
<?php 
include_once 'footer.php';
?>

