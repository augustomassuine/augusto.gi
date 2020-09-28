<?php
class Solicitacao {
private $valor;
private $estado;
private $agente;
private $data;

function __construct($v,$e,$a,$data){
$this->setValor($v);
$this->setEstado($e);
$this->setAgente($a);
$this->setData($data);
}

function setValor($var){
$this->valor = $var;
}
function setEstado($var){
$this->estado = $var;
}
function setAgente($var){
$this->agente = $var;
}
function getValor(){
	return $this->valor;
}
function getEstado(){
	return $this->estado;
}
function getAgente(){
	return $this->agente;
}

function getData(){
		return $this->data;
	}
	function setData($data){
		$this->data = $data;
	}

}
?>