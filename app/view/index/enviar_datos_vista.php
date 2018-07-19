	<h2>Ejemplo: envío de datos a la vista</h2>
	<p class="text-justify">
		Desde el controlador puedes enviar datos de la forma <strong>$this->set("nombre","valor");</strong> y en la vista puedes recibirlo como <strong> $v->get("nombre"); </strong>
	</p>
	<div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
		<div class="panel-body"> <strong>Numero:</strong> <?php echo $v->get("num") ?> </div> 
	</div>
	<div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
		<div class="panel-body"> <strong>Nombre:</strong> <?php echo $v->get("name") ?> </div> 
	</div>
	<div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
		 <div class="panel-body"> <strong>E-mail: </strong> <?php echo $v->get("mail") ?> </div> 
	</div>
	<div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
             <div class="panel-body"> 
                 <p>Tambien puedes llamar tus datos en formato json.</p>
                 <strong>json: </strong> <?php echo $v->get("json") ?> 
             </div> 
    </div>

