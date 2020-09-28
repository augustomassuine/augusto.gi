<?php
include_once('sessaoControl.php');
include 'ConDb.class.php';


class CRUD extends ConDb{
    
    //preparando os dados
    private $query;
    private function prepExec($prep,$exec){
        $this ->query = $this->getConn()->prepare($prep);
        $this->query->execute($exec);
    }
    
    // funcao para inserir dados
    public function Insert($tabela, $prep, $exec){
        $this->prepExec('INSERT INTO '.$tabela.' SET '.$prep.'', $exec);
        return $this->getConn()->lastinsertid();
        // return $this->query;
    }
      //funcao para select dados
    public function Select($fildes, $tabela, $prep, $exec){
        $this->prepExec('SELECT '.$fildes.' FROM '.$tabela.' '.$prep.'', $exec);
        return $this->query;
        
       }
       //  
         //funcao para update dados
       public function Update($tabela, $prep, $exec){
           $this->prepExec('UPDATE '.$tabela.' SET '.$prep.'', $exec);
           return $this->query;
       }
       //funcao para Delete dados
       public function Delete($tabela, $prep, $exec){
           $this->prepExec('DELETE FROM '.$tabela.' '.$prep.'', $exec);
           return $this->query;
       }

//FUNCOES ADICIONAIS
       //Selecionar pagamentos de represente em sessao

 public function SelectInnerJoinPagamentoRep($sessao,$exec){
        $this->prepExec('SELECT pagamentos.id as pId,pagamentos.data as pData,pagamentos.valorPago as pValor,agente.nomeAgente as aNome, agente.codigoAgente as aCodigo,referencia.estado as rEstado, referencia.referencia as rReferencia,referencia.valorTotal as rValor,referencia.formaPagamento as rForma,referencia.data as rData,referencia.dataUpdate as rDataUpdate,referencia.representante_id as rRepresentante
          FROM representante
          INNER JOIN divida
          ON representante.id = divida.representante_id AND representante.id  = '.$sessao.'
          INNER JOIN pagamentos
          ON pagamentos.divida_id = divida.id
          INNER JOIN referencia
          ON pagamentos.referencia_id = referencia.id
          INNER JOIN agente
          ON  agente.id = divida.agente_id 
          ORDER BY pagamentos.data DESC',$exec);
        return $this->query;
        
       }

       public function SelectInnerJoinPagamentoSup($sessao,$exec){
        $this->prepExec('SELECT pagamentos.referencia_id as pRef,usuario.nome as uNome
          FROM superagente
          INNER JOIN divida
          ON superagente.id = divida.superAgente_id AND superagente.id  = '.$sessao.'
          INNER JOIN pagamentos
          ON pagamentos.divida_id = divida.id 
          INNER JOIN referencia 
          ON referencia.id = pagamentos.referencia_id
          INNER JOIN representante
          ON  representante.id = divida.representante_id
          INNER JOIN usuario 
          ON usuario.id = representante.usuario_id
          ',$exec);
        return $this->query;
        
       }
/*APAGAR REPETICOES NAS DIVIDAS*/
public function apagarDividaRepetida($exec){
        $this->prepExec('SELECT max(id) id_max,min(id) id_min,`divida_id` 
          from operacao 
          GROUP by `divida_id` 
          HAVING COUNT(1)=2 or COUNT(1)=3',$exec);
          return $this->query;
        
       }


}
           
?>