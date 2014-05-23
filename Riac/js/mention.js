$(document).ready(function(){
	var m = 1
	$('#mention').click(function(){
		if (m == 1){
			$(this).after('<div style="margin-top:20px; margin-bottom:20px;"><p style="color:#FFFFFF; font-family:arial;">Copyright &copy; Campus Num&eacute;rique 2013</p><a href="mailto:campus.numerique@univ-mlv.fr" style="color:#e85510;">Contactez-nous</a></div> ');
			m = 0;
		}else{
			$(this).next().remove();
			m = 1;
		}
	});	
});