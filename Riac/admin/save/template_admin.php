<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Portail e-learning <?=$portail_title?></title>
<link href="../css/background_login.css" rel="stylesheet" media="all"	type="text/css"> 
<link href="<?=$css_login_etab ?>" rel="stylesheet" media="all"	type="text/css">
<link href="<?=$css_admin_etab ?>" rel="stylesheet" media="all"	type="text/css">  
</head>

<body>
<header>
	<img src=<?='../img/logo_portail/'.$logo_etab?> id="login_logo" alt="Logo de l'établissement" />
	<div id="page_title" >PLATEFORME E-LEARNING</div>
</header>

<section>		

	<div class="admin_tools">
		<div class="menu">
			<b>Utilisateurs</b>
			<a class="add_button" id="add_button_user" href="#"></a>
			<a class="search_button" id="search_button_user" href="#"></a>
		</div>		
		<form class="formulaire" id="add_user" action="<?=$link_form?>" method="POST">
			<label for="firstname">Pr&eacute;nom :</label>
			<input name="firstname" id="firstname" type="text" />
			<label for="lastname">Nom :</label>
			<input name="lastname" id="lastname" type="text" />
			<label for="email">Email :</label>
			<input name="email" id="email" type="email" />			
			<div>
				<a class="close_button" href="#" ></a>
				<a class="valid_button" href="#" >Validez</a>
				<a class="reset_button" href="#" >Reset</a>
			</div>
			<input type="hidden" name="add_user" />
		</form>
		<form class="formulaire" id="search_user" action="<?=$link_form?>" method="POST">
			<label for="firstname">Pr&eacute;nom :</label>
			<input name="firstname" id="firstname" type="text" />
			<label for="lastname">Nom :</label>
			<input name="lastname" id="lastname" type="text" />
			<div>
				<a class="close_button" href="#" ></a>
				<a class="valid_button" href="#" >Validez</a>
				<a class="reset_button" href="#" >Reset</a>
			</div>
			<input type="hidden" name="search_user" />
		</form>
	
	
		<div class="menu">
			<b>Cours</b>
			<a class="add_button" id="add_button_cours" href="#"></a>
			<a class="search_button" id="search_button_cours" href="#"></a>			
		</div>
		<form class="formulaire" id="add_cours" action="<?=$link_form?>" method="POST">
			<label for="intitule">Intitul&eacute; :</label>
			<input name="intitule" id="intitule" type="text" />
			<label for="code">Code :</label>
			<input name="code" id="code" type="text" />
			<label for="format">Format :</label>
			<select name="format" id="format">
				<option value="Valeur1">Valeur1</option>
				<option value="Valeur2">Valeur2</option>
				<option value="Valeur3">Valeur3</option>
			</select>			
			<label for="resume">R&eacute;sum&eacute; :</label>
			<textarea name="resume" id="resume" type="text" rows="8"></textarea>
			<div>
				<a class="close_button" href="#" ></a>
				<a class="valid_button" href="#" >Validez</a>
				<a class="reset_button" href="#" >Reset</a>
			</div>			
		</form>
		<form class="formulaire" id="search_cours" action="<?=$link_form?>" method="POST">
			<label for="intitule">Intitul&eacute; :</label>
			<input name="intitule" id="intitule" type="text" />
			<label for="code">Code :</label>
			<input name="code" id="code" type="text" />			
			<div>
				<a class="close_button" href="#" ></a>
				<a class="valid_button" href="#" >Validez</a>
				<a class="reset_button" href="#" >Reset</a>
			</div>			
		</form>
		
		
		<div class="menu">
			<b>Statistique</b>
			<a class="add_button" id="add_button_cours" href="#"></a>
			<a class="search_button" id="search_button_cours" href="#"></a>			
		</div>
	</div>
	<div class="admin_tools">
		<?php
		if (isset ($_POST["add_user"])){
			echo "Bou";
		}elseif (isset ($_POST["search_user"])){
			echo "BouBou";
		}
		?>
	</div>
	
</section>

<footer>
	<a id="mention" href="#" >MENTIONS LEGALES</a>   
</footer>
</body>

<script type="text/javascript" src="../js/jquery-2.0.3.min.js" ></script>
<script type="text/javascript" src="../js/mention.js" ></script>
<script type="text/javascript">
	
	function menu (param1, param2){
		$(param1).parent().parent().children(".formulaire").css('display','none');
		$(param1).parent().parent().children(param2).css('display','block');
		$('.valid_button').click(function(){
				$(param2).submit();
			});
		$('.close_button').click(function(){
			$(this).parent().parent().css('display','none');
		});	
	}
	
	
	$(document).ready(function(){		
		$("#add_button_user").click(function(){
			menu(this, "#add_user");													
		});
		$("#search_button_user").click(function(){
			menu (this, "#search_user");				
		});
		$("#add_button_cours").click(function(){
			menu (this, "#add_cours");											
		});
		$("#search_button_cours").click(function(){
			menu (this, "#search_cours");											
		});
	});

</script>

</html>