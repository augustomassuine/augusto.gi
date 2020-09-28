			<!--===================
           REPRESENTANTE 
           -==============================-->
           <!-- EDITAR REPRESENTANTE -->
           <div class="modal fade" id="editarRepresentante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert alert-secondary">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form class="addRepresentanteForm" action="representanteSuper.php" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp" placeholder="Seu nome completo" required minlength="3">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Morada</label>
                    <input type="text" class="form-control" id="morada" name="morada" aria-describedby="emailHelp" placeholder="Provincia , Cidade ,Bairro outros detalhes" required minlength="3">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome do Usuario </label>
                    <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp" placeholder="Seu nome do Usuario" required minlength="3">
                  </div>
                  <!--    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small> -->
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Telefone</label>
                      <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required length="9" pattern="(84|85|82|86|87|83)[0-9]{7}" title="Ex : 84/82/85/87/86 #######">
                    </div>
                    <div class="form-group col-sm-6">

                      <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary" name="idEditarRepres">Editar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <script type="text/javascript">
         $('#editarRepresentante').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) 
          var id = button.data('whateverid') 
          var nome = button.data('whatevernome') 
          var morada = button.data('whatevermorada') 
          var telefone = button.data('whatevertelefone') 
          var usuario = button.data('whateveruser') 
          
          var modal = $(this)
          modal.find('.modal-title').text('Editar Representante ')
          modal.find('.modal-body input#id').val(id)
          modal.find('.modal-body input#nome').val(nome)
          modal.find('.modal-body input#morada').val(morada)
          modal.find('.modal-body input#telefone').val(telefone)
          modal.find('.modal-body input#usuario').val(usuario)

        })
      </script>

<!-- ===================
APAGAR REPRESENTANTE
==================== -->
<div class="modal fade" id="idApagarRepres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px; ">
       <form class="addRepresentanteForm" action="representanteSuper.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
        <button type="submit" class="btn btn-danger" name="idApagarRepres">Sim</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#idApagarRepres').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('whateverid') 
    var nome = button.data('whatevernome') 


    var modal = $(this)
    modal.find('.inf').text('Tem a certeza que pretende apagar o Representante '+ nome +' ?')
    modal.find('.modal-body input#id').val(id)

  })
</script>
<!-- REDEFINIR SENHA DO REPRESENTANTE -->
<div class="modal fade" id="idRedefinirSenhaRepres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px;">
       <form class="addRepresentanteForm" action="representanteSuper.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="nome" name="nome" placeholder="Senha">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
        <button type="submit" class="btn btn-danger" name="idRedefinirSenhaRepres">Sim</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#idRedefinirSenhaRepres').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('whateverid') 
    var nome = button.data('whatevernome') 


    var modal = $(this)
    modal.find('.inf').text('Tem a certeza que pretende redifinir senha do Representante '+ nome +' ?')
    modal.find('.modal-body input#id').val(id)
    modal.find('.modal-body input#nome').val(nome)

  })
</script>

<!-- ==============================================================
 -->          <!--===================
           AGENTE MPESA 
           -==============================-->

           <!-- EDITAR AGENTE -->
           <div class="modal fade" id="idEditarAgente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert alert-secondary">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form class="addRepresentanteForm" action="agenteRep.php" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp" placeholder="Seu nome completo" pattern="[^\d]*" title="O nome não pode conter número" required minlength="3">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Morada</label>
                    <input type="text" class="form-control" id="morada" name="morada" aria-describedby="emailHelp" placeholder="Provincia , Cidade ,Bairro outros detalhes" required minlength="3">
                  </div>
                  <div class="form-group">
                    <label for="nomeAgente">Nome do Agente</label>
                    <input type="text" class="form-control" id="nomeAgente" name="nomeAgente" aria-describedby="emailHelp" placeholder="Seu nome do Usuario" required minlength="3">
                  </div>
                  <!--    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small> -->
                  <div class="row">
                   <div class="form-group col-sm-6">
                    <label for="codigoAgente">Codigo do Agente</label>
                    <input type="text" class="form-control" id="codigoAgente" name="codigoAgente" aria-describedby="emailHelp" placeholder="Codigo do agente" required length="5" pattern="[0-9]{5}" title="#####">

                    <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required length="9" pattern="(84|85|82|86|87|83)[0-9]{7}" title="Ex : 84/82/85/87/86 #######">
                  </div>
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" name="idEditarAgente">Editar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $('#idEditarAgente').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) 
          var id = button.data('whateverid') 
          var nome = button.data('whatevernome') 
          var morada = button.data('whatevermorada') 
          var telefone = button.data('whatevertelefone') 
          var codigoAgente = button.data('whatevercodigoagente') 
          var nomeAgente = button.data('whatevernomeagente') 

          var modal = $(this)
          modal.find('.modal-title').text('Editar Representante ')
          modal.find('.modal-body input#id').val(id)
          modal.find('.modal-body input#nome').val(nome)
          modal.find('.modal-body input#morada').val(morada)
          modal.find('.modal-body input#telefone').val(telefone)
          modal.find('.modal-body input#codigoAgente').val(codigoAgente)
          modal.find('.modal-body input#nomeAgente').val(nomeAgente)

        })
      </script>

<!-- ===================
APAGAR REPRESENTANTE
==================== -->
<div class="modal fade" id="idApagarAgente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px; ">
       <form class="addRepresentanteForm" action="agenteRep.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
        <button type="submit" class="btn btn-danger" name="idApagarAgente">Sim</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#idApagarAgente').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('whateverid') 
    var nome = button.data('whatevernome') 


    var modal = $(this)
    modal.find('.inf').text('Tem a certeza que pretende apagar o Agente '+ nome +' ?')
    modal.find('.modal-body input#id').val(id)

  })
</script>


          <!--===================
           DIVIVA E PAGAMENTO 
           -==============================-->
           <!-- PAGE DIVIDA -->

           <div class="modal fade" id="pagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert alert-secondary">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form class="addRepresentanteForm" action="dividaRep.php" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Introduza o valor a pagar</label>
                    <input type="number" class="form-control" id="valor" name="valor" min="100" value="0" aria-describedby="emailHelp" placeholder="Valor">

                    <input type="hidden" class="form-control" id="idDivida" name="idDivida">
                  </div> 

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary" name="pagamento">Pagar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          $('#pagamento').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var idDivida = button.data('whateverid') 
            var modal = $(this)
            modal.find('.modal-body input#idDivida').val(idDivida)

          })
        </script>
        <!-- ======================================================== -->

    <!--===================
         PAGAMENTO COM REFERENCIA
         -==============================-->
         <!-- PAGE DIVIDA -->
         <?php 
         include_once('../Control/sessaoControl.php');

         $con11 = new CRUD;
         $dividaTotalDeposito =0;
         $sqlPag = $con11->SelectInnerJoinPagamentoRep($_SESSION['dados'],array());
         foreach($sqlPag as $sqlPagLinha){
          if($sqlPagLinha['rEstado']==0){
            $dividaTotalDeposito = $dividaTotalDeposito + $sqlPagLinha['pValor'];
          }
        }
        
        ?>

        <div class="modal fade" id="pagamentoDeposito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header alert alert-secondary">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <form class="addRepresentanteForm" action="pagamentoRep.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Valor Total</label>
                  <input type="text" class="form-control" id="valorDepositado" name="valorDepositado"   aria-describedby="emailHelp"  value="<?php echo $dividaTotalDeposito;?>" readonly required>
                  <input type="hidden" class="form-control" id="idRepresentante" name="idRepresentante" value="<?php echo $_SESSION['dados'];?>">
                </div>
                <div class="form-group">
                  <label for="formaPagamento">Forma de pagamento</label>
                  <SELECT name="formaPagamento" class="form-control" required>
                    <option value="">Selecione --</option>
                    <option value="Mpesa">Mpesa</option>
                    <option value="BIM">BIM</option>
                    <option value="BCI">BCI</option>
                    <option value="Ponto24">Ponto24</option>
                    <option value="MozaBanco">Moza-Banco</option>
                    <option value="MozaBanco">Barclays</option>
                    <option value="MozaBanco">ABC</option>
                  </SELECT>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="referencia" name="referencia"  aria-describedby="emailHelp" placeholder="Introduza a referencia" required>
                </div> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" name="pagamentoDeposito">Pagar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $('#pagamentoDeposito').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) 
// var idDivida = button.data('whateverid') 
var modal = $(this)
// modal.find('.modal-body input#depositp').val(idDivida)

})
</script>
<!-- ======================================================== -->

<!--===================
        CONFIRMAR PAGAMEMENTO AUTOMATICO
        -==============================-->
        <!--  -->

        <div class="modal fade" id="confPagamento1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header alert alert-secondary">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <form class="col-sm-10" action="pagamentoSuper.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" class="form-control-file" name="arquivo" id="arquivo" required>
                </div>
              </div>
              <div class="modal-footer">
                 <button type="submit" style="height: 40px;" name="pagamentoAutomatico" class="btn btn-primary">Processar o pagamento</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $('#confPagamento1').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) 
// var idDivida = button.data('whateverid') 
var modal = $(this)
// modal.find('.modal-body input#depositp').val(idDivida)

})
</script>
<!-- ======================================================== -->






<!-- ===================
SOLICITACAO ACEITAR SUPERAGENTE
==================== -->
<div class="modal fade" id="aceitarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px; ">
       <form class="addRepresentanteForm" action="solicitacaoSuper.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
        <button type="submit" class="btn btn-danger" name="aceitarSolicitacao">Sim</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#aceitarSolicitacao').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('whateverid') 
    var modal = $(this)
    modal.find('.inf').text('Tem a certeza da Aceitacao?')
    modal.find('.modal-body input#id').val(id)

  })
</script>
<!-- ======================================================== -->
<!-- ======================================================== -->



<!-- ===================
EDITAR SOLICITACAO  SUPERAGENTE
==================== -->

<div class="modal fade" id="editarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-secondary">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form class="addRepresentanteForm" action="solicitacaoSuper.php" method="POST">
        <div class="form-group">
          <input type="number" class="form-control" id="valorActual" name="valorActual"  aria-describedby="emailHelp" placeholder="Introduza o valor" min="100" required>
          <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" name="editarSolicitacao">Editar</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#editarSolicitacao').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('whateverid') 
    var modal = $(this)
    modal.find('.inf').text('Tem a certeza da Aceitacao?')
    modal.find('.modal-body input#id').val(id)

  })
</script>
<!-- ======================================================== -->





<!-- ===================
APAGAR SOLICITACAO SUPER AGENTE
==================== -->
<div class="modal fade" id="idSolicitacaoApagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px; ">
       <form class="addRepresentanteForm" action="solicitacaoSuper.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Senha">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
        <button type="submit" class="btn btn-danger" name="idSolicitacaoApagar">Sim</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#idSolicitacaoApagar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('whateverid') 
    var nome = button.data('whatevernome') 


    var modal = $(this)
    modal.find('.inf').text('Tem a certeza que pretende apagar a Solicitacao ?')
    modal.find('.modal-body input#id').val(id)

  })
</script>






<!-- ===================
PAGAMENTO REGEITAR DO PAGAMENTO
==================== -->
<div class="modal fade" id="regeitarPagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px; ">
       <form class="addRepresentanteForm" action="pagamentoSuper.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="referencia" name="referencia" placeholder="Senha">
<!--   <input type="hidden" class="form-control" id="idDivida" name="idDivida" placeholder="Senha">
  <input type="hidden" class="form-control" id="valorPago" name="valorPago" placeholder="Senha"> -->
</div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
  <button type="submit" class="btn btn-danger" name="regeitarPagamento">Sim</button>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
  $('#regeitarPagamento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var referencia = button.data('whateverreferencia') 
// var idDivida =button.data('whateverdivida') 
// var valorPago =button.data('whatevervalorpago') 
var modal = $(this)
modal.find('.inf').text('Tem a certeza da Regeição do pagamento?')
modal.find('.modal-body input#referencia').val(referencia)
// modal.find('.modal-body input#idDivida').val(idDivida)
// modal.find('.modal-body input#valorPago').val(valorPago)

})
</script>











<!-- ===================
PAGAMENTO CONFIRMACAO DO PAGAMENTO
==================== -->
<div class="modal fade" id="confirmarPagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body alert alert-secondary" style="height: 100px; ">
       <form class="addRepresentanteForm" action="pagamentoSuper.php" method="POST">
        <div class="row">
          <span class="inf"></span>
          <div class="form-group col-sm-6">
            <input type="hidden" class="form-control" id="referencia" name="referencia" placeholder="Senha">
<!--   <input type="hidden" class="form-control" id="idDivida" name="idDivida" placeholder="Senha">
  <input type="hidden" class="form-control" id="valorPago" name="valorPago" placeholder="Senha"> -->
</div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Nao</button>
  <button type="submit" class="btn btn-danger" name="confirmarPagamento">Sim</button>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
  $('#confirmarPagamento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var referencia = button.data('whateverreferencia') 
// var idDivida =button.data('whateverdivida') 
// var valorPago =button.data('whatevervalorpago') 
var modal = $(this)
modal.find('.inf').text('Tem a certeza da Confirmacao?')
modal.find('.modal-body input#referencia').val(referencia)
// modal.find('.modal-body input#idDivida').val(idDivida)
// modal.find('.modal-body input#valorPago').val(valorPago)

})
</script>



<script type="text/javascript">
  $(document).ready( function () {
    $('.myTable3').DataTable(
      {   "lengthMenu":[3,4],
      "oLanguage": {
        "sLengthMenu": "Registros _MENU_",
        "sZeroRecords": "Nenhuma registo foi encontrado",
        "sInfo": "Mostrando _TOTAL_ Registros",
        "sInfoEmpty": "Mostrando 0 Registros",
        "sInfoFiltered": "(pesquisa feita em _MAX_ Registros)",
        "sSearch": "Pesquisa",
        "sPaginate": {"Next":"Proximo", "Previous":"Anterior"},

      } }
      );
  } );
</script>

<script>
  $(document).ready(function() {
    var table = $('#example').DataTable( {
      lengthChange: false,
      dom: 'Bfrtip',
      buttons: ['pdf', 'colvis' ]
    // 'excel',
        // buttons: [{
        //       extend: 'pdfHtml5',
        //       orientation: 'landscape',
        //       pageSize: 'LEGAL'
        //   }]
      } );

    table.buttons().container()
    .appendTo( '#example_wrapper .col-md-12:eq(0)' );
  } );
</script>
<script type="text/javascript">
  $(document).ready( function () {
    $('.myTable').DataTable(
      {   "lengthMenu":[10,5,20,],
    // "lengthMenu":[10,5,20,],
    "oLanguage": {
      "sLengthMenu": "Registros _MENU_",
      "sZeroRecords": "Nenhuma registo foi encontrado",
      "sInfo": "Mostrando _TOTAL_ Registros",
      "sInfoEmpty": "Mostrando 0 Registros",
      "sInfoFiltered": "(pesquisa feita em _MAX_ Registros)",
      "sSearch": "Pesquisa",
      "sPaginate": {"Next":"Proximo", "Previous":"Anterior"},

    } }
    );
  } );
</script> 


