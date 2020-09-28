<?php
  $activo=1;
include_once 'header.php';
include_once 'menuSuper.php';

if(isset($_POST['aceitarSolicitacao'])){ // ACEITAR A SOLICITACAO
$id = $_POST['id'];
$solContr = new solicitacaoControl();
$linha = $solContr->editarEstadoSolicitacao($id,$data);
if($linha>0){
$msn = new Mensagem();
$msn->sucesso('Solicitacao Confirmada','solicitacaoSuper.php');
}else{
  $msn = new Mensagem();
$msn->sucesso('<b>Erro<b> ao Confirmar solicitacao!','solicitacaoSuper.php');
}
}
elseif (isset($_POST['editarSolicitacao'])) {
$id = $_POST['id'];
$valor = $_POST['valorActual'];
$solContr = new solicitacaoControl();
$linha = $solContr->editarValorSolicitacao($id,$valor);
if($linha>0){
$msn = new Mensagem();
$msn->sucesso('Valor editado com Sucesso. ','solicitacaoSuper.php');
}else{
  $msn = new Mensagem();
$msn->sucesso('<b>Erro<b> ao editar o valor!','solicitacaoSuper.php');
}
}
elseif(isset($_POST['idSolicitacaoApagar'])){
$id = $_POST['id'];
$estado = 0;
$con =new CRUD;
$sqlApagar = $con->Delete("divida","WHERE id=? AND estado=?",array($id,$estado));
}
 ?>
   <section class="col-sm-9">
     
    <div class="tab-content" id="v-pills-tabContent">
     <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
      <h4>Solicitação</h4>
      <div class="table-responsive-sm table-responsive-md   ">
      <table class="table myTable table-bordered table-striped table-hover tableDivida">
  <thead>
    
    <tr>
      <th class="headTab" scope="col">Valor</th>
      <th class="headTab" scope="col">Agente</th>
      <th class="headTab" scope="col">Representante</th>
      <th class="headTab" scope="col">Data</th>
      <th class="headTab" scope="col"></th>
       

    </tr>

  </thead>
  <tbody>
    <?php 
    $con = new CRUD;
  
    $selSol = $con->Select("*","divida","WHERE estado =? AND superAgente_id=? ORDER BY data DESC",array(0,$_SESSION['dados']));
     foreach($selSol as $selSolLinha){

  $sqlRep = $con->Select("usuario_id","representante","WHERE id=?",array($selSolLinha['representante_id']));
foreach($sqlRep as $sqlRepLinha){
 $sqlUser = $con->Select("nome","usuario","WHERE id=?",array($sqlRepLinha['usuario_id']));
foreach($sqlUser as $sqlUserLinha){

 $sqlAg = $con->Select("nomeAgente,codigoAgente","agente","WHERE id=?",array($selSolLinha['agente_id']));
foreach($sqlAg as $sqlAgLinha){ ?> 
     <tr>
      <td><?php echo $selSolLinha['valor_emprestimo'].' MT'; 
      
      ?></td>
      <td> <?php echo $sqlAgLinha['nomeAgente'].' , '.$sqlAgLinha['codigoAgente'];?></td>
      <td><?php echo $sqlUserLinha['nome'];?></td>
       <td><?php echo $selSolLinha['data'];?></td>
      <td><a class="btn btn-success" style="padding: 0px 4px;margin-bottom: 1px; font-size: 9pt;" href="" data-toggle="modal" data-target="#aceitarSolicitacao" data-whateverid="<?php echo $selSolLinha['id'];?>">Aceito</a>&nbsp;&nbsp;
      <a class="btn btn-info" style="padding: 0px 4px;margin-bottom: 1px; font-size: 9pt;" href="" data-toggle="modal" data-target="#editarSolicitacao" data-whateverid="<?php echo $selSolLinha['id'];?>">Editar</a>&nbsp;&nbsp;
<a style="color: #fff;padding: 0px 4px;margin-bottom: 1px; font-size: 9pt;" class="btn btn-danger"  data-toggle="modal" data-target="#idSolicitacaoApagar" data-whateverid="<?php echo $selSolLinha['id'];?>">Apagar</a>
    </td>
    </tr>
     <?php
}
}
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

