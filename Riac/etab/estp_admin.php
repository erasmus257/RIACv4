<?php
//////////////////////////////////
//ADMINISTRATION DU MOODLE UPEM //
//////////////////////////////////

$mode ="admin";

$etab = array 	(
				'nom' => 'upem',
				'logo' => '../img/logo_portail/logo_estp.jpg',
				'css' => '../css/etab/estp.css',
				'titre' => 'de l\'ESTP',
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
							/*'Statistiques' => array ('Consulter' => 's1')*/
						);

include '../background.php';

?>