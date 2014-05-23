<section id="section1">		
<?php
	echo '<div id="menu_etabs">';
	foreach ($etabs as $etab =>$elements) {	
		foreach ($elements as $logo => $link){
			echo '<div>
				<a class="etabs" href="'.$link.'" title="'.$etab.'"><img  src="img/logo_mini/'.$logo.'"></a>
				</div>';
			
		}
	}			
?>	
</section>

<section id="section2">

</section>
<section id="section3">
		
</section>