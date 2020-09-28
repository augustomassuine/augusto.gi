<?php
class Agente{
private $nome;
private $morada;
private $telefone;
private $nomeAgente;
private $codigoAgente;
private $estado;

public function __construct($n,$m,$t,$na,$ca,$e){
$this->setNome($n);
$this->setMorada($m);
$this->setTelefone($t);
$this->setNomeAgente($na);
$this->setCodigoAgente($ca);
$this->setEstado($e);
}

function setNome($var){
$this->nome=$var;
}
function setMorada($var){
$this->morada=$var;
}
function setTelefone($var){
$this->telefone=$var;
}
function setNomeAgente($var){
$this->nomeAgente=$var;
}
function setCodigoAgente($var){
$this->codigoAgente=$var;
}
function setEstado($var){
$this->estado=$var;
}

function getNome(){
	return $this->nome;
}
function getMorada(){
	return $this->morada;
}
function getTelefone(){
	return $this->telefone;
}
function getNomeAgente(){
	return $this->nomeAgente;
}
function getCodigoAgente(){
	return $this->codigoAgente;
}
function getEstado(){
	return $this->estado;
}

}
?>