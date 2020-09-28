<?php
include_once 'CRUD.class.php';
include_once('sessaoControl.php');

class PagamentoControl{

 function Pagar(PagamentoModel $p){ //ADICIONAR REPRESENTANTE  
 	$conn= new CRUD;
 	// $referenciaExistem = false;
$sqlDivida = $conn->Select("valor_emprestimo","divida","WHERE estado = ? AND id=?",array(1,$p->getIdDivida())); //SELECTIONAR A DIVIDA QUE DESEJA-SE PAGAR PARA POSTERIOR REDUZIR


foreach($sqlDivida as $sqlDividaLinha){

	
if($p->getValor()>$sqlDividaLinha['valor_emprestimo']){ //O VALOR PAGO NAO PODE SER SUPERIOR A DIVIDA!
	return -300;
}

else{

	$sqlPago=$conn->Insert("pagamentos","valorPago=?,divida_id=?,referencia_id=?,data=?",array($p->getValor(),$p->getIdDivida(),$p->getIdReferencia(),$p->getData()));
	return $sqlPago;




}
}
}



function finalizarPagamento (referenciaModel $ref){
 $referenciaExistem = false;
$con = new CRUD;

$sqlPagamento = $con->Select("referencia,representante_id","referencia","",array());
	foreach($sqlPagamento as $sqlPagamentoLinha){
		if($ref->getReferencia()==$sqlPagamentoLinha['referencia']){
			
				$referenciaExistem = true;//VERIFICA A REFERENCIA SE TINHA SIDO USADO ANTERIORMENTE
				
		}
	}    

if( $referenciaExistem == true){
	//var_dump('referencia existe');
return -200;
}
else{
	//var_dump('referencia nao existe');
$sqlPagou = $con->Insert("referencia","valorTotal =?, referencia=?, formaPagamento=?,estado=?,representante_id=?,data=?,dataUpdate =?",array($ref->getValor(),$ref->getReferencia(),$ref->getFormaPagamento(),$ref->getEstadoReferencia(),$ref->getIdRepresentante(),$ref->getData(),$ref->getData()));

if($sqlPagou>0){
	$pagouPeloMenosUm = false; //para verificar se houve pelomenos um pagamento.
//var_dump('Inseriu referencia');
$sqlDividaApagar = $con->Select("id","divida","WHERE representante_id=? AND estado=?",array($_SESSION['dados'],1));
foreach($sqlDividaApagar as $sqlDividaApagarLinha){
 //var_dump('DIVIDAS : '.$sqlDividaApagarLinha['id']);
$sqlUpdatePagamento =$con->Update("pagamentos","referencia_id =? WHERE referencia_id = ? AND divida_id=? ",array($sqlPagou,1,$sqlDividaApagarLinha['id']));
if($sqlUpdatePagamento->rowCount()>0 AND $pagouPeloMenosUm == false){
	$pagouPeloMenosUm = true;
}
}

if($pagouPeloMenosUm == true){

return 1;	//para dizer que houve pagamento
}

}
else{
	var_dump('-7');
	return -7;
}

}

}

 function ConfirmarPagamento($referencia,$data){ //CONFIRMACAO DO PAGAMENTO
 	$con= new CRUD;
 	$sqlPago=$con->Update("referencia","estado=?, dataUpdate=? WHERE referencia=? AND estado =?",array(2,$data,$referencia,1));//ALTERA ESTADO DA REFERENCIA DO O PAGAMENTO DO REPRESENTATE

   if($sqlPago->rowCount()>0){  //CASO A REFERENCIA SEJA VALIDADA SELECIONA O ID DA REFERNCIA PARA PARA VERIFICAR OS ID DOS PAGAMEMTOS DESSAS REFERENCIAS
$sqlIdpago = $con->Select("id","referencia","WHERE referencia=? AND estado=?",array($referencia,2));
foreach($sqlIdpago as $sqlIdpagoLinha){
	
$sqlIdPagamento = $con->Select("id","pagamentos","WHERE referencia_id =?",array($sqlIdpagoLinha['id']));
foreach($sqlIdPagamento as $sqlIdPagamentoLinha){ //SELECIONAR PAGAMENTOS QUE TEM A REFERENCIA ACIMA CITADO PARA INTRODUZIR NA OPERACAO
$inserirIdPagamento = $con->Insert("operacao","tipo_operacao =?,pagamentos_id=?,data=?",array(2,$sqlIdPagamentoLinha['id'],$data)); //TIPO OPERACAO DE PAGEMNTO É 2 E DE DIVIDA É 1
}
return $inserirIdPagamento; //CASO TUDO DE CERTO ATE O PROCESSO DE INSERIRI NA OPERACAO 

}
   }
 
 	return -15; 	//CASSO ALGO NAO DE CERTO RETORNA AQUI. PARA UM ERRO
	}

 function RegeitarPagamento($referencia){
$con= new CRUD;
$sqlRefPag =$con->Update("pagamentos","referencia_id =? WHERE referencia_id =?",
	array(1,$referencia));

if($sqlRefPag->rowCount()>0){
$sqlRegeitar=$con->Delete("referencia","WHERE id =?",array($referencia));
return $sqlRegeitar->rowCount();
}
return -400;	
 }









}
?>