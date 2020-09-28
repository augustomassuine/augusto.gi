<?php
include_once 'CRUD.class.php';
include_once('sessaoControl.php');
class SolicitacaoControl {


function adicionar(Solicitacao $s){
$con= new CRUD;
$conSup = new CRUD;
$conDiv = new CRUD;
$dividaAg = false;

$sqlSup = $conSup->Select("superAgente_id","representante","Where id =?",array($_SESSION['dados']));
foreach ($sqlSup as $sqlSupLinha);
$sql=$con->Insert("divida","superAgente_id=?, 
 representante_id=?,agente_id=?,valor_emprestimo =?, 
 estado =?,data=?",array($sqlSupLinha['superAgente_id'],$_SESSION['dados'],$s->getAgente(),$s->getValor(),$s->getEstado(),$s->getData()));
	return $sql;  //CONTAR LINHAS AFECTADAS NO BANCO DE DADO
//}

}

 function editarEstadoSolicitacao($id,$data){ //EDITAR REPRESENTANTE
 	$con= new CRUD;
 	$sqlSol =$con->Update("divida","estado =?,dataUpdate =? WHERE id=?",array(1,$data,$id));
 	if($sqlSol->rowCount()>0){
	$inserirOperacao =$con->Insert("operacao","tipo_operacao=?,divida_id=?,data=?",array(1,$id,$data));////TIPO OPERACAO DE PAGEMNTO É 2 E DE DIVIDA É 1
	return 1; //CASO DE TUDO CERTO QUANTO A INSERCCAO
 	}
 	
    return -7; //CASO NAO DE CERTO QUANTO A INSERCCAO 
 }
  function editarValorSolicitacao($id,$valor){ //EDITAR REPRESENTANTE
 	$con= new CRUD;
 	$sqlSol =$con->Update("divida","valor_emprestimo =? WHERE id=? and estado=?",array($valor,$id,0));
    return $sqlSol->rowCount(); 
 }

function select ($id){
$con = new CRUD;
 	$sql = $con->Select("*","agente","WHERE id=?",array($id));
}
 function selectAll(){
 	$con = new CRUD;
 	$sql = $con->Select("*","agente","",array());
 	return $sql;
 }

}

?>