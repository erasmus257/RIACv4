<!doctype html>
<html lang="fr">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Portail e-learning <?=$portail_title?></title>
	<link href="../css/background_login.css" rel="stylesheet" media="all"	type="text/css"> 
	<link href="<?=$css_login_etab ?>" rel="stylesheet" media="all"	type="text/css">
	<link href="<?=$css_admin_etab ?>" rel="stylesheet" media="all"	type="text/css">
	
	<!--[if IE]>
		<script src="../js/html5-ie.js"></script>
	<![endif]-->
</head>

<body>
<header>
	<img src=<?='../img/logo_portail/'.$logo_etab?> id="login_logo" alt="Logo de l'établissement" />
	<div id="page_title" >PLATEFORME E-LEARNING</div>
</header>

<section>
	<div id="admin_menu">
		<?php 
		foreach  ( $menu_admin as $rubrique => $options){		
			echo '<a class="rubrique" href="#" data-icon="&#59226;">'.$rubrique.'</a>';
				echo'<div class="admin_outils">';
				foreach ($options as $option => $code){					
					echo '<a class="opt" id="'.$code.'" href="#" data-icon="&#59226;">'.$option.'</a>';
				}
				echo '</div>';
			}
		?>		
	</div>		
	

</section>
<footer>
	<a id="mention" href="#" >MENTIONS LEGALES</a>   
</footer>
</body>
<script type="text/javascript" src="../js/html5-ie.js" ></script>
<script type="text/javascript" src="../js/jquery-2.1.0.js" ></script>
<script type="text/javascript" src="../js/mention.js" ></script>


<script type="text/javascript">	
	
	$(document).ready(function(){
		
		function ahover(){
			var f =""
			$(".rubrique").hover(function(){
								if (!$(this).hasClass('selected')){								
								$(this).css("font-size", "20px");
								}							
						},function(){
								if (!$(this).hasClass('selected')){
								$(this).css("font-size", "16px");
								}
						});
			
		}
		
		function optclick() {			
			//$(".opt").css("font-weight", "normal");
			$(".opt").removeClass("selected");
			$("#admin_formulaire").remove();
			$("#admin_menu").after("<div id=\"admin_formulaire\"></div>");
			//$(this).css("font-weight", "bold");
			$(this).addClass("selected");
			$("#admin_formulaire").load("form.php", "opt="+$(this).attr("id"));			
			$("#admin_formulaire").on('click', '.formSubmit', function(){
				$("#admin_result").remove();
				$("#admin_formulaire").after("<div id=\"admin_result\"></div>");
				$('#admin_result').load("result.php");							
			});			
		}	
				
		$(".rubrique").click(function(){
			$("#admin_result").remove();
			$("#admin_formulaire").remove();
			$(".admin_outils").css('display','none');
			$(".rubrique").css("font-size", "16px");
			if ($(this).hasClass('selected')){
				$(this).removeClass('selected')
				$(this).css("font-size", "16px");
			}else{
				$(".rubrique").removeClass('selected')
				$(this).css("font-size", "26px");				
				$(this).addClass('selected')
				$(this).next(".admin_outils").css('display','block');				
				$(".admin_outils").on("click", ".opt", optclick);				
				$(this).next(".admin_outils").children("a:first").trigger("click");			
			}			
		});
		
		ahover();
		
	});

</script>
</html>