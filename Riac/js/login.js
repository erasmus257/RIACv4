$("#valide").click(function(){
	$("#username").val('');
	if ($("#etab").val() != 'upem'){
		$("#username").val($("#etab").val() + '_'+ $("#login").val());
	}	
	$("#login_form").submit();	
});
		

