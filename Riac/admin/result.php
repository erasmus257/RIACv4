



<!--
<div>
	<span>Matricule</span>
	<span>Nom/pr&eacute;nom</span>
	<span>Profile Moodle</span>
	<span>Inscription cours</span>
</div>
-->
<?php
		for( $i=0 ; $i<200 ; $i++){
			echo '<a class="ligne">00000000000 - Duce Jean-Claude</a>';
			}
		
		if (isset ($_POST["add_user"])){
			echo "Bou";
		}elseif (isset ($_POST["search_user"])){
			echo "BouBou";
		}
?>