<script type="text/javascript" src="jsLibs/jquery-1.3.2.js"></script>
<script type="text/javascript" src="../jsLibs/ajax.js"></script>
<script type="text/javascript" src="jsLibs/jquery.cycle.all.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-3526732-23']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#bannerLEFT, #bannerTOPS, #bannerBOTS').cycle({
    fx:'fade',
    speed:  5000,
    timeout: 2000
  });
});

function popolaColori(result)
{
	 if(!result)
	 {
	  var result=new Array();
	  result.esito=false;
	 }
	 
	 if(result.esito==true)
	  {
	   if(result.result.length>0)
	    {
		 var option = '<h3>COLORE</h3>';
		 for(var i = 0;i<result.result.length;i++)
		  {
		      //var nome = result.result[i].NOME;
			  option = option + '<input name="colore" type="radio" class="colore" value="'+result.result[i].ID+'" /><span>'+result.result[i].colore+'</span>';
			  					
		  }
		  //alert(option);
		  $('#colore').html(option);
			 $('.colore').click(function(){
			    	sendAjax("../../ajaxRequest/queries.php","","json","5000","task=getQtaFromColoreID&id="+$(this).val()+"","cerca","popolaQta(result)","","0");
			 });
		}
	  }
	 else
	  $('#colore').html('<option value="0">Nessuna colore disponibile</option>');
}

function popolaQta(result)
{
	 if(!result)
	 {
	  var result=new Array();
	  result.esito=false;
	 }
	 
	 if(result)
	  {
		 var option = '<h3>QUANTIT&Agrave;</h3>';
		 option = option + '<select name="qta">';
		 for(var i = 1;i<=result.result;i++)
		  {
		      //var nome = result.result[i].NOME;
			  option = option + '<option value="'+i+'">'+i+'</option>';
			  					
		  }
		  option = option + '</select>';
		  //alert(option);
		  $('#qta').html(option);
		  $('#pulsanteCarello').show();
	  }
	 else{
	  $('#qta').html('<p>Nessuna quantit&agrave; disponibile</p>');
	 }
}


</script>
