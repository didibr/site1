// JavaScript Document
$(document).ready(function(){
	var dcheight=Math.round($('#intro').height());
	//$('#one').css('height',dcheight+'px');
	//console.log($('#intro').height());
	$( "#admtabs" ).tabs();
});


function SwapToLogin(num){
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

function Logout(){
  $.ajax({
    type: 'POST',    
    data: {'LOGOUT':'1'},
    success: function(msg){
        location.reload();
    }});		
}

function Logar(){
  $.ajax({
    type: 'POST',    
    data: { 
		'LOGAR':'1',		
		'email':$('#imail').val(),
		'senha':$('#isenha').val()
	},
    success: function(msg){
        if(msg!='OK'){
			alert(msg);
		}else{
			location.reload();
		}
    }});	
}

function Cadastrar(){
	$.ajax({
    type: 'POST',    
    //url: 'bot.php',
    data: { 
'CADASTRAR':'1',		
'cad_nome':$('#cad_nome').val(),
'cad_cpf':$('#cad_cpf').val(),
'cad_email':$('#cad_email').val(),
'cad_senha':$('#cad_senha').val(),
'cad_homen':$('#cad_homen').val(),
'cad_mulher':$('#cad_mulher').val(),
'cad_nasc_dia':$('#cad_nasc_dia option:selected').val(),
'cad_nasc_mes':$('#cad_nasc_mes option:selected').val(),
'cad_nasc_ano':$('#cad_nasc_ano option:selected').val()
	},
    success: function(msg){
        alert(msg);
    }});			
}


var meanresp=null;
function MeanResponse(){
	var textsend=$('#chattext').val();	
	textsend=textsend.toLowerCase().trim();
	if(textsend=='nao'||textsend=='não'||textsend=='n'||textsend=='no')textsend='n';
	if(textsend=='sim'||textsend=='s'||textsend=='y'||textsend=='yes')textsend='s';
	if(textsend=='s'||textsend=='n'){
		if(textsend=='s'){
	    	$('#chat_response').html(meanresp['L']);				 	 
	   		$('#chattext').attr('placeholder','Escreva Aqui').val('');	
		}else{
			$('#chat_response').html('Não etendi oque você quiz dizer.<br>Escreva de outra forma');
			$('#chattext').attr('placeholder','Escreva Aqui').val('');	
            $.ajax({
    		type: 'POST',    
    		url: 'bot.php',
    		data: { 'in': meanresp['O'], 'force':'1'},
    		success: function(msg){}});							
		}
	}else{
		meanresp=null;
		PushTalk();
	}
}

function getResponse(data){
	meanresp=null;
	console.log(data);
 if(data['I']=='-1'){	 
     $('#chat_response').html(
		 'Não tenho uma resposta Definida para isto no momento.<br>'+
		 'Sua pergunta foi gravada no banco de dados e será verificada.'
	 );			
 }else{	 
	 if(data['L']==null){
	   $('#chat_response').html('Ainda não tenho uma resposta para isto.');				 
	 }else{
		 if(parseInt(data['R'])<100){
		   meanresp=data;	 
		   $('#chat_response').html('Você quis dizer:<br>'+data['M']);				 	 
		   $('#chattext').attr('placeholder','[S/N]').val('');
		 }else{
		  $('#chat_response').html(data['L']);				 	 
		 }	   
	 }	 
 }
	
}

function PushTalk(){
	if(meanresp!=null){
		MeanResponse();
		return;
	}	
	var textsend=$('#chattext').val();	
	$('#ai_load').css('display','block');
	$('#chattext').attr('disabled','true');
	$('#chat_response').html('aguarde...');
	$.ajax({
    type: 'POST',    
    url: 'bot.php',
    data: { 'in': textsend},
    success: function(msg){
		$('#ai_load').css('display','none');
		$('#chattext').attr('disabled',null);
        var data=JSON.parse(msg);
		getResponse(data[0]);
    }});	
}

function ClickPergunta(idp,idr){
   $('#PP').find('> tbody > tr').each(function(){	   
	   var perg=$($(this).find('td')[0]).text().trim();
	   var resp=$($(this).find('td')[2]).text().trim();
		if(idp==perg || idr==resp){
			$(this).addClass('tsel');
		}else{
			$(this).removeClass('tsel');
		}
	});		
}

function ClickScript(id){
   $('#SS').find('> tbody > tr').each(function(){	   
	   var scri=$($(this).find('td')[0]).text().trim();
		if(id==scri){
			$(this).addClass('tsel');
		}else{
			$(this).removeClass('tsel');
		}
	});		
}

function ClickResponse(idr,ids){
	var found=0;
	var perguntas=[];
   $('#RR').find('> tbody > tr').each(function(){
	   var perg=$($(this).find('td')[0]).text().trim();
	   var scri=$($(this).find('td')[2]).text().trim();	   
		if(idr==perg || ids==scri){
			perguntas.push(perg);
			$(this).addClass('tsel');
			ClickScript(scri);
			found=1;
		}else{
			$(this).removeClass('tsel');			
		}
	});	
 if(found==0)ClickScript(-1);
 return perguntas;
}

function SelectPergunta(tabela,tr){
    tr.addClass('tsel');
	tabela.find('> tbody > tr').each(function(){
		if($(this).hasClass('tsel')){
			if($(this)[0]!=tr[0])
			$(this).removeClass('tsel');			
		}
	});		
	var resposta=$(tr.find('td')[2]).text().trim();
	return resposta;
}

//ACOES DE CLICK NOS MENUS DE SCRIPT
function SelectP(obj){ 
	var tabela=$(obj).closest('table');		
	if($(tabela).attr('id')=='PP'){
		var resp=SelectPergunta($(tabela),$(obj));
		ClickResponse(resp,-1);
	}
	if($(tabela).attr('id')=='RR'){
		var scri=SelectPergunta($(tabela),$(obj));			
		var resp=$($(obj).find('td')[0]).text().trim();
		ClickScript(scri);		
		ClickPergunta(-1,resp);		
	}
	if($(tabela).attr('id')=='SS'){		
		var scri=$($(obj).find('td')[0]).text().trim();				
		var pergarray=ClickResponse(-1,scri);		
		if(pergarray.length==0){
			ClickPergunta(-1,-1);
			$($(obj)).addClass('tsel');
		}
		$.each(pergarray,function(index, value){
			ClickPergunta(-1,value);
		});
	}
}