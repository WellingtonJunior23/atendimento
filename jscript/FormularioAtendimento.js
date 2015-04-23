// JavaScript Document

var $mas = jQuery.noConflict();

$mas(document).ready(function(){
	
$mas("#atendimento").toggle(
		function(){
	          
		       $mas("#esconder").hide();
		       $mas("#atendimento").html('<a href="#">Informa&ccedil;&otilde;es do Atendimento [Mostrar]</a>').css("color","#06C");
		       
	        },
	    function(){
		       $mas("#esconder").show('slow');
		       $mas("#atendimento").html('<a href="#">Informa&ccedil;&otilde;es do Atendimento [Esconder]</a>').css("color","#06C");
		       
	        });
});