<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Procedures</title>
		<!--[if lt IE 9]>
		<script src="./js/html5.js"></script>
		<![endif]-->
		<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript">
			var current;
			var page;
			function formAtUpdate() {
				
				$("form").submit(function(e){
					var str = $("form").serialize();
					$.ajax({ 
						url: page, 
						data: str,
						type: "POST",
						success:function(html){ 
							afficher(html);
						}
					});
					return false;
				});
			}
			$(document).ready(function(){   // le document est chargé
				$("nav ul li a").click(function(){   // on selectionne tous les liens et on définit une action quand on clique dessus
					page=('./pages/'+($(this).attr("title"))+'.php'); // on recuperer l' adresse du lien $(this).attr("href")
					current = $(this).attr("title");
					$.ajax({ // ajax
						url: page, // url de la page à charger
						success:function(html){ // si la requête est un succès
							afficher(html);     // on execute la fonction afficher(donnees)
						}
					});
					return false; // on desactive le lien
				});
			});
			function afficher(donnees){ // pour remplacer le contenu du div contenu
				$('section').slideUp('slow', function(){
					$("section").empty(); // on vide le div
					$("section").append(donnees); // on met dans le div le résultat de la requête ajax
					$('section').slideDown('slow', formAtUpdate());
				});
			}
		</script>
		<link rel="stylesheet" type="text/css" href="./css/style.css" media="screen, tv, projection" />
    </head>
    <body>
	    <?php
	    	include('elements/header.php');
		?>
		<div class="br"></div>
		<?php
	    	include('elements/menu.php');
	    ?>
	    <section>
	    	<?php
	    		$_GET['p'] = (string)((!empty($_GET['p'])?$_GET['p']:'accueil'));
				if(file_exists('pages/'.$_GET['p'].'.php'))
	    			include('pages/'.$_GET['p'].'.php');
				else
					include('pages/accueil.php');
	    	?>
	    </section>
	    <div class="br"></div>
		<?php
			include('elements/footer.php');
		?>
    </body>
</html>