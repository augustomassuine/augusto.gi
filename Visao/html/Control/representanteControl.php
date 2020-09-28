<?php
include_once 'CRUD.class.php';
include_once('sessaoControl.php');

class RepresentacaoControl{


 function adicionar(RepresentanteModel $r){ //ADICIONAR REPRESENTANTE  
 	
 	//VERIFICAR SE O REPRESENTANTE EXISTE
 	$reprExistente = false;
 	$sel = $this->selectAll();
 	foreach($sel as $selFound){
if($selFound['nome']==$r->getNome() and $selFound['estado']==1 or $selFound['telefone']==$r->getTelefone() and $selFound['estado']==1){
$reprExistente =true;
 	}
 	}
 	if($reprExistente ==true){ //CASO REPRESENTANTE EXISTA 
return -100;
 	}elseif($reprExistente ==false){ //CASO REPRESENTANTE NAO EXISTA  
$con= new CRUD;

//var_dump($_SESSION['dados']['id']);

$sql1=$con->Insert("usuario","nome=?, 
 nomeUsuario=?,senha=?,telefone=?,nivelAcesso_id=?,morada=?,estado=?",array($r->getNome(),$r->getUserName(),$r->getSenha(),$r->getTelefone(),$r->getNivelAcesso(),$r->getMorada(),$r->getEstado()));
$sql=$con->Insert("representante","usuario_id=?,superAgente_id=?",array($sql1,$_SESSION['dados']));
	return $sql;  //CONTAR LINHAS AFECTADAS NO BANCO DE DADO
 	}

 }
 function editar(RepresentanteModel $r,$id){ //EDITAR REPRESENTANTE
 	$con= new CRUD;
 $sql = $con->Update("usuario","nome=?,morada=?,telefone=?,nomeUsuario=?,nivelAcesso_id=?,estado=? WHERE id=?",array($r->getNome(),$r->getMorada(),$r->getTelefone(),$r->getUserName(),$r->getNivelAcesso(),$r->getEstado(),$id));
 return $sql->rowCount();//CONTAR LINHAS AFECTADAS NO BANCO DE DADO
 }
 function apagar($id){
$con = new CRUD;
$estado = 0;
 $sql = $con->Update("usuario","estado=? WHERE id=?",array($estado,$id));
return $sql->rowCount();
 }
 function redefinirSenha($id){
 	$con= new CRUD;
 	$senhaRedefinida = 12345;
 $sql = $con->Update("usuario","senha=? WHERE id=?",array($senhaRedefinida,$id));
 return $sql->rowCount();
 }
function select ($id){
$con = new CRUD;
 	$sql = $con->Select("*","usuario","WHERE id=?",array($id));
}
 function selectAll(){
 	$con = new CRUD;
 	$sql = $con->Select("*","usuario","",array());
 	return $sql;
 }
}

?>