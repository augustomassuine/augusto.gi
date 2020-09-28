<?php
include_once 'CRUD.class.php';
include_once('sessaoControl.php');
$con = new CRUD;
$json = array();

/*Selecionar divida */
$selDivida = $con->Select("id,valor_emprestimo,data,agente_id","divida","WHERE estado =? AND representante_id=? AND data >'2019-11-20 00:00:00' ORDER BY data desc",array(1,$_SESSION['dados']));
foreach($selDivida as $linhaDivida){
	$soma = 0;
	/*Selecionar referencia para ver se foi validada para o pagamento */
	$sqlReferencia = $con->Select("id","referencia","WHERE estado=? AND representante_id=?",array(2,$_SESSION['dados']));
	foreach($sqlReferencia as $sqlReferenciaLinha){

		/*Selecionar valor pago da divida que a referencia foi validada para reduzir a divida*/
		$sqlPag =$con->Select("valorPago","pagamentos","WHERE divida_id=? AND referencia_id=? ",array($linhaDivida['id'],$sqlReferenciaLinha['id']));
		foreach($sqlPag as $sqlPagLinha){ 
			$soma=$soma+$sqlPagLinha['valorPago'];
		}
	} 
/*Reduzir divida - valor pago */
   $divida = $linhaDivida['valor_emprestimo']-$soma;

 $sqlAgente = $con->Select("nomeAgente,codigoAgente","agente","WHERE id =?",array($linhaDivida['agente_id']));
            foreach($sqlAgente as $sqlAgenteLinha){
 $agente = $sqlAgenteLinha['nomeAgente'].' , '.$sqlAgenteLinha['codigoAgente']; 
            }

   if($divida!=0){
   $json [] = array(
       'id'=>$linhaDivida['id'],
       'data'=>$linhaDivida['data'],
       'agente'=>$agente,
       'divida'=>$divida
     );
   } 
}
$jsonstring = json_encode($json);
echo $jsonstring;
	?>