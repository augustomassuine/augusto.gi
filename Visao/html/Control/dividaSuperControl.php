<?php
include_once 'CRUD.class.php';
include_once('sessaoControl.php');
$con = new CRUD;
$json = array();
$somaDivida = 0;
$somaPagamento = 0;
$soma = 0;
$pa =0;


$sqlRep = $con->Select("id,usuario_id","representante","WHERE superAgente_id=?",array($_SESSION['dados']));

foreach($sqlRep as  $sqlRepLinha){
	$somaDivida = 0;
	$somaPagamento = 0;

// var_dump('===='.$sqlRepLinha['usuario_id'].'====');

	$agente = $con->Select("id,nomeAgente,codigoAgente","agente","WHERE representante_id=?",array($sqlRepLinha['id']));
	foreach ($agente as $v) {


		$selDivida = $con->Select("id,valor_emprestimo,data,agente_id","divida","WHERE estado =? AND representante_id=? AND agente_id=? AND data >'2019-11-20 00:00:00' ORDER BY data desc",array(1,$sqlRepLinha['id'],$v['id']));
		foreach($selDivida as $linhaDivida){
			

			$somaDivida +=$linhaDivida['valor_emprestimo']; 
 // var_dump('dIV : '.$somaDivida);
			/*Selecionar referencia para ver se foi validada para o pagamento */
			$sqlReferencia = $con->Select("id","referencia","WHERE estado=? AND representante_id=?",array(2,$sqlRepLinha['id']));
			foreach($sqlReferencia as $sqlReferenciaLinha){
				/*Selecionar valor pago da divida que a referencia foi validada para reduzir a divida*/
				$sqlPag =$con->Select("valorPago","pagamentos","WHERE divida_id=? AND referencia_id=? ",array($linhaDivida['id'],$sqlReferenciaLinha['id']));
				foreach($sqlPag as $sqlPagLinha){ 
					$somaPagamento +=$sqlPagLinha['valorPago'];
				// var_dump('PAGO : '.$somaPagamento);
				}
			} 


		}


	} 




//  var_dump($v['nomeAgente'].'=='.$somaDivida.'    Pago =='.$somaPagamento);
	$soma=$somaDivida;
	$pa = $somaPagamento;
// var_dump('tOTALpAGAMENTO : '.$pa);
// var_dump('tOTALpDIVIDA : '.$soma);
	$a =$soma - $pa;
	if($a!=0){

		$sqlUser = $con->Select("nome","usuario","WHERE id =?",array($sqlRepLinha['usuario_id']));
		foreach($sqlUser as $sqlUserLinha){
			
			

			$json [] = array(
			// 'id'=>$linhaDivida['id'],
				'data'=>$linhaDivida['data'],
				'representante'=>$sqlUserLinha['nome'],
				'divida'=>$a
			);
		}
	}

 // var_dump($somaDivida-$somaPagamento);

}
$jsonstring = json_encode($json);
echo $jsonstring;
// ?>