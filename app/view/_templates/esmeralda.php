<!DOCTYPE html> 
<html lang="es">
	<head>
        <title>Kurmix Framework</title>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="public/favicon.ico" rel="icon" type="ico"> 
	    <!-- CSS de Bootstrap -->
	    <link href="public/css/bootstrap.css" rel="stylesheet" media="screen">
	    <link href="public/css/esmeraldacss.css" rel="stylesheet" media="screen">
	    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->    
	</head>
    <body>
    	<br>
    	<div class="kurbody container">
	  		<div id="kur-header">
	  			<div class="kur-search">
	  				<form class="navbar-form navbar-left" style="margin: 0;padding: 0;">
				        <div class="form-group">
				          <input type="text" class="form-control" placeholder="Buscar">
				        </div>
				    </form>
	  			</div>
	  		</div>
	  		
	  		<div class="row kur-nav">
	  			<ul class="nav navbar-nav">
			        <li class="active"><a href="?">Inicio <span class="sr-only">(current)</span></a></li>		        
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ejemplos <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="?k=index/hola">Hola mundo</a></li>
			            <li><a href="?k=index/enviar_datos_vista">Enviar datos a la vista</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="?k=index/otra_plantilla">Otra plantilla</a></li>
			          </ul>
			        </li>
			     </ul>
	  		</div>

			<div class="row" style="padding: 10px;">                
				<!-- body --> 
		        	<div class="col-lg-8">
		            	<div class="panel panel-body text-center">
		                	<?php include $v->body; ?>
		            	</div>
		            	<?php include $v->partial("right"); ?>
					</div>
				<!-- fin body -->        
                <div class="col-lg-4">	                
                    <?php include $v->partial("left"); ?>             			                    
                </div>
            </div>
		
			<footer class="footer">
			    <div class="text-right">
			        <p class="text-muted">Powered by <a href="https://www.kurmix.org" target="_blank" style="color:#337ab7;">kurmix.org</a></p>
			    </div>
			</footer>
		</div>
		<br>
<!-- scripts -->
    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.js"></script>
<!-- fin scripts -->        <!-- fin footer -->
    
		
	</body>
</html>