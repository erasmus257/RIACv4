


<?php

$id = $_GET["opt"];

echo '<form class="formulaire" id="form'.$id.'" action="" method="POST">';
	switch ($id) {
		case "u1":
			echo '<label for="firstname">Pr&eacute;nom :</label>
			<input name="firstname" id="firstname" type="text" />';
			echo '<label for="lastname">Nom :</label>
			<input name="lastname" id="lastname" type="text" />';
			break;
		case "u2":
			echo '<label for="firstname">Pr&eacute;nom :</label>
			<input name="firstname" id="firstname" type="text" />';
			echo '<label for="lastname">Nom :</label>
			<input name="lastname" id="lastname" type="text" />';
			echo '<label for="email">Email :</label>
			<input name="email" id="email" type="email" />';
			break;
		case "c1":
		
			echo '<label for="intitule">Intitul&eacute; :</label>
			<input name="intitule" id="intitule" type="text" />';
			echo '<label for="code">Code :</label>
			<input name="code" id="code" type="text" />';			
			break;	
		case "c2":
			echo '<label for="intitule">Intitul&eacute; :</label>
			<input name="intitule" id="intitule" type="text" />';
			echo '<label for="code">Code :</label>
			<input name="code" id="code" type="text" />';
			echo '<label for="format">Format :</label>
			<select name="format" id="format">
				<option value="Valeur1">Valeur1</option>
				<option value="Valeur2">Valeur2</option>
				<option value="Valeur3">Valeur3</option>
			</select>';
			echo '<label for="resume">R&eacute;sum&eacute; :</label>
			<textarea name="resume" id="resume" type="text" rows="8"></textarea>';			
			break;
		case "s1":
			echo '<label for="intitule">Intitul&eacute; :</label>
			<input name="intitule" id="intitule" type="text" />';
	}
	echo '<a id="valide" href="#" >Validez</a>';
	echo '</form>';
?>	
	