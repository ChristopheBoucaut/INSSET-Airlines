$(document).ready(function(){
	$('#content-menu a').live('click', function(e){
		e.preventDefault();
		disabledLink($(this));
	})
	
	$('#content-menu form').live('submit', function(e){
		e.preventDefault();
		disabledForm($(this));
	})
});

/**
 * Permet de changer le comportement de tous les liens dans le menu et le contenu qui change en fonction d'ajax
 * @param: Object(JQuery) lien_clique
 * @return: void
 **/
function disabledLink(lien_clique){	
	var url = lien_clique.attr("href");
	
	/*
	 * Lance la requête ajax vers la page désirée lors du clique
	 */
	$.ajax({
		url: url,
		success: function(data) {
			$('#content-ajax').html(data);
		},
		error: function(){
			var div_error = $('<div>',{
				class:"erreur-chargement",
				html:"Erreur lors du chargement de la page. Contacter l'administrateur."});
			$('#content-ajax').empty();
			$('#content-ajax').append(div_error);
		  }
	});
}

/**
 * Permet de changer le comportement de tous les formulaire contenu dans la partie changeant en fonction d'ajax
 * @param: Object(JQuery) lien_clique
 * @return: void
 **/
function disabledForm(form_submit){
		
}