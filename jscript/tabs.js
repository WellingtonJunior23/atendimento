/*
<!-- 
   fun��o para ativar a funcionalide
   das tabs.
 -->
<script>


  $(function() {
    $( "#tabs" ).tabs();
    $(".campoData").mask("99/99/9999");
  });
</script>


var $tab = jQuery.noConflict();

$tab(function() {
	$tab( "#tabs" ).tabs();
  })(jQuery);
*/


var $direcionar = jQuery.noConflict();


$direcionar(document).ready(function(){

$direcionar("#limparFiltros").click(function(){

	//$direcionar("input[name='limpar']").val("Aguarde");
	
	$direcionar("select[name='sat_codigo']").val("");
	$direcionar("select[name='ta_codigo_busca']").val("");	
	$direcionar("select[name='usu_codigo']").val("");
	$direcionar("select[name='td_codigo']").val("");
	$direcionar("select[name='ttp_codigo']").val("");
	
	$direcionar("input[name='at_paciente']").val("");
	$direcionar("input[name='at_descricao_busca']").val("");	
	$direcionar("input[name='at_medicamento']").val("");
	$direcionar("input[name='at_processo']").val("");
	$direcionar("input[name='data1']").val("");
	$direcionar("input[name='data2']").val("");
	
	$direcionar("#at_localidade").attr("checked",false);
	
	$direcionar("#informacao").show(1000).hide(1000);

	
});

	$direcionar('select[name="ta_codigo"]').change(function(){
	
		var codigo_id = $direcionar("select[name='ta_codigo']").val();
		$direcionar.post('meustiposderespostas.php',
				{at_codigo: codigo_id},
				function(data){
					$direcionar("select[name='tir_codigo']").html(data);
					$direcionar("textarea[name='at_descricao']").html('');
				},
		'html');				
		return false;
	});
	
	$direcionar('select[name="tir_codigo"]').change(function(){
		
		var codigo_id = $direcionar("select[name='tir_codigo']").val();
		$direcionar.post('carregarResposta.php',
				{tir_codigo: codigo_id},
				function(data){
					$direcionar("textarea[name='at_descricao']").html(data);
				},
		'html');				
		return false;
	});
	
	$direcionar('select[name="tap_codigo"]').change(function(){
		
		var codigo_id = $direcionar("select[name='tap_codigo']").val();
		$direcionar.post('carregarApontamento.php',
				{tap_codigo: codigo_id},
				function(data){
					$direcionar("textarea[name='ap_descricao']").html(data);
				},
		'html');				
		return false;
	});

});

