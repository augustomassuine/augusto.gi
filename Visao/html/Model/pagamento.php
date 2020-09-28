<?php
class PagamentoModel {
	private $valor;
	//private $estado;
	private $idDivida;
	// private $formaPagamento;
    private $idReferencia;
    private $data;

	public function __construct($v,$id,$ir,$data){
		$this->setValor($v);
	//	$this->setEstado($e);
		$this->setId($id);
		// $this->setFormaPagamento($f);
		$this->setIdReferencia($ir);
		$this->setData($data);
	}

	function setValor($v){
		$this->valor=$v;
	}
	// function setEstado($e){
	// 	$this->estado = $e;
	// }
	function setId($id){
		$this->idDivida =$id;
	}

	// function setFormaPagamento($f){
	// 	$this->formaPagamento = $f;
	// }
	function setIdReferencia($r){
		$this->idReferencia = $r;
	}
	// function getFormaPagamento(){
	// 	return $this->formaPagamento;
	// }
	function getIdReferencia(){
		return $this->idReferencia;
	}
	function getValor(){
		return $this->valor;
	}

	// function getEstado(){
	// 	return $this->estado;
	// }
	function getData(){
		return $this->data;
	}
	function setData($data){
		$this->data = $data;
	}
	function getIdDivida(){
		return $this->idDivida;
	}



}
?>