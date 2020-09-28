<?php
 $activo=3;
 include_once 'header.php';
 include_once 'menuSuper.php';
 if(isset($_POST['pagamento'])){
  $valor = $_POST['valor'];
  $idDivida = $_POST['idDivida'];
  $referencia_id =1;
  $pag = new PagamentoModel($valor,$idDivida,$referencia_id,$data);
  $pagControl = new PagamentoControl();
  $linha = $pagControl->pagar($pag);
  if($linha==-300){
    $msn = new Mensagem;
    echo $msn->sucesso('O valor pago nao pode ser Superior que a divida !','dividaRep.php');
  }
  elseif($linha>0){
    $msn = new Mensagem;
    echo $msn->sucesso('Já podes finalizar o pagamento  .','dividaRep.php');
  }
  else{
    $msn = new Mensagem;
    echo $msn->sucesso('<b>Erro</b> ao efectuar o pagamento !','dividaRep.php');
  }
}
?>
<section class="col-sm-9">
  <div class="tab-content" id="v-pills-tabContent">
   <div class="" id="" role="tabpanel" aria-labelledby="">
    <h5 class="sucesso "> </h5>
    <h4>Dívidas</h4>
    <div class="table-responsive-sm table-responsive-md   ">
      <table class="table myTable table-bordered table-striped table-hover tableDivida">
        <thead>
          <tr>
            <th class="headTab" scope="col">Data</th>
            <th class="headTab" scope="col">Valor</th>
            <th class="headTab" scope="col">Reprsentante</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $dividaTotal =0;
          $con = new CRUD;
          $selDivida = $con->Select("id,representante_id,valor_emprestimo,data","divida","WHERE estado =? AND superAgente_id=? ORDER BY data DESC",array(1,$_SESSION['dados']));
          foreach($selDivida as $linhaDivida){ 
           $soma = 0;     
   
    $sqlReferencia = $con->Select("id","referencia","WHERE estado=? AND representante_id=?",array(2,$linhaDivida['representante_id']));
          foreach($sqlReferencia as $sqlReferenciaLinha){
           
   $sqlPag =$con->Select("valorPago","pagamentos","WHERE divida_id=? AND referencia_id=? ",array($linhaDivida['id'],$sqlReferenciaLinha['id']));
   foreach($sqlPag as $sqlPagLinha){ 
         $soma+=$sqlPagLinha['valorPago'];
   }
 } 
$divida = $linhaDivida['valor_emprestimo']-$soma;
if($divida !=0){
 ?>
  <tr>
        <td><?php echo $linhaDivida['data']; ?></td>
            <td><?php echo $divida.' MT'; ?></td>
           <td>
            <?php
            $sqlRep = $con->Select("usuario_id","representante","WHERE id =?",array($linhaDivida['representante_id']));
            foreach($sqlRep as $sqlRepLinha){
            $sqlUser = $con->Select("nome","usuario","WHERE id =?",array($sqlRepLinha['usuario_id']));
            foreach($sqlUser as $sqlUserLinha){
            echo $sqlUserLinha['nome']; 
            }
            }
             ?>
               
             </td> 
         
          </tr> 
          
        <?php
 $dividaTotal = $dividaTotal + $divida ;
        }
        }
        ?>
      </tbody>
    </table>
    <div class="alert alert-secondary" style="padding: 2px;margin: 3px auto;text-align: center;color: rgba(92,145,155,1);" role="alert">
    Total por receber com os Reresentantes é <span style=""> <?php echo  '  '.$dividaTotal.' MT'; ?> </span>.
  </div>
  </div>
</div>     
</div>
</section>
<?php 
include_once 'footer.php';
?>


