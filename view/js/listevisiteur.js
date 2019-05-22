//function recuperation visiteur dans la base de données

function rep_Visiteur()
{
	$.post('model/affichvisiteur.php',function(data){
		$('.vizi').html(data);
	});

}
setInterval(rep_Visiteur,1000);
rep_Visiteur();
