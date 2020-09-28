<?php
include_once 'CRUD.class.php';
include_once('sessaoControl.php');

class AgenteControl {

function adicionar(Agente $ag){

 	//VERIFICAR SE O REPRESENTANTE EXISTE
 	$reprExistente = false;
 	$sel = $this->selectAll();
 	foreach($sel as $selFound){
if($selFound['codigoAgente']==$ag->getCodigoAgente() and $selFound['estado']==1 or $selFound['nomeAgente']==$ag->getNomeAgente() and $selFound['estado']==1 and $selFound['telefone']==$ag->getTelefone()){
$reprExistente =true;
 	}
 	}
 	if($reprExistente ==true){ //CASO REPRESENTANTE EXISTA 
return -100;
 	}elseif($reprExistente ==false){ //CASO REPRESENTANTE NAO EXISTA  
$con= new CRUD;

$sql=$con->Insert("agente","nome=?, 
 nomeAgente=?,codigoAgente=?,telefone=?,morada=?,estado=?,representante_id=?",array($ag->getNome(),$ag->getNomeAgente(),$ag->getCodigoAgente(),$ag->getTelefone(),$ag->getMorada(),$ag->getEstado(),$_SESSION['dados']));
	return $sql;  //CONTAR LINHAS AFECTADAS NO BANCO DE DADO
 	}
}
 function editar(Agente $ag,$id){ //EDITAR REPRESENTANTE
 	$con= new CRUD;
 $sql = $con->Update("agente","nome=?,morada=?,telefone=?,nomeAgente=?,codigoAgente=?,estado=? WHERE id=?",array($ag->getNome(),$ag->getMorada(),$ag->getTelefone(),$ag->getNomeAgente(),$ag->getCodigoAgente(),$ag->getEstado(),$id));
 return $sql->rowCount();//CONTAR LINHAS AFECTADAS NO BANCO DE DADO
 }

 function apagar($id){
$con = new CRUD;
$conDivia = new CRUD;
$estado = 0;
$dividaAg=false;

$sqlDiv = $conDivia->Select("valor_emprestimo","divida","WHERE agente_id=?",array($id));
foreach($sqlDiv as $sqlDivLinha){
	if($sqlDivLinha['valor_emprestimo']!=0){
	$dividaAg = true;
	}
}
if($dividaAg == true){
return -200;  //ESTE AGENTE ESTA A DEVER O SUPER AGENTE NAO PODE DEVER UMA VEZ QUE NAO PAGOU A DIVIDA ANTERIOR
}else{
 $sql = $con->Update("agente","estado=? WHERE id=?",array($estado,$id));
return $sql->rowCount();
}
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