<?php
$activo=1;
include_once 'header.php';
include_once 'menuRep.php';


if(isset($_POST['idsolicitacao'])){
  $valor = $_POST['valor'];
  $agente = $_POST['agente'];
  $estado =0;
  $sol = new Solicitacao($valor,$estado,$agente,$data);
  $solControl = new SolicitacaoControl();
  $linha = $solControl->adicionar($sol);
  if($linha==-200){
   $msn = new Mensagem;
   echo $msn->sucesso('O agente selecionado esta em dívida ou tem uma solicitacão pendente.Com isso não poder solicitar neste momento. ','solicitacaoRep.php');
 }
 elseif($linha>0){
  $msn = new Mensagem;
  echo $msn->sucesso('Sucesso na Solicitacao !','solicitacaoRep.php');
}
else{
  $msn = new Mensagem;
  echo $msn->sucesso('<b>Erro</b> na Solicitacao !','solicitacaoRep.php');
}
}
// elseif(isset($_POST['idSolicitacaoApagar'])){
// $id = $_POST['id'];
// $estado = 0;
// $con =new CRUD;
// $sqlApagar = $con->Delete("divida","WHERE id=? AND estado=?",array($id,$estado));
// }
?>
<section class="col-sm-9 solicitaRep">
  
  <div class="tab-content" id="v-pills-tabContent">
   <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
    <h4>Solicitação</h4>
    <div  class="solicitarRepr">
      <form  class="addRepresentanteForm" action="" method="POST">
        <div class="row">
          <div class="form-group col-sm-4">
            <label for="valor">Valor</label>
            <input type="number" class="form-control" id="valor" min='500' name="valor" value="500" required>
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Agente a solicitar</label>
            <?php
            $conAg =new CRUD;
            $selAgente =$conAg->Select("nome,id","agente","WHERE representante_id=? AND estado=?",array($_SESSION['dados'],1)); 
            ?>
            <select id="agente" name="agente" class="form-control" required>
              <option value="">Selecione --</option>
              <?php
              foreach($selAgente as $linhaAgente){?>
               <option value="<?php echo $linhaAgente['id'];?>"><?php echo $linhaAgente['nome'];?></option>
             <?php }
             ?>
           </select>
         </div>
       </div>
       <input style="" type="submit" class="btn btn-primary" id="cadastarRepresentante" name="idsolicitacao" value="Solicitar">
     </form>
   </div>


   <div class="table-responsive-sm table-responsive-md solicitacaoTbleRep"> 
    <table class="table  myTable3 table-bordered  table-hover tableRepresentante " style="font-size: 10pt;" >
      <thead>
        <tr>
          <th class="headTab" scope="col">Valor</th>
          <th class="headTab" scope="col">Agente</th>
          <th class="headTab" scope="col">Estado</th>
          <th class="headTab" scope="col">Data</th>
         <!--  <th class="headTab" scope="col"></th> -->
        </tr>
      </thead>
      <tbody style="text-align: center;">
        <?php
        $connSol = new CRUD;
        $connAg = new CRUD;
$selSol =  $connSol->Select("*","divida","WHERE estado = ? AND representante_id=? ORDER BY data DESC",array(0,$_SESSION['dados']));//SELECIONAR DIVIDAS


foreach($selSol as $selSolLinha){
  $seleAg = $connAg->Select("nomeAgente ","agente","WHERE id=?",array($selSolLinha['agente_id']));
  foreach($seleAg as $seleAgLinha){
    ?>
    <tr>
      <td><?php echo $selSolLinha['valor_emprestimo'].' MT';?></td>
      <td><?php echo $seleAgLinha['nomeAgente'];?></td>
      <td><?php if($selSolLinha['estado']==0){ echo "N/Conf";}?></td>
      <td><?php echo $selSolLinha['data'];?></td>

      <!-- <td style="text-align: center;padding: none;margin: none;color: #fff;">
        <a style="padding: 0px 4px;margin-bottom: 1px; font-size: 9pt;" class="btn btn-danger"  data-toggle="modal" data-target="#idSolicitacaoApagar" data-whateverid="<?php echo $selSolLinha['id'];?>">Apagar</a> </td>
     </tr> -->
     <?php
   }
 } 
 ?>





</tbody>
</table>
</div>




</div>
</div>
</section>
<?php 
include_once 'footer.php';
?>

