<?php
	$backgroundCss = '../css/background.css';
	$mentionJs = '../js/mention.js';
	$jqueryJs = '../js/jquery-2.1.0.js';
	$html5ieJs = '../js/html5-ie.js';
	switch ($mode){
		case "admin":
			$modeCss = '../css/admin.css';
			$modeJs = '../js/admin.js';
			$titre = 'ADMINISTRATION E-LEARNING';			
		break;
		case "login":
			$titre = strtoupper('PLATEFORME E-LEARNING '.$etab['titre']);
			$modeCss = '../css/login.css';
			$modeJs = '../js/login.js';
		break;
		case "portail":
			$titre = 'PORTAIL E-LEARNING';
			$modeCss = 'css/portail.css';
			$modeJs = 'js/portail.js';
			
			$backgroundCss = 'css/background.css';
			$mentionJs = 'js/mention.js';
			$jqueryJs = 'js/jquery-2.1.0.js';
			$html5ieJs = 'js/html5-ie.js';
		break;
}
?>

<!doctype html>
<html lang="fr">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Portail e-learning <?=$etab['titre']?></title>
	<link href="<?=$backgroundCss?>" rel="stylesheet" media="all"	type="text/css"> 
	<link href="<?=$etab['css']?>" rel="stylesheet" media="all"	type="text/css">
	<link href="<?=$modeCss?>" rel="stylesheet" media="all"	type="text/css">
	
	<!--[if IE]>
		<script src="../js/html5-ie.js"></script>
	<![endif]-->
</head>

<body>

<header>
	<img src=<?=$etab['logo']?> id="login_logo" alt="Logo de l'établissement" />
	<div id="page_title" ><?=$titre?></div>
</header>


<div id="corps">

<?php
switch ($mode){
	case "admin":
		include 'admin/admin.php';
		break;
	case "login":
		include 'login/login.php';
		break;
	case "portail":
		include 'login/portail.php';
		break;
}
?>
</div>
<footer>
	<a id="mention" href="#" >MENTIONS LEGALES</a>   
</footer>
</body>
<script type="text/javascript" src="<?=$html5ieJs?>" ></script>
<script type="text/javascript" src="<?=$jqueryJs?>" ></script>
<script type="text/javascript" src="<?=$modeJs?>" ></script>
<script type="text/javascript" src="<?=$mentionJs?>" ></script>



</html>