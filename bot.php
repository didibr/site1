<?php
putenv('GOOGLE_APPLICATION_CREDENTIALS=secret.json');
require 'vendor/autoload.php';
use Google\Cloud\Language\LanguageClient;

$projectId = 'rational-camera-215416';
$language = new LanguageClient(['projectId' => $projectId]);
$text = 'Olá Mundo!';

/* ANALIZE DE SENTIMENTO
$annotation = $language->analyzeSentiment($text);
$sentiment = $annotation->sentiment();
echo 'Text: ' . $text . '
Sentiment: ' . $sentiment['score'] . ', ' . $sentiment['magnitude'];
*/

if(!isset($_GET['in'])){
	header('Location: bot.php?in=texto aqui');
	die();
}

$entrada=$_GET['in'];
$annotation = $language->analyzeSyntax($entrada);

//echo 'Texto: '.$entrada.'<br>';
$lemmatext='';
foreach ($annotation->tokens() as $palavra) {
	$lemmatext.=$palavra['lemma'].' ';
}
$lemmatext=trim($lemmatext);

$annotation = $language->analyzeSyntax($lemmatext);
$textbot=array();
$sortarray=array();
foreach ($annotation->tokens() as $key => $palavra) {	
	$textolemma=$palavra['lemma'];
	if($textolemma!='.'){
		$indexnum=$palavra['dependencyEdge']['headTokenIndex'];
		$sortarray[$key]  = $indexnum;
		array_push($textbot,array(
	 		'INDEX'=>$indexnum,
	 		'REGRA'=>$palavra['dependencyEdge']['label'],
	 		'TEXTO'=>$palavra['lemma']	
		));	
	}
}

array_multisort($sortarray, SORT_DESC, $textbot);

$saida='';
foreach($textbot as $palavra){
	$saida.=$palavra['TEXTO'].'('.$palavra['REGRA'].')'.' ';
}

echo 'Texto: '.$entrada.'<br>';
echo $saida;

?>