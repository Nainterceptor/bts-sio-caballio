<?php 
define('INDEX', true);
?>
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
			    lienAjax();
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
			function lienAjax() {
			    $("a").unbind('click');
                $("a").click(function(){
                    page=('./pages/'+($(this).attr("title"))+'.php');
                    var data = '';
                    if($(this).attr('data') != null)
                        data = 'id='+$(this).attr('data');
                    $.ajax({
                        url: page,
                        data: data,
                        success:function(html){ 
                            afficher(html); 
                        }
                    });
                    return false;
                });
			}
			$(document).ready(function(){
                lienAjax();
			});
			function afficher(donnees){
				$('section').slideUp('slow', function(){
					$("section").empty();
					$("section").append(donnees);
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