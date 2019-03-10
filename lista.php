<?php
  $lista=$_GET['lista'];
  $DATABASE='db/data.db';    
  $query = new PDO('sqlite:'.$DATABASE) or die('Connection Error');  
  $perguntas='<thead><tr><th>ID</th><th>Pergunta</th><th>Resp</th></tr></thead><tbody>';
  $respostas='<thead><tr><th>ID</th><th>Resposta</th><th>script</th></tr></thead><tbody>';	 			
  $scripts='<thead><tr><th>ID</th><th>Script</th></tr></thead><tbody>';			

if($lista=='P'){	  
	$comand = "SELECT * FROM perguntas ";            
    $tabelas = $query->query($comand);    
  	foreach ($tabelas as $row){
		$cmd = "<tr id='PP{$row['id']}' class='pclick' onClick='SelectP(this);'>".
			"<td>{$row['id']}</td>".
			"<td>{$row['entrada']}</td>".
			"<td>{$row['resposta_id']}</td>".
			"</tr>";	
    	$perguntas.=$cmd;	
	}
	$perguntas.='</tbody><tfoot><tr><td></td><td></td><td></td></tr></tfoot>';
    die($perguntas);
}

if($lista=='R'){	 
   $comand = "SELECT * FROM respostas ";             
   $tabelas = $query->query($comand);  
   foreach ($tabelas as $row){								
			$respostas.="<tr id='RR{$row['id']}' class='pclick' onClick='SelectP(this);'><td>".$row['id']."</td>".
			"<td>".$row['resposta']."</td>".
			"<td>".$row['script_id']."</td></tr>";
	}	
	$respostas.='</tbody><tfoot><tr><td></td><td></td><td></td></tr></tfoot>';
	die($respostas);
}

if($lista=='S'){
	$comand = "SELECT * FROM scripts ";             
    $tabelas = $query->query($comand);  
    foreach ($tabelas as $row){								
			$scripts.="<tr id='SS{$row['id']}' class='pclick' onClick='SelectP(this);'><td>".$row['id']."</td>".
			"<td>".$row['script']."</td></tr>";	
	}	
	$scripts.='</tbody><tfoot><tr><td></td><td></td></tr></tfoot>';
	die($scripts);
}
   
									
