<?php
 include('vars.php');
 //include('bot.php');
 setlocale(LC_ALL, 'pt_BR');
 session_start();

if(isset($_POST['LOGOUT'])){
 session_unset($_SESSION["LOGUED"]);
 $_SESSION["LOGUED"]=null;	
 die('OK');
}

if(isset($_POST['LOGAR'])){
 $email=$_POST['email'];
 $senha=$_POST['senha'];
 $email=str_replace("'",'',$email);
 $senha=str_replace("'",'', $senha);
 $DATABASE='db/data.db';    
  $query = new PDO('sqlite:'.$DATABASE) or die('Não é possivel abrir banco de dados');
  $comand = "select count(nome) as CC,* from usuarios where email='{$email}' and senha_md3='{$senha}'";
  $tabelas = $query->query($comand);
  $count=0;
  $datasex;
  foreach ($tabelas as $row){$count=$row[0];$datasex=$row;}
  if($count==0){
	  die('Login Inválido');
  }else{	
     $_SESSION["LOGUED"]=$datasex;
	 die('OK');
  }	
}


if(isset($_POST['CADASTRAR'])){
 $email=$_POST['cad_email'];
 $cpf=$_POST['cad_cpf'];
 $email=str_replace("'",'',$email);
 $cpf=str_replace("'",'',$cpf);// "' or 1=1 or '"	
 $cpf=filter_var($cpf, FILTER_SANITIZE_NUMBER_INT);
 $DATABASE='db/data.db';    
  $query = new PDO('sqlite:'.$DATABASE) or die('Não é possivel abrir banco de dados');
  $comand = "select count(nome) from usuarios where email='{$email}' or cpf='{$cpf}'";
  $tabelas = $query->query($comand);
  $count=0;
  foreach ($tabelas as $row)$count=$row[0];
  if($count!=0){
	  die('Email ou CPF já cadastrado !');
  }else{
	  $comand = "INSERT INTO usuarios VALUES('{$email}','{$_POST['cad_nome']}','{$_POST['cad_senha']}',".
		  "'{$cpf}','M','10/10/2010','0')";
	  $query->exec($comand);
	  die($comand);
  }	  
}

//print_r($_SESSION["LOGUED"]);
?>
<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $SITE_TITLE;?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/css/jquery-ui.css" />
		<link rel="stylesheet" href="css/main.css" />
		<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Sidebar MENU -->
			<section id="sidebar">
				<div class="inner">
					<nav>
						<ul>
							<li><a href="#intro">Converse</a></li>
							<?php
							if(isset($_SESSION["LOGUED"])){
							 echo '<li><a href="#logoff">Deslogar</a></li>';
							 echo '<li><a href="#two">Comandos</a></li>';
							  if($_SESSION["LOGUED"]['acesso']==1)
								 echo '<li><a href="#three">Admin</a></li>';
							}else{
							 echo '<li><a href="#one">Login</a></li>';	
							}
							?>							
							
							<li><a href="#four">Contato</a></li>
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper DOCUMENTO -->
			<div id="wrapper">

				<!-- Intro - CONVERSE -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
						<div id="ai_load" class="fade-up" style="display:none">
							<img src="/images/load.gif" width="200em;"/>
						</div>
							<h1><?php echo $SITE_NAME;?></h1>
							<p><div id='chat_response'>#RESPONSE</div>
							</p>														
							<ul class="actions">
								<input type="text" id="chattext" placeholder="Escreva Aqui" 
									   style="width: 50%; min-width: 300px;"/>
								
								<li><a href="JAVASCRIPT:PushTalk();" class="button scrolly" style="display: flex;">
									<div style="">
										<div class="icon major fa-microphone" style="display: inline-block;"></div>
										<div style="display: inline-block;">Enviar</div>										
									</div>
									
									</a>
								</li>
							</ul>
						</div>
					</section>

		<?php
		if(isset($_SESSION["LOGUED"])){
		?>
		            <!-- DIV DESLOGAR -->
                    <section id="logoff" class="wrapper style2 fullscreen">
						<section id="one_login">
							<div class="content">
								<div class="inner" align="center">
									<h2>Login</h2>
									<div class="row" align="center" style="display: block;">  
									<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="JAVASCRIPT:Logout();" class="button icon fa-power-off" style="width: 50%;">Sair</a>
									</div>
									</div>
								</div>
							</div>
						</section>
		       		</section>
		<?php
		}else{		
		?>
				    <!-- DIV LOGAR -->
					<section id="one" class="wrapper style2 fullscreen">
						<section id="one_login">
							<div class="content">
								<div class="inner" align="center">
									<h2>Login</h2>									
									<div class="row" align="center" style="display: block;">  
										<div class="col-5 col-12-xsmall">											
											<input type="email" name="imail" id="imail" value="" placeholder="Email">
										</div>
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<input type="password" name="isenha" id="isenha" value="" placeholder="Senha">
										</div>
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="JAVASCRIPT:Logar();" class="button icon fa-check" style="width: 50%;">Entrar</a>
										</div>
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="JAVASCRIPT:SwapToLogin(1);" class="button icon fa-address-card" style="width: 50%;">Cadastrar</a>
										</div>
										
									</div>
									
								</div>
							</div>
						</section>
						
						<section id="one_cadastro" style="display: none;">							
							<div class="content">
								<div class="inner" align="center">
									<h2>Cadastrar</h2>									
									<div class="row" align="center" style="display: block;">  									<div class="col-5 col-12-xsmall" >
											<input type="text" name="cad_nome" id="cad_nome" value="" placeholder="Nome">
										</div>
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<input type="text" name="cad_cpf" id="cad_cpf" value="" placeholder="CPF">
										</div>	
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">						 <input type="email" name="cad_email" id="cad_email" value=""		 placeholder="Email"/>
										</div>
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<input type="password" name="cad_senha" id="cad_senha" value="" placeholder="Senha">
										</div>										
										<div class="col-6 col-12-small" style="margin-top: 0.5em;">
											<input type="radio" id="cad_homen" name="cad_homen" onClick="Rdi(this);">
											<label for="cad_homen">Homen</label>
											<input type="radio" id="cad_mulher" name="cad_mulher" onClick="Rdi(this);">
											<label for="cad_mulher">Mulher</label>
										</div>
										<div class="col-6 col-12-small" style="margin-top: 0.5em;">
											Data de Nascimento:
										</div>
										<div class="col-6 col-12-small" style="margin-top: 0.5em;">
												<select name="cad_nasc_dia" id="cad_nasc_dia" 
														style="width: 23%;display: inline-block;">
													<option value="" style="color: rgba(140,140,140,1.00);">DIA</option>
													<?php
													 for($i=1;$i<32;$i++)
														 echo "<option value='{$i}'>{$i}</option>";
													?>													
												</select>
											    <select name="cad_nasc_mes" id="cad_nasc_mes" 
														style="width: 43%;display: inline-block;">
													<option value="" style="color: rgba(140,140,140,1.00);">MÊS</option>
													<?php
													 for($i=1;$i<13;$i++){
														 $mes = strftime("%B", strtotime("{$i}/01/2001"));
														 $mes[0] = strtoupper($mes[0]); 
														 echo "<option value='{$i}'>{$mes}</option>";
													 }
													?>													
												</select>
												<select name="cad_nasc_ano" id="cad_nasc_ano" 
														style="width: 23%;display: inline-block;">
													<option value="" style="color: rgba(140,140,140,1.00);">ANO</option>
													<?php
													 for($i=2020;$i>1960;$i--)
														 echo "<option value='{$i}'>{$i}</option>";
													?>													
												</select>
										</div>
											
										
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="JAVASCRIPT:Cadastrar();" class="button icon fa-book" style="width: 50%;">Cadastrar</a>
										</div>
										<div class="col-5 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="JAVASCRIPT:SwapToLogin(0);" class="button icon fa-check" 
											   style="width: 50%;">Entrar</a>
										</div>
										
									</div>
									
								</div>
							</div>
						</section>
						
		
					</section>
        <?php
		}
		if(isset($_SESSION["LOGUED"])){							
        ?>

				<!-- LISTA DE COMANDOS -->
					<section id="two" class="wrapper style3 fade-up">
						<div class="inner">
							<h2>Comandos</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
							<div class="features">
								<section>
									<span class="icon major fa-code"></span>
									<h3>Lorem ipsum amet</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-lock"></span>
									<h3>Aliquam sed nullam</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-cog"></span>
									<h3>Sed erat ullam corper</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-desktop"></span>
									<h3>Veroeros quis lorem</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-chain"></span>
									<h3>Urna quis bibendum</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-diamond"></span>
									<h3>Aliquam urna dapibus</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
							</div>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn more</a></li>
							</ul>
						</div>
					</section>
		<?php
			if($_SESSION["LOGUED"]['acesso']==1){							
		?>
		          <!-- Three - Ações de ADMIN -->
					<section id="three" class="wrapper style4 fade-up">
						<div class="inner">
							<h2>Admin</h2>
							<p>Ações a serem tomadas quando pergunta for feita.</p>
							<div class="split style1">
								<section>
<!--TABVIEW -->									
<div id="admtabs">
  <ul>
    <li><a href="#tabs-1">Perguntas</a></li>
    <li><a href="#tabs-2">Respostas</a></li>    
  </ul>		
	<!--TABVIEW TAB1 -->
	<div id="tabs-1">
								
									<table class="alt">
									<thead><tr><th>ID</th><th>Pergunta</th><th>Resp</th></tr></thead><tbody>
<?php
  $DATABASE='db/data.db';  
  $error = array(array('I'=>'99','R'=>'','L'=>'Cannot Open DataBase'));
  $query = new PDO('sqlite:'.$DATABASE) or die(json_encode($textbot));
  $comand = "SELECT perguntas.id,entrada,pergunta,respostas.resposta,respostas.id as idr FROM perguntas ".
            "LEFT JOIN  respostas on  perguntas.resposta_id = respostas.id";
  $tabelas = $query->query($comand);  
  $respostas='';				
  	foreach ($tabelas as $row){
				
  ?>
											<tr>
												<td><?php echo $row['id'];?></td>
												<td><?php echo $row['entrada'];?></td>
												<td><?php echo $row['idr'];?></td>
											</tr>										
  <?php 
		if($row['idr']!=null){
			$respostas.="<tr><td>".$row['idr']."</td>".
			"<td>".$row['resposta']."</td>".
			"<td>".$row['id']."</td></tr>";
		}
	} ?>
											   
										
										
									</tbody><tfoot><tr><td></td><td></td><td></td></tr></tfoot>
									</table>
	</div>
	
	<!--TABVIEW TAB2 -->
	<div id="tabs-2">
									<table class="alt">
									<thead><tr><th>ID</th><th>Resposta</th><th>Perg</th></tr></thead><tbody>
  <?php
	echo $respostas;
  ?>		
											
									</tbody><tfoot><tr><td></td><td></td><td></td></tr></tfoot>
									</table>
		
	</div>
									
									
								</section>
									
									
								<section>
								<div class="row" align="center" style="display: block;">  
										<div class="col-12 col-12-xsmall">											
											<a href="#" class="button" >Default</a>
										</div>
										<div class="col-12 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="#" class="button" >Default</a>
										</div>
										<div class="col-12 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="#" class="button" >Default</a>
										</div>
										<div class="col-12 col-12-xsmall" style="margin-top: 0.5em;">
											<a href="#" class="button" >Default</a>
										</div>
								</div>
										
					
								</section>
							</div>
						</div>
					</section>
		<?php
				}
		 }
		?>
		

				<!-- Four -->
					<section id="four" class="wrapper style1 fade-up">
						<div class="inner">
							<h2>Contato</h2>
							<p>Preencha o formulário abaixo para entrar em contato.<br>Não armazenamos currículos em nosso banco de dados.</p>
							<div class="split style1">
								<section>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="name">Name</label>
												<input type="text" name="name" id="name" />
											</div>
											<div class="field half">
												<label for="email">Email</label>
												<input type="text" name="email" id="email" />
											</div>
											<div class="field">
												<label for="message">Message</label>
												<textarea name="message" id="message" rows="5"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><a href="" class="button submit">Send Message</a></li>
										</ul>
									</form>
								</section>
								<section>
									<ul class="contact">
										<li>
											<h3>Endereço</h3>
											<span><?php echo $SITE_ENDERECO;?></span>
										</li>
										<li>
											<h3>Email</h3>
											<a href="mailto:<?php echo $SITE_MAIL;?>"><?php echo $SITE_MAIL;?></a>
										</li>
										<li>
											<h3>Telefone</h3>
											<span><?php echo $SITE_PHONE;?></span>
										</li>
										<li>
											<h3>Social</h3>
											<ul class="icons">
												<?php
												if($SITE_CONT_TWITTER!=''){
													echo '<li><a href="'.$SITE_CONT_TWITTER.'" class="fa-twitter"><span class="label">Twitter</span></a></li>';					
												}
												if($SITE_CONT_FACEBOOK!=''){
													echo '<li><a href="'.$SITE_CONT_FACEBOOK.'" class="fa-facebook"><span class="label">Facebook</span></a></li>';					
												}
												if($SITE_CONT_GITHUB!=''){
													echo '<li><a href="'.$SITE_CONT_GITHUB.'" class="fa-github"><span class="label">GitHub</span></a></li>';					
												}
												if($SITE_CONT_INSTAGRAM!=''){
													echo '<li><a href="'.$SITE_CONT_INSTAGRAM.'" class="fa-instagram"><span class="label">Instagram</span></a></li>';					
												}
												if($SITE_CONT_LINKEDIN!=''){
													echo '<li><a href="'.$SITE_CONT_LINKEDIN.'" class="fa-linkedin"><span class="label">LinkedIn</span></a></li>';					
												}
												?>

											</ul>
										</li>
									</ul>
								</section>
							</div>
						</div>
					</section>

			</div>

		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="/js/jquery.min.js"></script>
			<script src="/js/jquery.scrollex.min.js"></script>
			<script src="/js/jquery.scrolly.min.js"></script>
			<script src="/js/browser.min.js"></script>
			<script src="/js/breakpoints.min.js"></script>
			<script src="/js/util.js"></script>
			<script src="/js/main.js"></script>
	        <script src="/js/jquery-ui.js"></script>
		    <script src="/index.js"></script>

	</body>
</html>