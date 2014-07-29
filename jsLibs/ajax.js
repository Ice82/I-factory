$(document).ready(function()
	  {
	   genericErrorFunction = function()
	    {
	    	alert('Errore di trasmissione/ricezione dei dati');
	    }
	    
	    genericSuccessFunction = function()
	    {
	    	alert('Operazione effettuata');
	    }
	    
	    sendAjax = function(indirizzo,tipo,tipoDati,time,dati,form,success,error,overlay)
	    {
			if(overlay==1)
			 {
			  //createOverLay();
			  jQuery.blockUI({ message:'Caricamento in corso...',css: { 
              border: 'none',  
			  width:'350px',
              //height: '20px',
			  padding:'30px 0',
			  fontWeight:'bold',
			  fontFamily:'Verdana, Arial, Helvetica, sans-serif',
              fontSize:'12px',
              border:'2px solid #69c',
			  backgroundColor: '#FFFFFF', 
			  backgroundImage: 'url(css/entity//ajax-loader.gif)',
			  backgroundRepeat: 'no-repeat',
			  backgroundPosition: '10% 50%',
              '-webkit-border-radius': '10px', 
              '-moz-border-radius': '10px', 
              opacity: '.5', 
              color: '#69c' 
              } }); 
			 }
			 
	    	if(!tipo) tipo = 'POST';
	    	if(!tipoDati) tipoDati = 'html';
	    	if(!time) time = 10000;
	    	if(!success) success = 'genericSuccessFunction()';
	    	if(!error) error = 'genericErrorFunction()';
	    	
	    	var parametri = dati;
	    	parametri = parametri+"&"+$("#"+form).serialize();
	    	$.ajax({
    				url: indirizzo,
    				type: tipo,
    				dataType: tipoDati,
    				data: parametri,
    				timeout: time,
    				error: function(){
						if(overlay==1)
						 jQuery.unblockUI();
						
    					eval(error);
    				},
    				success: function(result){
						if(overlay==1)
						 jQuery.unblockUI();
						 
    					eval(success);
    				}
				});
	    }
	    
      });