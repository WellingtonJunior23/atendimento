
var $submit = jQuery.noConflict();

$submit(function() 
{
	
	$submit("form").submit(function() 
	{
		$submit("#novoteste").html("TESTE");

		//alert("TESTE");
		// ReadOnly em todos os inputs
		
//Se validate estiver ativo
	        if (validate() == true) 
	        {
// ReadOnly em todos os inputs
	        	$submit("input", this).attr("readonly", true);		
// Desabilita os submits
	        	$submit("input[type='submit'],input[type='image']", this).attr("disabled", true);			
	        	$submit("#novoteste").html("Aguarde");
	        	alert("TESTE");
	        	
			           //return true;
			 }else 
			 {
				 alert("TESTE");
				 return false;
			 }
			
	});		
})(jQuery);
