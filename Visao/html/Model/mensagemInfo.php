
<?php
include_once('../Control/sessaoControl.php');
class Mensagem{




public function sucessoAjax($mensagem){?>

	<div class="modal fade " id="apagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-header alert alert-success">
        <h6 style="text-align: center;" class="modal-title" id="exampleModalLabel"><?php echo $mensagem;?></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
       
      </div>
    </div>
  </div>
</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#apagar').modal('show');
			setTimeout(makeRedirect=function(){
				return $('#apagar').modal('hide');
			},6000);
		
		});
	</script>



	<?php }
	public function sucesso($mensagem,$direcao){?>

	<div class="modal fade " id="apagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-header alert alert-success">
        <h6 style="text-align: center;" class="modal-title" id="exampleModalLabel"><?php echo $mensagem;?></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
       
      </div>
    </div>
  </div>
</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#apagar').modal('show');
			//$('#apagar').show();
			setTimeout(makeRedirect=function(){
				return window.location.href='<?php print($direcao);?>';

			},4000);
		});
	</script>



	<?php }
	public function erro($mensagem){?>

	<div class="col-md-offset-3 col-md-6 col-md-offset-3 apagar" style="background-color:rgba(166,226,46,0.1);position: relative; top:20px; ">
		<h4 style="color: rgba(166,226,46,1);" class="text-center"><?php echo $mensagem; ?></h4>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.apagar').show();
			setTimeout(makeRedirect=function(){
				return window.location.href='../index.php';

			},1000000);
		});
	</script>



	<?php }
	public function confirmacao($msnHeader,$msnBody,$direcao){ ?>
	<!-- Modal -->
	<div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">	
						<?php echo $msnHeader; ?>
					</h4>
				</div>
				<div class="modal-body">
					<?php echo $msnBody; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
					<a href="<?php $direcao;?>"  class="btn btn-primary" style="padding: 5px 25px;" >Sim</a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#erro').modal('show');
		});

	</script>
	<?php

}
}

?>