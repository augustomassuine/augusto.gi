 <?php
 $activo=3;
 
 include_once 'header.php';
 include_once 'menuRep.php';
                 // ==========================
                 //   CADASTAR AGENTE MPSA
                 //===========================
 if(isset($_POST['cadastarAgente'])){
  $nome = $_POST['nome'];
  $morada=$_POST['morada'];
  $telefone =$_POST['telefone'];
  $nomeAgente =$_POST['nomeAgente'];
  $codigoAgente =$_POST['codigoAgente'];
  $estado = 1;

  $agente = new Agente($nome,$morada,$telefone,$nomeAgente,$codigoAgente,$estado);
  $agenteControl = new AgenteControl();
  $linha = $agenteControl->adicionar($agente);
  if($linha ==-100){
    $msn = new Mensagem();
    $msn->sucesso('<b>Erro<b> Este Agente ja existe !','agenteRep.php');
  }
 elseif($linha>0){ //CASO REPRESENTANTE SEJA ADICIONADO 
  $msn = new Mensagem;
  echo $msn->sucesso('Novo Agente adicionado!','agenteRep.php');
 }else{  //CASO REPRESENTANTE NAO SEJA ADICIONADO 
  $msn = new Mensagem;
  echo $msn->sucesso('<b>Erro</b> ao adicionado Agente !','agenteRep.php');
}
}

                  // ==========================
                 //   EDITAR AGENTE
                 //===========================
elseif(isset($_POST['idEditarAgente'])){
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $nomeAgente = $_POST['nomeAgente'];
  $codigoAgente = $_POST['codigoAgente'];
  $morada = $_POST['morada'];
  $telefone = $_POST['telefone'];
  $estado = 1;
  // include_once('../Model/representante.php');
  // include_once('../Control/representanteControl.php');
  $agente = new Agente($nome,$morada,$telefone,$nomeAgente,$codigoAgente,$estado);
  $AgContr = new AgenteControl;
  $linha = $AgContr->editar($agente,$id);
  if($linha>0){
    $msn = new Mensagem;
    echo $msn->sucesso('Agente editado com sucesso!','agenteRep.php');
  }else{
    $msn = new Mensagem;
    echo $msn->sucesso('<b>Erro</b> ao Editar Agente!. Por favor altere pelomenos um dado do Agente no formulario.','agenteRep.php');
  }
}
 // ==========================
                 //   APAGAR AGENTE
                 //===========================
elseif(isset($_POST['idApagarAgente'])){
 $id = $_POST['id'];
// include_once('../Control/representanteControl.php');
 $AgContr = new AgenteControl;
 $linha=$AgContr->apagar($id);
 if($linha==-200){
   $msn = new Mensagem;
   echo $msn->sucesso('O Agente nao pode ser apagado , uma vez que ainda nao pagou a divida anterior ','agenteRep.php');
 }
 elseif($linha>0){
  $msn = new Mensagem;
  echo $msn->sucesso('Removido com sucesso!','agenteRep.php');
}else{
  $msn = new Mensagem;
  echo $msn->sucesso('<b>Erro <b> ao Remover Agente!','agenteRep.php');
}

}
// Editar
?>

<section class="col-sm-9">
  <div class="tab-content" id="v-pills-tabContent">
   
    
   <div class="" id="" role="tabpanel" aria-labelledby="">
    <h5 class="sucesso "> </h5>
    <h4>Agente Mpsa</h4>
    <ul class="nav nav-tabs tabsRepresentante" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Visualizar Agente Mpsa</a>

      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="profile" aria-selected="false">Adicionar Agente Mpsa</a>
      </li>
    </ul>



    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active mostrarRep" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="table-responsive-sm table-responsive-md   "> 
          <table class="table myTable table-bordered table-striped table-hover tableRepresentante " style="font-size: 10pt;" >
            <thead>
              <tr>
                <th class="headTab" scope="col">Nome</th>
                <th class="headTab" scope="col">Morada</th>
                <th class="headTab" scope="col">Agente Mpsa</th>
                <th class="headTab" scope="col">Telefone</th>
                <th class="headTab" scope="col">Accao</th>
              </tr>
            </thead>
            <tbody>
              
             <?php
             $conAg = new CRUD;
             $sqlAg = $conAg->Select("*","agente","WHERE representante_id=? and  
               estado=? ORDER BY nome ",array($_SESSION['dados'],1));
             

               foreach($sqlAg as $linha){ ?>

                <tr>
                  <td><?php echo $linha['nome'];?></td>
                  <td><?php echo $linha['morada'];?></td>
                  <td><?php echo $linha['nomeAgente'].' , '.$linha['codigoAgente'];?></td>
                  <td><?php echo $linha['telefone'];?></td>
                  <td style="text-align: center;">
                   <a class="btn btn-info" name="" data-toggle="modal" data-target="#idEditarAgente" data-whateverid="<?php echo $linha['id'];?>"  data-whatevernome="<?php echo $linha['nome'];?>"  data-whatevermorada="<?php echo $linha['morada'];?>"  data-whatevertelefone="<?php echo $linha['telefone'];?>"  data-whatevernomeagente="<?php echo $linha['nomeAgente'];?>" data-whatevercodigoagente="<?php echo $linha['codigoAgente'];?>" href="">Editar</a>  &nbsp;&nbsp;&nbsp;

                   <a class="btn btn-danger" style="color: #fff;" data-toggle="modal" data-target="#idApagarAgente" data-whateverid="<?php echo $linha['id'];?>"  data-whatevernome="<?php echo $linha['nomeAgente'];?>"  >Apagar</a>
                 </tr>

                 <?php
               }  
               
               ?>
               
             </tbody>
           </table>
         </div>
       </div>


       <div class="tab-pane fade " id="perfil" role="tabpanel" aria-labelledby="profile-tab">
        

        <form class="addRepresentanteForm" action="" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp" placeholder="Seu nome completo"  pattern="[^\d]*" title="O nome não pode conter número" required minlength="3">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Morada</label>
            <input type="text" class="form-control" id="morada" name="morada" aria-describedby="emailHelp" placeholder="Cidade e Bairro" required minlength="3" >
          </div>
          <div class="form-group">
            <label for="nomeAgente">Nome do Agente </label>
            <input type="text" class="form-control" id="nomeAgente" name="nomeAgente" aria-describedby="emailHelp" placeholder="Seu nome do Agente" required minlength="3">
          </div>
          <!--    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small> -->
          <div class="row">
            <div class="form-group col-sm-6">
              <label for="codigoAgente">COdigo do Agente</label>
              <input type="text" class="form-control" id="codigoAgente" name="codigoAgente" placeholder="codigoAgente " required length="5" pattern="[0-9]{5}" title="##### ">
            </div>
            <div class="form-group col-sm-6">
              <label for="exampleInputEmail1">Telefone</label>
              <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required length="9" pattern="(84|85|82|86|87|83)[0-9]{7}" title="Ex : 84/82/85/87/86 #######">
            </div>
          </div>
          <input type="submit" class="btn btn-primary" id="cadastarAgente" name="cadastarAgente" value="Cadastar">
          
        </form>
      </div>
      
    </div>
  </div>      </div>
</section>









<?php 
include_once 'footer.php';
?>

