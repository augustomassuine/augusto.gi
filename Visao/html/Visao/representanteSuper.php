 <?php
  $activo=2;
  
include_once 'header.php';
include_once 'menuSuper.php';
                 // ==========================
                 //   CADASTAR REPRESENTANTE
                 //===========================
if(isset($_POST['cadastarRepresentante'])){
  $nome = $_POST['nome'];
  $userName = $_POST['usuario'];
  $morada = $_POST['morada'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];
  $nivelAcesso = 2;
  $estado = 1;
//INTRODUZIR DADOS DO REPRESENTANTE PARA CLASSE REPRESENTANTE MODEL
$repMod = new RepresentanteModel($nome,$userName,$morada,$senha,$telefone,$nivelAcesso,$estado);
$repContr = new RepresentacaoControl;
//ADICIONAR REPRESENTANTE
 $linha = $repContr->adicionar($repMod);
 if($linha == -100){ //VERICAR A EXISTENCIA DE REPRESENTANTE 
$msn = new Mensagem;
echo $msn->sucesso('<b>Erro<b> Este representante ja existe','representanteSuper.php');
 }
 elseif($linha>0){ //CASO REPRESENTANTE SEJA ADICIONADO 
$msn = new Mensagem;
echo $msn->sucesso('Novo Representante adicionado!','representanteSuper.php');
 }else{  //CASO REPRESENTANTE NAO SEJA ADICIONADO 
  $msn = new Mensagem;
echo $msn->sucesso('<b>Erro</b> ao adicionado Representante !','representanteSuper.php');
 }
}
                  // ==========================
                 //   EDITAR REPRESENTANTE
                 //===========================
elseif(isset($_POST['idEditarRepres'])){
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $userName = $_POST['usuario'];
  $morada = $_POST['morada'];
  $telefone = $_POST['telefone'];
  $senha = 12345;
  $nivelAcesso = 2;
  $estado = 1;
  // include_once('../Model/representante.php');
  // include_once('../Control/representanteControl.php');
$repMod = new RepresentanteModel($nome,$userName,$morada,$senha,$telefone,$nivelAcesso,$estado);
$repContr = new RepresentacaoControl;
$linha = $repContr->editar($repMod,$id);
if($linha>0){
$msn = new Mensagem;
echo $msn->sucesso('Representante editado com sucesso!','representanteSuper.php');
}else{
  $msn = new Mensagem;
echo $msn->sucesso('<b>Erro</b> ao Editar Representante!. Por favor altere pelomenos um dado do representante no formulario.','representanteSuper.php');
}
}
 // ==========================
                 //   APAGAR REPRESENTANTE
                 //===========================
elseif(isset($_POST['idApagarRepres'])){
 $id = $_POST['id'];
// include_once('../Control/representanteControl.php');
$repContr = new RepresentacaoControl;
$linha=$repContr->apagar($id);
if($linha>0){
$msn = new Mensagem;
echo $msn->sucesso('Removido com sucesso!','representanteSuper.php');
}else{
$msn = new Mensagem;
echo $msn->sucesso('<b>Erro <b> ao Removido Representante!','representanteSuper.php');
}
//header('Location:representante.php');
}
 // ==========================
                 //   REDIFINIR SENHA DO REPRESENTANTE
                 //===========================
elseif(isset($_POST['idRedefinirSenhaRepres'])){
   $id = $_POST['id'];
   $nome = $_POST['nome'];
  // include_once('../Control/representanteControl.php');
  $repContr= new RepresentacaoControl;
  $linha=$repContr->redefinirSenha($id);
if($linha>0){
$msn = new Mensagem;
echo $msn->sucesso('Redefiniu a senha do Representante <b>'.$nome.'</b> para <b> 12345</b>.!','representanteSuper.php');
}else{
$msn = new Mensagem;
echo $msn->sucesso('<b>Erro :</b> A senha ja foi redifinidida !','representanteSuper.php');
}

//  $msn = new Mensagem;
// echo $msn->sucesso('Redefiniu a senha do Representante <b>'.$nome.'</b> para <b> 12345</b>.','representante.php');

}

 ?>

   <section class="col-sm-9">
    <div class="tab-content" id="v-pills-tabContent">
     
    
 <div class="" id="" role="tabpanel" aria-labelledby="">
        <h5 class="sucesso "> </h5>
        <h4>Representante</h4>
        <ul class="nav nav-tabs tabsRepresentante" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Visualizar Representante</a>

  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="profile" aria-selected="false">Adicionar Representante</a>
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
      <th class="headTab" scope="col">Telefone</th>
      <th class="headTab" scope="col">Usuario</th>
      <th class="headTab" scope="col">Accao</th>
    </tr>
  </thead>
  <tbody>
  
 <?php
  $conUser = new CRUD;
   $conRep = new CRUD;

   $sqlRep = $conRep->Select("*","representante","WHERE superAgente_id=?",array($_SESSION['dados']));

   foreach($sqlRep as $linhaRpres){

   $sqlUser=$conUser->Select("*","usuario","WHERE id=? and nivelAcesso_id=? and estado=? ORDER BY nome",array($linhaRpres['usuario_id'],2,1));
   foreach($sqlUser as $linha){ ?>

    <tr>
      <td><?php echo $linha['nome'];?></td>
      <td><?php echo $linha['morada'];?></td>
       <td><?php echo $linha['telefone'];?></td>
      <td><?php echo $linha['nomeUsuario'];?></td>
      <td style="text-align: center;color: #fff;">
        <a class="btn btn-info" name="editarRepresentante" data-toggle="modal" data-target="#editarRepresentante" data-whateverid="<?php echo $linha['id'];?>"  data-whatevernome="<?php echo $linha['nome'];?>"  data-whatevermorada="<?php echo $linha['morada'];?>"  data-whatevertelefone="<?php echo $linha['telefone'];?>"  data-whateveruser="<?php echo $linha['nomeUsuario'];?>" href="Visao/representante.php?idEditarRepres=<?php echo $linha['id'];?>">Editar</a> &nbsp;&nbsp;&nbsp;
        <a class="btn btn-danger" style="color: #fff;" data-toggle="modal" data-target="#idApagarRepres" data-whateverid="<?php echo $linha['id'];?>"  data-whatevernome="<?php echo $linha['nome'];?>"  >Apagar</a>
        <a class="btn btn-success" data-toggle="modal" data-target="#idRedefinirSenhaRepres" data-whateverid="<?php echo $linha['id'];?>" data-whatevernome="<?php echo $linha['nome'];?>" >Redifinir Senha</a></td>
    </tr>

   <?php
 }  
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
    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp" placeholder="Seu nome completo" required minlength="3">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Morada</label>
    <input type="text" class="form-control" id="morada" name="morada" aria-describedby="emailHelp" placeholder="Cidade e Bairro" required minlength="3">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Nome do Usuario </label>
    <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp" placeholder="Seu nome do Usuario" required minlength="3">
  </div>
  <!--    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small> -->
  <div class="row">
  <div class="form-group col-sm-6">
    <label for="exampleInputPassword1">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite no minimo 8 caracateres" minlength="8" maxlength="50" required>
  </div>
  <div class="form-group col-sm-6">
    <label for="exampleInputEmail1">Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required length="9" pattern="(84|85|82|86|87|83)[0-9]{7}" title="Ex : 84/82/85/87/86 #######">
  </div>
  </div>
  <input type="submit" class="btn btn-primary" id="cadastarRepresentante" name="cadastarRepresentante" value="Enviar">
  
</form>
  </div>
  
</div>
      </div>      </div>
    </section>









<?php 
include_once 'footer.php';
?>

