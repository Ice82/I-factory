$(document).ready(function(){

	// Menù - START
    $('#menu_visualizza').click(function(){
		$(this).html("<a href=\"#\" class=\"active\"><span><span>Visualizza</span></span></a>");
		$("#menu_nascondi").html("<a href=\"#\"><span><span>Nascondi</span></span></a>");
		$("#div_menu_top").show();
   	});

    $('#menu_nascondi').click(function(){
		$(this).html("<a href=\"#\" class=\"active\"><span><span>Nascondi</span></span></a>");
		$("#menu_visualizza").html("<a href=\"#\"><span><span>Visualizza</span></span></a>");
		$("#div_menu_top").hide();
   	});
    // Menù - END

});

function popolaSelectSezioniModulo(result)
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
		 var option = '<option value="0">Scegli il contratto</option>';
		 for(var i = 0;i<result.result.length;i++)
		  {
		      //var nome = result.result[i].NOME;
			  option = option + '<option value="'+result.result[i].ID+'">'+result.result[i].NOME+'</option>';
		  }
		  //alert(option);
		  $('#sezioni').html(option);
		}
	  }
	 else
	  $('#sezioni').html('<option value="0">Nessuna sezione</option>');
}


function popolaSelectProdotti(result)
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
		 var option = '<option value="0">Scegli prodotto</option>';
		 for(var i = 0;i<result.result.length;i++)
		  {
		      //var nome = result.result[i].NOME;
			  option = option + '<option value="'+result.result[i].ID+'">'+result.result[i].nomeMarca+' - '+result.result[i].nome+'</option>';
		  }
		  //alert(option);
		  $('#prodotto').html(option);
		}
	  }
	 else
	  $('#prodotto').html('<option value="0">Nessuna prodotto</option>');
}



function changeStatoUser(result)
{
	var div = "stato"+result.utente; 
	$('#'+div).html(result.testo);
}
