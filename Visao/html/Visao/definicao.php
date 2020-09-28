<?php
$activo=6;
include_once 'header.php';
include_once 'menuSuperRelatorio.php';
$con = new CRUD;

if(isset($_POST['apagarDivida'])){

$count = 0;
$sql = $con->apagarDividaRepetida(array());
foreach ($sql as $varLinha) {

   $del = $con->Delete("operacao","WHERE id=?",array($varLinha['id_max']));
   $count = $del->rowCount();
}
if($count>0){
$msn = new Mensagem;
echo $msn->sucesso('Dados repetidos Apagados. Porvafor reinicia o processo.','definicao.php');
}
else{
$msn = new Mensagem;
echo $msn->sucesso('Não foi encontrado nenhum dado repetido.','definicao.php');
}

  
// $id=$_POST['idOperacao'];


// $sqlOperacao =$con->Select("divida_id","operacao","WHERE id=?",array($id));
// foreach($sqlOperacao as $sqlOperacaoLinha){ //Seleciona operacao com id definino no $id


// $sqlDivida =$con->Select("id","divida","WHERE id = ? AND superAgente_id=?",array($sqlOperacaoLinha['divida_id'],$_SESSION['dados']));//Selecionar caso o representante é do superagante em sessão.

// foreach($sqlDivida as $sqlDividaLiha){

//   $sqlDivOperacao = $con->Select("id","operacao","WHERE  divida_id =?",array($sqlDividaLiha['id'])); //Analisa quantos numeros de operacoes tem esta divida 
// }

// $sqlPag = $con->Select("id","pagamentos"," WHERE divida_id=?",array($sqlOperacaoLinha['divida_id'])); 

// if($sqlDivOperacao->rowCount()>1) { // Caso o numero da operacao da divida for maior que 1 deve apagar a operacao. pois uma divida so pode ter uma operacao.
//   $sqlOpera =$con->Delete("operacao","WHERE id =?",array($id));
//   if($sqlOpera->rowCount()>0){
//      $msn = new Mensagem;  
//   echo $msn->sucesso('Sucesso na operação       (codigo: x0000).','definicao.php');
//   }
//   else{
//     $msn = new Mensagem;
//   echo $msn->sucesso('Por favor, Contacta ao Administrador para esta operação.        (ERRO-codigo: x0000).','definicao.php');
//   }

// }
// elseif($sqlPag->rowCount()>0){ //verifica se a divida foi paga.
// $msn = new Mensagem;
//   echo $msn->sucesso('Não podes apagar uma divida ja Paga. Mais informações Contacte o Administrador','definicao.php');
// }
// elseif ($sqlDivida->rowCount()<1) { // CASO O REPRESENTANTE DESTA OPERACAO NÃO É DESTE AGENTE
//   $msn = new Mensagem;
//   echo $msn->sucesso('Introduza o número válido da operação  .','definicao.php');
 
// }


// //APAGA A OPERACAO E DIVIDA 
// elseif($sqlOperacao->rowCount()==1 AND $sqlDivida->rowCount()>0){ // se econtra uma operacao e divida , o representante da divida é de o super Agente em sessao. 

// $sqlOpera =$con->Delete("operacao","WHERE id =?",array($id));
// $sqlDiv = $con->Delete("divida","WHERE id=?",array($sqlOperacaoLinha['divida_id']));
// if($sqlDiv->rowCount()>0 AND $sqlOpera->rowCount()>0){ // se todas as opercoes ocorreu com sucesso.
//   $msn = new Mensagem;
//   echo $msn->sucesso('Sucesso na operação.    (codigo: x1111).','definicao.php');
// }
// else{
// $msn = new Mensagem;
//   echo $msn->sucesso('Por favor, Contacta ao Administrador para esta operação.               (ERRO-codigo: x1111).','definicao.php');
// }
// }

// else{ 

// $msn = new Mensagem;
//   echo $msn->sucesso('Introduza o número válido da operação  .','definicao.php');

// }
// }
// //NAO ENCONTROU NENHUM OPERACAO COM NUMERO INDICADO
// if($sqlOperacao->rowCount()==0){// caso nao econntre nenhum registo da operacao
// $msn = new Mensagem;
//   echo $msn->sucesso('Introduza o número válido da operação .','definicao.php');
// }
}


?>

<section class="col-sm-9 solicitaRep definicao">
  <div class="tab-content" id="v-pills-tabContent">
   <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
    <h4>Definições</h4>
    <div  class="solicitarRepr row" style="margin:auto 0.1%;background-color: rgba(249,250,251,.5);border: none;">
      <div class="dividaApagar col-sm-5">
        <h6>Apagar Dados repetidos</h6>
<form  method="POST" class="col-sm-8" style="margin:auto;" >
  <div class="form-group">
 <!--    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite o nr da operação." name="idOperacao" required>
     -->
  </div>
  <button type="submit" style="width: 100%; margin:0px;padding: 0.5%;" class="btn btn-danger" name="apagarDivida">Iniciar o processo </button>

</form>
      </div>
      <div class="dividaEditar col-sm-5">
        <h6>Editar divida</h6>
        <form class="col-sm-8" style="margin:auto;">
  <div class="form-group">
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite o nr da operação." required>
  </div>
   <div class="form-group">
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite valor a editar." required>
  </div>
  <button type="submit" style="width: 100%; margin:0px;padding: 0.5%;" class="btn btn-danger">Editar</button>

</form>
      </div>
<div class="alert alert-danger col-sm-11" style="margin:auto;padding: 0.25%; " role="alert">
  Uma informação apagada, pode não ter chance de recopera-la !
</div>
    </div>

</div>
</div>
</section>
<?php 
include_once 'footer.php';
?>

