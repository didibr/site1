<?php
ini_set('default_charset','UTF-8');
use Google\Cloud\Language\LanguageClient;


function array_diff_assoc_recursive($array1, $array2){
	foreach($array1 as $key => $value)
	{
		if(is_array($value))
		{
			if(!isset($array2[$key]))
			{
				$difference[$key] = $value;
			}
			elseif(!is_array($array2[$key]))
			{
				$difference[$key] = $value;
			}
			else
			{
				$new_diff = array_diff_assoc_recursive($value, $array2[$key]);
				if($new_diff != FALSE)
				{
					$difference[$key] = $new_diff;
				}
			}
		}
		elseif(!isset($array2[$key]) || $array2[$key] != $value)
		{
			$difference[$key] = $value;
		}
	}
	return !isset($difference) ? 0 : $difference;
}

function CompareLemmaToPergunta($lemmaA,$perguntaJS){
	$perguntaA=json_decode($perguntaJS,true);
	$lemmaX=array();
	foreach($lemmaA as $pal){
	 array_push($lemmaX,$pal['L']);	
	}
	$perguntaX=array();
	foreach($perguntaA as $pal){
	 array_push($perguntaX,$pal['L']);	
	}		
	$rrr=array_diff($perguntaX,$lemmaX);	
	$qtdl=count($lemmaX); 
	$qtdp=count($perguntaX); //6		
	$qtda=count($rrr);//X achado	
	$xperc = 100-((100*$qtda)/$qtdp);
    return $xperc;	
}
 
function GetResponse($entrada,$lemmaA){	
  $DATABASE='db/data.db';  
  $error = array(array('I'=>'99','R'=>'','L'=>'Cannot Open DataBase'));
  $query = new PDO('sqlite:'.$DATABASE) or die(json_encode($textbot));
  $comand = "SELECT perguntas.id,entrada,pergunta,respostas.resposta FROM perguntas ".
            "LEFT JOIN  respostas on  perguntas.resposta_id = respostas.id";
  $tabelas = $query->query($comand);
  $id_perg=-1;
  $id_perc=0;
  $id_resp='';
  $id_mean='';
  foreach ($tabelas as $row){
	    $percFind=CompareLemmaToPergunta($lemmaA,$row['pergunta']);
	  if($percFind>$id_perc){
		  $id_perc=$percFind;
		  $id_perg=intval($row['id']);
		  $id_resp=$row['resposta'];
		  $id_mean=$row['entrada'];
	  }
  }
  if($id_perc<60 || isset($_POST['force'])){
	 $lemma=json_encode($lemmaA);
	 $commands = <<<COMAND
INSERT INTO perguntas(entrada,pergunta) VALUES('{$entrada}','{$lemma}');              
COMAND;
	  //echo $commands;
      $query->exec($commands); 
	  $resp = array(array('I'=>'-1','R'=>'','L'=>'Sem Resposta'));
	  return json_encode($resp);
  }else{
	 $resp = array(array('I'=>$id_perg,'R'=>$id_perc,'L'=>$id_resp));	  
	  if($id_perc!=100){
		$resp[0]['M']=$id_mean; 
		$resp[0]['O']=$entrada;
	  }
	  return json_encode($resp);  
  }	
}

function GetLemma($entrada){
	putenv('GOOGLE_APPLICATION_CREDENTIALS=secret.json');
    require 'vendor/autoload.php';
	$projectId = 'rational-camera-215416';
	$language = new LanguageClient(['projectId' => $projectId]);	
	/* ANALIZE DE SENTIMENTO
	$annotation = $language->analyzeSentiment($text);
	$sentiment = $annotation->sentiment();
	echo 'Text: ' . $text . '
	Sentiment: ' . $sentiment['score'] . ', ' . $sentiment['magnitude'];
	*/
	//primeiro teste
	$annotation = $language->analyzeSyntax($entrada);
	$lemmatext='';
	foreach ($annotation->tokens() as $palavra) {
		$lemmatext.=$palavra['lemma'].' ';
	}
	$lemmatext=trim($lemmatext);
    //segundo teste
	$annotation = $language->analyzeSyntax($lemmatext);
	$textbot=array();
	$sortarray=array();
	foreach ($annotation->tokens() as $key => $palavra) {	
		$textolemma=$palavra['lemma'];
		if($textolemma!='.'){//remove pontos
			$indexnum=$palavra['dependencyEdge']['headTokenIndex'];
			$sortarray[$key]  = $indexnum;
			array_push($textbot,array(
	 			'I'=>$indexnum,
	 			'R'=>$palavra['dependencyEdge']['label'],
	 			'L'=>$palavra['lemma']	
			));	
		}		
	}
	array_multisort($sortarray, SORT_DESC, $textbot);
    return GetResponse($entrada,$textbot);
}



if(isset($_POST['in'])){
	echo GetLemma($_POST['in']);
}else{
	$error = array(array('I'=>'99','R'=>'','L'=>'Nenh'));
	echo json_encode($error);
}
?>