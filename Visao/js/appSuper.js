$(document).ready(function(){

dividatable();	
	
function dividatable(){
$.ajax({
		url:'../Control/dividaSuperControl.php',
		type:'GET',
		beforeSend:function(){
        $('#carregandoSuper').css("display","block");
		},
		success:function(res){
			let resultado = ''; 
			let total =0;
			let dividas = JSON.parse(res);
        

			dividas.forEach(div=>{
				resultado +=
				`<tr>
				<td>${div.data}</td>
				<td>${div.divida}</td>
				<td>${div.representante}</td>
				</tr>`;
             total = total +div.divida;
			});
			$('#prod-listSuper').html(resultado);
			$('#total-dividaSuper').html(total+'  MT');
			// console.log(resultado);
},
complete:function(){
	$('#carregandoSuper').css("display","none");
}

});	
}

});