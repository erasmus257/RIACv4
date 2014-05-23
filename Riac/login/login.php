<section id="section1">		
	<form id="login_form" action="https://elearning.univ-mlv.fr/login/index.php" method="post" name="loginform" >		
		<input type="hidden" id="log_link" name="login_link" value="<?=$etab['log_link']?>" />
		<input type="hidden" id="etab" name="etab" value="<?=$etab['nom']?>" />
		<input type="hidden" id="username" name="username" />
		<label class="labelLog" for="login">LOGIN :</label>
		<input class="inputLog"id="login" type="text" name="login" required />
		<label class="labelLog" for="password">PASSWORD :</label>
		<input class="inputLog" id="password" type="password" name="password" required />
		<input id="valide" type="submit"  />
	</form>
	<?php 
		setcookie('login_link', $etab['log_link'], time() + 365*24*3600, "/", "elearning.univ-mlv.fr", false, false);
		if (isset($_GET["err"])){
			echo '<div id="login_error">Login ou password incorrect !</div>';
		}
	?>	
</section>	
<section id="section2">		
	
</section>	
<section id="section3">
</section>		