<?php
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);
	// include_once('Control/sessaoControl.php');
include_once('../Model/mensagemInfo.php');
include_once 'CRUD.class.php';


if(!empty($_FILES['arquivo']['tmp_name'])){
	$arquivo = new DomDocument();
	$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);

	$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);

	$primeira_linha = true;

	foreach($linhas as $linha){
		if($primeira_linha == false){
			$nrOperacao = $linha->getElementsByTagName("Data")->item(2)->nodeValue;


			$valor = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
			$exp = explode(",", $valor); 
			$exp1 = explode(".", $exp[0]); 
			$exp2 = substr($exp1[0],0,1);
			if($exp2=='+'){
				$exp2 = substr($exp1[0],1);
				$valorFinal =$exp2.''.$exp1[1];

				$con = new CRUD;
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
                 
					break;
				}

			}
			
		}
 if($confirmado->rowCount()>0){
 	$msn = new Mensagem();
    $msn->sucesso('<b>Pagamento Confirmados.','../Visao/pagamentoSuper.php');
 }
 else{
 	$msn = new Mensagem();
    $msn->sucesso('<b>Nenhum pagamento confirmado.','../Visao/pagamentoSuper.php');
 }

	}
	else{
$msn = new Mensagem();
    $msn->sucesso('<b>Erro ao inserir o aquivo.','../Visao/pagamentoSuper.php');
	}

}
?>