// JavaScript Document
$(document).ready(function(e) {
	$('#logowanie input[name="submit"]').click(function(){
		var data = $('#logowanie').serialize();
		data +="&submit=1";
		var wynik=11;
		
		$.ajax({
		  type: 'POST',
		  url: "script/_php/login.php",
		  data: data,
		  dataType: 'html',
		  async: false,
		  success: function(result){wynik = result;}
		});
		
		console.log(wynik);
		if(wynik == 1){
			return;
			}else
			{
				$('.error').show().text(wynik);
				return false;
				}
	});		
});