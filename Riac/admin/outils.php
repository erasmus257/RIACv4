<?php
$rub = $_GET["rub"];

switch ($rub){
	case "user":
		echo '<a class="opt" id="searchuser" href="#" data-icon="&#59226;">Recherche</a>';
		echo'<a class="opt" id="adduser" href="#" data-icon="&#59226;">Ajout</a>';
		break;
	case "cours":
		echo '<a class="opt" id="searchcours" href="#" data-icon="&#59226;">Recherche</a>';
		echo'<a class="opt" id="addcours" href="#" data-icon="&#59226;">Ajout</a>';
		break;
	case "stat":
		echo '<a class="opt" id="" href="#" data-icon="&#59226;">Consulter</a>';		
		break;
}
?>