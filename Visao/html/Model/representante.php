<?php
include_once('../Control/sessaoControl.php');
class RepresentanteModel{
	private $nome;
	private $userName;
	private $morada;
	private $senha;
	private $telefone;
	private $nivelAcesso;
	private $estado;


	function __construct($n,$us,$m,$s,$t,$na,$es){
$this->setNome($n);
$this->setUserName($us);
$this->setMorada($m);
$this->setSenha($s);
$this->setTelefone($t);
$this->setNivelAcesso($na);
$this->setEstado($es);

	}


function setNome($var){
$this->nome=$var;
}
function setUserName($var){
$this->userName=$var;
}
function setMorada($var){
$this->morada=$var;
}
function setSenha($var){
$this->senha=$var;
}
function setTelefone($var){
$this->telefone=$var;
}
function setNivelAcesso($var){
$this->nivelAcesso=$var;
}
function setEstado($var){
$this->estado=$var;
}

function getNome(){
	return $this->nome;
}
function getUserName(){
	return $this->userName;
}
function getMorada(){
	return $this->morada;
}
function getSenha(){
	return $this->senha;
}
function getTelefone(){
	return $this->telefone;
}
function getNivelAcesso(){
	return $this->nivelAcesso;
}
function getEstado(){
	return $this->estado;
}



}
?>