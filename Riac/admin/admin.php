<section id="section1">	
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
<section id="section2">	
</section>
<section id="section3">
</section>	