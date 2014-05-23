<?php

$mode = 'portail';

$etab = array 	(
				'nom' => 'upe',
				'logo' => 'img/logo_portail/logoUPE.jpg',
				'css' => 'css/portail.css',
				'titre' => '',
				'log_link' => 'httpUpem',
				);

 
$etabs = 	array(
			'UPEM' => array ('logo_UPEM.png' => 'etab/upem_login.php'),
			'ESTP' => array ('logo_estp.png' => 'etab/estp_login.php'),	
			'EAMLV' => array('Marne-La-Vallee_list-first-item-16-9.jpg' => 'etab/ensavt_login.php'),			
			);

include 'background.php';
?>