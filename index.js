// JavaScript Document
$(document).ready(function(){
	var dcheight=Math.round($('#intro').height());
	//$('#one').css('height',dcheight+'px');
	//console.log($('#intro').height());
});


function Cadastrar(num){
	if(num==1){
		$('#one_login').css('display','none');
		$('#one_cadastro').css('display','block');	
	}else{
		$('#one_login').css('display','block');
		$('#one_cadastro').css('display','none');	
	}	
}

function Rdi(radio){
	$('#cad_homen').prop('checked', false);
	$('#cad_mulher').prop('checked', false);
	$(radio).prop('checked', true);
}