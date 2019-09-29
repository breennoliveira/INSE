<?php  if (count($errors) > 0) : ?>
<?php foreach ($errors as $error) : ?>
  	  <div class='alert alert-danger alert-dismissible' role='alert'><?php echo $error ?>
	   <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button></div>
 <?php endforeach ?>
<?php  endif ?>