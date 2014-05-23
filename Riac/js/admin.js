$(document).ready(function(){
		
		function ahover(){
			var f =""
			$(".rubrique").hover(function(){
								if (!$(this).hasClass('selected')){								
								$(this).css("font-size", "20px");
								}							
						},function(){
								if (!$(this).hasClass('selected')){
								$(this).css("font-size", "16px");
								}
						});
			
		}
		
		function optclick() {			
			//$(".opt").css("font-weight", "normal");
			$(".opt").removeClass("selected");
			$("#admin_formulaire").remove();
			/*$("#admin_menu").after("<div id=\"admin_formulaire\"></div>");*/
			$("#admin_menu").after("<div id=\"admin_formulaire\"></div>");
			//$(this).css("font-weight", "bold");
			$(this).addClass("selected");
			$("#admin_formulaire").load("../admin/form.php", "opt="+$(this).attr("id"));			
			$("#admin_formulaire").on('click', '.formSubmit', function(){
				$("#admin_result").remove();
				$("#admin_formulaire").after("<div id=\"admin_result\"></div>");
				$('#admin_result').load("../admin/result.php");							
			});			
		}	
				
		$(".rubrique").click(function(){
			$("#admin_result").remove();
			$("#admin_formulaire").remove();
			$(".admin_outils").css('display','none');
			$(".rubrique").css("font-size", "16px");
			if ($(this).hasClass('selected')){
				$(this).removeClass('selected')
				$(this).css("font-size", "16px");
			}else{
				$(".rubrique").removeClass('selected')
				$(this).css("font-size", "26px");				
				$(this).addClass('selected')
				$(this).next(".admin_outils").css('display','block');				
				$(".admin_outils").on("click", ".opt", optclick);				
				$(this).next(".admin_outils").children("a:first").trigger("click");			
			}			
		});
		
		ahover();
		
	});