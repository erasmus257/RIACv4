<?php
//////////////////////////////////
//ADMINISTRATION DU MOODLE UPEM //
//////////////////////////////////

$mode ="admin";

$etab = array 	(
				'nom' => 'upem',
				'logo' => '../img/logo_portail/logo_UPEM.png',
				'css' => '../css/etab/upem.css',
				'titre' => 'de l\'UPEM',
				);
				
/*				
$link_form = 'http://localhost/portail_moodle/admin/admin_upem_bis.php';
*/

$menu_admin = array 	(	'Utilisateurs' => array (	'Rechercher' => 'u1', 
														'Ajouter' => 'u2'
													), 
							'Espace de cours' => array (	'Rechercher' => 'c1', 
												'Créer' => 'c2'
											), 
							'Statisques' => array ('Consulter' => 's1')	
							
						);

include '../background.php';

?>