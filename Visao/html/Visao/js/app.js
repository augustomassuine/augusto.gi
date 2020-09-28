$(document).ready(function(){

dividatable();	
$(document).on('click','.pagar-divida',function(evento){
let element = $(this)[0].parentElement.parentElement;
let id = $(element).attr('id');


$('#pagamento').modal('show')
$('#idDivida').val(id)
});

	
function dividatable(){
$.ajax({
		url:'../Control/dividaControl.php',
		type:'GET',
		beforeSend:function(){
        $('#carregando').css("display","block");
		},
		success:function(res){
			let resultado = ''; 
			let total =0;
			let dividas = JSON.parse(res);
        

			dividas.forEach(div=>{
				resultado +=
				`<tr id='${div.id}'>
				<td>${div.data}</td>
				<td>${div.divida}</td>
				<td>${div.agente}</td>
				<td><button class='btn btn-primary btn-sm pagar-divida'>Pagar</button></td>
				</tr>`;
             total = total +div.divida;
			});
			$('#prod-list').html(resultado);
			$('#total-divida').html(total+'  MT');
},
complete:function(){
	$('#carregando').css("display","none");
}

});	
}

});