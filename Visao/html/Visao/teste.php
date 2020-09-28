<?PHP


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
	var_dump('referencia existe');
return -200;
}
else{
	var_dump('referencia nao existe');
$sqlPagou = $con->Insert("referencia","valorTotal =?, referencia=?, formaPagamento=?,estado=?,representante_id=?",array($ref->getValor(),$ref->getReferencia(),$ref->getFormaPagamento(),$ref->getEstadoReferencia(),$ref->getIdRepresentante()));

if($sqlPagou>0){
var_dump('Inseriu referencia');
$sqlDividaApagar = $con->Select("id","divida","WHERE representante_id=? AND estado=?",array($_SESSION['dados'],1));
foreach($sqlDividaApagar as $sqlDividaApagarLinha){
 var_dump('DIVIDAS : '.$sqlDividaApagarLinha['id']);
$sqlUpdatePagamento =$con->Update("pagamentos","referencia_id =? WHERE referencia_id = ? AND divida_id=? ",array($sqlPagou,1,$sqlDividaApagarLinha['id']));
}
var_dump('PAGAMENTO : '.$sqlUpdatePagamento->rowCount());
return $sqlUpdatePagamento->rowCount();
}
else{
	var_dump('-7');
	return -7;
}

}

}
?>