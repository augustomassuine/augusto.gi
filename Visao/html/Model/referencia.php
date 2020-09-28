<?php
class referenciaModel {
	private $valorDepositado;
	private $idRepresentante;
	private $estadoReferencia;
	private $formaPagamento;
	private $referencia;
	private $data;


	public function __construct($v,$ir,$e,$f,$r,$data){
		$this->setValor($v);
		$this->setIdRepresentante($ir);
		$this->setEstadoReferencia($e);
		$this->setRefencia($r);
		$this->setFormaPagamento($f);
		$this->setData($data);

	}
	function setValor($var){
		$this->valorDepositado =$var;
	}


	function setIdRepresentante($var){
		$this->idRepresentante =$var;
	}
	function setEstadoReferencia($var){
		$this->estadoReferencia =$var;
	}
	function setFormaPagamento($var){
		$this->formaPagamento =$var;
	}
	function setRefencia($var){
		$this->referencia =$var;
	}

	function getValor(){
		return $this->valorDepositado;
	}
	function getReferencia(){
		return $this->referencia;
	}

	function getFormaPagamento(){
		return $this->formaPagamento;
	}

	function getEstadoReferencia(){
		return $this->estadoReferencia;
	}

	function getIdRepresentante(){
		return $this->idRepresentante;
	}

	function getData(){
		return $this->data;
	}
	function setData($data){
		$this->data = $data;
	}



}
?>