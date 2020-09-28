 <?php
include "../Control/CRUD.class.php";
include_once('../Control/sessaoControl.php');
$query = new CRUD;
$queryLog = new CRUD;
//session_start();

if(isset($_POST['entrar'])){
 $nomeUsuario= $_POST['nomeUsuario'];
 $senha = $_POST['senha'];

$linha = $query->Select("*","usuario","WHERE senha =? and nomeUsuario=? and estado=?",array( $senha,$nomeUsuario,1));


if($linha->rowCount()>0){
	foreach($linha as $var){
	if($var['nivelAcesso_id']==1){ //SUPER AGENTE

$querySup = $queryLog->Select("*","superagente","WHERE usuario_id=?",array($var['id']));
foreach($querySup as $selSupAgLinha){
$_SESSION['dados'] =$selSupAgLinha['id']; 	
}
$_SESSION['usuarioLogin'] = $var;
header("Location:../Visao/solicitacaoSuper.php");
}
else if($var['nivelAcesso_id']==2){//REPRESENTE

$queryRep = $queryLog->Select("*","representante","WHERE usuario_id=?",array($var['id']));
foreach($queryRep as $selRepLinha){
$_SESSION['dados'] =$selRepLinha['id']; 	
}
$_SESSION['usuarioLogin'] = $var;
header("Location:../Visao/solicitacaoRep.php");
// header("Location:../index.php");
}
}
}
else{  //ACESSO NEGADO
session_destroy();
$aleatoria = rand(1000,9999);
          $md5=md5($aleatoria);
header("Location:../index.php?massuineErro=$md5;");

}


}

?>