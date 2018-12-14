// JavaScript Document
$(document).ready(function(e) {
var disable = false;
var orgName = "";
var	orgSurname = "";
var	orgPrice = "";
var	orgComment = "";
function createPrompt()
{
	var div = $("<div></div>", {id: "prompt"});
	var qu = $("<p></p>").text("Czy na pewno chcesz usunać dany rekord z bazy?");
	var tak = $("<a></a>",{href: "#", id: "tak"}).text("Tak");
	var nie = $("<a></a>",{href: "#", id: "nie"}).text("Nie");
	
	div.append(qu).append(tak).append(nie);
	$("#container").append(div);
}

$("#paginacja").find(".paginacja").first().addClass("active");

$('#stats').hide();

$("#statystyki").fancybox();
	
function usuwanie(){
	if(disable == true)
	{
		return;	
	}
	var id = $(this).data("id");
	console.log("id: "+id);
	createPrompt();
	$('#tak').data("id", id);
	console.log($('#tak').data("id"));
	
	$.fancybox.open("#prompt", {
	closeBtn: false,
	modal: true
		});
	
	$("#prompt #tak").click(function(){
		//alert("id: "+$(this).data("id"));	
		var id = $(this).data("id");
		var data = "delete="+ id;
		$.ajax({
			type: 'POST',
			url: "script/_php/confirm.php",
			data: data,
			dataType: 'html',
			async: false,
			success: function(result){
				var ed = $("a[data-id="+id+"]").parent().parent();
				ed.remove();
				$("#prompt #nie").click();	
				
				var data = "strona="+$(".active").data("page");
				console.log(data);
				
				$.ajax({
				type: 'POST',
				url: "script/_php/paginacja.php",
				data: data,
				dataType: 'html',
				async: false,
				success: function(result){
					$("tbody tr").not("#table-header").remove();	
					$("tbody").append(result);
					$('.delete').click(usuwanie);
					$("tr").dblclick(edytowanie);
				}});
			}});
		});
	
	$("#prompt #nie").click(function(){
		$.fancybox.close();
		$("#prompt").remove();
		$(".fancybox-placeholder").remove();
		return false;
	});
}
$('.delete').click(usuwanie);
	
$("tr").dblclick(edytowanie);
	
//Edycja wybranego wpisu z tabeli
function edytowanie(){
	if(disable==true || $(this).attr("id") == "table-header"){
		return;
	}
	disable=true;
	var row = $(this);
	
	orgName = row.find("#imie").text();
	orgSurname = row.find("#nazwisko").text();
	orgPrice = row.find("#kwota").text();
	orgComment = row.find("#uwagi").text();
	
	var struct = $(this).html();
	
	
	$(this).find("#delete").removeClass("btn-warning").addClass("btn-success").text("Edytuj").removeClass("delete").addClass("edit");
	
	$(this).find(".val").each(function() {
		var valuee = $(this).text();
		var input = $("<input></input>",{name: $(this).attr("id"), type: "text", value: valuee, class: "form-control input-sm"});	
		$(this).html(input);
	});
	
	
	$(document.documentElement).on("keyup", function(e){
		if(e.keyCode==27)
			{

				$(".edit").parent().parent().find("#imie").text(orgName);	
				$(".edit").parent().parent().find("#nazwisko").text(orgSurname);
				$(".edit").parent().parent().find("#kwota").text(orgPrice);
				$(".edit").parent().parent().find("#uwagi").text(orgComment);

				$(".edit").removeClass("btn-success").addClass("btn-warning").text("Usuń").removeClass("edit").addClass("delete");
				disable = false;
			}
		});
		
	$(".edit").click(function(){
		var name = $("input[name='imie']").val(),
		surname = $("input[name='nazwisko']").val(),
		payback = $("input[name='kwota']").val(),
		comment = $("input[name='uwagi']").val();
		var data = "imie="+name+"&nazwisko="+surname+"&kwota="+payback+"&uwagi="+comment+"&edytuj="+$(this).data("id");
		console.log(data);
		$.ajax({
			type: 'POST',
			url: "script/_php/confirm.php",
			data: data,
			dataType: 'html',
			async: false,
			success: function(result){
					$(".edit").parent().parent().find(".form-control").each(function(){
					var value = $(this).val();
					
					$(this).parent().text(value);	
				});
			}});
		$(".edit").removeClass("btn-success").addClass("btn-warning").text("Usuń").removeClass("edit").addClass("delete");
		disable = false;

	});
}


function nowyRekord(){
		var index = parseInt($("tbody tr").last().find("#index").text()) + 1;
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();
		var year = d.getFullYear().toString();
		
		var data = day + '.' +
			(month<10 ? '0' : '') + month + '.' +
			(day<10 ? '0' : '') + year.substr(2, 3);

		
		var row = $("<tr></tr>", {id: "new"}),
			ind = $("<td></td>",{ id: 'index'}).text(index),
			nam = $("<td></td>",{ id: 'imie', class: 'val'}),
			sur = $("<td></td>",{ id: 'nazwisko', class: 'val'}),
			pri = $("<td></td>",{ id: 'kwota', class: 'val'}),
			dat = $("<td></td>",{ id: 'data',}).text(data),
			com = $("<td></td>",{ id: 'uwagi', class: 'val'}),
			dod = $("<td></td>",{ id: 'dodal'}),
			but = $("<td></td>",{ id: "button" }),
			inNam = $("<input></input>",{name: "imie", type: "text", value: "", class: "form-control input-sm"}),
			inSur = $("<input></input>",{name: "nazwisko", type: "text", value: "", class: "form-control input-sm"}),
			inPri = $("<input></input>",{name: "kwota", type: "text", value: "", class: "form-control input-sm"}),
			inCom = $("<input></input>",{name: "uwagi", type: "text", value: "", class: "form-control input-sm"}),
			submiter = $("<a></a>",{ href: '#prompt', id: 'delete', class: 'btn btn-info btn-xs send'}).text("Wyślij");
			nam.append(inNam);
			sur.append(inSur);
			pri.append(inPri);
			com.append(inCom);
			but.append(submiter);
			
			row.append(ind);
			row.append(nam);
			row.append(sur);
			row.append(pri);
			row.append(dat);
			row.append(com);
			row.append(dod);
			row.append(but);
			console.log(row);
			
			$("tbody").append(row);
}

function sprawdzCzyWyp(){
	var name = $("tbody tr").last().find("input[name='imie']"),
	surname = $("tbody tr").last().find("input[name='nazwisko']"),
	price = $("tbody tr").last().find("input[name='kwota']");
	
	if(name.val() == '' )
	{ name.css('backgroundColor','cyan');
	return false; }
	else if(surname.val() == '')
	{ surname.css('backgroundColor','cyan');
	return false; }
	else if(price.val() == '')
	{ price.css('backgroundColor','cyan');
	return false;}
	
	return true; 
}
	
$("#nowyRekord").click(function(){
		if(disable == true)
		{ return; }
		
		$(".paginacja").last().click();
		
		nowyRekord();
		disable=true;
		
		$(document.documentElement).on("keyup", function(e){
		if(e.keyCode==27)
			{
				$("#new").remove();
				disable = false;
			}
		});
		
		$(".send").click(function(){
			if(sprawdzCzyWyp())
			{ 
				var name = $("tbody tr").last().find("input[name='imie']").val(),
				surname = $("tbody tr").last().find("input[name='nazwisko']").val(),
				payback = $("tbody tr").last().find("input[name='kwota']").val(),
				comment = $("tbody tr").last().find("input[name='uwagi']").val();
				var data = "imie="+name+"&nazwisko="+surname+"&kwota="+payback+"&uwagi="+comment+"&dodano=1";
				console.log(data);
				$.ajax({
					type: 'POST',
					url: "script/_php/confirm.php",
					data: data,
					dataType: 'html',
					async: false,
					success: function(result){
						var index = $("tbody tr").last().find("#index").text();
						$("#new").remove();	
						$("tbody").append(result);
						$("tbody tr").last().find("#index").text(index);
						$('.delete').click(usuwanie);
						$("tr").dblclick(edytowanie);
					}});
				
				disable = false;
			}
			else
			{alert('niewypelnione');}
			});
});

$(".paginacja").click(function(){
	$(".active").removeClass("active");
	$(this).addClass("active");
	var data = "strona="+$(this).data("page");
	console.log(data);
	
	$.ajax({
	type: 'POST',
	url: "script/_php/paginacja.php",
	data: data,
	dataType: 'html',
	async: false,
	success: function(result){
		$("tbody tr").not("#table-header").remove();	
		$("tbody").append(result);
		$('.delete').click(usuwanie);
		$("tr").dblclick(edytowanie);
	}});
});


});