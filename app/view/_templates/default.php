<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include $v->partial("head"); ?>
    </head>
    <body>
	  	<!-- navbar -->
			<?php include $v->partial("navbar"); ?>
		<!-- fin navbar -->
		<div class="container">
            <div class="row">
                <div class="col-lg-3">				
                   <?php include $v->partial("left"); ?>
                </div>
				<!-- body --> 
		        	<div class="col-lg-6">
		            	<div class="panel panel-body text-center">
		                	<?php include $v->body; ?>
		            	</div>
					</div>
				<!-- fin body -->        
                <div class="col-lg-3">				
                    <?php include $v->partial("right"); ?>
                </div>
            </div>		
		</div>
		<!-- footer -->			
			<?php include $v->partial("footer"); ?>
        <!-- fin footer -->
    </body>
</html>